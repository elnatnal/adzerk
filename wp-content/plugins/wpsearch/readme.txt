=== Plugin Name ===
Contributors: Kenny Katzgrau, John Crepezzi
Donate link: http://codefury.net/projects/wpsearch/donate-to-wpsearch/
Tags: search, lucene, fast, relevant
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 2.0.4.0

WPSearch 2 is the missing site search for your Wordpress installation. Install this plugin if you need a fast, relevant, google-like search.

== Description ==

WPSearch 2 is a major update to the highest rated search plug-in for Wordpress, WPSearch.
This plugin focuses on search relevancy and speed.

If you find this project useful and you want to support it, just follow @\_kennyk\_ on Twitter :)

The major features of WPSearch 2 are:

    * Super-fast search speed
    * Unmatched and customizable search relevancy
    * Control over boosting the importance of title and content fields
    * Instantly updated searching after a post has been written
    * Searching of any type of post
    * Wildcard and Boolean operator support
    * Category searching

Requirements:

	* Wordpress 3
	* The iconv library/multibyte support (Usually installed/enabled on a server by default. If not, have an admin compile PHP with --enable-mbstring).

Coming soon!: Exclude certain posts or categories (a long-standing feature request).

Note:

If you have a large site with over 10,000 posts, consider using WPSearch Premium, 
which has all the power of this free repository version, but can handle up to 500,000 posts under heavy load and faster speed
with it's low-level backend driver. To learn more, email kenny@oconf.org.

== Manual Installation ==

Install WPSearch 2 from the Wordpress plugin admin panel if possible.

If you are upgrading from a previous version, it is recommended that you rebuild your index after the upgrade.

	* Copy the wpsearch folder to the Wordpress plugins directory
	* Set permissions of the wpsearch directory to 777 (very important!): $ chmod -R 777 wpsearch/*
	* Activate wpSearch
	* Go to Settings-->WPSearch Options, and click "Build Index"
	* Click "Save Changes" and wait until the page reloads (this can take a while depending on the number of posts in your blog)
	* Go to your blog's search box and search. Do the results look better? Cool!
	
	Did you have trouble installing? Let me know! katzgrau@gmail.com

Note: Don't forget the bit about changing folder permissions!

== Screenshots ==

For a video introduction or "Before wpSearch" / "After wpSearch" Screenshots,
Visit http://codefury.net/projects/wpsearch/wpsearch-screenshots/

== Frequently Asked Questions ==

1. Q: I get an error that says something like:

Parse error: syntax error, unexpected T_STRING, expecting '{' in /homepages/18/d179583305/htdocs/MLL-site/book/wp-content/plugins/wpsearch/Zend/Search/Lucene.php on line 82

What's going on?

1. A: This means you are using PHP 4.x.x or lower. The search library underneath wpSearch needs PHP 5 or higher to run.

2. Q: Where do I send bug reports to?

2. A: Bug reports are very appreciated! ohcrap@oconf.org .

== Fix Log ==

* 2.0.3.0: Fixed file path inclusion issue for Zend library. Added notice in case user does not have multibyte support.
* 2.0.2.5: Stopped WPSearch from interfering with admin post search, fixed error message in WP admin page registration
* 2.0.2.0: Added customizable searching of post types, and a relevancy fix
* 2.0.1.2: Fixed 'quick edit' javascript error due to erroneous inclusion, added fix for long indexing times
* 2.0.1.0: Re-added ability to boost title and content, fixed pagination bug
* 2.0.0.0: Complete rewrite with a bunch of new features. Check it out!
* 1.5.0.5: Null Result Fix ( Finally! ), logging support, search library upgrade (ZF v1.5.3)
* 1.5.0.1: Comment Searching, Foreign Character support, 'Phone Home'
* 1.5.0.0: Faster searching, core integration, 0 style or javascript includes

== Known Conflictions ==

wpSearch is known to react with certain plugins which manipulate search results. 
These plugins most likely expect the default Wordpress search to in use, which it is not. 
The following plugins are known to cause issues:

* Custom Query String ( CQS )
* Headspace2

Send all bug reports to ohcrap@oconf.org.
