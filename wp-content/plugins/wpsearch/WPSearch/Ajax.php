<?php
/**
 * This file contains a class which provides the AJAX callback functions required
 *  for WPSearch.
 *
  * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * A class containing functions for the AJAX functionality in WPSearch. These
 *  aren't executed directly by any WPSearch code -- they are registered with
 *  the Wordpress hooks in WPSearch_Core::_registerHooks(), and called as needed
 *  by the front-end and Wordpress. All of these methods output JSON.
 */
class WPSearch_Ajax
{
    /**
     * Return the index status object
     */
    public static function getStats()
    {
        die(json_encode(WPSearch_Search::instance()->getStats()));
    }

    /**
     * Save a boolean value of whether to index comments on the next rebuild
     */
    public static function saveIndexComments()
    {
        WPSearch_Utility::setOption(WPSearch_Core::KEY_INDEX_COMMENTS, $_POST['value']);
        die(json_encode(array('success' => true)));
    }

    /**
     * Save a boolean value of whether to index categories on the next rebuild
     */
    public static function saveIndexCategories()
    {
        WPSearch_Utility::setOption(WPSearch_Core::KEY_INDEX_CATEGORIES, $_POST['value']);
        die(json_encode(array('success' => true)));
    }

    /**
     * Save a numerical value of the amount to boost the title
     */
    public static function saveTitleBoost()
    {
        WPSearch_Utility::setOption(WPSearch_Core::KEY_TITLE_BOOST, $_POST['value']);
        die(json_encode(array('success' => true)));
    }

    /**
     * Save a comma-delimted string containing Wordpress search types as an array
     */
    public static function saveSearchTypes()
    {
        $types = (is_array($_POST['value']) ? $_POST['value'] : array());
        WPSearch_Utility::setOption(WPSearch_Core::KEY_SEARCH_TYPES, serialize($types));
        die(json_encode(array('success' => true)));
    }

    /**
     * Save a numerical value of the amount to boost the content
     */
    public static function saveContentBoost()
    {
        WPSearch_Utility::setOption(WPSearch_Core::KEY_CONTENT_BOOST, $_POST['value']);
        die(json_encode(array('success' => true)));
    }

    /**
     * Start the rebuild process and save any necesarry status flags
     */
    public static function rebuildIndex()
    {
        $indexed_comments   = WPSearch_Utility::getOption(WPSearch_Core::KEY_INDEX_COMMENTS);
        $indexed_categories = WPSearch_Utility::getOption(WPSearch_Core::KEY_INDEX_CATEGORIES);
        
        WPSearch_Utility::setOption( WPSearch_Core::KEY_INDEXED_COMMENTS,
                                     $indexed_comments);


        WPSearch_Utility::setOption( WPSearch_Core::KEY_INDEXED_CATEGORIES,
                                     $indexed_categories);

        $indexed_comments   = ($indexed_comments   == 'true');
        $indexed_categories = ($indexed_categories == 'true');
        
        $success = WPSearch_Search::instance()->buildFullIndex($indexed_comments, $indexed_categories);
        
        die(json_encode(array('success' => $success)));
    }

    /**
     * An ajax method that will search the index (you can specify the driver)
     * and return results in JSON format.
     */
    public static function search()
    {
        $driver     = WPSearch_Utility::arrayGet($_POST, 'driver');
        $term       = WPSearch_Utility::arrayGet($_POST, 'q');
        $page       = WPSearch_Utility::arrayGet($_POST, 'p', 0);
        $per_page   = WPSearch_Utility::arrayGet($_POST, 'n', 5);

        if(!$term) die(json_encode(array('success' => false)));

        try
        {
            $search  = new WPSearch_Search($driver);

            $start       = microtime(true);
            $results     = $search->search($term, $page, $per_page);
            $search_time = round((microtime(true) - $start), 3);

            # Return seconds without the leading 0
            if(substr($search_time, 0, 1) == '0')
                $search_time = substr($search_time, 1);
        }
        catch(WPSearch_Exception $ex)
        {
            WPSearch_Log::add('error', "Exception during AJAX search call: ".$ex->__toString());
            die(json_encode(array('success' => false)));
        }
        
        die(json_encode(array('success' => true, 'search_time' => $search_time, 'result' => $results)));
    }
}