<?php
/**
 * This file contains a class for utility methods and/or wrappers for built-in
 *  Wordpress API calls
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * The class contains a number of utility methods that may be needed by various
 *  parts of WPSearch
 */
class WPSearch_Utility
{
    /**
     * Sets a Wordpress option
     * @param string $name The name of the option to set
     * @param string $value The value of the option to set
     */
    public static function setOption($name, $value)
    {
        if($value != '')
        {
            if (get_option($name) !== FALSE)
            {
                update_option($name, $value);
            }
            else
            {
                $deprecated = ' ';
                $autoload   = 'no';
                add_option($name, $value, $deprecated, $autoload);
            }
        }
    }

    /**
     * Gets a Wordpress option
     * @param string    $name The name of the option
     * @param mixed     $default The default value to return if one doesn't exist
     * @return string   The value if the option does exist
     */
    public static function getOption($name, $default = FALSE)
    {
        $value = get_option($name);
        if( $value !== FALSE ) return $value;
        return $default;
    }

    /**
     * Get a value from an associative array. The specified key may or may
     *  not exist.
     * @param array $array Array to grab the value from
     * @param mixed $key The key to check the array
     * @param mixed $default A value to return if the key doesn't exist int he array (default is FALSE)
     * @return mixed The value if the key exists, and the default if it doesn't
     */
    public static function arrayGet($array, $key, $default = FALSE)
    {
        if(array_key_exists($key, $array))
            return $array[$key];
        else
            return $default;
    }

    /**
     * Get the base URL of the plugin installation
     * @return string the base URL
     */
    public static function getWPSearchBaseURL()
    {
        return (get_bloginfo('url') . '/wp-content/plugins/wpsearch/WPSearch/');
    }

    /**
     * Get the base URL for plugin images
     * @return string
     */
    public static function getImageBaseURL()
    {
        return self::getWPSearchBaseURL() . 'Public/img/';
    }

    /**
     * Get the base url for plugin CSS
     * @return string
     */
    public static function getCSSBaseURL()
    {
        return self::getWPSearchBaseURL() . 'Public/css/';
    }

    /**
     * Get the base URL for plugin javascript
     * @return string
     */
    public static function getJSBaseURL()
    {
        return self::getWPSearchBaseURL() . 'Public/js/';
    }

    /**
     * Close a connection with the client, but keep PHP execution alive.
     * @param string $data Any data to send to the client/browser.
     * @param int $time_limit
     */
    public static function killConnectionAndContinue($data = '', $time_limit = 0)
    {
        ignore_user_abort(true);
        set_time_limit($time_limit);

        header("Connection: close");
        header("Content-Length: " . strlen($data));
        echo $data;
        flush();
    }

    /**
     * Check to see if a process with a given PID is running
     * @param int $pid The PID of the process in question
     * @return bool True if the process is running, false if not
     */
    public static function isProcessRunning($pid)
    {
        $output = array();
        exec('ps -A -o pid', $output);
        $pid = intval($pid);

        foreach($output as $running_pid)
        {
            if($pid == intval(trim($running_pid)))
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Set PHP to call WPSearch's custom handlers for Exceptions and Erros.
     *  This is used mainly for when drivers will still be running in the
     *  background doing something like an index build
     */
    public static function registerLogErrorHandlers()
    {
        set_error_handler(array(__CLASS__, 'handleError'));
        set_exception_handler(array(__CLASS__, 'handleException'));
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        WPSearch_Log::add('error', "Error [$errno]: '$errstr' in $errfile:$errline");
    }

    public static function handleException(Exception $ex)
    {
        WPSearch_Log::add('error', "Exception: ".$ex->__toString());
    }

    /**
     * Makes a call to the WPSearch service to collect information information
     *  on the blog in case of errors and other needs.
     */
    public static function sendReport($message = FALSE)
    {
        $base   = 'http://report.wpsearch2.com?';
        $report = array();
        $report['t'] = get_bloginfo('name');
        $report['u'] = get_bloginfo('url');
        $report['e'] = get_bloginfo('admin_email');
        $report['c'] = WPSearch_Model::getPublishedPostCount();
        $report['d'] = WPSearch_Config::get('driver', 'NONE?');
        $report['v'] = WPSEARCH_VERSION;

        if($message)
            $report['m'] = $message;

        $report = http_build_query($report);

        return @file_get_contents("{$base}{$report}");
    }

    /**
     * If this is a new installation and we've never sent a report to the
     * WPSearch server, send a packet of basic info about this blog in case
     * issues should arise in the future.
     */
    public static function sendInstallReportIfNew()
    {
        $sent = self::getOption(WPSearch_Core::KEY_INSTALL_REPORT);

        if($sent === FALSE)
        {
            self::sendReport("Installation");
            self::setOption(WPSearch_Core::KEY_INSTALL_REPORT, 'true');
        }
    }

    /**
     * Get any reports / warnings / messages from the WPSearch server.
     * @return mized A string if a message was found, FALSE if not
     */
    public static function getWPSearchMessage()
    {
        //self::setOption(WPSearch_Core::KEY_LAST_MESSAGE_DATE, time() - 60*60*13);
        $date = self::getOption(WPSearch_Core::KEY_LAST_MESSAGE_DATE);

        if($date !== FALSE && ($date + 12*60*60) > time())
            return self::getOption(WPSearch_Core::KEY_LAST_MESSAGE);

        $driver = WPSearch_Config::get('driver');
        $count  = WPSearch_Model::getPublishedPostCount();

        $url     = "http://report.wpsearch2.com/messages?d=$driver&c=$count";
        $content = file_get_contents($url);

        self::setOption(WPSearch_Core::KEY_LAST_MESSAGE, $content);
        self::setOption(WPSearch_Core::KEY_LAST_MESSAGE_DATE, time());

        if(strlen($content) == 0 || $content == "0")
            return FALSE;

        return $content;
    }

    /**
     * Given a boost value (probably between 0 and 100, scale it between to
     *  other values most likely specific to a driver)
     * @param float $boost_value The value to be scaled
     * @param float $low The lower bound of the boost value
     * @param float $high The upper bound of the boost value
     * @return float The scaled value
     */
    public static function getScaledBoostValue($boost_value, $low, $high)
    {
        return round(($boost_value / (WPSearch_Core::DEFAULT_BASE_HIGH - WPSearch_Core::DEFAULT_BASE_LOW))
                * ($high - $low) + $low, 
                1);
    }

    /**
     * Return a unique identifier for the site for use with future help requests
     * @return string A unique identifier
     */
    public static function getServiceTag()
    {
        return md5($report['u'] = get_bloginfo('url'));
    }
}