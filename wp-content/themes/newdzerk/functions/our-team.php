<?php 

// Custom Content Type for Team Members
// -------------------------------------------------- //


function adzerk_team() {

  register_post_type( 'team',
                      array(
                            'labels' => array('name' => __( 'Team' ), 'singular_name' => __( 'Team Member' )),
                            'description' => 'Who works here? _______ works here! And they are proud of it.',
                            'public' => true,
                            'has_archive' => false,
                            'hierarchical' => false, // set to true to "nest" like pages

                            'menu_position' => 7, // where on the menu it should appear; 5 = below posts, 10 = below media, etc
                            'supports' => array( 'title','editor','thumbnail', 'custom-fields'),
			       'taxonomies' => array('category'),
                            'register_meta_box_cb' => 'add_team_metaboxes'
                            )
                      ); }


add_action( 'init', 'adzerk_team' );
set_post_thumbnail_size( 170, 170 );

//POSITION META BOX BEGIN
//--------------------------------------

// Call different custom meta boxes
$teammate_position_meta_boxes = array();

// titles
$teammate_position_meta_boxes[] = array(
    'id' => 'teammate-position_meta',
    'title' => 'Teammate Position',
    'pages' => array('team'), // multiple post types
    'context' => 'side',
    'priority' => 'default',
    'fields' => array(
        array(
            'name' => 'Position',
            'desc' => 'Example: Professional Adzerker',
            'id' => 'teammmate-position-meta-text',
            'type' => 'text'
        )
    )
);

foreach ($teammate_position_meta_boxes as $meta_box) {
    $myteammate_position_box = new Teammate_position_meta_box($meta_box);
}

class Teammate_position_meta_box {

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
        echo '<input type="hidden" name="teammate_position_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

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
        if (!wp_verify_nonce($_POST['teammate_position_meta_box_nonce'], basename(__FILE__))) {
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

// Custom thumbnail sizes for use with teammate items
add_image_size( 'profile-pic', 170, 170 );



?>
