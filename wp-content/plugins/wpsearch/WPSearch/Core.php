<?php
/**
 * This file acts as the 'Controller' of the application. It contains a class
 *  that will load the required hooks, and the callback functions that those
 *  hooks execute.
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

require_once dirname(__FILE__) . '/Ajax.php';
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/Document.php';
require_once dirname(__FILE__) . '/Benchmark.php';
require_once dirname(__FILE__) . '/Log.php';
require_once dirname(__FILE__) . '/Model.php';
require_once dirname(__FILE__) . '/Net.php';
require_once dirname(__FILE__) . '/Search.php';
require_once dirname(__FILE__) . '/Utility.php';
require_once dirname(__FILE__) . '/View.php';
require_once dirname(__FILE__) . '/Drivers/Search.php';
require_once dirname(__FILE__) . '/Exception.php';

if (! class_exists('WPSearch_Core')):

/**
 * This class contains the core code and callback for the behavior of Wordpress.
 *  It is instantiated and executed directly by the WPSearch plugin loader file
 *  (which is most likely at the root of the WPSearch installation).
 */
class WPSearch_Core
{
    CONST KEY_INDEX_CATEGORIES    = 'WPSearch_Index_Categories';
    CONST KEY_INDEX_COMMENTS      = 'WPSearch_Index_Comments';
    CONST KEY_INDEXED_CATEGORIES  = 'WPSearch_Indexed_Categories';
    CONST KEY_INDEXED_COMMENTS    = 'WPSearch_Indexed_Comments';
    CONST KEY_INSTALL_REPORT      = 'WPSearch_Install_Report';
    CONST KEY_LAST_MESSAGE        = 'WPSearch_Last_Message';
    CONST KEY_LAST_MESSAGE_DATE   = 'WPSearch_Last_Message_Date';
    CONST KEY_TITLE_BOOST         = 'WPSearch_Key_Title_Boost';
    CONST KEY_CONTENT_BOOST       = 'WPSearch_Key_Content_Boost';
    CONST KEY_SEARCH_TYPES        = 'WPSearch_Key_Search_Types';

    CONST DEFAULT_TITLE_BOOST     = 50;
    CONST DEFAULT_CONTENT_BOOST   = 30;

    CONST DEFAULT_BASE_LOW        = 0;
    CONST DEFAULT_BASE_HIGH       = 100;

    public static $_defaultSearchTypes = array ('post', 'page');

    public static $_page          = 0;
    public static $_perPage       = 10;

    private static $_addPostHookRan  = FALSE;
    private static $_editPostHookRan = FALSE;

    /**
     * The constructor
     */
    public function __construct()
    {
        WPSearch_Log::add('debug', "WPSearch initializing..");
    }

    /**
     * Get the WPSearch environment loaded and register Wordpress hooks
     */
    public function execute()
    {
        $this->_registerHooks();
    }

    /**
     * Register Wordpress hooks required for WPSearch
     */
    private function _registerHooks()
    {
        WPSearch_Log::add('debug', "Registering hooks..");

        # -- Below is core functionality --
        # TODO: Find out if the below is needed
        add_action('edit_post', 	array($this, 'editCallback'  ));
        add_action('delete_post', 	array($this, 'deleteCallback'    ));
        add_action('publish_post', 	array($this, 'postCallback'      ));
        add_action('publish_page', 	array($this, 'pageCallback'      ));
        add_action('admin_menu', 	array($this, 'adminCallback'     ));
        add_action('admin_init', 	array($this, 'adminInitCallback' ));
        add_action('admin_notices',     array($this, 'adminWarningCallback'));
        add_filter('posts_where', 	array($this, 'searchCallback'    ));
        add_filter('post_limits', 	array($this, 'limitCallback'     ));
        add_filter('the_posts', 	array($this, 'queryCallback'     ));

        # -- Below is administration AJAX functionality
        add_action('wp_ajax_get_stats',              array('WPSearch_Ajax', 'getStats'));
        add_action('wp_ajax_save_index_comments'   , array('WPSearch_Ajax', 'saveIndexComments'));
        add_action('wp_ajax_save_index_categories' , array('WPSearch_Ajax', 'saveIndexCategories'));
        add_action('wp_ajax_save_title_boost'      , array('WPSearch_Ajax', 'saveTitleBoost'));
        add_action('wp_ajax_save_content_boost'    , array('WPSearch_Ajax', 'saveContentBoost'));
        add_action('wp_ajax_save_search_types'     , array('WPSearch_Ajax', 'saveSearchTypes'));
        add_action('wp_ajax_rebuild_index'         , array('WPSearch_Ajax', 'rebuildIndex'));
        add_action('wp_ajax_search'                , array('WPSearch_Ajax', 'search'));
        add_action('wp_ajax_nopriv_search'         , array('WPSearch_Ajax', 'search'));
    }

    /**
     * A callback called whenever a post is edited or commented on
     * @param int $postId The id of the post/page
     */
    public function editCallback($postId)
    {
        WPSearch_Log::add('debug', "Edit post callback executed for post #$postId");
        if(self::$_addPostHookRan) return;
        WPSearch_Search::instance()->addToIndex($postId);
        self::$_editPostHookRan = TRUE;
    }

    /**
     * A callback executed whenever a post/page is deleted
     * @param int $postId
     */
    public function deleteCallback($postId)
    {
        WPSearch_Log::add('debug', "Page/Post delete callback executed for post #$postId");
        WPSearch_Search::instance()->removeFromIndex($postId);
    }

    /**
     * A callback executed wheeever a post is posted
     * @param int $postId
     */
    public function postCallback($postId)
    {
        WPSearch_Log::add('debug', "Post published callback executed for post #$postId");
        if(self::$_editPostHookRan) return;
        WPSearch_Search::instance()->addToIndex($postId);
        self::$_addPostHookRan = TRUE;
    }

    /**
     * A callback executed whenever a page is published
     * @param int $postId
     */
    public function pageCallback($postId)
    {
        WPSearch_Log::add('debug', "Page published callback executed for post #$postId");
        WPSearch_Search::instance()->addToIndex($postId);
    }

    /**
     * A callback executed whenever the user tried to access the WPSearch admin page
     */
    public function adminCallback()
    {
        add_options_page('WPSearch Settings', 'WPSearch 2', 'edit_pages', 'wpsearch/wpsearch.php', array($this, 'adminMenuCallback'));
    }

    /**
     * Emit a warning that the search index hasn't been built (if it hasn't)
     */
    public function adminWarningCallback()
    {
        $stats = WPSearch_Search::instance()->getStats();

        if(!$stats->last_rebuild)
            WPSearch_View::load('_buildWarning');
    }

    /**
     * A callback executed when the admin page callback is a about to be called.
     *  Use this for loading stylesheets/css.
     */
    public function adminInitCallback()
    {
        # Only register javascript and css if the wpsearch admin page is loading
        if(strstr($_SERVER['QUERY_STRING'], 'wpsearch') === FALSE) return;

        wp_enqueue_style ('wpsearch-styles',  WPSearch_Utility::getCSSBaseURL() . 'wpsearch.css');
        wp_enqueue_style ('jquery-theme',    'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
        wp_enqueue_style ('multisel-styles',  WPSearch_Utility::getCSSBaseURL() . 'jquery.multiselect.css');
        wp_enqueue_script('wpsearch-timers',  WPSearch_Utility::getJSBaseURL().'jquery.timers-1.2.js');
        wp_enqueue_script('wpsearch-slider',  'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
        wp_enqueue_script('wpsearch-multis',  WPSearch_Utility::getJSBaseURL().'jquery.multiselect.min.js');
        wp_enqueue_script('wpsearch-main'  ,  WPSearch_Utility::getJSBaseURL().'wpsearch.js');
    }

    /**
     * A callback executed whenever Wordpress is building the WHERE clause for
     *  a search. The goal here is to append a condition which could never be
     *  possible (0 = 1) so MySQL instantly returns an empty result set.
     *
     * This will clear the way for inserting our own results.
     * 
     * @param string $where The original WHERE clause
     * @return string The impossible WHERE clause
     */
    public function searchCallback($where)
    {
        if(! WPSearch_Search::instance()->isReady()) return $where;
        
        # Cut off the default Wordpress SQL search
        if (is_search() && !is_admin())
        {
            $where = "AND (0=1)";
        }

    	return $where;
    }

    /**
     * Parse out the limit and offset values from the limit clause. We'll use
     *  this to figure out with page number we need to grab, and how many
     *  results we should find. We'll then store them as class variables for
     *  future use.
     * 
     * @param string $limit_clause
     * @return string The same limit clause
     */
    public function limitCallback($limit_clause)
    {
        if(! WPSearch_Search::instance()->isReady()) return $limit_clause;
        # Parse out the range of search items to retreive
        if(is_search() && !is_admin())
        {
            WPSearch_Log::add('debug', "Query limit callback executed");
            
            $limit                      = str_replace("LIMIT", "", $limit_clause);
            list($offset, $limit) 		= split(",", $limit);

            $offset = intval($offset);
            $limit  = intval($limit);

            self::$_page    = $offset / $limit;
            self::$_perPage = $limit;
        }

        return $limit_clause;
    }

    /**
     * 
     * @global object $wp_query The Wordpress query object (available from the Wordpress env.)
     * @global object $wp The Wordpress super-oobject, also available from the Wordpress env.
     * @param array $posts The array of posts Wordpress found originall. This should be empty
     *   from the LIMIT clause manipulation hook
     * @return array[WPSearch_Document] An array of objects that maintain all of the
     *   properties expected of the Wordpress search results
     */
    public function queryCallback($posts)
    {
        if(!is_search() || is_admin()) return $posts;

        WPSearch_Log::add('debug', "Search callback executed");

        global $wp_query; # Think I like doing this? You're off your rocker
	global $wp;       # Wp super object
        
        $term = array();
        $term['q']        = $wp->query_vars["s"]; # The search term
        $term['page']     = self::$_page;
        $term['per_page'] = self::$_perPage;

        $category_id = WPSearch_Utility::arrayGet($_GET, 'c_id', FALSE);

        if($category_id !== FALSE) $term['category_id'] = $category_id;

        if(! WPSearch_Search::instance()->isReady())
        {
            WPSearch_Log::add('debug', "Search is in execution for term '{$term['q']}', but the driver is either not installed or indexing."
                                      ." Falling back to Wordpress search..");
            return $posts;
        }

        $count_per_page = self::$_perPage;

        $posts = array(); # Empty what should be an empty array

        WPSearch_Log::add('debug', "Grabbing term from Wordpress query variabled ({$term['q']})");

        try
        {
            $result = WPSearch_Search::instance()->search($term, self::$_page, self::$_perPage);
            $wp_query->found_posts   = count($result->hits);
            $wp_query->max_num_pages = ceil($result->total / $count_per_page);

            WPSearch_Log::add('debug', "Total number of posts found: {$result->total}");
            WPSearch_Log::add('debug', "Set Wordpress vars - # Retrieved posts for page, {$wp_query->found_posts}; # Pages, {$wp_query->max_num_pages}");
            return $result->hits;
        }
        catch (Exception $ex)
        {
            $wp_query->found_posts   = 0;
            $wp_query->max_num_pages = 0;
            WPSearch_Log::add('error', "There was an error searching the index!" . $ex->__toString());
            return array();
        }
    }

    /**
     * The callback that is executed when the user is loading the admin page.
     *  Basically, output the page content for the admin page. The function
     *  acts just like a controller method for and MVC app. That is, it loads
     *  a view.
     */
    public function adminMenuCallback()
    {
        WPSearch_Log::add('debug', "Admin page callback executed");
        WPSearch_Utility::sendInstallReportIfNew();

        $stats   = WPSearch_Search::instance()->getStats();
        $about   = WPSearch_Search::instance()->getAbout();
        $errors  = WPSearch_Search::instance()->runTests();
        
        $search_types = unserialize(WPSearch_Utility::getOption(self::KEY_SEARCH_TYPES, FALSE));
        $search_types = ($search_types !== FALSE ? $search_types : self::$_defaultSearchTypes);
        
        $data = array();

        if($about)
        {
            $data['is_alive']          = true;
            $data['total_docs']        = $stats->total;
            $data['indexed_docs']      = $stats->current;
            $data['is_building']       = $stats->reindexing;
            $data['last_reindex']      = $stats->last_rebuild;
            $data['about']             = $about;
            $data['errors']            = $errors;
            $data['searched_types']    = $search_types;
            $data['post_types']        = get_post_types();
            $data['index_comments']    = (WPSearch_Utility::getOption(self::KEY_INDEX_COMMENTS)    == 'true');
            $data['index_categories']  = (WPSearch_Utility::getOption(self::KEY_INDEX_CATEGORIES)  == 'true');
            $data['indexed_comments']  = (WPSearch_Utility::getOption(self::KEY_INDEXED_COMMENTS)  == 'true');
            $data['indexed_categories']= (WPSearch_Utility::getOption(self::KEY_INDEXED_CATEGORIES)== 'true');
            $data['title_boost']       = (WPSearch_Utility::getOption(self::KEY_TITLE_BOOST, self::DEFAULT_TITLE_BOOST));
            $data['content_boost']     = (WPSearch_Utility::getOption(self::KEY_CONTENT_BOOST, self::DEFAULT_CONTENT_BOOST));
            $data['service_tag']       = WPSearch_Utility::getServiceTag();
        }
        else
        {
            $data['is_alive']     = false;
            $data['error_message']= 'The backend WPSearch Driver is not responding.';
        }

        WPSearch_View::load('admin', $data);
    }
}

endif;