<?php
/*
 * Plugin Name:       WOW Page Builder
 * Plugin URI:        https://wow-wp.com
 * Description:       WOW Page Builder is a FREE drag & drop website building tool for WordPress. This plugin lets you develop a wonderful site in minutes without any coding.
 * Version:           1.2.6
 * Author:            WOW WordPress
 * Author URI:        https://github.com/baonguyenyam/wp-wow-website-builder/
 * Text Domain:       wow-pagebuilder
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Language Load
add_action( 'init', 'wow_builder_language_load');
function wow_builder_language_load(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'wow-pagebuilder', false, $plugin_dir );
}

// Define Version
define('WOW_VERSION', '1.2.6');

// Define License
define('WOW_LICENSE', 'free');

// Define Dir URL
define('WOW_DIR_URL', plugin_dir_url(__FILE__));

// Define Physical Path
define('WOW_DIR_PATH', plugin_dir_path(__FILE__));

//WP PageBuilder Base Name
define('WOW_BASENAME', plugin_basename(__FILE__));

// Include Require File
require_once WOW_DIR_PATH.'core/initial-setup.php'; // Initial Setup Data

// Version Check & Include Core
if ( ! version_compare( PHP_VERSION, '5.4', '>=' ) ) {
    add_action('admin_notices', array('WOW_Initial_Setup', 'php_error_notice')); // PHP Version Check
} elseif ( ! version_compare( get_bloginfo( 'version' ), '4.5', '>=' ) ) {
    add_action('admin_notices', array('WOW_Initial_Setup', 'worpress_error_notice')); // WordPress Version Check
} else {
    require_once WOW_DIR_PATH.'inc/WOW.php';              // Loading Page Builder Main Files
}

// Initialize Data When plugins Activated
function wow_builder_activate() {
    WOW_Initial_Setup::initialize_data();
}
register_activation_hook( __FILE__, 'wow_builder_activate' );

add_action( 'upgrader_process_complete', 'wow_upgrade_completed', 10, 2 );
function wow_upgrade_completed( $upgrader_object, $options ) {
    $our_plugin = plugin_basename( __FILE__ );
    if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
        foreach( $options['plugins'] as $plugin ) {
            if( $plugin == $our_plugin ) {
                WOW_Initial_Setup::wow_legacy_data();
            }
        }
    }
}