<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WOW_Initial_Setup')) {
    class WOW_Initial_Setup{
        protected static $_instance = null;
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        // Dependency For 1.0.0-beta2 to Update+ 
        public static function wow_legacy_data(){
            global $wpdb;
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = %s WHERE meta_key = %s", '_wow_content', 'wow_content' ) );
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = %s WHERE meta_key = %s", '_wow_page_css', 'wow_page_css' ) );
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = %s WHERE meta_key = %s", '_wow_current_post_editor', 'wow_current_post_editor' ) );
        }

        // Initialize Save Data
        public static function initialize_data(){
            
            // Update Legacy
            self::wow_legacy_data();

            // Activating default post type
            if ( ! get_option( 'wow_is_used' ) ) { 
	            $wow_options = ( array ) get_option( 'wow_options' );
	            $wow_options['supported_post_type'] = array( 'post', 'page' );
                $wow_options['include_role'] = array(
                    'administrator',
                    'editor',
                    'author',
                    'contributor'
                );
	            $wow_options['css_save_as'] = 'wp_head';
	            update_option( 'wow_options', $wow_options );
	            update_option( 'wow_is_used', WOW_VERSION );
            }
            $wow_options = ( array ) get_option( 'wow_options' );
            $wow_options['supported_post_type'] = array( 'post', 'page' );
            $wow_options['include_role'] = array(
                'administrator',
                'editor',
                'author',
                'contributor'
            );
            $wow_options['css_save_as'] = 'wp_head';
            update_option( 'wow_options', $wow_options );
            update_option( 'wow_is_used', WOW_VERSION );
        }

        // PHP Error Notice
        public static function php_error_notice(){
            $message = sprintf( esc_html__( 'WOW Page Builder requires PHP version %s or more.', 'wow-pagebuilder' ), '5.4' );
            $html_message = sprintf( '<div class="notice notice-error is-dismissible">%s</div>', wpautop( $message ) );
            echo wp_kses_post( $html_message );
        }

        // Wordpress Error Notice
        public static function worpress_error_notice(){
            $message = sprintf( esc_html__( 'WOW Page Builder requires WordPress version %s or more.', 'wow-pagebuilder'
            ), '4.7' );
            $html_message = sprintf( '<div class="notice notice-error is-dismissible">%s</div>', wpautop( $message ) );
            echo wp_kses_post( $html_message );
        }

    }
}