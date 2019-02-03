<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Includes custom files.
 */
include get_stylesheet_directory() . '/includes/shortcodes.php';
include get_stylesheet_directory() . '/includes/products.php';
include get_stylesheet_directory() . '/includes/cart.php';
/**
 * Loading scripts.
 */
function import_scripts()
{
    wp_enqueue_style('general-site', get_stylesheet_directory_uri() . '/css/general-site.css', 40, 1);
    wp_enqueue_script(
        'main',
        get_stylesheet_directory_uri() . '/js/front-end/main.js',
        array('jquery')
    );
}
add_action('wp_enqueue_scripts', 'import_scripts', 20, 1);
