<?php

/*
Plugin Name: Latest Posts by Author
Plugin URI: http://wordpress.org/extend/plugins/latest-posts-by-author/
Description: Displays a list of recent posts by the specified author
Author: Alex Mansfield
Version: 0.8.2
Author URI: http://alexmansfield.com/
*/


function latest_posts_by_author($array) {
	global $post;
	
	if( in_the_loop() || is_single() ){

		// If this is executed inside the loop or on a single post/page, the author of the current post is set as the default author if no author is specified in the shortcode.
		$author_id=$post->post_author;
		$author = get_the_author_meta( 'user_login', $author_id );
		extract(shortcode_atts(array('author' => $author, 'show' => 5, 'excerpt' => 'false'), $array));
	} else {
		
		// If this is executed ouside the loop and not on a single post/page, the author is not set. If no author is specified in the shortcode, the list will not be displayed at all.
		extract(shortcode_atts(array('author' => '', 'show' => 5, 'excerpt' => 'false'), $array));
	}
	
	// Checks to make sure an author has been set
	if( !empty( $author ) ){
		
		// Checks to see if there are multiple authors set
		$comma = strpos($author, ',');
		if( $comma === false ){
			
			// Gets the author data for a single author
			$author_data = get_user_by( 'login', $author );
			$args = array(	'author' => $author_data->ID, 'posts_per_page' => $show, 'post__not_in' => array($post->ID) );
			
		} else {
			
			// Gets the author data for multiple authors
			$authors = explode( ',', $author  );
			$author_data = '';
			foreach( $authors as $author_login ){
				$user = get_user_by( 'login', $author_login );
				$author_data .= $user->ID . ',';
			}
			$args = array(	'author' => $author_data, 'posts_per_page' => $show, 'post__not_in' => array($post->ID) );
		}
		
		// Gets posts form database
		$author_query = new WP_Query( $args );
	
		// Displays posts if available
		if( $author_query ) {
			$html = '<ul class="latestbyauthor">';
			while ( $author_query->have_posts() ) : $author_query->the_post();
				$html .= '<li>';
				
				/*
					The following lines will display the post thumbnail if uncommented
					...also, it uses the thumbnail size created by the function at the bottom
					of this script which is also commented out. 
					
					$postID = get_the_ID();
					if ( current_theme_supports( 'post-thumbnails' ) ) {
						$html .= get_the_post_thumbnail( $postID, 'latest-by-author' );
					}
				*/
				
				// Displays a link to the post, using the post title
				$html .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
				
				// Displays the post excerpt if "excerpt" has been set to true
				if($excerpt == 'true'){
	         	$html .= '<p>' . get_the_excerpt() . '</p>';
	      	}
				$html .= '</li>';
			endwhile;
			$html .= '</ul>';
		}
		
		// Resets Post Data
		wp_reset_postdata();
	 
	 	// Returns the results
	   return $html;
	}

}
add_shortcode('latestbyauthor', 'latest_posts_by_author');


/*
	The following sections allows for the creation of a new thumbnail size for
	use with the plugin. It is commented out because I haven't figured out a good
	way for it to seemlessly integrade with different themes. You will need to 
	regenerate your thumbnails in order for this size to apply to images that
	have already been uploaded
	
	function latest_posts_by_author_thumbnails() {
		if ( current_theme_supports( 'post-thumbnails' ) ) {
		
			// Defines additional image size for this plugin
			add_image_size( 'latest-by-author', 25, 25, true );
		}
	}
	add_action( 'init', 'latest_posts_by_author_thumbnails' );
*/

?>