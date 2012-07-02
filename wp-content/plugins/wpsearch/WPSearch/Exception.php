<?php
/**
 * This file contains a custom Exception class for WPSearch
 *
 * @author Kenny Katzgrau <kenny@oconf.org>
 */

/**
 * Whenever an Exception needs to be thrown in WPSearch, use this class or an
 *  Exception dervided form it. This helps separating Wordpress exceptions from
 *  WPSearch exceptions
 */
class WPSearch_Exception extends Exception
{
    
}