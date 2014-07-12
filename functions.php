<?php


?>
<?php
/**
 *
 * MaxFlat functions and definitions.
 *
 * The functions file is used to initialize everything in the theme.
 * It sets up the supported features, default actions  and filters.
 *
 *
 * 
 * @since      MaxFlat 1.0
 */

// Load Smart Library
require(get_template_directory() . '/smart-lib/load.php');

/**
 * Initialize smart lib project object
 */
__MAXFLAT::init();



/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */

if (!isset($content_width))
    $content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features
 */

function maxflat_setup(){
    /*
             * Load textdomain.
             */
    load_theme_textdomain('maxflat', get_template_directory() . '/languages');

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status', 'video',  'gallery'));

    // add custom header suport
    $args = array(

        'uploads' => true,
        'header-text' => false
    );
    add_theme_support('custom-header', $args);

    // This theme large-2 wp_nav_menu() in large-1 location.
    register_nav_menu('top_pages', __('Top Menu', 'maxflat'));
    register_nav_menu('footer_pages', __('Bottom Menu', 'maxflat'));
    register_nav_menu('categories', __('Vertical Menu', 'maxflat'));
    /*
                 * This theme supports custom background color and image, and here
                 * we also set up the default background color.
                 */
    add_theme_support('custom-background', array(
                                                'default-color' => 'fff',
                                           ));
	  add_theme_support('shortcode');
    /**
     * POSTS THUMBNAILS
     */
    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
    add_image_size('small-image', 80, 80, true);
    add_image_size('medium-image-thumb', 200, 150, true);
	  add_image_size('wide-image', 1000, 620, true);
	  add_image_size('medium-square', 350, 350, true);


}

add_action('after_setup_theme', 'maxflat_setup');

/**
 * Enqueues scripts and styles for front-end.
 *
 */
function maxflat_scripts_styles()
{

    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');



}

add_action('wp_enqueue_scripts', 'maxflat_scripts_styles');
