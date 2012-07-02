<?php
/**
 * This file contains the WPSearch library, which uses an internal driver
 *  to support it's core functionality
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * This is the class used to load and interact with the configured driver. All
 *  driver handling must take place through this class. Use the ::instance()
 *  method to get the driver.
 */
class WPSearch_Search
{

    /**
     * A handle of the loaded driver
     * @var WPSearch_Driver_Search
     */
    private $_driver          = NULL;

    /**
     * The internal instance of the search engine
     * @var WPSearch_Search
     */
    private static $_instance = NULL;

    /**
     * Holds the stats object for class-level caching
     * @var object
     */
    private static $_stats    = NULL;

    /**
     * Holds the about string for class level caching
     * @var string
     */
    private static $_about    = NULL;

    /**
     * Get an instance of the search engine
     * @return WPSearch_Search
     */
    public static function instance()
    {
        if(self::$_instance === NULL)
            self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * The Search library's constructor
     * @param string $cdriver Allow specification of the driver to be used. If
     *  this is omitted, the driver will be pulled from the config.
     */
    public function  __construct($cdriver = FALSE)
    {
        if(! $cdriver)
            $cdriver = WPSearch_Config::get('driver');
        
        $driver  = ucfirst(strtolower($cdriver));

        if(WPSearch_Config::get("driver-configs.$cdriver") === FALSE)
            throw new WPSearch_Exception("Driver '$cdriver' chosen, but there is no config available.");

        $driver_file = dirname(__FILE__)
                       . '/Drivers/Search/'
                       . $driver . '.php';

        if(!file_exists($driver_file))
        {
            WPSearch_Log::add('fatal', "Cannot find search driver named '$driver'");
            throw new WPSearch_Exception("Driver '$driver' does not exist");
        }

        require_once $driver_file;

         $driver = 'WPSearch_Drivers_Search_' . $driver;

        if(! class_exists($driver))
        {
            WPSearch_Log::add('fatal', "Driver file was loaded, but class '$driver' wasn't found");
            throw new WPSearch_Exception("Class '$driver' does not exist");
        }

        $this->_driver = new $driver();
        WPSearch_Log::add('info', "Driver '$driver' successfully loaded");
    }

    /**
     * Search over the index for documents matching the search string
     * @param string $term
     * @return array[WPSearch_Document]
     */
    public function search($term, $page = 0, $per_page = 10)
    {
        return $this->_driver->search($term, $page, $per_page);
    }

    /**
     * Add documents to the search index
     * @param array[WPSearch_Document] $documents
     * @return bool
     */
    public function addToIndex($documents)
    {
        return $this->_driver->addToIndex($documents);
    }

    /**
     * Delete items from the index
     * @param array $document_ids
     * @return boolean
     */
    public function removeFromIndex($document_ids)
    {
        return $this->_driver->removeFromIndex($document_ids);
    }

    /**
     * Rebuild the full search index
     * @return boolean
     */
    public function buildFullIndex($index_comments = FALSE, $index_categories = FALSE)
    {
        return $this->_driver->buildFullIndex($index_comments, $index_categories);
    }

    /**
     * Get an information string about the driver
     * @return string A string describing the plugin
     */
    public function getAbout()
    {
        if(self::$_about === NULL)
            return $this->_driver->getAbout();

        return self::$_about;
    }


    /**
     * Get information about when the last index was built, whether it is
     *  currently running a full build, and it's progress
     * @return object An object with properties:
     *  'last_index_build'
     *  'is_building'
     *  'total_to_index'
     *  'total_in_index'
     */
    public function getStats($cache = TRUE)
    {
        if(self::$_stats === NULL || $cache === FALSE)
            self::$_stats = $this->_driver->getStats();

        return self::$_stats;
    }

    /**
     * Check whether the backend is in a state where is can be used. Ie,
     *  the backend is running and it is not currently building the index
     * @return boolean
     */
    public function isReady()
    {
        $stats = $this->getStats();
        return (($stats !== FALSE) && !$stats->reindexing);
    }

    /**
     * Run any checks the driver has to do in order to run properly.
     * @return array An array of error messages if errors exist. An empty array
     *  if no errors exist
     */
    public function runTests()
    {
        return $this->_driver->runTests();
    }
}