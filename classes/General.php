<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists('WOW_General')){
	class WOW_General{
		/**
		 * WOW_General constructor.
		 */
		public function __construct(){
			if ( wow_helper()->can_edit_editor() ) {
				add_filter('post_row_actions', array($this, 'posts_table_row_actions'), 10, 2 );
				add_filter('page_row_actions', array($this, 'posts_table_row_actions'), 10, 2 );
				add_filter('display_post_states' , array($this, 'wow_display_post_states'), 10, 2);
			}

			// Check if editor iframe load by get_permalink
			if (wow_helper()->is_load_editor_iframe()){
				add_filter('show_admin_bar', '__return_false' ); // Remove Admin Bar
			}
			
			add_action( 'init', array( $this, 'addon_include') ); // Include addon directory
			add_action( 'edit_form_after_title', array( $this, 'after_title_button_add' )); // Add Button After Title
			add_filter( 'the_content', array( $this, 'content_modify_filter' ) ); // Return Content After Modify

			add_action( 'admin_init', array( $this, 'wow_go_premium_page' ) );
			add_action( 'admin_menu', array( $this, 'wow_add_admin_menu' ), 502 );

		}
		
		/**
		 * @param $actions
		 * @param $post
		 *
		 * @return mixed
		 */
		public function posts_table_row_actions( $actions, $post ) {
			$wow_supports_post_types = wow_helper()->wow_supports_post_types();
			if ( in_array( $post->post_type, $wow_supports_post_types ) ) {
				$editor_url = wow_helper()->get_editor_url($post->ID);
				$actions['wow_editor'] = '<a href="'.$editor_url.'">'.__('Edit with WOW Page Builder', 'wow-pagebuilder' ).'</a>';
			}
			return $actions;
		}

		/**
		 * @param $post_states
		 * @param $post
		 *
		 * @return array
		 *
		 * display post states in the wp post list
		 */
		public function wow_display_post_states($post_states, $post){
			require_once(ABSPATH . 'wp-admin/includes/screen.php');
			$screen = get_current_screen();
			if (isset($screen->base)) {
				if ( $screen->base === 'edit'){
					$wow_supports_post_types = wow_helper()->wow_supports_post_types();
					if ( in_array($post->post_type, $wow_supports_post_types)) {
						$is_wow_editor_page = get_post_meta( $post->ID, '_is_wow_editor', true );
						if ( $is_wow_editor_page ) {
							$post_states[] = ' WOW Page Builder ';
						}
					}
				}
			}
			return $post_states;
		}

		// Return Content After Modify
		function content_modify_filter( $content ) {
			$editor = get_post_meta( get_the_ID(), '_wow_current_post_editor', true );
			if( $editor  ){
				if( $editor == 'wow_builder_activated' ){
					return '<div id="wow-builder-container" class="wow-builder-container">'.$content.'</div>';
				}else{
					return $content;	
				}
			}else{
				return $content;
			}
		}

		// Include addon directory
		public function addon_include(){
			$addon_dir = array_filter(glob( WOW_DIR_PATH.'addons/*'), 'is_dir');
			if (count($addon_dir) > 0) {
				foreach ($addon_dir as $key => $value) {
					$addon_dir_name = str_replace(dirname($value).'/', '', $value);
					$file_name = WOW_DIR_PATH . 'addons/'.$addon_dir_name.'/'.$addon_dir_name.'.php';
					if ( file_exists($file_name) ){
						include_once $file_name;
					}
				}
			}
		}

		// Add Button After Title
		public function after_title_button_add($pram){
			global $post;
			$editor = get_post_meta( $post->ID,'_wow_current_post_editor', true );

			$supported_post_types    = wow_helper()->wow_supports_post_types();
			if( !in_array($pram->post_type, $supported_post_types) ){
				return;
			}
			if (! wow_helper()->can_edit_editor()){
				return;
			}
			?>
			<?php if( $editor == 'wow_builder_activated' ) { ?>
				<div class="wppagebuilder-edit-button wppagebuilder-edit-hide-editor" data-postid="<?php echo $post->ID; ?>">
			<?php } else { ?>
				<div class="wppagebuilder-edit-button wppagebuilder-edit-show-editor" data-postid="<?php echo $post->ID; ?>">
			<?php } ?>
			<?php if( $editor == 'wow_builder_activated' ) { ?>
				<div class="wow-edit-button-wrap">
					<div class="wow-back-editor wow-class-editor-show">
						<a href="#" class="wow-backend-btn wow-info-btn use-default-editor"><?php _e('Use Default Editor','wow-pagebuilder' );?></a>
					</div><!--/.wow-back-editor-->
					<div class="wow-editor-warper">
						<a href="<?php echo wow_helper()->get_editor_url($post->ID); ?>" class="wow-backend-btn wow-primary-btn edit-with-wow-builder"><?php _e('Edit With WOW Page Builder','wow-pagebuilder');?></a>
					</div>
				</div><!--/.wow-edit-button-wrap-->
			<?php } else { ?>
				<div class="wow-edit-button-default-wrap">
					<div class="wow-editor-warper">
						<a href="<?php echo wow_helper()->get_editor_url($post->ID); ?>" class="wow-backend-btn wow-primary-btn edit-with-wow-builder"><?php _e('Edit With WOW Page Builder','wow-pagebuilder');?></a>
					</div>
				</div><!--/.wow-edit-button-default-wrap-->
			<?php } ?>
			</div><!--/.wppagebuilder-edit-button-->
			<?php
		}

		/*
		 * Add go pro plugin if pro plugin as not activated
		 */
		public function wow_add_admin_menu(){
            $is_pro_activated = is_plugin_active('wow-pagebuilder-pro/wow-pagebuilder-pro.php');
            if ( ! $is_pro_activated ){
	            // add_submenu_page( 'wow-settings', __( 'Go Premium', 'wow-pagebuilder' ), __( '<span class="dashicons dashicons-awards wow-go-premium-star"></span> Go Premium', 'wow-pagebuilder' ), 'manage_options', 'wow-go-premium', array($this, 'wow_go_premium_page') );
            }
		}

		/**
		 * Admin Go Premium Redirect to Themeum
		 */
		public function wow_go_premium_page(){
			if ( empty( $_GET['page'] ) ) {
				return;
			}
			
			if ( 'wow-go-premium' === $_GET['page'] ) {
				wp_redirect( 'https://wow-wp.com' );
				die();
			}
        }
	}
}