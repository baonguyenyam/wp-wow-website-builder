<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists('WOW_Assets')) {
	class WOW_Assets {

		private $_post_id;

		public function __construct() {
			if( wow_helper()->is_editor_screen() ) {
				$this->_post_id = absint( $_REQUEST['post'] );
			}

			if (wow_helper()->is_editor_screen() || wow_helper()->is_load_editor_iframe()){
				//Load only for WOW Page Builder
				add_action('wow_enqueue_scripts', array($this, 'wow_enqueue_scripts'));
				add_action('wow_enqueue_scripts', array($this, 'wow_enqueue_gblobal_scripts'));
				add_action('wow_enqueue_styles', array($this, 'wow_enqueue_styles'));

				add_action('wp_enqueue_scripts', array($this, 'wow_enqueue_gblobal_scripts'));
				add_action('wp_enqueue_scripts', array($this, 'wow_enqueue_styles'));

				do_action('wow_after_enqueue_in_editor');
			}

			// Load backend script
			add_action('admin_enqueue_scripts', array($this, 'wow_backend_script_loader'));
			add_action('wp_ajax_wow_switch_editor', array($this, 'wow_switch_editor_callback'));
			add_action('wp_ajax_wow_switch_default', array($this, 'wow_switch_default_callback'));

		}

		/**
		 * enqueue scripts to the pagebuilder section
		 */
		public function wow_enqueue_scripts(){
			global $wp_styles, $wp_scripts;

			if( wow_helper()->is_editor_screen() ){

				// Reset global variable
				$wp_scripts = new \WP_Scripts();


				$is_script_debug = wow_helper()->is_script_debug();
				$suffix = $is_script_debug ? '' : '.min';
				/**
				 * Giving widgets support from wp version 4.8
				 */
				$wp_scripts->add( 'media-widgets', "/wp-admin/js/widgets/media-widgets{$suffix}.js", array( 'jquery', 'media-models', 'media-views' ) );
				$wp_scripts->add_inline_script( 'media-widgets', 'wp.mediaWidgets.init();', 'after' );

				$wp_scripts->add( 'media-audio-widget', "/wp-admin/js/widgets/media-audio-widget{$suffix}.js", array( 'media-widgets', 'media-audiovideo' ) );
				$wp_scripts->add( 'media-image-widget', "/wp-admin/js/widgets/media-image-widget{$suffix}.js", array( 'media-widgets' ) );
				$wp_scripts->add( 'media-video-widget', "/wp-admin/js/widgets/media-video-widget{$suffix}.js", array( 'media-widgets', 'media-audiovideo' ) );
				$wp_scripts->add( 'text-widgets', "/wp-admin/js/widgets/text-widgets{$suffix}.js", array( 'jquery', 'editor', 'wp-util' ) );
				$wp_scripts->add_inline_script( 'text-widgets', 'wp.textWidgets.init();', 'after' );

				wp_enqueue_style( 'widgets' );
				wp_enqueue_style( 'media-views' );

				do_action( 'admin_print_scripts-widgets.php' );
				do_action( 'sidebar_admin_setup' );
				do_action( 'admin_enqueue_scripts', 'widgets.php' );
				do_action( 'admin_print_styles-widgets.php' );
				/**
				 * End specialized widgets support
				 */

				wp_enqueue_editor();

				wp_enqueue_script( 'wow-lodash',WOW_DIR_URL.'assets/js/lodash.min.js',array(),false,true );
				wp_add_inline_script( 'wow-lodash', 'window.__ = _.noConflict();' );

				wp_enqueue_script( 'engine',WOW_DIR_URL.'assets/js/engine.js',
					array(
						'jquery',
						'jquery-ui-resizable',
						'wp-auth-check',
						'heartbeat',
					), false,true );


				$initial_state = json_decode( get_post_meta( $this->_post_id,'_wow_content', true ) );
				if( empty($initial_state) ){
					$initial_state = array();
				}
				$addons_data = new WOW_Base_Data();


				$dashboard_page = '#';
				$view_page = '#';
				if (wow_helper()->is_editor_screen()){
					$editor_id = wow_helper()->get_the_editor_post_id();
					$dashboard_page = admin_url("post.php?post={$editor_id}&action=edit");
					$view_page = get_permalink($editor_id);
				}

				$js_translate = array(
					'add_row' => __('Add Row','wow-pagebuilder'), 'layouts' => __('Layouts','wow-pagebuilder'), 'default_addons' => __('Default Addons','wow-pagebuilder'), 
					'wordpress_widgets' => __('WordPress Widgets','wow-pagebuilder'), 'add_column' => __('Add Column','wow-pagebuilder'), 'duplicate_column' => __('Duplicate Column','wow-pagebuilder'), 
					'disable_column' => __('Disable Column','wow-pagebuilder'), 'delete_column' => __('Delete Column','wow-pagebuilder'), 'add_inner_row' => __('Add Inner Row','wow-pagebuilder'), 
					'drag_column' => __('Drag Column','wow-pagebuilder'), 'drag_inner_row' => __('Drag Inner Row','wow-pagebuilder'), 'addons' => __('Addons','wow-pagebuilder'), 
					'blocks' => __('Blocks','wow-pagebuilder'), 'library' => __('Library','wow-pagebuilder'), 'tools' => __('Tools','wow-pagebuilder'), 'import' => __('Import','wow-pagebuilder'), 
					'export' => __('Export','wow-pagebuilder'), 'clear_page_content' => __('Clear Page Content','wow-pagebuilder'), 'view' => __('View','wow-pagebuilder'), 
					'save' => __('Save','wow-pagebuilder'), 'dashboard' => __('Dashboard','wow-pagebuilder'), 'edit_page' => __('Edit Page','wow-pagebuilder'), 
					'view_page' => __('View Page','wow-pagebuilder'), 'undo' => __('Undo','wow-pagebuilder'), 'redo' => __('Redo','wow-pagebuilder'), 
					'duplicate_row' => __('Duplicate Row','wow-pagebuilder'), 'save_row' => __('Save Row','wow-pagebuilder'), 'disable_row' => __('Disable Row','wow-pagebuilder'), 
					'move_up' => __('Move Up','wow-pagebuilder'), 'move_down' => __('Move Down','wow-pagebuilder'), 'delete_row' => __('Delete Row','wow-pagebuilder'), 
					'preview' => __('Preview','wow-pagebuilder'), 'pro' => __('PRO','wow-pagebuilder'), 'save_to_library' => __('Save to Library','wow-pagebuilder'), 
					'discard' => __('Discard','wow-pagebuilder'), 'title_of_the_custom_section' => __('Title of the custom section','wow-pagebuilder'), 'pages' => __('Pages','wow-pagebuilder'), 
					'categories' => __('Categories','wow-pagebuilder'), 'search' => __('Search','wow-pagebuilder'), 'apply' => __('Apply','wow-pagebuilder'), 'add_item' => __('Add Item','wow-pagebuilder'), 
					'cancel' => __('Cancel','wow-pagebuilder'), 'name' => __('Name','wow-pagebuilder'), 'delay' => __('Delay','wow-pagebuilder'), 'duration' => __('duration','wow-pagebuilder'), 
					'background' => __('Background','wow-pagebuilder'), 'hover' => __('Hover','wow-pagebuilder'), 'color' => __('Color','wow-pagebuilder'), 'image' => __('Image','wow-pagebuilder'), 
					'gradient' => __('Gradient','wow-pagebuilder'), 'video' => __('Video','wow-pagebuilder'), 'position' => __('Position','wow-pagebuilder'), 
					'attachment' => __('Attachment','wow-pagebuilder'), 'repeat' => __('Repeat','wow-pagebuilder'), 'size' => __('Size','wow-pagebuilder'), 'url' => __('URL','wow-pagebuilder'), 
					'fallback_image' => __('Fallback Image','wow-pagebuilder'), 'upload_video' => __('Upload Video','wow-pagebuilder'), 'type' => __('Type','wow-pagebuilder'), 
					'background_color' => __('Background Color','wow-pagebuilder'), 'style' => __('Style','wow-pagebuilder'), 'horizontal' => __('Horizontal','wow-pagebuilder'), 
					'vertical' => __('Vertical','wow-pagebuilder'), 'blur' => __('Blur','wow-pagebuilder'), 'spread' => __('Spread','wow-pagebuilder'), 'top' => __('Top','wow-pagebuilder'), 'right' => __('Right','wow-pagebuilder'), 
					'bottom' => __('Bottom','wow-pagebuilder'), 'left' => __('Left','wow-pagebuilder'), 'gradient_type' => __('Gradient Type','wow-pagebuilder'), 
					'gradient_direction' => __('Gradient Direction','wow-pagebuilder'), 'start_position' => __('Start Position','wow-pagebuilder'), 'end_position' => __('End Position','wow-pagebuilder'), 
					'all' => __('All','wow-pagebuilder'), 'wow_icon' => __('Default Icon','wow-pagebuilder'), 'fontawesome' => __('Font Awesome 5','wow-pagebuilder'), 
					'open_in_new_window' => __('Open in new window','wow-pagebuilder'), 'nofollow' => __('nofollow','wow-pagebuilder'), 'delete' => __('Delete','wow-pagebuilder'), 
					'width' => __('Width','wow-pagebuilder'), 'height' => __('Height','wow-pagebuilder'), 'flip' => __('Flip','wow-pagebuilder'), 'invert' => __('Invert','wow-pagebuilder'), 
					'bring_to_front' => __('Bring to Front','wow-pagebuilder'), 'font_family' => __('Font Family','wow-pagebuilder'), 'font_size' => __('Font Size','wow-pagebuilder'), 
					'line_height' => __('Line Height','wow-pagebuilder'), 'letter_spacing' => __('Letter Spacing','wow-pagebuilder'), 'font_style' => __('Font Style','wow-pagebuilder'), 
					'font_weight' => __('Font Weight','wow-pagebuilder'),'text_decoration' => __('Text Decoration','wow-pagebuilder'), 'text_transform' => __('Text Transform','wow-pagebuilder'),'disable' => __('Disable','wow-pagebuilder'),'enable' => __('Enable','wow-pagebuilder'), 
					'brightness' => __('Brightness','wow-pagebuilder'), 'contrast' => __('Contrast','wow-pagebuilder'), 'grayscale' => __('Grayscale','wow-pagebuilder'), 'invert' => __('Invert','wow-pagebuilder'), 'hue_rotate' => __('Hue Rotate','wow-pagebuilder'), 'saturate' => __('Saturate','wow-pagebuilder'), 'sepia' => __('Sepia','wow-pagebuilder'),       
				);

				$page_data = apply_filters('wow_page_data',
					array(
						'ajaxurl'           => admin_url( 'admin-ajax.php' ),
						'wow_version'      => WOW_VERSION,
						'initialState'      => $initial_state,
						'pagebuilder_base'  => WOW_DIR_URL,
						'script_debug'      => $is_script_debug ? 1 : 0,
						'content_url'       => content_url(),
						'admin_url'         => admin_url('/'),
						'addonsJSON'        => $addons_data->addons_data()['addons'],
						'rowSettings'       => $addons_data->row_settings(),
						'colSettings'       => $addons_data->column_settings(),
						'globalAttr'        => $addons_data->global_attr(),
						'widgetJSON'        => $addons_data->widgetLists(),
						'dashboard_page'    => $dashboard_page,
						'view_page'         => $view_page,
						'wow_wp_editor'    => $this->wp_editor_default_template(),
						'SvgShape'			=> $addons_data->getSvgShapes(),
						'wppbimagesize'		=> wow_getLall_image_sizes_option(),
						'i18n'				=> $js_translate,
					)
				);
				
				wp_localize_script( 'engine', 'page_data', $page_data );
			}
		}

		public function wow_enqueue_gblobal_scripts(){
			// Register JS for Addons
			wp_enqueue_script( 'jquery.magnific-popup',WOW_DIR_URL.'assets/js/jquery.magnific-popup.min.js',array(),false,true );
			wp_enqueue_script( 'jquery.easypiechart',WOW_DIR_URL.'assets/js/jquery.easypiechart.min.js',array(),false,true );
			wp_enqueue_script( 'jquery.inview',WOW_DIR_URL.'assets/js/jquery.inview.min.js',array(),false,true );
			wp_enqueue_script( 'wow-slick-slider', WOW_DIR_URL.'assets/js/slick/slick.min.js', array(),'1.8.0', true);

			wp_enqueue_script( 'wppagebuilder-main',WOW_DIR_URL.'assets/js/main.js',array(),false,true );
			wp_localize_script( 'wppagebuilder-main', 'ajax_objects', array(
				'ajaxurl'           => admin_url( 'admin-ajax.php' ),
				'redirecturl'       => home_url('/'),
			));

			do_action('wow_enqueue_scripts_in_editor');
		}

		/**
		 * Adding stylesheet in the pagebuilder section
		 */

		public function wow_enqueue_styles(){
			$suffix = wow_helper()->is_script_debug() ? '' : '.min';
			wp_enqueue_style( 'jquery-ui', WOW_DIR_URL . 'assets/css/jquery-ui.css',false,'1.12.1');
			wp_enqueue_style( 'animate', WOW_DIR_URL . 'assets/css/animate.min.css',false,'all');
			wp_enqueue_style( 'font-awesome-5', WOW_DIR_URL . 'assets/css/font-awesome-5.min.css',false,'all');
			wp_enqueue_style( 'wow-fonts', WOW_DIR_URL . 'assets/css/wow-fonts.css',false,'all');
			wp_enqueue_style( 'magnific-popup', WOW_DIR_URL . 'assets/css/magnific-popup.css',false,'all');

			//SLick Slider
			wp_enqueue_style('wow-slick', WOW_DIR_URL.'assets/js/slick/slick.css', array(),'1.8.0' );
			wp_enqueue_style('wow-slick-theme', WOW_DIR_URL.'assets/js/slick/slick-theme.css', array(),'1.8.0' );

			// New Grid
			wp_enqueue_style( 'wow-addons', WOW_DIR_URL . 'assets/css/wow-addons.css',false,'all');

			//Load only in the page builder editor
			wp_enqueue_style( 'dashicons-wppb', "/wp-includes/css/dashicons{$suffix}.css", false, 'all' );
			wp_enqueue_style( 'edit-frontend', WOW_DIR_URL . 'assets/css/edit.css', false, 'all' );
			wp_enqueue_style( 'react-select', WOW_DIR_URL . 'assets/css/react-select.css', false, 'all' );
			wp_enqueue_style( 'wow-main', WOW_DIR_URL . 'assets/css/wow-main.css', array('wp-auth-check'),'all');

			do_action('wow_enqueue_style_in_editor');
		}


		public function wp_editor_default_template(){
			ob_start();

			wp_editor( '{{WP_EDITOR_CONTENT}}', 'wow_wp_editor',
				array(
					'editor_class' => 'wow-wp-editor',
					'editor_height' => 250,
					'drag_drop_upload' => true
				)
			);
			return ob_get_clean();
		}

		/**
		 * @param $page
		 *
		 *
		 */
		function wow_backend_script_loader($page) {
			wp_enqueue_style( 'wow-edit-backend',  WOW_DIR_URL . 'assets/css/wow-backend.css',false,'all');
			wp_enqueue_script( 'wow-edit-backend-js',WOW_DIR_URL.'assets/js/wow-backend.js',array(),false,true );
			$is_switched_editor = '';
			if ($page === 'post.php' && ! empty($_GET['post'])){
				$page_id = (int) sanitize_text_field($_GET['post']);
				$get_editor_switched = get_post_meta($page_id, '_wow_current_post_editor', true);
				if ($get_editor_switched){
					$is_switched_editor = $get_editor_switched;
				}
			}
			$ajax_nonce = wp_create_nonce( "wow-nonce-string" );


			$supported_post_types    = wow_helper()->wow_supports_post_types();

			wp_localize_script( 'wow-edit-backend-js', 'wow_admin_ajax',
				array(
					'ajax_url' => admin_url('admin-ajax.php'),
					'wow_nonce'     => $ajax_nonce,
					'current_editor' => $is_switched_editor,
					'supported_post_type'   => $supported_post_types
				)
			);
		}

		function wow_switch_editor_callback(){
			check_ajax_referer( 'wow-nonce-string', 'wow_nonce' );

			$post_id = (int) sanitize_text_field($_POST['post_id']);
			if ($post_id){
				update_post_meta($post_id, '_wow_current_post_editor', 'wow_builder_activated');
				wp_send_json_success(array('success' => true));
			}
		}

		function wow_switch_default_callback(){
			check_ajax_referer( 'wow-nonce-string', 'wow_nonce' );

			$post_id = (int) sanitize_text_field($_POST['post_id']);
			if ($post_id){
				//Mark last edit to view pages
				$lastEditor = isset($_POST['last_editor']) ? sanitize_text_field($_POST['last_editor']) : 'wow_default_editor';
				update_post_meta($post_id, '_wow_current_post_editor', $lastEditor);
				wp_send_json_success(array('success' => true));
			}
		}


	}
}