<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Theme_Manager {

	/**
	 * WOW_Theme_Manager constructor.
	 *
	 */
	public function __construct() {
		//Include wp page builder default template without wrapper
		add_filter( 'template_include', array($this, 'template_include') );

		//Add WP PageBuilder supported Post type in page template
		$post_types = wow_get_option('supported_post_type');
		if( is_array($post_types) ){
			foreach ($post_types as $post_type){
				add_filter( "theme_{$post_type}_templates", array( $this, 'add_wow_pagebuilder_template' ) );
			}
		}

		$gutenberg_editor = wow_get_option('gutenberg_editor');
		$widget_block_editor = wow_get_option('widget_block_editor');
		if( $gutenberg_editor && $gutenberg_editor == 'enable' ){	
			add_filter('use_block_editor_for_post', '__return_false');
		}
		if( $widget_block_editor && $widget_block_editor == 'enable' ){	
			add_filter( 'use_widgets_block_editor', '__return_false' );
		}

	}

	/**
	 * @param $template
	 *
	 * @return string
	 */
	public function template_include($template){
		if ( is_singular() ) {
			$page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			if ( $page_template === 'wow_theme_template' ) {
				$template = WOW_DIR_PATH . 'inc/default-template.php';
			}
		}
		return $template;
	}

	/**
	 * @param $post_templates
	 *
	 * @return mixed
	 */
	public function add_wow_pagebuilder_template($post_templates){
		$post_templates['wow_theme_template'] = __('WOW Page Builder Template', 'wow-pagebuilder');
		return $post_templates;
	}

}