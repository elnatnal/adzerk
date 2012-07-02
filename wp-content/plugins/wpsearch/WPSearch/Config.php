<?php
/**
 * This file contains a class which holds WPSearch's configuration information
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * A class which acts as the source and accessor of all of WPSearch's configuration
 *  information.
 */
class WPSearch_Config
{
    /**
     * Load up all of WPSearch's configuration values. This currently where
     *  configuration otpions should be set too..
     */
    public function setConfig()
    {
        $config = array();
        # Set config values below

        $config['driver']         = 'phplucene';
        $config['driver-configs'] = array (

            

            /*phplucene_start*/
            'phplucene' => array (
                'index-path'     => dirname(__FILE__) . '/Backends/Phplucene/data/',
                'zend-path'      => dirname(__FILE__) . '/Backends/Phplucene/Zend/',
                'analyzer-path'  => dirname(__FILE__) . '/Backends/Phplucene/StandardAnalyzer/',
                'tmp-path'       => dirname(__FILE__) . '/Backends/Phplucene/tmp/'
            ),
            /*phplucene_end*/

            

            
        );

        $config['log'] = array (

            'level'     => WPSearch_Log::ERROR,
            'directory' => '/tmp/wpsearch/'

        );

        # End config
        $this->_config = $config;
    }

    /**
     * The instance of this config class
     * @var WPSearch_Config
     */
    private static $_instance = NULL;

    /**
     * The config array for this class
     * @var array
     */
    private $_config          = NULL;

    /**
     * The constructor for this class
     */
    public function __construct()
    {
        $this->setConfig();
    }

    /**
     * Set a configuration value
     * @param string $key The key to store the variable as
     * @param string $value The value to store for the key
     * @return mixed The value that was set
     */
    public static function set($key, $value)
    {
        return self::_getInstance()->setValue($key, $value);
    }

    /**
     *
     * @param string $key The key of the config value to retrieve. If the
     *  config item is nested in subarrays, you can use dot-separated strings
     *  to specifykey items. For example, given a config setup like:
     *
     *  $config['driver-configs'] = array (
     *      'Javalucene' = array (
     *          port => '12345',
     *          host => 'localhost'
     *      )
     *  )
     *
     * I could use WPSearch_Config::get('driver-configs.Javalucene.port') to get
     *  the port.
     * @param string $default A value to return if the key wasn't found
     * @return string The configuration value
     */
    public static function get($key = FALSE, $default = FALSE)
    {
        return self::_getInstance()->getValue($key, $default);
    }

    /**
     * Set an internal config value. This is not meant to be called directly
     *  outside of this class.
     * @param string $key The key to store the variable as
     * @param string $value The value to store for the key
     * @return mixed The value that was set
     */
    public function setValue($key, $value)
    {
        return $this->_config[$key] = $value;
    }

    /**
     * The internal method for getting a config value. This method is not meant
     *  to be accessed directly outside of this class, so use WPSearch_Config::get()
     *  instead.
     * @param string $key The config value name
     * @param string $default A value to return if the key wasn't found
     * @return string The configuration value
     */
    public function getValue($key = FALSE, $default = FALSE)
    {
        if($key === FALSE)
            return $this->_config;

        $config = $this->_config;
        $keys   = explode('.', $key);

        foreach($keys as $key)
        {
            if(array_key_exists($key, $config))
                $config = $config[$key];
            else
                return $default;
        }
        
        return $config;
    }

    /**
     * Return the instance of this class
     * @return WPSearch_Config
     */
    private static function _getInstance()
    {
        if(self::$_instance === NULL)
            self::$_instance = new self();

        return self::$_instance;
    }
}

define('WPSEARCH_VERSION', 'WPS-2.0.3.0');
