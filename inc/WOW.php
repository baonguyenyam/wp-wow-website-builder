<?php

class WPPB{
	public static $instance = null;

	public $wow_general;
	public $wow_widget;
	public $wow_editor;
	public $wow_assets;
	public $wow_options;
	public $wow_ajax;
	public $wow_frontend;
	public $wow_theme_manager;
	public $compatibility;

	/**
	 * WPPB constructor
	 */
	public function __construct() {
		$this->register_autoloader();
		add_action( 'init', array($this, 'init'), 0 );
		add_action('init', array($this, 'load_addons_and_initialize'), 11);
	}

	public function init(){
		$this->init_components();
	}

	/**
	 * @return null|WPPB
	 *
	 * instance of WPPB Class
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			do_action( 'wow_loaded' );
		}

		return self::$instance;
	}

	/**
	 * Auto load class
	 */
	private function register_autoloader() {
		require WOW_DIR_PATH . '/inc/class-wow-autoloader.php';
		\WPPB\Wppb_autoloader::run();
	}

	/**
	 * Init all components
	 *
	 * @since v.1.0.0
	 */
	private function init_components(){
		$this->wow_frontend		= new WOW_Frontend();
		$this->wow_widget			= new WOW_Widget();
		$this->wow_editor			= new WOW_Editor_Management();
		$this->wow_assets			= new WOW_Assets();
		$this->wow_general			= new WOW_General();
		$this->wow_options			= new WOW_Options();
		$this->wow_ajax			= new WOW_Ajax();
		$this->wow_theme_manager 	= new WOW_Theme_Manager();
		$this->compatibility 		= new Compatibility();
	}

	/**
	 * Get all addons and Initialize them
	 */
	function load_addons_and_initialize(){
		$addons = wow_helper()->get_addon_classes();
		$initializeAddonClasses = array();
		do_action('before_wow_addon_initialize');
		foreach ($addons as $addon){
			if (class_exists($addon)){
				do_action('before_wow_addon_initializing_'.$addon);
				$initializeAddonClasses[$addon] = new $addon;
				do_action('after_wow_addon_initializing_'.$addon);
			}
		}
		do_action('after_wow_addon_initialize');
		apply_filters('wow_initialize_addons', $initializeAddonClasses);
	}
}



if (! function_exists('wow_init')){
	function wow_init(){
		WPPB::instance();
	}
}
wow_init();


if ( ! function_exists('wow_helper')){
	function wow_helper(){
		return new WOW_Helper();
	}
}

/**
 * @param null $addon_name
 *
 * @return null
 */
if ( ! function_exists('addon_instance')){
	function addon_instance($addon_name = null){
		list($instance, $addon_instance) = null;

		$available_addons = wow_helper()->get_addon_classes();
		if( !empty($available_addons) ) {
			foreach ( $available_addons as $class ) {
				if ( ! class_exists($class)){
					continue;
				}
				$instance = new $class;
				if ($instance->get_name() === $addon_name){
					$addon_instance = $instance;
				}
			}
		}
		return $addon_instance;
	}
}
