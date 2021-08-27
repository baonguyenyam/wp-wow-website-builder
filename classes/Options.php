<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists('WOW_Options')){

	class WOW_Options{
		// Constructor
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}

		/**
		 * Add Menu Page Callback
		 *
		 * @since 1.0.0
		 */
		public function add_admin_menu() {
			add_menu_page(
				esc_html__( 'WOW Page Builder', 'wow-pagebuilder' ),
				esc_html__( 'WOW Page Builder', 'wow-pagebuilder' ),
				'manage_options',
				'wow-settings',
				array( $this, 'create_admin_page' ),
				plugins_url( 'wp-wow-website-builder/assets/img/tinny-logo.png' )
			);

		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * @since 1.0.0
		 */
		public function register_settings() {
			register_setting( 'wow_options', 'wow_options', array( $this, 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {
			if ( $options ) {
				if ( ! empty( $options['css_save_as'] ) ) {
					$options['css_save_as'] = sanitize_text_field( $options['css_save_as'] );
				}
				if ( ! empty( $options['gutenberg_editor'] ) ) {
					$options['gutenberg_editor'] = sanitize_text_field( $options['gutenberg_editor'] );
				}
				if ( ! empty( $options['widget_block_editor'] ) ) {
					$options['widget_block_editor'] = sanitize_text_field( $options['widget_block_editor'] );
				}
				if ( ! empty( $options['supported_post_type'] ) ) {
					$options['supported_post_type'] = $options['supported_post_type'];
				}
			}
			return $options;
		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>
            <div class="wrap">
                <h1 class="wow-title"><img src="<?php echo plugins_url( 'wp-wow-website-builder/assets/img/tinny-logo.png' )?>" alt="" srcset=""><?php esc_html_e( 'WOW Page Builder Options', 'wow-pagebuilder' ); ?></h1>

                <form method="post" action="options.php">
					<?php
					settings_fields( 'wow_options' );
					$option_data    = get_option( 'wow_options' );
					$post_types     = get_post_types( [ 'public' => true ], 'objects' );
					if( isset($post_types['attachment']) ){ unset( $post_types['attachment'] ); }

					$user_roles = get_editable_roles();
					?>

					<div class="wow-box-wrapper">
	
						<table class="form-table wpex-custom-admin-login-table wow-table clearfix">


							<tr>
								<th scope="row"><?php esc_html_e( 'Disable the Gutenberg Editor', 'wow-pagebuilder' ); ?></th>
								<td>
									<?php $value = $option_data['gutenberg_editor']; ?>
									<select name="wow_options[gutenberg_editor]">
										<?php
										$options = array(
											'disable' => __( 'Off','wow-pagebuilder' ),
											'enable'   => __( 'On','wow-pagebuilder' ),
										);
										foreach ( $options as $id => $label ) { ?>
											<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
												<?php echo strip_tags( $label ); ?>
											</option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row"><?php esc_html_e( 'Disable Widget Block Editor', 'wow-pagebuilder' ); ?></th>
								<td>
									<?php $value = $option_data['widget_block_editor']; ?>
									<select name="wow_options[widget_block_editor]">
										<?php
										$options = array(
											'disable' => __( 'Off','wow-pagebuilder' ),
											'enable'   => __( 'On','wow-pagebuilder' ),
										);
										foreach ( $options as $id => $label ) { ?>
											<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
												<?php echo strip_tags( $label ); ?>
											</option>
										<?php } ?>
									</select>
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php esc_html_e( 'Post Type', 'wow-pagebuilder' ); ?></th>
								<td>
									<?php
									$value = wow_get_option('supported_post_type');
									if( $post_types ){
										foreach( $post_types as $post_type ){ ?>
											<label>
												<input type="checkbox" name="wow_options[supported_post_type][]" value="<?php echo $post_type->name; ?>" <?php if( $value ){ if(in_array( $post_type->name, $value )){ echo 'checked'; } } ?> >
												<?php echo $post_type->label; ?><br>
											</label>
										<?php }
									}
									?>
	
									<p class="description"> <?php _e('Select post types that can be edited with WOW Page Builder.', 'wow-pagebuilder'); ?></p>
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php esc_html_e( 'Include User Role', 'wow-pagebuilder' ); ?></th>
								<td>
									<?php
									$included_user_roles = wow_get_option( 'include_role' );
	
									if ( $user_roles ) {
										foreach ( $user_roles as $user_slug => $single_role ) { ?>
											<label><input type="checkbox" name="wow_options[include_role][]" value="<?php echo $user_slug; ?>" <?php if ( $included_user_roles ) { if (in_array( $user_slug, $included_user_roles )){ echo 'checked'; } } ?> > <?php echo $single_role['name']; ?><br></label>
										<?php }
									}
									?>
	
									<p class="description"> <?php _e('Include the user roles that you want to allow editing this site with WOW Page Builder.', 'wow-pagebuilder'); ?></p>
	
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php _e('Content Width', 'wow-pagebuilder'); ?></th>
								<td>
									<input type="text" class="wow-regular-text" id="wow_container_width" name="wow_options[wow_container_width]" value="<?php echo wow_get_option('wow_container_width'); ?>" placeholder="1140"> px
									<p class="description"> <?php _e('Default Content Width is 1140 px. You can set any width.','wow-pagebuilder'); ?></p>
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php _e('Gutter', 'wow-pagebuilder'); ?></th>
								<td>
									<input type="text" class="wow-regular-text" id="wow_col_spacing" name="wow_options[wow_col_spacing]" value="<?php echo wow_get_option('wow_col_spacing'); ?>" placeholder="30"> px
									<p class="description"> <?php _e('Default Spacing is 30 px. You can set any spacing.','wow-pagebuilder'); ?></p>
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php esc_html_e( 'CSS Save Method', 'wow-pagebuilder' ); ?></th>
								<td>
									<?php $value = $option_data['css_save_as']; ?>
									<select name="wow_options[css_save_as]">
										<?php
										$options = array(
											'filesystem' => __( 'File System','wow-pagebuilder' ),
											'wp_head'   => __( 'Header','wow-pagebuilder' ),
										);
										foreach ( $options as $id => $label ) { ?>
											<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
												<?php echo strip_tags( $label ); ?>
											</option>
										<?php } ?>
									</select>
									<p class="description"> <?php _e('Select where you want to save the CSS.', 'wow-pagebuilder'); ?></p>
								</td>
							</tr>
	
							<tr>
								<th scope="row"><?php esc_html_e( 'Cache', 'wow-pagebuilder' ); ?></th>
								<td>
									<label>
										<button type="button" id="wow_clear_cache_btn" class="button"><?php _e('Clean Cache and Sync','wow-pagebuilder'); ?></button>
										<p class="response-text"></p>
										<p class="description"> <?php _e('Clean WOW Page Builder cache & synchronize built-in layouts & blocks with server.', 'wow-pagebuilder'); ?></p>
									</label>
								</td>
							</tr>
	
	
						</table>
						<div class="clearfix"><?php submit_button(); ?></div>

					</div>
                </form>
            </div>
		<?php }
	}


}