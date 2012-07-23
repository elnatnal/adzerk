<?php
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );
 
        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
	
// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','html5reset' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

    add_theme_support( 'menus' );

    function my_wp_nav_menu_args( $args = '' )
    {
    	$args['container'] = false;
    	return $args;
    } // function

    add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
    

    // we need custom fields for the Sassy text above a h1

    // Call different custom meta boxes
    $meta_boxes = array();

    // titles
    $meta_boxes[] = array(
        'id' => 'sassy-header-text',
        'title' => 'Sassy Header Text',
        'pages' => array('post', 'page', 'link'), // multiple post types
        'context' => 'side',
        'priority' => 'default',
        'fields' => array(
            array(
                'name' => 'Text',
                'desc' => 'Example: High fives all around',
                'id' => 'adzerk-sassy-text',
                'type' => 'text'
            )
        )
    );

    foreach ($meta_boxes as $meta_box) {
        $my_box = new Sassy_meta_box($meta_box);
    }

    class Sassy_meta_box {

        protected $_meta_box;

        // create meta box based on given data
        function __construct($meta_box) {
            $this->_meta_box = $meta_box;
            add_action('admin_menu', array(&$this, 'add'));

            add_action('save_post', array(&$this, 'save'));
        }

        /// Add meta box for multiple post types
        function add() {
            foreach ($this->_meta_box['pages'] as $page) {
                add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
            }
        }

        // Callback function to show fields in meta box
        function show() {
            global $post;

            // Use nonce for verification
            echo '<input type="hidden" name="mytheme2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

            echo '<table class="form-table">';

            foreach ($this->_meta_box['fields'] as $field) {
                // get current post meta data
                $meta = get_post_meta($post->ID, $field['id'], true);

                echo '<tr>',
                        '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                        '<td>';
                switch ($field['type']) {
                    case 'text':
                        echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                            '<br />', $field['desc'];
                        break;
                    case 'textarea':
                        echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                            '<br />', $field['desc'];
                        break;
                    case 'select':
                        echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                        foreach ($field['options'] as $option) {
                            echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                        }
                        echo '</select>';
                        break;
                    case 'radio':
                        foreach ($field['options'] as $option) {
                            echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                        }
                        break;
                    case 'checkbox':
                        echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                        break;
                }
                echo     '<td>',
                    '</tr>';
            }

            echo '</table>';
        }

        // Save data from meta box
        function save($post_id) {
            // verify nonce
            if (!wp_verify_nonce($_POST['mytheme2_meta_box_nonce'], basename(__FILE__))) {
                return $post_id;
            }

            // check autosave
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            }

            // check permissions
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id)) {
                    return $post_id;
                }
            } elseif (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }

            foreach ($this->_meta_box['fields'] as $field) {
                $old = get_post_meta($post_id, $field['id'], true);
                $new = $_POST[$field['id']];

                if ($new && $new != $old) {
                    update_post_meta($post_id, $field['id'], $new);
                } elseif ('' == $new && $old) {
                    delete_post_meta($post_id, $field['id'], $old);
                }
            }
        }
    }

    // 3. Custom Content Types
    //--------------------------------------------------//

    // Custom Content Type for Team Mates
    require_once('functions/testimonials.php');
    require_once('functions/our-team.php');


add_theme_support('post-thumbnails');

function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}


// LATEST POST BY AUTHOR

function latest_posts_by_author($array) {
       extract(shortcode_atts(array('author' => 'admin', 'show' => 5, 'excerpt' => 'false'), $array));
 
       global $wpdb;
              $table = $wpdb->prefix . 'users';
              $result = $wpdb->get_results('SELECT ID FROM '.$table.' WHERE user_login = "'.$author.'"');
              $id = $result[0]->ID;
              $table = $wpdb->prefix . 'posts';
              $result = $wpdb->get_results('SELECT * FROM '.$table.' WHERE post_author = '.$id.' AND post_status = "publish" AND post_type = "post" ORDER BY post_date DESC');
                     $i = 0;
                            $html = '<ul>';
                                   foreach ($result as $numpost) {
                                                 $html .= '<h5><a href="'.get_permalink($numpost->ID).'">'.$numpost->post_title.'</a></h5>';
                                                        if($excerpt == 'true'){
                                                               $html .= '<p>'.$numpost->post_excerpt.'</p> <br /> <a class="readmore" href="'.get_permalink($numpost->ID).'">Read Post</a>';
                                                        }
                                                               $html .= '</li>';
                                                        $i++;
                                                 if($i == $show){
                                                        break;
                                                 }
                                          }
                                          $html .= '</ul>';
 
                                          return $html;
                                   }
 
add_shortcode('latestbyauthor', 'latest_posts_by_author');

// END LATEST POST BY AUTHOR

// Puts link in excerpts more tag
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">...Read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


?>