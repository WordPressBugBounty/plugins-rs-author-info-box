<?php
/**
 * Plugin Name:       RS Author Info Box
 * Plugin URI:        https://rswpthemes.com/how-to-add-about-me-widget-on-wordpress-step-by-step-guide/
 * Description:       This widget allows you to display your name, image, title, description, and social links in the sidebar area. It is fully compatible with the Author Portfolio WordPress Theme.
 * Version:           2.2.0
 * Requires at least: 4.9
 * Tested up to:      6.7
 * Requires PHP:      7.4
 * Author:            RS WP THEMES
 * Author URI:        https://rswpthemes.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rs-author-info-box
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!defined('RS_AUTHOR_INFO_BOX_PLUGIN_PATH')) {
    define('RS_AUTHOR_INFO_BOX_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
}
if (!defined('RS_AUTHOR_INFO_BOX_PLUGIN_URL')) {
    define('RS_AUTHOR_INFO_BOX_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

require RS_AUTHOR_INFO_BOX_PLUGIN_PATH . '/includes/author-info-box-widget.php';


add_action('wp_enqueue_scripts', 'rs_author_info_box_enqueue_assets');

function rs_author_info_box_enqueue_assets(){
    $is_rs_author_info_box_active = is_active_widget( false, false, 'rs_info_box_widget' );
    $getRswpThemesSlug = get_stylesheet();

    $enqueueIcons = true;
    $rswpThemes = array('book-review-blog', 'book-author-blog', 'author-portfolio-pro', 'electronic-store');
    if (in_array($getRswpThemesSlug, $rswpThemes)) {
        $enqueueIcons = false;
    }
    if ($is_rs_author_info_box_active) :
        if (true === $enqueueIcons) :
            wp_enqueue_style( 'rswpthemes-icons', RS_AUTHOR_INFO_BOX_PLUGIN_URL . 'assets/webfonts/icons.css');
        endif;
        wp_enqueue_style( 'rs-author-info-box-style', RS_AUTHOR_INFO_BOX_PLUGIN_URL . 'assets/css/style.css');
    endif;
}
