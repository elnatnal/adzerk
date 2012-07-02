<?php
/*
Plugin Name: WP Search
Plugin URI: http://codefury.net/projects/wpSearch/
Description: This is the missing search functionality for Wordpress-powered sites. 
Version: 2.0.4.0
Author: Kenny Katzgrau
Author URI: http://codefury.net
*/

require dirname(__FILE__) . '/WPSearch/Core.php';

# Start the beast
$engine = new WPSearch_Core;
$engine->execute();
