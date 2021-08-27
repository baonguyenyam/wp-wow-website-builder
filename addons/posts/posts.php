<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Posts_Grid{

	protected $settings = array();

	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
		add_action('wp_ajax_wow_posts_addon_load_more', array($this, 'wow_posts_addon_load_more'));
		add_action('wp_ajax_nopriv_wow_posts_addon_load_more', array($this, 'wow_posts_addon_load_more'));
	}

	public function get_name(){
		return 'wow_posts_grid';
	}
	public function get_title(){
		return 'Posts Grid';
	}
	public function get_icon() {
		return 'wow-font-interface';
	}

	public function enqueue_frontend_scripts(){
		wp_enqueue_style( 'wow-posts-css', WOW_DIR_URL.'addons/posts/assets/css/posts-addon.css');
		wp_enqueue_script( 'wow-posts-addon', WOW_DIR_URL.'addons/posts/assets/js/posts-addon.js', array('jquery'), false, true );
		wp_localize_script('wow-posts-addon', 'wow_posts_addon', array( 'ajax_url'  => admin_url('admin-ajax.php') ) );
	}

	// Settings Fields
	public function get_settings() {
		$settings = array(
			'posts_column' => array(
				'type'      => 'slider',
				'title'     => __('Column','wow-pagebuilder'),
				'responsive' => true,
				'std' => array(
					'md' => '3',
					'sm' => '2',
					'xs' => '1',
				),
				'step' => 1,
				'max' => 6,
				'min' => 1,
			),
			'posts_per_page' => array(
				'type'      => 'number',
				'title'     => __('Posts Per Page','wow-pagebuilder'),
				'std'       => '3'
			),
			'posts_image_size' => array(
				'type'      => 'select',
				'title'     => __('Image Size','wow-pagebuilder'),
				'values'    => wow_getLall_image_sizes_option(),
				'std'       => 'wow-medium',
			),
			'posts_title_position' => array(
				'type'      => 'select',
				'title'     => __('Title Position','wow-pagebuilder'),
				'values'    => array(
					'above_meta'       => 'Above Meta',
					'below_meta'       => 'Below Meta',
				),
				'std'       => 'above_meta',
			),
			'posts_title' => array(
				'type' => 'switch',
				'title' => __('Title','wow-pagebuilder'),
				'std' => '1'
			),
			'posts_title_tag' => array(
				'type'      => 'select',
				'title'     => __('Title Tag','wow-pagebuilder'),
				'values'    => array(
					'h1'       => 'H1',
					'h2'       => 'H2',
					'h3'       => 'H3',
					'h4'       => 'H4',
					'h5'       => 'H5',
					'h6'       => 'H6',
					'span' 	   => 'span',
					'p' 		=> 'p',
					'div' 		=> 'div',
				),
				'std'       => 'h3',
			),
			'posts_excerpt' => array(
				'type' => 'switch',
				'title' => __('Excerpt','wow-pagebuilder'),
				'std' => '1'
			),
			'posts_excerpt_length' => array(
				'type'      => 'number',
				'title'     => __('Excerpt Length','wow-pagebuilder'),
				'std'       => '30'
			),
			'posts_metadata' => array(
				'type'      => 'select',
				'multiple'  => true,
				'title'     => __('Meta Data','wow-pagebuilder'),
				'values'    => array(
					'author'        => __('Author','wow-pagebuilder'),
					'date'          => __('Date','wow-pagebuilder'),
					'time'          => __('Time','wow-pagebuilder'),
					'comments'      => __('Comments','wow-pagebuilder'),
					'tags'          => __('Tags','wow-pagebuilder'),
					'categories'    => __('Categories','wow-pagebuilder'),
				),
				'std'       => array('author','date','comments'),
			),
			'posts_separator' => array(
				'type'      => 'text',
				'title'     => __('Separator','wow-pagebuilder'),
				'std'       => '/'
			),
			'posts_read_more' => array(
				'type' => 'switch',
				'title' => __('Read More','wow-pagebuilder'),
				'std' => '1'
			),
			'posts_read_more_text' => array(
				'type'      => 'text',
				'title'     => __('Read More Text','wow-pagebuilder'),
				'std'       => 'Read More »'
			),

			//Query Section
			'post_type' => array(
				'type'      => 'select',
				'title'     => __('Post Type','wow-pagebuilder'),
				'values'    => get_post_types(array('public' => true)),
				'std'       => 'post',
				'section' => 'Advanced_Query',
			),
			'posts_categories' => array(
				'type'      => 'select',
				'multiple'  => true,
				'title'     => __('Categories','wow-pagebuilder'),
				'values'    => wow_get_category_lists(),
				'std'       => array(),
				'section' => 'Advanced_Query',
			),
			'posts_tags' => array(
				'type'      => 'select',
				'multiple'  => true,
				'title'     => __('Tags','wow-pagebuilder'),
				'values'    => wow_get_tags_lists(),
				'std'       => array(),
				'section' => 'Advanced_Query',
			),
			'post_order_by' => array(
				'type'      => 'select',
				'title'     => __('Order By','wow-pagebuilder'),
				'values'    => array(
					'title' => __('Title','wow-pagebuilder'),
					'date' => __('Date','wow-pagebuilder'),
					'menu_order' => __('Menu Order','wow-pagebuilder'),
					'comments_count' => __('Comment Count','wow-pagebuilder'),
					'random' => __('Random','wow-pagebuilder'),
				),
				'std'       => 'date',
				'section' => 'Advanced_Query',
			),

			'post_order' => array(
				'type'      => 'select',
				'title'     => __('Order','wow-pagebuilder'),
				'values'    => array(
					'desc' => __('DESC','wow-pagebuilder'),
					'asc' => __('ASC','wow-pagebuilder'),
				),
				'std'       => 'desc',
				'section' => 'Advanced_Query',
			),
			'posts_ids' => array(
				'type'      => 'text',
				'title'     => __('IDS','wow-pagebuilder'),
				'std'       => '',
				'section' => 'Advanced_Query',
			),
			'posts_exclude_ids' => array(
				'type'      => 'text',
				'title'     => __('Exclude IDS','wow-pagebuilder'),
				'std'       => '',
				'section' => 'Advanced_Query',
				'desc' => 'Exclude these ids from the query',
			),

			//Pagination
			'posts_enable_pagination' => array(
				'type' => 'switch',
				'title' => __('Pagination','wow-pagebuilder'),
				'std' => '0',
				'section' => 'Pagination',
			),

			'post_pagination_type' => array(
				'type'      => 'select',
				'title'     => __('Pagination Type','wow-pagebuilder'),
				'values'    => array(
					'numbers_next_previous' => __('Numbers With Next/Previous','wow-pagebuilder'),
					'next_previous' => __('Next/Previous','wow-pagebuilder'),
					'numbers' => __('Numbers','wow-pagebuilder'),
					'load_more' => __('Load More Page Ends','wow-pagebuilder'),
				),
				'std'       => 'numbers_next_previous',
				'section' => 'Pagination',
			),

			// Style Area

			//title
			'post_title_color' => array(
				'type' => 'color',
				'title' => __('Title color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post Title',
				'selector' => '{{SELECTOR}} .wow-post-grid-title a { color: {{data.post_title_color}}; }'
			),
			'post_title_hcolor' => array(
				'type' => 'color',
				'title' => __('Title hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post Title',
				'selector' => '{{SELECTOR}} .wow-post-grid-title a:hover { color: {{data.post_title_hcolor}}; }'
			),
			'post_title_size' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'16px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-post-grid-title',
				'section' => 'Post Title',
				'tab' => 'style',
			),
			'title_item_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '10px', 'left' => '0px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-post-grid-title { margin: {{data.title_item_margin}}; }',
				'section' => 'Post Title',
			),

			//post meta
			'post_meta_item_color' => array(
				'type' => 'color',
				'title' => __('Meta item color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post Meta Item',
				'selector' => '{{SELECTOR}} .wow-post-grid-meta,{{SELECTOR}} .wow-post-grid-meta a { color: {{data.post_meta_item_color}}; }'
			),
			'post_meta_item_hcolor' => array(
				'type' => 'color',
				'title' => __('Meta item hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post Meta Item',
				'selector' => '{{SELECTOR}} .wow-post-grid-meta a:hover { color: {{data.post_meta_item_hcolor}}; }'
			),
			'post_meta_item' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'12px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-post-grid-meta',
				'section' => 'Post Meta Item',
				'tab' => 'style',
			),
			'post_meta_item_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-post-grid-meta { margin: {{data.post_meta_item_margin}}; }',
				'section' => 'Post Meta Item',
			),

			//separator
			'post_meta_size' => array(
				'type' => 'slider',
				'title' => __('Font Size','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 10,
						'step' => .1,
					),
					'px' => array(
						'min' => 5,
						'max' => 100,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Meta Separator',
				'selector' => '{{SELECTOR}} .wow-postmeta-sept { font-size: {{data.post_meta_size}}; }'
			),
			'post_meta_height' => array(
				'type' => 'slider',
				'title' => __('Line height','wow-pagebuilder'),
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 10,
						'step' => .1,
					),
					'px' => array(
						'min' => 5,
						'max' => 100,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'tab' => 'style',
				'section' => 'Meta Separator',
				'selector' => '{{SELECTOR}} .wow-postmeta-sept { line-height: {{data.post_meta_height}}; }'
			),
			'post_meta_separator' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Meta Separator',
				'selector' => '{{SELECTOR}} .wow-postmeta-sept { color: {{data.post_meta_separator}}; }'
			),
			'post_meta_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'std' => array(
					'md' => array( 'top' => '0px', 'right' => '8px', 'bottom' => '0px', 'left' => '8px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-postmeta-sept { margin: {{data.post_meta_margin}}; }',
				'section' => 'Meta Separator',
			),

			//image
			'post_img_width' => array(
				'type' => 'slider',
				'title' => __('Image width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 50,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 500,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post image',
				'selector' => '{{SELECTOR}} .wow-post-grid-img img { width: {{data.post_img_width}}; }'
			),
			'post_img_height' => array(
				'type' => 'slider',
				'title' => __('Image height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 50,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 500,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post image',
				'selector' => '{{SELECTOR}} .wow-post-grid-img img { height: {{data.post_img_height}}; }'
			),
			'post_border_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post image',
				'selector' => '{{SELECTOR}} .wow-post-grid-img img { border-radius: {{data.post_border_radius}}; }'
			),
			'post_img_margin' => array(
				'type' => 'dimension',
				'title' => __('margin','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post image',
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '15px', 'left' => '0px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-post-grid-img img { margin: {{data.post_img_margin}}; }'
			),

			//Content
			'post_content_color' => array(
				'type' => 'color',
				'title' => __('Content color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post content',
				'selector' => '{{SELECTOR}} .wow-post-grid-intro { color: {{data.post_content_color}}; }'
			),
			'post_content_size' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'16px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-post-grid-intro',
				'section' => 'Post content',
				'tab' => 'style',
			),
			'post_content_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '0px', 'bottom' => '15px', 'left' => '0px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'selector' => '{{SELECTOR}} .wow-post-grid-intro { margin: {{data.post_content_margin}}; }',
				'section' => 'Post content',
			),

			//Button
			'post_button_color' => array(
				'type' => 'color',
				'title' => __('Button color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn { color: {{data.post_button_color}}; }'
			),
			'post_button_hcolor' => array(
				'type' => 'color',
				'title' => __('Button hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn:hover { color: {{data.post_button_hcolor}}; }'
			),
			'post_btton_bg' => array(
				'type' => 'color2',
				'title' => 'Button background',
				'clip' => false,
				'selector' => '{{SELECTOR}} .wow-post-grid-btn',
				'tab' => 'style',
				'section' => 'Post button',
			),
			'post_btton_hover_bg' => array(
				'type' => 'color2',
				'title' => 'Button hover background',
				'clip' => false,
				'selector' => '{{SELECTOR}} .wow-post-grid-btn:hover',
				'tab' => 'style',
				'section' => 'Post button',
			),
			'post_button_size' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'12px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-post-grid-btn',
				'section' => 'Post button',
				'tab' => 'style',
			),
			'post_button_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn'
			),
			'post_border_hcolor' => array(
				'type' => 'border',
				'title' => 'hover Border',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn:hover'
			),
			'post_buttom_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn { border-radius: {{data.post_buttom_radius}}; }'
			),
			'post_buttom_hradius' => array(
				'type' => 'dimension',
				'title' => __('hover border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn:hover { border-radius: {{data.post_buttom_hradius}}; }'
			),
			'post_button_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn { margin: {{data.post_button_margin}}; }',
				'section' => 'Post button',
			),
			'post_button_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn { padding: {{data.post_button_padding}}; }',
				'section' => 'Post button',
			),
			'post_button_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Post button',
				'selector' => '{{SELECTOR}} .wow-post-grid-btn-wrap { text-align: {{data.post_button_align}}; }'
			),

			//Load More
			'post_load_more_color' => array(
				'type' => 'color',
				'title' => __('Button color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Load More',
				'std' => '#fff',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn { color: {{data.post_load_more_color}}; }'
			),
			'post_load_more_hcolor' => array(
				'type' => 'color',
				'title' => __('Button hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Load More',
				'std' => '#fff',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn:hover { color: {{data.post_load_more_hcolor}}; }'
			),
			'post_load_more_bg' => array(
				'type' => 'color2',
				'title' => 'Button background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#3666E4',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn',
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'section' => 'Load More',
			),
			'post_load_more_hover_bg' => array(
				'type' => 'color2',
				'title' => 'Button hover background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#2a55c5',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn:hover',
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'section' => 'Load More',
			),
			'post_load_more_size' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'12px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn',
				'section' => 'Load More',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'tab' => 'style',
			),
			'post_load_more_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Load More',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn'
			),
			'post_loadmore_border_hcolor' => array(
				'type' => 'border',
				'title' => 'hover Border',
				'std' => array(
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Load More',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn:hover'
			),
			'post_load_more_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'std' => array(
					'md' => array( 'top' => '4px', 'right' => '4px', 'bottom' => '4px', 'left' => '4px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Load More',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn { border-radius: {{data.post_load_more_radius}}; }'
			),
			'post_load_more_hradius' => array(
				'type' => 'dimension',
				'title' => __('hover border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Load More',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn:hover { border-radius: {{data.post_load_more_hradius}}; }'
			),
			'post_load_more_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn { margin: {{data.post_load_more_margin}}; }',
				'section' => 'Load More',
			),
			'post_load_more_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'std' => array(
					'md' => array( 'top' => '10px', 'right' => '25px', 'bottom' => '10px', 'left' => '25px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-loadmore-btn { padding: {{data.post_load_more_padding}}; }',
				'section' => 'Load More',
			),
			'post_load_more_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Load More',
				'std' => array( 'md' => 'center', 'sm' => '', 'xs' => '' ),
				'depends' => array(array('post_pagination_type', '=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-pagination{ text-align: {{data.post_load_more_align}}; }'
			),

			//Navigation
			'post_nav_color' => array(
				'type' => 'color',
				'title' => __('Navigation color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Navigation',
				'std' => '#000',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link { color: {{data.post_nav_color}}; }'
			),
			'post_nav_hcolor' => array(
				'type' => 'color',
				'title' => __('Navigation hover color','wow-pagebuilder'),
				'tab' => 'style',
				'std' => '#fff',
				'section' => 'Navigation',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link:hover,{{SELECTOR}} .paginate-active { color: {{data.post_nav_hcolor}}; }'
			),
			'post_nav_bg' => array(
				'type' => 'color2',
				'title' => 'Navigation background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#fff',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link',
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'section' => 'Navigation',
			),
			'post_nav_hover_bg' => array(
				'type' => 'color2',
				'title' => 'Navigation hover background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#3666E4',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link:hover, {{SELECTOR}} .paginate-active',
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'section' => 'Navigation',
			),
			'post_nav_size' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'12px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link',
				'section' => 'Navigation',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'tab' => 'style',
			),
			'post_navborder' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'itemOpenBorder' => 1,
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#f5f5f5' 
				),
				'tab' => 'style',
				'section' => 'Navigation',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link'
			),
			'post_nav_border_hcolor' => array(
				'type' => 'border',
				'title' => 'hover Border',
				'std' => array(
					'itemOpenBorder' => 1,
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#3666E4' 
				),
				'tab' => 'style',
				'section' => 'Navigation',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link:hover,{{SELECTOR}} .paginate-active'
			),
			'post_nav_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Navigation',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link { border-radius: {{data.post_nav_radius}}; }'
			),
			'post_nav_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'std' => array(
					'md' => array( 'top' => '0px', 'right' => '5px', 'bottom' => '0px', 'left' => '0px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link { margin: {{data.post_nav_margin}}; }',
				'section' => 'Navigation',
			),
			'post_nav_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'std' => array(
					'md' => array( 'top' => '5px', 'right' => '15px', 'bottom' => '5px', 'left' => '15px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'selector' => '{{SELECTOR}} .wow-posts-paginate-link { padding: {{data.post_nav_padding}}; }',
				'section' => 'Navigation',
			),
			'post_nav_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Navigation',
				'std' => array( 'md' => 'center', 'sm' => '', 'xs' => '' ),
				'depends' => array(array('post_pagination_type', '!=', array('load_more'))),
				'selector' => '{{SELECTOR}} .wow-posts-addon-pagination{ text-align: {{data.post_nav_align}}; }'
			),

		);

		return $settings;
	}


	// Posts Render HTML
	public function render($data = null){
		$settings 				= $data['settings'];

		$this->settings = $settings;
		add_filter('excerpt_more', array($this, 'excerpt_more_text'), 30);
		add_filter('excerpt_length', array($this, 'excerpt_length'), 30);

		$posts_layout           = isset($settings['posts_layout']) ? $settings['posts_layout'] : '';
		$posts_column        	= isset($settings['posts_column']) ? $settings['posts_column'] : '3';
		$posts_title_position   = isset($settings['posts_title_position']) ? $settings['posts_title_position'] : 'above_meta';
		$posts_per_page         = isset($settings['posts_per_page']) ? $settings['posts_per_page'] : '-1';
		$posts_image_size       = isset($settings['posts_image_size']) ? $settings['posts_image_size'] : 'wow-medium';
		$posts_image_position   = isset($settings['posts_image_position']) ? $settings['posts_image_position'] : '';
		$posts_title            = (bool) isset($settings['posts_title']) ? $settings['posts_title'] : false;
		$posts_title_tag        = isset($settings['posts_title_tag']) ? $settings['posts_title_tag'] : 'h3';
		$posts_excerpt          = (bool) isset($settings['posts_excerpt']) ? $settings['posts_excerpt'] : false;
		$posts_excerpt_length   = isset($settings['posts_excerpt_length']) ? $settings['posts_excerpt_length'] : 30;
		$posts_metadata         = isset($settings['posts_metadata']) ? $settings['posts_metadata'] : array();
		$posts_separator        = isset($settings['posts_separator']) ? $settings['posts_separator'] : '/';
		$posts_separator        = '<span class="wow-postmeta-sept">'.$posts_separator.'</span>';
		$posts_read_more        = (bool) isset($settings['posts_read_more']) ? $settings['posts_read_more'] : false;
		$posts_read_more_text   = isset($settings['posts_read_more_text']) ? $settings['posts_read_more_text'] : __('Read More »', 'wow-pagebuilder');

		//Advance Query
		$post_type              = isset($settings['post_type']) ? $settings['post_type'] : 'post';
		$posts_categories       = isset($settings['posts_categories']) ? $settings['posts_categories'] : array();
		$posts_tags             = isset($settings['posts_tags']) ? $settings['posts_tags'] : array();
		$post_order_by          = isset($settings['post_order_by']) ? $settings['post_order_by'] : 'date';
		$post_order             = isset($settings['post_order']) ? $settings['post_order'] : 'desc';
		$posts_ids              = isset($settings['posts_ids']) ? $settings['posts_ids'] : false;
		$posts_exclude_ids      = isset($settings['posts_exclude_ids']) ? $settings['posts_exclude_ids'] : false;

		//Pagination
		$posts_enable_pagination      = (bool) isset($settings['posts_enable_pagination']) ? $settings['posts_enable_pagination'] : false;
		$post_pagination_type      = isset($settings['post_pagination_type']) ? $settings['post_pagination_type'] : 'numbers_next_previous';

		//Query Arguments
		$args = array(
			'post_type'         => $post_type,
			'post_status'       => 'publish',
			'posts_per_page'    => $posts_per_page,
			'orderby'           => $post_order_by,
			'order'             => $post_order,
		);

		//pagination
		if ($posts_enable_pagination){
			$paged = isset($_POST['paged']) ? $_POST['paged'] : 1;
			$current_page = $paged;
			$args['paged'] = $paged;
			$paged = $paged+1;
		}

		if ($posts_ids){
			$args['post__in'] = explode(',', $posts_ids);
		}
		if ($posts_exclude_ids){
			$args['post__not_in'] = explode(',', $posts_exclude_ids);
		}
		if (is_array($posts_categories) && count($posts_categories)){
			$args['category__in'] = $posts_categories;
		}
		if (is_array($posts_tags) && count($posts_tags)){
			$args['tag__in'] = $posts_tags;
		}

		$the_query = new WP_Query( $args );

		ob_start();
		if ( $the_query->have_posts() ) {
			?>
	
            <div class="wow-posts-addon">
                <div class="wow-posts-addon-content">
					<div class="wow-addons-col">
						<?php 
						if ( ! is_array($posts_metadata)){
							$posts_metadata = explode(',', $posts_metadata);
						}

						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							$post_title = get_the_title();
							$post_excerpt = get_the_excerpt();
							$post_permalink = get_the_permalink();

							//MetaData
							$meta_data_print = '';
							if (count($posts_metadata)) {
								$meta_data              = array();
								if (in_array('author', $posts_metadata)){
									$meta_data['author']    = get_the_author();
								}
								if (in_array('date', $posts_metadata)) {
									$meta_data['date'] = get_the_date();
								}
								if (in_array('time', $posts_metadata)) {
									$meta_data['time'] = get_the_time();
								}
								if (in_array('comments', $posts_metadata)) {
									$meta_data['comments'] = get_comments_number() . ' ' . __( 'Comments', 'wow-pagebuilder' );
								}
								if (in_array('tags', $posts_metadata)) {
									if ( get_the_tag_list() ) {
										$meta_data['tags'] = get_the_tag_list( '', ', ' );
									}
								}
								if (in_array('categories', $posts_metadata)) {
									if ( get_the_category_list() ) {
										$meta_data['categories'] = get_the_category_list( ', ' );
									}
								}
								$meta_data_arr   = apply_filters( 'wppn_posts_addon_meta_data', $meta_data );
								$meta_data_print = implode( "{$posts_separator}", $meta_data_arr );
							}
							//Post feature Image
							$img_url = get_the_post_thumbnail_url(get_the_ID(), $posts_image_size);
							?>
							<div class="wow-addons-col-md<?php echo $posts_column['md'];?> wow-addons-col-sm<?php echo $posts_column['sm'];?> wow-addons-col-xs<?php echo $posts_column['xs'];?>">
								
								<?php

								echo '<div class="wow-post-grid-wrap wow-post-grid-one">';
								if(has_post_thumbnail()) {
									echo '<div class="wow-post-grid-img">';
									echo "<a href='{$post_permalink}'><img src='{$img_url}' alt='{$post_title}'/></a>";
									echo '</div>';//wow-post-grid-img
								}
								echo '<div class="wow-post-grid-content">';
								if($posts_title_position == 'above_meta') {
									if ($posts_title){
										echo "<$posts_title_tag class='wow-post-grid-title'><a href='{$post_permalink}'>{$post_title}</a></$posts_title_tag>";
									}
								}
								if (count($posts_metadata)){
									echo "<div class='wow-post-grid-meta'>{$meta_data_print} </div>";
								}
								if($posts_title_position == 'below_meta') {
									if ($posts_title){
										echo "<$posts_title_tag class='wow-post-grid-title'><a href='{$post_permalink}'>{$post_title}</a></$posts_title_tag>";
									}
								}
								if ($posts_excerpt){
									echo "<div class='wow-post-grid-intro'>{$post_excerpt}</div>";
								}
								if ($posts_read_more){
									echo "<div class='wow-post-grid-btn-wrap'><a class='wow-post-grid-btn' href='{$post_permalink}'>{$posts_read_more_text}</a></div>";
								}
								echo '</div>';//wow-post-grid-content
								echo '</div>';//wow-post-grid-wrap
								?>
							</div> <!--/.wow-addons-col-->
							<?php
						}
						wp_reset_postdata();
						?>
					</div><!--/.wow-posts-addon-content-->

					<?php
					if ($posts_enable_pagination) {
						$max_pages = $the_query->max_num_pages;
						$data_paged = ($paged > $max_pages) ? $max_pages : $paged;

						echo "<div class='wow-posts-addon-pagination'>";

							$big        = 999999999; // need an unlikely integer
							$translated = __( 'Page', 'wow-pagebuilder' ); // Supply translatable string

							$pagination = paginate_links( array(
								'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format'             => '?paged=%#%',
								'current'            => max( 1, get_query_var( 'paged' ) ),
								'total'              => $the_query->max_num_pages,
								'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
								'type' => 'array'
							) );
							$previous_page = $paged - 2;

							if ($post_pagination_type === 'numbers_next_previous'){
								if ($current_page > 1){
									echo "<a href='#' class='wow-posts-paginate-link' data-paged='{$previous_page}'><i class='fas fa-angle-left'></i></a>";
								}else{
									echo "<span class='wow-posts-paginate-link wow-posts-paginate-link-disable'><i class='fas fa-angle-left'></i></span>";
								}

								for ($i = 1; $i <= $max_pages; $i++){
									$active_class = ( $i == $current_page ) ? 'paginate-active' : '';
									echo "<a href='#' class='wow-posts-paginate-link {$active_class}' data-paged='{$i}'>{$i}</a>";
								}
								if ( $current_page < $max_pages){
									echo "<a href='#' class='wow-posts-paginate-link' data-paged='{$data_paged}'><i class='fas fa-angle-right'></i></a>";
								}else{
									echo "<span class='wow-posts-paginate-link wow-posts-paginate-link-disable'><i class='fas fa-angle-right'></i></span>";
								}
							}
							if ($post_pagination_type === 'numbers') {
								for ($i = 1; $i <= $max_pages; $i++){
									$active_class = ( $i == $current_page ) ? 'paginate-active' : '';
									echo "<a href='#' class='wow-posts-paginate-link {$active_class}' data-paged='{$i}'>{$i}</a>";
								}
							}
							if ($post_pagination_type === 'next_previous') {
								if ($current_page > 1){
									echo "<a href='#' class='wow-posts-paginate-link' data-paged='{$previous_page}'><i class='fas fa-angle-left'></i></a>";
								}else{
									echo "<span class='wow-posts-paginate-link wow-posts-paginate-link-disable'><i class='fas fa-angle-left'></i></span>";
								}

								if ( $current_page < $max_pages){
									echo "<a href='#' class='wow-posts-paginate-link' data-paged='{$data_paged}'><i class='fas fa-angle-right'></i></a>";
								}else{
									echo "<span class='wow-posts-paginate-link wow-posts-paginate-link-disable'><i class='fas fa-angle-right'></i></span>";
								}
							}
							if ($post_pagination_type === 'load_more'){
								echo '<a href="#" data-paged="'.$paged.'" class="wow-posts-addon-loadmore-btn">'.__( 'Load More', 'wow-pagebuilder' ).'</a>';
							}
						echo '</div>';//wow-posts-addon-pagination
						
					}
					?>
            </div><!--/.wow-posts-addon-->
        </div><!--/.wow-posts-addon-->
			<?php
		}

		return ob_get_clean();
	}

	public function excerpt_length(){
		return isset($this->settings['posts_excerpt_length']) ? $this->settings['posts_excerpt_length'] : 30;
	}

	public function excerpt_more_text($more){
		return '';
	}

	public function wow_posts_addon_load_more(){
	    $addon_id   = sanitize_text_field($_POST['addon_id']);
	    $page_id    = sanitize_text_field($_POST['page_id']);
	    $paged      = sanitize_text_field($_POST['paged']);

	    $addon = wow_get_saved_addon_settings($addon_id, $page_id);

	    echo $this->render($addon);
        die();
    }

}