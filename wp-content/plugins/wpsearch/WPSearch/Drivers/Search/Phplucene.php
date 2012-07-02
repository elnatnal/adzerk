<?php
/**
 * This file contains a driver for use with WPSearch 2.
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * The class is a driver for WPSearch 2 which depends on the port of Lucene to
 *  PHP by Zend
 */
class WPSearch_Drivers_Search_Phplucene extends WPSearch_Driver_Search
{
    /**
     *
     * @var Zend_Search_Lucene_Interface
     */
    private $_index      = NULL;

    /**
     * A status flag to check whether the Zend library has been loaded
     * @var bool
     */
    private $_zendLoaded = FALSE;

    /**
     * Holds the path to the Zend installation
     * @var string
     */
    private $_zendDirectory  = NULL;

    /**
     * Holds the path to where the index will be stored
     * @var string
     */
    private $_indexDirectory = NULL;

    /**
     * Holds the path to where a directory for storage for utility purposes
     *  will be held (statuses, etc)
     * @var string
     */
    private $_tmpPath        = NULL;

    /**
     * Holds the path to the custom StandardAnalyzer build for WPSearch for
     *  use with Zend
     * @var string
     */
    private $_analyzerPath   = NULL;

    /**
     * The lower bound of the boost range
     * @var int
     */
    private static $_boostRangeLow = 1;

    /**
     * The upper bound of the boost range
     * @var int
     */
    private static $_boostRangeHigh = 3;

    public function __construct()
    {
        $this->_indexDirectory = WPSearch_Config::get('driver-configs.phplucene.index-path');
        $this->_zendDirectory  = WPSearch_Config::get('driver-configs.phplucene.zend-path');
        $this->_tmpPath        = WPSearch_Config::get('driver-configs.phplucene.tmp-path');
        $this->_analyzerPath   = WPSearch_Config::get('driver-configs.phplucene.analyzer-path');

        # Fix index_directory if needed
        $this->_indexDirectory = rtrim($this->_indexDirectory, '/');
    }

     /**
     * Search the the backend service for a given term
     * @param string $term The search string to be fed in
     * @return array[WPSearch_Document]
     */
    public function search($term, $page = 0, $per_page = 10)
    {
        $timer  = "Function " . __CLASS__ . "::search()";
        WPSearch_Benchmark::start($timer);

        if(!is_array($term))
            $term = array('q' => $term);

        $category_id   = WPSearch_Utility::arrayGet($term, 'category_id');

        $title_boost   = WPSearch_Utility::getOption(WPSearch_Core::KEY_TITLE_BOOST, WPSearch_Core::DEFAULT_TITLE_BOOST);
        $content_boost = WPSearch_Utility::getOption(WPSearch_Core::KEY_CONTENT_BOOST, WPSearch_Core::DEFAULT_CONTENT_BOOST);
        $title_boost   = WPSearch_Utility::getScaledBoostValue($title_boost, self::$_boostRangeLow, self::$_boostRangeHigh);
        $content_boost = WPSearch_Utility::getScaledBoostValue($content_boost, self::$_boostRangeLow, self::$_boostRangeHigh);
        $search_types  = unserialize(WPSearch_Utility::getOption(WPSearch_Core::KEY_SEARCH_TYPES, FALSE));
        $search_types  = ($search_types !== FALSE ? $search_types : WPSearch_Core::$_defaultSearchTypes);

        if(!$search_types) $search_types = "NOTYPES";
        else $search_types = implode (' ', $search_types);

        $title_query        = "post_title:({$term['q']})^{$title_boost}";
        $content_query      = "post_content:({$term['q']})^{$content_boost}";
        $category_query     = ($category_id ? "+post_category_ids:($category_id)" : '');
        $type_query         = "+post_type:($search_types)";
        $comments_query     = "";
        $categories_query   = "";

        if($this->_doesIndexCategories())
            $categories_query = "post_category_names:({$term['q']})";

        if($this->_doesIndexComments())
            $comments_query = "post_comments:({$term['q']})";

        $index = $this->_getIndex();

        if(!$index) throw new Exception("Can't get index object for search..");

        $index->setResultSetLimit(100);
        
        $query = "+($title_query $content_query) $type_query $category_query $categories_query $comments_query";

        WPSearch_Log::add('debug', "Searching index for '$query'");

        $query =  Zend_Search_Lucene_Search_QueryParser::parse($query, 'UTF-8');
        $hits  = $index->find($query);
        
        $start     = $page * $per_page;
        $documents = array();
        $stop      = min(array($start + $per_page, count($hits)));

        for($i = $start; $i < $stop; $i++)
        {
            $doc = $this->_buildResultFromHit($hits[$i]);
            /* We're gonna hold off on this one until the next release */
            # $doc->post_content = $this->_highlightMatches($query, $doc->post_content);
            # $doc->post_title   = $this->_highlightMatches($query, $doc->post_title);

            $documents[] = $doc;
        }

        WPSearch_Benchmark::stop($timer);
        return (object)array('hits' => $documents, 'total' => count($hits));
    }

    /**
     * Start a full index building process
     * @return Whether it succeeded
     */
    public function buildFullIndex($index_comments = FALSE, $index_categories = FALSE, $immediate = FALSE)
    {
        WPSearch_Log::add('debug', "Registering shutdown hook to start build process");

        # TODO: Output status to file
        $status = array( 'total'        => 0,
                         'current'      => 0,
                         'last_rebuild' => time(),
                         'reindexing'   => true,
                         'last_updated' => time());

        WPSearch_Utility::registerLogErrorHandlers();
        $this->_setStatusInfo($status);
        @set_time_limit(0);
        @ini_set("memory_limit","256M");
        @ini_set("max_input_time","-1");

        if(!$immediate)
        {
            @ignore_user_abort(true);
            @register_shutdown_function(array($this, 'asyncBuildFullIndex'), $index_comments, $index_categories);
        }
        else
        {
            $this->asyncBuildFullIndex();
        }
        
        
        return true;
    }

    /**
     * This is the real full index building process. It is meant to be kicked off
     *  by $this->buildFullIndex(...) via registration with the PHP shutdown function.
     *  It will continue running after the conenction with the client closes.
     *  Don't call this directly. It must be public to work with the PHP shutdown
     *  function handler.
     * @param bool $index_comments
     * @param bool $index_categories
     */
    public function asyncBuildFullIndex($index_comments = FALSE, $index_categories = FALSE)
    {
        try
        {
            WPSearch_Log::add('debug', "Starting index build ..");

            $timer = "Index build process";
            WPSearch_Benchmark::start($timer);

            $page     = 0;
            $per_page = 20;
            $total    = WPSearch_Model::getPublishedPostCount();
            $index    = $this->_getIndex(true);
            $started  = time();

            do
            {
                WPSearch_Log::add('debug', "Pulling down page $page, with $per_page rows");

                $post_batch = WPSearch_Model::getPublishedDocuments($page, $per_page);

                WPSearch_Log::add('debug', "Got " . count($post_batch) . " posts back ..");

                if(count($post_batch) == 0) break;

                foreach($post_batch as $post)
                {
                    $comments   = ($index_comments   ? $this->_getCommentsAsString($post->ID)    : FALSE);
                    $categories = ($index_categories ? $this->_getCategoriesAsStrings($post->ID) : FALSE);
                    # WPSearch_Log::add('debug', "Indexing post: $post->ID");
                    $index->addDocument($this->_createLuceneDocument($post, $categories, $comments));
                }

                # TODO: Output status to file
                $status = array( 'total'        => $total,
                                 'current'      => $page * $per_page,
                                 'last_rebuild' => $started,
                                 'reindexing'   => true,
                                 'last_updated' => time());

                $this->_setStatusInfo($status);

                $page++;
            }
            while(true);

            $index->commit();
            $index->optimize();

            WPSearch_Log::add('debug', "Completing index build ..");

            $this->_deleteStatusInfo();
            $this->_setRebuildTime();

            WPSearch_Benchmark::stop($timer);
        }
        catch(Exception $ex)
        {
            WPSearch_Log::add('error', "Exception during index! " . $ex->__toString());
        }
    }

    /**
     * Add a document to the index by id
     * @param array[WPSearch_Document] $documents
     */
    public function addToIndex($document_ids)
    {
        if(! is_array($document_ids))
            $document_ids = array($document_ids);

        $this->removeFromIndex($document_ids);

        $index = $this->_getIndex();

        foreach($document_ids as $id)
        {
            # TODO: If you really need to doc multiple posts, do this in one call
            WPSearch_Log::add('debug', "Adding post #$id to index");

            $post = WPSearch_Model::getPublishedDocument($id);

            $categories = FALSE;
            $comments   = FALSE;

            if($this->_doesIndexCategories())
                $categories = $this->_getCategoriesAsStrings($id);

            if($this->_doesIndexComments())
                $comments = $this->_getCommentsAsString($id);

            $index->addDocument($this->_createLuceneDocument($post, $categories, $comments));
        }

        $index->commit();
        $index->optimize();
    }

    /**
     * Remove a document from the index by id
     * @param array[int] $document_ids
     */
    public function removeFromIndex($document_ids)
    {
        if(! is_array($document_ids))
            $document_ids = array($document_ids);

        $index = $this->_getIndex();

        foreach($document_ids as $id)
        {
            WPSearch_Log::add('debug', "Deleting document #$id from the index");
            # Remove from index
            $query = Zend_Search_Lucene_Search_QueryParser::parse('docId:' . $id);
            $hits  = $index->find($query);

            foreach($hits as $hit)
            {
                $index->delete($hit->id);
            }
        }

        $index->commit();
    }

    /**
     * Get an information string about the driver
     * @return string About the backend service
     */
    public function getAbout()
    { $this->_loadZend();
        $info = "Zend Lucene Driver / Zend Framework";

        return $info;
    }

    /**
     * Get information about when the last index was built, whether it is
     *  currently running a full build, and it's progress
     */
    public function getStats()
    { 
        $timer  = "Function " . __CLASS__ . "::getStats()";
        WPSearch_Benchmark::start($timer);

        $status = $this->_getStatusInfo();
        $index  = $this->_getIndex();

        if(!$status)
        {
            $status = array();
            $status['last_rebuild'] = $this->_getRebuildTime();
            $status['reindexing']   = false;
        }

        $status['total'] = WPSearch_Model::getPublishedPostCount(); 

        if($index)
            $status['current'] = $index->numDocs();
        else
            $status['current'] = 0;

        WPSearch_Benchmark::stop($timer);

        return (object)$status;
    }

    /**
     * Run any checks the driver has to do in order to run properly.
     * @return array An array of error messages if errors exist. An empty array
     *  if no errors exist
     */
    public function runTests()
    {
        $errors = array();

        if(!file_exists($this->_indexDirectory))
            $errors[] = "The index directory, {$this->_indexDirectory}, does not exist";

        if(!file_exists($this->_tmpPath))
            $errors[] = "The tmp directory, {$this->_tmpPath}, does not exist";

        if(!file_exists($this->_indexDirectory))
            $errors[] = "The index directory, {$this->_indexDirectory}, does not exist";

        if(!is_writable($this->_indexDirectory))
            $errors[] = "The index directory, {$this->_indexDirectory}, is not writable. You or your system admin can easily fix this.";

        if(!is_writable($this->_tmpPath))
            $errors[] = "The tmp directory, {$this->_tmpPath}, is not writable. You or your system admin can easily fix this.";

        $fast_cgi_error = "FastCGI is enabled on this server. You may have to extend"
                        ." your FastCGI timout for WPSearch to index properly.";

        if(!function_exists('mb_strtolower'))
            $errors[] = "Multibyte string support is not enabled in this instance of PHP. "
                        ."The index build process needs this in order to add data "
                        ."of different encodings to the index. Ask your administrator to compile PHP with --enable-mbstring.";

        if(strstr(php_sapi_name(), 'fcgi'))
            $errors[] = $fast_cgi_error;
        elseif(function_exists('apache_get_modules')
            && in_array('mod_fastcgi', apache_get_modules()))
            $errors[] = $fast_cgi_error;

        # Safe mode is bad because you cannot set an infinite time limit, which
        #  we need to do to build an index.
        if(ini_get('safe_mode'))
            $errors[] = "This WPSearch driver cannot run in safe mode (".__CLASS__.")";

        $inilimit = ini_get('memory_limit');

        if($inilimit && strstr($inilimit, 'M') !== FALSE)
        {
            $limit      = intval(str_replace('M', '', $inilimit));
            $post_count = WPSearch_Model::getPublishedPostCount();
            $needed     = round(($post_count / 1000 * 2 + 10), 0);

            if($post_count > 5000 || ($limit < $needed))
            {
                $errors[] = "This Wordpress installation currently has $post_count published posts. "
                           ."An index build will need approximately {$needed}M of memory to complete. "
                           ."While WPSearch will try to allocate that space, it may not be able to go "
                           ."above your configured default of $inilimit. If builds are unsuccessful, "
                           ."please look into <a href=\"#\">WPSearch Premium</a> which can handle up to 1 million posts "
                           ."with ease.";
            }
        }

        return $errors;
    }

    private function _doesIndexComments()
    {
        return (WPSearch_Utility::getOption(WPSearch_Core::KEY_INDEXED_COMMENTS)  == 'true');
    }

    private function _doesIndexCategories()
    {
        return (WPSearch_Utility::getOption(WPSearch_Core::KEY_INDEXED_CATEGORIES)== 'true');
    }

    private function _doesSearchComments()
    {
        return (WPSearch_Utility::getOption(WPSearch_Core::KEY_SEARCH_COMMENTS)   == 'true');
    }

    private function _doesSearchCategories()
    {
        return (WPSearch_Utility::getOption(WPSearch_Core::KEY_SEARCH_CATEGORIES) == 'true');
    }

    /**
     * Use the Zend engine to highlight matches for terms in a document
     * @param  Zend_Search_Lucene_Search_Query $query
     * @param string $content
     */
    private function _highlightMatches(&$query, $content)
    {
        $content = preg_replace('/.*<html><body><p>/s', '', $query->highlightMatches($content));
        $content = preg_replace('/<\/p><\/body><\/html>/s', '', $content);
        return $content;
    }

    /**
     * Load up the Zend library if it hasn't been loaded yet.
     */
    private function _loadZend()
    {
        if($this->_zendLoaded !== FALSE) return;

        $zend_include     = 'Search/Lucene.php';
        $analyzer_include = 'Analyzer/Standard.php';
        $cwd              = getcwd();

        set_include_path(get_include_path()
                        .PATH_SEPARATOR.rtrim($this->_zendDirectory, '/')
                        .PATH_SEPARATOR.rtrim($this->_analyzerPath, '/'));

        //chdir($this->_zendDirectory);
        require_once ($zend_include);

        //chdir($this->_analyzerPath);
        require_once ($analyzer_include);

        //chdir($cwd);
        $this->_zendLoaded = TRUE;
    }

    /**
     * Get a lucene directory handle
     * @param bool $create Whether to create the index
     * @return Zend_Search_Lucene_Interface
     */
    private function _getIndex($create = false)
    {
        if($this->_index !== NULL) return $this->_index;

        $this->_loadZend();

        try
        {
            if($create)
                $this->_index = Zend_Search_Lucene::create($this->_indexDirectory);
            else
                $this->_index = Zend_Search_Lucene::open($this->_indexDirectory);
        }
        catch(Exception $ex)
        {
            WPSearch_Log::add('warn', "Could not open lucene index: {$this->_indexDirectory}");
            return FALSE;
        }

        return $this->_index;
    }

    /**
     * Remove newlines from text.
     * @param string $string
     * @return string The string without newlines
     */
    private function _sanitizeText($string)
    {
        $string = strip_tags( $string );
        $string = str_replace ( "\n\r" , " " , $string );
        $string = str_replace ( "\n" , " " , $string );
        $string = str_replace ( "\r" , " " , $string );
        return $string;
    }

    private function _getCommentsAsString($post_id)
    {
        $comments     = WPSearch_Model::getPostComments($post_id);
        $comment_blob = '';

        foreach($comments as $comment)
        {
            $comment_blob .= "{$comment->comment_author} {$comment->comment_content} ";
        }

        return $comment_blob;
    }

    /**
     * Gets the category names and ids as strings separates by spaces
     * @param int $post_id
     * @return array('names' => string, 'ids' => string)
     */
    private function _getCategoriesAsStrings($post_id)
    {
        /**
         * Use Wordpress' internal methods to get the category information
         */
        $categories = get_the_category( $post_id );

        $ids   = "";
        $names = "";

        foreach($categories as $category)
        {
            $names .= strtolower($category->name) . " ";
            $ids   .= $category->cat_ID . " ";
        }

        $return = array('names' => $names,
                        'ids'   => $ids );

        return $return;
    }

    /**
     * Create a Zend Lucene doc from a Wordpress post
     * @param object $post
     * @return Zend_Search_Lucene_Document
     */
    private function & _createLuceneDocument($post, $categories = false, $comments = false)
    {
        $doc = new Zend_Search_Lucene_Document();
        $encoding = 'UTF-8';

        # WPSearch_Log::add('debug', "Adding field data ..");

        $doc->addField(Zend_Search_Lucene_Field::Text('docId', $post->ID, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_author', $post->post_author, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_date', $post->post_date, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_date_gmt', $post->post_date_gmt, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::Text('post_content', $this->_sanitizeText($post->post_content), $encoding));
        $doc->addField(Zend_Search_Lucene_Field::Text('post_title',  $this->_sanitizeText($post->post_title  )   , $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_excerpt', $post->post_excerpt, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_status', $post->post_status, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('comment_status', $post->comment_status, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('ping_status', $post->ping_status, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_name', $this->_sanitizeText($post->post_name), $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('to_ping', $post->to_ping, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pinged',  $post->pinged, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_modified', $post->post_modified, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_modified_gmt', $post->post_modified_gmt, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_content_filtered', $post->post_content_filtered, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_parent', $post->post_parent, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('guid', $post->guid, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('menu_order', $post->menu_order, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::Text('post_type', $post->post_type, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_mime_type', $post->post_mime_type, $encoding));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('comment_count', $post->comment_count, $encoding));

        if($categories)
        {
            $doc->addField(Zend_Search_Lucene_Field::Text('post_category_ids', $categories['ids'], $encoding));
            $doc->addField(Zend_Search_Lucene_Field::Text('post_category_names', $categories['names'], $encoding));
        }
        else
        {
            $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_category_ids', '', $encoding));
            $doc->addField(Zend_Search_Lucene_Field::UnIndexed('post_category_names', '', $encoding));
        }

        if($comments)
        {
            $doc->addField(Zend_Search_Lucene_Field::Text('post_comments', $this->_sanitizeText($comments), $encoding));
        }
        else
        {
            $doc->addField(Zend_Search_Lucene_Field::Text('post_comments', '', $encoding));
        }

        # WPSearch_Log::add('debug', "Added all fields to post: $post->ID");
        return $doc;
    }

    /**
     * Build a result object from a Lu
     * @param Zend_Search_Lucene_Search_QueryHit $hit
     */
    private function _buildResultFromHit(Zend_Search_Lucene_Search_QueryHit $hit)
    {
        $result = new WPSearch_Document();
        $result->ID = $hit->docId;
        $result->post_author = $hit->post_author;
        $result->post_date = $hit->post_date;
        $result->post_date_gmt = $hit->post_date_gmt;
        $result->post_content = $hit->post_content;
        $result->post_title = $hit->post_title;
        $result->post_excerpt = $hit->post_excerpt;
        $result->post_status = $hit->post_status;
        $result->comment_status = $hit->comment_status;
        $result->ping_status = $hit->ping_status;
        $result->post_name = $hit->post_name;
        $result->to_ping = $hit->to_ping;
        $result->pinged = $hit->pinged;
        $result->post_modified = $hit->post_modified;
        $result->post_modified_gmt = $hit->post_modified_gmt;
        $result->post_content_filtered = $hit->post_content_filtered;
        $result->post_parent = $hit->post_parent;
        $result->guid = $hit->guid;
        $result->menu_order = $hit->menu_order;
        $result->post_type = $hit->post_type;
        $result->post_mime_type = $hit->post_mime_type;
        $result->comment_count = $hit->comment_count;

        return $result;
    }

    /**
     * Store the current index process status to a file so other processes can
     *  see how far along we are.
     * @param array $info
     * @return bool True if the save worked, false if not
     */
    private function _setStatusInfo($info)
    {
        $file = WPSearch_Config::get('driver-configs.phplucene.tmp-path') . 'index-status.nfo';

        if(! @file_put_contents($file, serialize($info)) )
        {
            WPSearch_Log::add('error', "Could not save the indexing status to $file!");
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Get the index process info from a file. The is used by processes running
     *  which need to get the progress (likely for a user)
     * @return mixed An assoc. array of status info if there was a status,
     *   false if not. Also, false if the status hasn't been updated in 30 seconds.
     */
    private function _getStatusInfo()
    {
        $file = WPSearch_Config::get('driver-configs.phplucene.tmp-path') . 'index-status.nfo';

        if(($content = @file_get_contents($file)))
        {
            $status = unserialize($content);

            # Timeout after 30 seconds
            if(time() - $status['last_updated'] > 30)
            {
                @unlink($file);
                return FALSE;
            }

            return $status;
        }

        return FALSE;
    }

    /**
     * Remove the status info file
     */
    private function _deleteStatusInfo()
    {
        $file = WPSearch_Config::get('driver-configs.phplucene.tmp-path') . 'index-status.nfo';

        if(! @unlink($file))
        {
            WPSearch_Log::add('error', "Could not delete status file: $file");
        }
    }

    /**
     * Get the last time that the index was built (UNIX timestamp)
     * @return int
     */
    private function _getRebuildTime()
    {
        $time = @file_get_contents(WPSearch_Config::get('driver-configs.phplucene.tmp-path') . 'rebuild-time.nfo');
        return (int)$time;
    }

    /**
     * Set the last time the index was built and store it in a file
     * @param int $time UNIX timestamp
     */
    private function _setRebuildTime($time = FALSE)
    {
        if($time === FALSE) $time = time();
        $file    = WPSearch_Config::get('driver-configs.phplucene.tmp-path') . 'rebuild-time.nfo';
        $success = @file_put_contents($file, $time);

        if(!$success)
        {
            WPSearch_Log::add('error', "Could not write to temp file: $file");
        }
    }
}