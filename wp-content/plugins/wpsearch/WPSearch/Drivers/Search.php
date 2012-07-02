<?php
/**
 * This file contains an abstract class that all WPSearch backend drivers must
 *  all be derived from
 */

/**
 * This class is the abstract class that all WPSearch Search drivers must be derived
 *  from in order to act as a search driver
 */
abstract class WPSearch_Driver_Search
{
    /**
     * Search an index for a term
     * @param string $term The search string to be fed in
     * @return array[WPSearch_Document]
     */
    public abstract function search($term, $page = 0, $per_page = 10);

    /**
     * Build a full index
     * @return bool Whether it succeeded
     */
    public abstract function buildFullIndex($index_comments = FALSE, $index_categories = FALSE);

    /**
     * Add a document to the index
     * @param array[WPSearch_Document] $documents
     */
    public abstract function addToIndex($documents);

    /**
     * Remove a document from the index
     * @param array[int] $document_ids
     * @return bool Whether it succeeded
     */
    public abstract function removeFromIndex($document_ids);

    /**
     * Get an information string about the driver
     * @return A versions string
     */
    public abstract function getAbout();


    /**
     * Get information about when the last index was built, whether it is
     *  currently running a full build, and it's progress
     * @return The status object
     */
    public abstract function getStats();

    /**
     * Run any checks the driver has to do in order to run properly.
     * @return array An array of error messages if errors exist. An empty array
     *  if no errors exist
     */
    public abstract function runTests();
}