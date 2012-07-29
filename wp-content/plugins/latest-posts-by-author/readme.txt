=== Latest Posts by Author ===
Contributors: alexmansfield
Donate link: http://alexmansfield.com/
Tags: posts, authors
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 0.8.2

Displays an unordered list of an author's latest posts.

== Description ==

This plugin allows you to display an unordered list of links to a specific author's latest posts (or a list of multiple authors). It can be called either with a shortcode or from within a theme file.

To call it with a shortcode, use `[latestbyauthor author="username" show="3"]` where "username" is the login name of the author (or a comma separated list of multiple authors) and "3" is the number of posts to display. If you don't specify an author or a display number, it will show the latest 5 posts from the author of the current page. If you want it to display the post excerpt as well, you can use the following code: `[latestbyauthor author="username" show="3" excerpt="true"]` This will only show exerpts that you have entered manually.

To call it from within a theme template, you have to wrap it in this PHP function: `<?php echo do_shortcode('[latestbyauthor author="username" show="3"]'); ?>`


== Installation ==

1. Upload the `latests-posts-by-author` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php echo do_shortcode('[latestbyauthor]'); ?>` in your templates or `[latestbyauthor]` in your posts

== Frequently Asked Questions ==

= No questions yet =

That's right, none so far.

= 0.8.2 =

Corrected an issue with post thumbnail support. Thanks to gkemp on the WordPress.org forum for reporting it.

== Changelog ==

= 0.8.1 =

Updated the documentation.

= 0.8 =

Added a missing `</ul>` tag. Thanks to <a href="http://www.simplicatedweb.com/">Ken Howard</a> for pointing that out.

Added support for multiple authors. You can now use a comma separated list of authors. Thanks to <a href="http://wordpress.org/support/profile/zgunder">Zgunder</a> for the suggestion.

Updated the query to exclude the current post. This prevents a link to the current pate from being displayed. Thanks again to <a href="http://www.simplicatedweb.com/">Ken Howard</a> for the help on this one.

Added better inline documentation.

= 0.7 =

Switched from using the $wpdb object to the WP_Query class to gather posts from the database, greatly simplifying the plugin code. Thanks to <a href="http://jackrugile.com/">Jack Rugile</a> for pointing out some issues with the last version that led to this update.

= 0.6 =

Fixed reference to guid. Replaced with get_permalink()

= 0.5 =

* Tested with Wordpress 3.0

= 0.4 =

* Fixed documentation.

= 0.3 =

* Added the option to show post excerpts.

= 0.2 =
* Now only shows published posts (not drafts). Thanks for catching that <a href="http://blog.codehangover.com/">Welzie</a>.

= 0.1 =
* First version, no changes yet.


