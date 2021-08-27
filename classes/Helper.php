<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists('WOW_Helper')) {
	class WOW_Helper {
		public function __construct() {
			add_filter( 'plugin_action_links_' . WOW_BASENAME, array($this, 'plugin_action_links_callback') );
			add_filter( 'plugin_row_meta' , array($this, 'plugin_row_meta_callback'), 10, 2 );
			add_filter( 'wp_kses_allowed_html', array( $this, 'custom_wpkses_post_tags' ), 10, 2 );
		}

		/**
		 * @param int $post_id
		 *
		 * @return mixed
		 *
		 * @return WPPB editor URL
		 *
		 * @since v.1.0.0
		 */
		public function get_editor_url($post_id = 0){
			$edit_link = add_query_arg( array( 'post' => $post_id, 'action' => 'wow_editor' ), admin_url( 'post.php' ) );
			return apply_filters( 'wow_get_editor_url', $edit_link, $post_id );
		}

		public function is_script_debug(){
			return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
		}


		/**
		 * @param $post_id
		 *
		 * Setup post data based on post id
		 *
		 * @since v.1.0.0
		 */
		public function setup_post_data( $post_id ) {
			if ( $post_id === get_the_ID()) {
				return;
			}
			$GLOBALS['post'] = get_post( $post_id );
			setup_postdata( $GLOBALS['post'] );
		}


		/**
		 *
		 * determine if wppb editor is open
		 *
		 * @since V.1.0.0
		 * @return bool
		 *
		 * @since v.1.0.0
		 */
		public function is_editor_screen(){
			if ( ! empty($_GET['action']) &&  $_GET['action'] === 'wow_editor'){
				return true;
			}
			return false;
		}

		/**
		 * @return bool
		 *
		 * @since v.1.0.0
		 */
		public function is_load_editor_iframe(){
			if ( ! empty($_GET['load_for']) && $_GET['load_for'] === 'wow_editor_iframe' ){
				return true;
			}
			return false;
		}

		/**
		 * @return bool|false|int
		 *
		 * determine if current single page is WOW Page Builder Page
		 */
		public function is_wow_single(){
			$post_id = get_the_ID();
			if ( ! $post_id){
				return false;
			}
			$post = get_post($post_id);
			if ( ! is_singular($post->post_type)){
				return false;
			}

			if ( ! $this->is_wow_content($post_id)){
				return false;
			}
			return $post_id;
		}

		/**
		 * @param int $post_id
		 *
		 * @return bool
		 *
		 * Determine if this post contain wppb editor content
		 *
		 * @since v.1.0.0
		 */
		public function is_wow_content($post_id = 0){
			$is_wow_pagebuilder_page = get_post_meta($post_id, '_is_wow_editor', true);
			if ($is_wow_pagebuilder_page){
				return true;
			}

			return false;
		}

		/**
		 * @return mixed
		 *
		 * return options
		 *
		 * @since v.1.0.0
		 */
		public function wow_options(){
			return apply_filters('wow_options', get_option( 'wow_options' ));
		}

		/**
		 * @return mixed
		 *
		 * get WOW Page Builder Support Post Type
		 * @since v.1.0.0
		 */
		public function wow_supports_post_types(){
			$wow_option = $this->wow_options();
			$support_post_type = array();
			if ( is_array( $wow_option['supported_post_type'] ) ){
				if( ! empty($wow_option['supported_post_type'] ) ){
					$support_post_type = $wow_option['supported_post_type'];
				}
			}
			return apply_filters('wow_supports_post_type', $support_post_type);
		}

		/**
		 * @return array
		 *
		 * get exclude roles
		 * @since v.1.0.0
		 */
		public function wow_exclude_roles(){
			$exclude = array();
			$wow_options = $this->wow_options();

			if ( ! empty( $wow_options['exclude_role'] ) ) {
				$exclude = $wow_options['exclude_role'];
			}

			return $exclude;
		}

		/**
		 * @return bool
		 *
		 * @since v.1.0.0
		 */
		public function can_edit_editor() {
			if ( ! is_user_logged_in() ) {
				return false;
			}
			$user_meta = get_userdata( get_current_user_id() );

			$wow_options = $this->wow_options();

			$included_users_roles = isset( $wow_options['include_role'] ) ? $wow_options['include_role'] : array();

			$bool = false;

			if ( ! empty( $included_users_roles ) ) {
				if ( count( array_intersect( $user_meta->roles, $included_users_roles ) ) > 0 ) {
					$bool = true;
				}
			}
			return $bool;
		}

		/**
		 * @return array
		 *
		 * Get All Addon Class Name
		 *
		 * @since v.1.0.0
		 */
		public function get_addon_classes(){
			$addons = array(
				'WOW_Addon_Accordion',
				'WOW_Addon_Alert',
				'WOW_Addon_Animated_Number',
				'WOW_Addon_Blocknumber',
				'WOW_Addon_Button',
				'WOW_Addon_Button_Group',
				'WOW_Addon_Carousel',
				'WOW_Addon_Form',
				'WOW_Addon_Feature_Box',
				'WOW_Addon_Flip_Box',
				'WOW_Addon_Heading',
				'WOW_Addon_Icon',
				'WOW_Addon_Image',
				'WOW_Addon_Image_Hover',
				'WOW_Addon_Person',
				'WOW_Addon_Person_Carousel',
				'WOW_Addon_Pie_Progress',
				'WOW_Addon_Posts_Grid',
				'WOW_Addon_Pricing_Table',
				'WOW_Addon_Progress_Bar',
				'WOW_Addon_Raw_Html',
				'WOW_Addon_Social_Button',
				'WOW_Addon_Soundcloud',
				'WOW_Addon_Tab',
				'WOW_Addon_Testimonial',
				'WOW_Addon_Testimonial_Carousel',
				'WOW_Addon_Text_Block',
				'WOW_Addon_Video',
				'WOW_Addon_Video_Popup',
			);
			return apply_filters('wow_available_addons', $addons);
		}

		/**
		 * @return int
		 *
		 * Get the editor ID
		 */
		public function get_the_editor_post_id(){
			$id = 0;
			if ($this->is_editor_screen()){
				$id = get_the_ID();
			}

			return $id;
		}

		public function get_class_by_addon_name($addon_name = null){
			if ( ! $addon_name){
				return false;
			}

			$get_addon_classes = wow_helper()->get_addon_classes();
			if ( ! empty($get_addon_classes) && count($get_addon_classes)){
				foreach ($get_addon_classes as $addon_class){
					if (class_exists($addon_class)){
						$class_instance = new $addon_class;
						if (method_exists($class_instance, 'get_name')){

							if ($addon_name === $class_instance->get_name()){
								return $class_instance;
							}

						}
					}
				}
			}
			return false;
		}

		public function plugin_action_links_callback( $links ){
			$actionsLinks =  array();
			if (!defined('WOW_PRO_VERSION')) {
				// $actionsLinks['wow_go_premium'] = '<a href="https://wow-wp.com" target="_blank"><span style="color: #39a700eb; font-weight: bold;">'.__('Get Premium', 'wow-pagebuilder').'</span></a>';
			}
			$actionsLinks['wow_settings'] = '<a href="' . admin_url( 'admin.php?page=wow-settings' ) . '">'.__('Settings', 'wow-pagebuilder').'</a>';
			return array_merge( $actionsLinks, $links );
		}

		public function plugin_row_meta_callback( $links , $plugin ){
			if( WOW_BASENAME === $plugin ){
			$actionsLinks =  array(
				// 'wow_docs' =>  '<a href="https://wow-wp.com/" target="_blank">'.__('Docs', 'wow-pagebuilder').'</a>',
			);
				$links = array_merge( $links, $actionsLinks );
			}
			return $links;
		}

		/**
		 * Adding custom tags to allowed html
		 */
		public function custom_wpkses_post_tags( $tags, $context ) {

			if ( $this->is_wow_content( get_the_ID() ) ) {
				$tags['iframe'] = array(
					'src'             => true,
					'height'          => true,
					'width'           => true,
					'frameborder'     => true,
					'allowfullscreen' => true,
				);
			}
		
			return $tags;
		}
	}
}


/**
 * @param null $option
 *
 * @return null
 *
 * get wppb option from this helper
 */
if ( ! function_exists('wow_get_option')){
	function wow_get_option($option = null){
		$wow_options = get_option('wow_options');
		$value = null;
		if ( $wow_options ){
			if ( ! empty($wow_options[$option])){
				$value = $wow_options[$option];
			}
		}

		return $value;
	}
}

if ( ! function_exists('get_wow_array_value_by_key')){
	function get_wow_array_value_by_key($array = array(), $key = null){
		$value = null;

		if ( key_exists($key, $array)){
			$value = $array[$key];
		}
		return $value;
	}
}

/**
 * @return array
 *
 * Return all image sizes
 */
if ( ! function_exists('wow_get_all_image_sizes')){
	function wow_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$image_sizes = array();
		$default_image_sizes = get_intermediate_image_sizes();

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}

		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}
}

/**
 * @return array
 *
 * Return ready made options for image sizes
 */
if ( ! function_exists('wow_getLall_image_sizes_option')){
	function wow_getLall_image_sizes_option(){
		$sizes = wow_get_all_image_sizes();

		$sizes_option = array();
		foreach ($sizes as $key => $size){
			$sizes_option[$key] = ucwords(str_replace(array('_', '-'), ' ', $key))." - ({$size['width']} x {$size['height']}) ";
		}
		return $sizes_option;
	}
}

/**
 * @return array
 */
if ( ! function_exists('wow_get_category_lists')){
	function wow_get_category_lists(){
		$cat = array();
		$categories = get_categories();

		foreach ($categories as $category){
			$cat[$category->cat_ID] = $category->cat_name;
		}

		return $cat;
	}
}

if ( ! function_exists('wow_get_tags_lists')){
	function wow_get_tags_lists(){
		$tagArr = array();
		$tags = get_tags();

		foreach ($tags as $tag){
			$tagArr[$tag->term_id] = $tag->name;
		}

		return $tagArr;
	}
}

if ( ! function_exists('wow_get_saved_addon_settings')) {
	function wow_get_saved_addon_settings( $addon_id = 0, $page_id = 0 ) {
		if ( ! $addon_id || ! $page_id ) {
			return false;
		}

		$addon_id = (int) $addon_id;

		$page_builder_content = get_post_meta( $page_id, '_wow_content', true );
		$settings             = json_decode( $page_builder_content, true );

		foreach ( $settings as $setting ) {
			$columns_count = 0;
			if ( isset( $setting['columns'] ) ) {
				$columns_count = count( $setting['columns'] );
			}

			if ( $columns_count ) {
				foreach ( $setting['columns'] as $col ) {
					$addons_count = 0;
					if ( isset( $col['addons'] ) ) {
						$addons_count = count( $col['addons'] );
					}

					if ( $addons_count ) {
						foreach ( $col['addons'] as $addon ) {

							$addon_type = '';
							if ( ! empty( $addon['type'] ) ) {
								$addon_type = $addon['type'];
							}

							if ( $addon_type === 'inner_row' ) {
								$the_addon = array();
								if ( isset( $addon['columns'] ) && ! empty( $addon['columns'] ) ) {
									foreach ( $addon['columns'] as $inner_columns ) {
										foreach ( $inner_columns['addons'] as $inner_addon ) {
											$the_addon = $inner_addon;
										}
									}
								}
								$saved_addon_id = (int) isset( $the_addon ) ? $the_addon['id'] : 0;
								if ( $addon_id === $saved_addon_id ) {
									return $the_addon;
								}
							} else {
								if ( $addon_type === 'addon' ) {
									$saved_addon_id = (int) isset( $addon ) ? $addon['id'] : 0;
									if ( $addon_id === $saved_addon_id ) {
										return $addon;
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

if ( ! function_exists('wow_get_saved_addons_by_name')){

	function wow_get_saved_addons_by_name($addon_name = false, $page_id = 0){
		if ( ! $addon_name || ! $page_id){
			return false;
		}

		$page_builder_content = get_post_meta($page_id, '_wow_content', true);
		$settings = json_decode($page_builder_content, true);

		$addons = array();
		if( is_array( $settings ) ){
			foreach ( $settings as $setting ){
				$columns_count = 0;
				if ( isset($setting['columns'])){
					$columns_count = count($setting['columns']);
				}

				if ($columns_count){
					foreach ($setting['columns'] as $col){
						$addons_count = 0;
						if ( isset($col['addons'])){
							$addons_count = count($col['addons']);
						}

						if ($addons_count) {
							
							foreach ( $col['addons'] as $addon ) {

								$addon_type = '';
								if ( ! empty($addon['type'])){
									$addon_type = $addon['type'];
								}

								if ( $addon_type === 'inner_row' ) {
									$the_addon = array();
									if ( isset( $addon['columns'] ) && ! empty( $addon['columns'] ) ) {
										foreach ( $addon['columns'] as $inner_columns ) {
											foreach ( $inner_columns['addons'] as $inner_addon ) {
												$the_addon = $inner_addon;
											}
										}
									}
									$inner_addon_name = isset( $the_addon ) ? $the_addon['name'] : '';
									if ( $addon_name === $inner_addon_name ) {
										$addons[] = $the_addon;
									}
								} else {
									if ( $addon_type === 'addon' ) {
										$addon_name = isset($addon) ? $addon['name'] : '';
										if ($addon_name === $addon_name){
											$addons[] = $addon;
										}
									}
								}
							}
						}
					}
				}
			}
		}

		return $addons;
	}
}