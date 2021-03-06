<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Testimonial_Carousel{
	public function get_name(){
		return 'wow_testimonial_carousel';
	}
	public function get_title(){
		return 'Testimonial Carousel';
	}
	public function get_icon() {
		return 'wow-font-full-slider';
	}

	public function get_enqueue_script(){
		return array('wow-slick-slider');
	}

	public function get_enqueue_style(){
		return array('wow-slick-slider-css', 'wow-slick-slider-css-theme');
	}
	// Testimonial Settings Fields
	public function get_settings() {

		$settings = array(

			'testimonial_layout' => array(
				'type' => 'radioimage',
				'title' => 'Layout',
				'values'=> array(
					'layoutone' =>  WOW_DIR_URL.'addons/testimonial_carousel/img/testimonial-img1.png',
					'layouttwo' =>  WOW_DIR_URL.'addons/testimonial_carousel/img/testimonial-img2.png',
					'layoutthree' =>  WOW_DIR_URL.'addons/testimonial_carousel/img/testimonial-img3.png',
					'layoutfour' =>  WOW_DIR_URL.'addons/testimonial_carousel/img/testimonial-img4.png',
				),
				'std' => 'layoutone',
			),

			'testimonial_list' => array(
				'title' => __('Testimonial Item','wow-pagebuilder'),
				'type' => 'repeatable',
				'label' => 'name',
				'std' => array(
					array(
						'image' => array( 'url' =>  WOW_DIR_URL.'assets/img/placeholder/wow-small.jpg' ),
						'name' => 'Michel Clark',
						'name_link' => array( 'link'=>'#' ),
						'designation' => 'Developer',
						'introtext' => 'Reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),
					array(
						'image' => array( 'url' =>  WOW_DIR_URL.'assets/img/placeholder/wow-small.jpg' ),
						'name' => 'John Doe',
						'name_link' => array( 'link'=>'#' ),
						'designation' => 'Designer',
						'introtext' => 'Reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),
					array(
						'image' => array( 'url' =>  WOW_DIR_URL.'assets/img/placeholder/wow-small.jpg' ),
						'name' => 'Stephen Fleming',
						'name_link' => array( 'link'=>'#' ),
						'designation' => 'Founder',
						'introtext' => 'Reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),

				),
				'attr' => array(
					'image' => array(
						'type' => 'media',
						'title' => __('Image','wow-pagebuilder'),
						'std' => array( 'url' =>  WOW_DIR_URL.'assets/img/placeholder/wow-small.jpg' ),
					),
					'name' => array(
						'type' => 'text',
						'title' => __('Name','wow-pagebuilder'),
						'std' => 'John Doe',
					),
					'name_link' => array(
						'type' => 'link',
						'title' => __('Link','wow-pagebuilder'),
						'std' =>   array( 'link'=>'#' ),
					),
					'designation' => array(
						'type' => 'text',
						'title' => __('Designation','wow-pagebuilder'),
						'std' => 'Designer',
					),
					'introtext' => array(
						'type' => 'textarea',
						'title' => __('Message Text','wow-pagebuilder'),
						'std' => 'She was bouncing away, when a cry from the two women, who had turned towards the bed, caused her to look round.',
					),
				),
      ),

			'autoplay_option' => array(
				'type' => 'switch',
				'title' => __('Autoplay','wow-pagebuilder'),
				'std' => '1',
				'section' => 'Slide Settings',
			),
			'speed_option' => array(
				'type' => 'number',
				'title' => __('Animated Speed','wow-pagebuilder'),
				'std' => '600',
				'section' => 'Slide Settings',
				'depends' => array(array('autoplay_option', '=', '1')),
			),
			'control_dots' => array(
				'type' => 'switch',
				'title' => __('Control Dots','wow-pagebuilder'),
				'std' => '1',
				'section' => 'Slide Settings',
			),
			'control_nav' => array(
				'type' => 'switch',
				'title' => __('Control Nav','wow-pagebuilder'),
				'std' => '0',
				'section' => 'Slide Settings',
			),
			'control_nav_style' => array(
				'type' => 'select',
				'title' => __('Nav Style','wow-pagebuilder'),
				'values' => array(
					'nav_style1' => __('Nav Style 1','wow-pagebuilder'),
					'nav_style2' => __('Nav Style 2','wow-pagebuilder'),
					'nav_style3' => __('Nav Style 3','wow-pagebuilder'),
					'nav_style4' => __('Nav Style 4','wow-pagebuilder'),
				),
				'std' => 'nav_style1',
				'depends' => array(array('control_nav', '!=', '')),
				'section' => 'Slide Settings',
			),
			'column' => array(
				'type' => 'select',
				'title' => __('Column','wow-pagebuilder'),
				'values' => array(
					'1' => __('Column 1','wow-pagebuilder'),
					'2' => __('Column 2','wow-pagebuilder'),
					'3' => __('Column 3','wow-pagebuilder'),
					'4' => __('Column 4','wow-pagebuilder'),
					'5' => __('Column 5','wow-pagebuilder'),
					'6' => __('Column 6','wow-pagebuilder'),
				),
				'std' => '1',
				'section' => 'Slide Settings',
			),
			'testimonial_align' => array(
				'type' => 'alignment',
				'title' => __('Testimonial alignment','wow-pagebuilder'),
				'responsive' => true,
				'section' => 'Slide Settings',
				'selector' => '{{SELECTOR}} .wow-testimonial-carousel-addon-content{ text-align: {{data.testimonial_align}}; }'
			),

			//style
			'img_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'std' => array(
					'md' => '50px',
					'sm' => '',
					'xs' => '',
				),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 250,
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
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-testimonial-addon-img { width: {{data.img_width}}; }',
			),
			'img_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 250,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '50px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-testimonial-addon-img { height: {{data.img_height}}; }',
			),
			'img_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => array( 'top' => '100px', 'right' => '100px', 'bottom' => '100px', 'left' => '100px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-testimonial-addon-img { border-radius: {{data.img_radius}}; }',
			),
			'image_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-testimonial-addon-img'
			),
			'image_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-testimonial-addon-img { margin: {{data.image_margin}}; }'
			),
			//name
			'name_color' => array(
				'type' => 'color',
				'title' => __('color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Name',
				'selector' => '{{SELECTOR}} .wow-testimonial-name, {{SELECTOR}} .wow-testimonial-name a { color: {{data.name_color}}; }'
			),
			'name_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'18px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-testimonial-name',
				'section' => 'Name',
				'tab' => 'style',
			),
			'name_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-testimonial-name { margin: {{data.name_margin}}; }',
				'section' => 'Name',
			),
			//Designation
			'desgn_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Designation',
				'selector' => '{{SELECTOR}} .wow-testimonial-designation { color: {{data.desgn_color}}; }'
			),
			'desgn_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'12px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-testimonial-designation',
				'section' => 'Designation',
				'tab' => 'style',
			),
			//intro
			'intro_color' => array(
				'type' => 'color',
				'title' => __('Text color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Message text',
				'selector' => '{{SELECTOR}} .wow-testimonial-introtext { color: {{data.intro_color}}; }'
			),
			'intro_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'18px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-testimonial-introtext',
				'section' => 'Message text',
				'tab' => 'style',
			),
			'message_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-testimonial-introtext { margin: {{data.message_margin}}; }',
				'section' => 'Message text',
			),

			//intro
			'quote_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Quote Style',
				'depends' => array(array('testimonial_layout', '=', array('layoutfour'))),
				'selector' => '{{SELECTOR}} .testimonial-layout-layoutfour .wow-testimonial-quote { color: {{data.quote_color}}; }'
			),
			'quote_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'18px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .testimonial-layout-layoutfour .wow-testimonial-quote',
				'section' => 'Quote Style',
				'depends' => array(array('testimonial_layout', '=', array('layoutfour'))),
				'tab' => 'style',
			),

			// dots
			'dot_position' => array(
				'type' => 'slider',
				'title' => __('Position','wow-pagebuilder'),
				'responsive' => true,
				'max' => 550,
				'min' => -200,
				'range' => array(
					'em' => array(
						'min' => -20,
						'max' => 50,
						'step' => .1,
					),
					'px' => array(
						'min' => -220,
						'max' => 550,
						'step' => 1,
					),
					'%' => array(
						'min' => -100,
						'max' => 100,
						'step' => 1,
					),
				),
				'tab' => 'style',
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'unit' => array( '%','px','em' ),
				'section' => 'Dots Style',
				'depends' => array(array('control_dots', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots { bottom: {{data.dot_position}}; }',
			),
			'dot_bg_color' => array(
				'type' => 'color',
				'title' => __('background','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Dots Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li button { background: {{data.dot_bg_color}}; }'
			),
			'dot_bg_hcolor' => array(
				'type' => 'color',
				'title' => __('hover/active background','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Dots Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li.slick-active button,{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li button:hover { background: {{data.dot_bg_hcolor}}; }'
			),
			'dot_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => '16px',
					'sm' => '',
					'xs' => '',
				),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 50,
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
				'section' => 'Dots Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li button, {{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li { width: {{data.dot_width}}; }'
			),
			'dot_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => '16px',
					'sm' => '',
					'xs' => '',
				),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 50,
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
				'section' => 'Dots Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li button, {{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li { height: {{data.dot_height}}; }'
			),
			'dot_margin' => array(
				'type' => 'dimension',
				'title' => __('Dot Margin','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Dots Style','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li { margin: {{data.dot_margin}}; }'
			),
			'dot_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => array( 'top' => '100px', 'right' => '100px', 'bottom' => '100px', 'left' => '100px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Dots Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .slick-dots li button { border-radius: {{data.dot_radius}}; }'
			),

			// nav
			'nav_position' => array(
				'type' => 'slider',
				'title' => __('Position','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( '%','px','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 20,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 550,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '0px',
						'sm' => '',
						'xs' => '',
					),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-carousel-addon-content .wow-testimonial-content-carousel .wow-carousel-prev,{{SELECTOR}} .wow-testimonial-carousel-addon-content .wow-testimonial-content-carousel .wow-carousel-next { top: {{data.nav_position}}; }',
			),
			'nav_left_position' => array(
				'type' => 'slider',
				'title' => __('Prev Position','wow-pagebuilder'),
				'unit' => array( 'px','em','%' ),
				'range' => array(
						'em' => array(
							'min' => -10,
							'max' => 20,
							'step' => .1,
						),
						'px' => array(
							'min' => -200,
							'max' => 1000,
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
				'section' => 'Nav Style',
				'depends' => array(array('control_nav_style', '=', array('nav_style1','nav_style2'))),
				'selector' => '{{SELECTOR}} .wow-testimonial-carousel-addon-content .wow-testimonial-content-carousel .wow-carousel-next { left: {{data.nav_left_position}}; }',
			),
			'nav_right_position' => array(
				'type' => 'slider',
				'title' => __('Next Position','wow-pagebuilder'),
				'responsive' => true,
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'tab' => 'style',
				'unit' => array( 'px','em','%' ),
				'range' => array(
					'em' => array(
						'min' => -10,
						'max' => 20,
						'step' => .1,
					),
					'px' => array(
						'min' => -200,
						'max' => 1000,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'section' => 'Nav Style',
				'depends' => array(array('control_nav_style', '=', array('nav_style1','nav_style3'))),
				'selector' => '{{SELECTOR}} .wow-testimonial-carousel-addon-content .wow-testimonial-content-carousel .wow-carousel-prev { right: {{data.nav_right_position}}; }',
			),

			'nav_font_size' => array(
				'type' => 'slider',
				'title' => __('Nav Font Size','wow-pagebuilder'),
				'responsive' => true,
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'tab' => 'style',
				'unit' => array( 'px','em','%' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 150,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'section' => 'Nav Style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev { font-size: {{data.nav_font_size}}; }',
			),

			'nav_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { color: {{data.nav_color}}; }'
			),
			'nav_bg_color' => array(
				'type' => 'color',
				'title' => __('background color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { background: {{data.nav_bg_color}}; }'
			),
			'nav_hcolor' => array(
				'type' => 'color',
				'title' => __('hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev:hover, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next:hover { color: {{data.nav_hcolor}}; }'
			),
			'nav_bg_hcolor' => array(
				'type' => 'color',
				'title' => __('background hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev:hover, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next:hover { background: {{data.nav_bg_hcolor}}; }'
			),
			'nav_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 250,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '30px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { width: {{data.nav_width}}; }'
			),
			'nav_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 250,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '30px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => array(
					'{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { height: {{data.nav_height}}; }',
					'{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { line-height: {{data.nav_height}}; }',
				)
			),
			'nav_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => array( 'top' => '100px', 'right' => '100px', 'bottom' => '100px', 'left' => '100px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev, {{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next { border-radius: {{data.nav_radius}}; }'
			),
			'nav_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev,{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next'
			),
			'border_hcolor' => array(
				'type' => 'border',
				'title' => 'Border hover color',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Nav Style',
				'depends' => array(array('control_nav', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-prev:hover,{{SELECTOR}} .wow-testimonial-content-carousel .wow-carousel-next:hover'
			),

			//wrapper
			'wrap_background' => array(
				'type' => 'background',
				'title' => '',
				'selector' => '{{SELECTOR}} .wow-testimonial-content .wow-testimonial-content-in',
				'tab' => 'style',
				'section' => 'Testimonial Wrapper',
			),
			'wrap_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '0px', 'left' => '0px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Testimonial Wrapper',
				'selector' => '{{SELECTOR}} .wow-testimonial-content .wow-testimonial-content-in'
			),
			'wrap_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Testimonial Wrapper',
				'selector' => '{{SELECTOR}} .wow-testimonial-content .wow-testimonial-content-in { border-radius: {{data.wrap_radius}}; }'
			),
			'wrap_boxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'Box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'tab' => 'style',
				'section' => 'Testimonial Wrapper',
				'selector' => '{{SELECTOR}} .wow-testimonial-content.slick-active .wow-testimonial-content-in'
			),
			'wrap_padding'  => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-testimonial-content .wow-testimonial-content-in { padding: {{data.wrap_padding}}; }',
				'section' => 'Testimonial Wrapper',
			),

			'wrap_margin' => array(
				'type' => 'slider',
				'title' => __('Margin Right','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 150,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 150,
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
				'section' => 'Testimonial Wrapper',
				'selector' => array('{{SELECTOR}} .wow-testimonial-content-carousel .slick-slide { margin-right: {{data.wrap_margin}}; }',
					'{{SELECTOR}} .wow-testimonial-content-carousel .slick-list { margin-right: -{{data.wrap_margin}}; }')
			),

		);
		return $settings;
	}

	// Testimonial Render HTML
	public function render($data = null){
		$settings 			 = $data['settings'];

		$testimonial_list    = isset($settings["testimonial_list"]) ? $settings["testimonial_list"] : array();
		$testimonial_layout  = isset($settings['testimonial_layout']) ? $settings['testimonial_layout'] : '';
		$autoplay_option  	 = isset($settings['autoplay_option']) ? $settings['autoplay_option'] : '';
		$control_nav  	 	 = isset($settings['control_nav']) ? $settings['control_nav'] : '';
		$control_dots  	 	 = isset($settings['control_dots']) ? $settings['control_dots'] : '';
		$control_nav_style   = isset($settings['control_nav_style']) ? $settings['control_nav_style'] : '';
		$speed_option   = isset($settings['speed_option']) ? $settings['speed_option'] : '500';
		$column  	 	 	 = isset($settings['column']) ? $settings['column'] : '';

		$rand = rand(1000,999999);
		$output = '';

		if( $autoplay_option == '1'){
			$autoplay_option = "true";
		} else {
			$autoplay_option = "false";
		}
		if( $control_dots == '1'){
			$control_dots = "true";
		} else {
			$control_dots = "false";
		}
		if( $control_nav == '1'){
			$control_nav = "true";
		} else {
			$control_nav = "false";
		}
		$column = (isset($column) && $column) ? $column : 1;
		$control_nav_style = (isset($control_nav_style) && $control_nav_style) ? $control_nav_style : 'nav_style1';

		$output  .= '<div class="wow-testimonial-addon">';
		$output  .= '<div class="wow-testimonial-carousel-addon-content testimonial-layout-'.esc_attr($testimonial_layout).'">';
		$output  .= '<div class="wow-testimonial-content-carousel wow-testimonial-'.esc_attr($column).' '.esc_attr($control_nav_style).'" data-col="'.esc_attr($column).'" data-shownav="'.esc_attr($control_nav).'" data-showdots="'.esc_attr($control_dots).'" data-autoplay="'.esc_attr($autoplay_option).'" data-speed="'.esc_attr($speed_option).'">';

		if (is_array($testimonial_list) && count($testimonial_list)) {
			if ( $testimonial_layout == "layouttwo" ) {
				foreach ( $testimonial_list as $key => $value ) {
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						$target  = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['window'] ) ? 'target=_blank' : 'target=_self';
						$nofolow = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['nofolow'] ) ? 'rel=nofolow' : "";
					}

					$output .= '<div class="wow-testimonial-content">';
					$output .= '<div class="wow-testimonial-content-in">';
					if ( ! empty( $value['image']['url'] ) ) {
						$img_url = $value['image']['url'];
						$output  .= '<div class="wow-testimonial-image">';
						$output  .= '<img class="wow-testimonial-addon-img" src="' . esc_url( $img_url ) . '" alt="' . esc_attr( get_wow_array_value_by_key( $value, 'name' ) ) . '">';
						$output  .= '</div>';
					}
					if ( get_wow_array_value_by_key( $value, 'introtext' ) ) {
						$output .= '<div class="wow-testimonial-introtext">' . wp_kses_post($value['introtext']) . '</div>';
					}
					$output .= '<div class="wow-testimonial-title">';
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name"><a ' . esc_attr( $nofolow ) . ' href="' . esc_url( $value['name_link']['link'] ) . '" ' . esc_attr( $target ) . '>' . $value['name'] . '</a></h4>';
						}
					} else {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name">' . wp_kses_post($value['name']) . '</h4>';
						}
					}
					if ( get_wow_array_value_by_key( $value, 'designation' ) ) {
						$output .= '<span class="wow-testimonial-designation">' . wp_kses_post($value['designation']) . '</span>';
					}
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				}

			} elseif ( $testimonial_layout == "layoutthree" ) {
				foreach ( $testimonial_list as $key => $value ) {

					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						$target  = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['window'] ) ? 'target=_blank' : 'target=_self';
						$nofolow = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['nofolow'] ) ? 'rel=nofolow' : "";
					}

					$output .= '<div class="wow-testimonial-content">';
					$output .= '<div class="wow-testimonial-content-in">';
					if ( get_wow_array_value_by_key( $value, 'introtext' ) ) {
						$output .= '<div class="wow-testimonial-introtext">' . wp_kses_post($value['introtext']) . '</div>';
					}
					if ( ! empty( $value['image']['url'] ) ) {
						$img_url = $value['image']['url'];
						$output  .= '<div class="wow-testimonial-image">';
						$output  .= '<img class="wow-testimonial-addon-img" src="' . esc_url( $img_url ) . '" alt="' . esc_attr( get_wow_array_value_by_key( $value, 'name' ) ) . '">';
						$output  .= '</div>';
					}
					$output .= '<div class="wow-testimonial-title">';
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name"><a ' . esc_attr( $nofolow ) . ' href="' . esc_url( $value['name_link']['link'] ) . '" ' . esc_attr( $target ) . '>' . $value['name'] . '</a></h4>';
						}
					} else {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name">' . wp_kses_post($value['name']) . '</h4>';
						}
					}
					if ( get_wow_array_value_by_key( $value, 'designation' ) ) {
						$output .= '<span class="wow-testimonial-designation">' . wp_kses_post($value['designation']) . '</span>';
					}
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';

				}

			} elseif ( $testimonial_layout == "layoutfour" ) {
				foreach ( $testimonial_list as $key => $value ) {

					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						$target  = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['window'] ) ? 'target=_blank' : 'target=_self';
						$nofolow = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['nofolow'] ) ? 'rel=nofolow' : "";
					}

					$output .= '<div class="wow-testimonial-content">';
					$output .= '<div class="wow-testimonial-content-in">';
					$output .= '<span class="wow-testimonial-quote wow-font-quote"></span>';
					if ( get_wow_array_value_by_key( $value, 'introtext' ) ) {
						$output .= '<div class="wow-testimonial-introtext">' . wp_kses_post($value['introtext']) . '</div>';
					}
					if ( ! empty( $value['image']['url'] ) ) {
						$img_url = $value['image']['url'];
						$output  .= '<div class="wow-testimonial-image">';
						$output  .= '<img class="wow-testimonial-addon-img" src="' . esc_url( $img_url ) . '" alt="' . esc_attr( get_wow_array_value_by_key( $value, 'name' ) ) . '">';
						$output  .= '</div>';
					}
					$output .= '<div class="wow-testimonial-title">';
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name"><a ' . esc_attr( $nofolow ) . ' href="' . esc_url( $value['name_link']['link'] ) . '" ' . esc_attr( $target ) . '>' . $value['name'] . '</a></h4>';
						}
					} else {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name">' . wp_kses_post($value['name']) . '</h4>';
						}
					}
					if ( get_wow_array_value_by_key( $value, 'designation' ) ) {
						$output .= '<span class="wow-testimonial-designation">' . wp_kses_post($value['designation']) . '</span>';
					}
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';

				}

			} else {
				foreach ( $testimonial_list as $key => $value ) {
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						$target  = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['window'] ) ? 'target=_blank' : 'target=_self';
						$nofolow = ! empty( get_wow_array_value_by_key( $value, 'name_link' )['nofolow'] ) ? 'rel=nofolow' : "";
					}
					$output .= '<div class="wow-testimonial-content">';
					$output .= '<div class="wow-testimonial-content-in">';
					if ( get_wow_array_value_by_key( $value, 'introtext' ) ) {
						$output .= '<div class="wow-testimonial-introtext">' . wp_kses_post($value['introtext']) . '</div>';
					}
					$output .= '<div class="wow-testimonial-information">';
					if ( ! empty( $value['image']['url'] ) ) {
						$img_url = $value['image']['url'];
						$output  .= '<div class="wow-testimonial-image">';
						$output  .= '<img class="wow-testimonial-addon-img" src="' . esc_url( $img_url ) . '" alt="' . esc_attr( get_wow_array_value_by_key( $value, 'name' ) ) . '">';
						$output  .= '</div>';
					}
					$output .= '<div class="wow-testimonial-title">';
					if ( ! empty( get_wow_array_value_by_key( $value, 'name_link' )['link'] ) ) {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name"><a ' . esc_attr( $nofolow ) . ' href="' . esc_url( $value['name_link']['link'] ) . '" ' . esc_attr( $target ) . '>' . $value['name'] . '</a></h4>';
						}
					} else {
						if ( get_wow_array_value_by_key( $value, 'name' ) ) {
							$output .= '<h4 class="wow-testimonial-name">' . wp_kses_post($value['name']) . '</h4>';
						}
					}
					if ( get_wow_array_value_by_key( $value, 'designation' ) ) {
						$output .= '<span class="wow-testimonial-designation">' . wp_kses_post($value['designation']) . '</span>';
					}
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				}
			}
		}
		$output  .= '</div>';
		$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}

	// Testimonial Template
	public function getTemplate(){
		$output = '
			<#
			var rand = Math.floor(Math.random() * 1000);

			var autoplay_option = "";
			if(data.autoplay_option == 1){
				autoplay_option = "true";
			} else {
				autoplay_option = "false";
			}
			var control_dots = "";
			if(data.control_dots == 1){
				control_dots = "true";
			} else {
				control_dots = "false";
			}
			var control_nav = "";
			if(data.control_nav == 1){
				control_nav = "true";
			} else {
				control_nav = "false";
			}
			column =  data.column ? data.column : "1";
			control_nav_style =  data.control_nav_style ? data.control_nav_style : "nav_style1";
			#>
			<div class="wow-testimonial-addon">
				<div class="wow-testimonial-carousel-addon-content testimonial-layout-{{data.testimonial_layout}}">
					<div class="wow-testimonial-content-carousel wow-testimonial-{{column}} {{control_nav_style}} " data-col="{{column}}" data-shownav="{{control_nav}}" data-showdots="{{control_dots}}" data-autoplay="{{autoplay_option}}" data-speed="{{data.speed_option}}">
						<# if( data.testimonial_layout == "layouttwo" ){ #>
							<#  _.forEach(data.testimonial_list, function(value, key) { #>
								<div class="wow-testimonial-content">
									<div class="wow-testimonial-content-in">
										<# if ( value.image ) { #>
											<div class="wow-testimonial-image">
												<img class="wow-testimonial-addon-img" src="{{value.image.url}}">
											</div>
										<# } #>
										<div class="wow-testimonial-introtext">{{{value.introtext}}}</div>
										<div class="wow-testimonial-title">
											<# if( value.name_link ){ #>
												<h4 class="wow-testimonial-name"><a {{ value.name_link.link ? "href="+value.name_link.link : "" }} {{ value.name_link.window ? "target=_blank" : "" }} {{ value.name_link.nofolow ? "rel=nofolow" : "" }}>{{{value.name}}}</a></h4>
											<# } else { #>
												<h4 class="wow-testimonial-name">{{{value.name}}}</h4>
											<# } #>
											<span class="wow-testimonial-designation">{{{value.designation}}}</span>
										</div>
									</div>
								</div>
							<# }); #>
						<# } else if( data.testimonial_layout == "layoutthree" ){ #>

							<#  _.forEach(data.testimonial_list, function(value, key) { #>
								<div class="wow-testimonial-content">
									<div class="wow-testimonial-content-in">
										<div class="wow-testimonial-introtext">{{{value.introtext}}}</div>
										<# if ( value.image ) { #>
											<div class="wow-testimonial-image">
												<img class="wow-testimonial-addon-img" src="{{value.image.url}}">
											</div>
										<# } #>
										<div class="wow-testimonial-title">
											<# if( value.name_link ){ #>
												<h4 class="wow-testimonial-name"><a {{ value.name_link.link ? "href="+value.name_link.link : "" }} {{ value.name_link.window ? "target=_blank" : "" }} {{ value.name_link.nofolow ? "rel=nofolow" : "" }}>{{{value.name}}}</a></h4>
											<# } else { #>
												<h4 class="wow-testimonial-name">{{{value.name}}}</h4>
											<# } #>
											<span class="wow-testimonial-designation">{{{value.designation}}}</span>
										</div>
									</div>
								</div>
							<# }); #>

						<# } else if( data.testimonial_layout == "layoutfour" ){ #>

								<#  _.forEach(data.testimonial_list, function(value, key) { #>
									<div class="wow-testimonial-content">
										<div class="wow-testimonial-content-in">
											<span class="wow-testimonial-quote wow-font-quote"></span>
											<div class="wow-testimonial-introtext">{{{value.introtext}}}</div>
											<# if ( value.image ) { #>
												<div class="wow-testimonial-image">
													<img class="wow-testimonial-addon-img" src="{{value.image.url}}">
												</div>
											<# } #>
											<div class="wow-testimonial-title">
												<# if( value.name_link ){ #>
													<h4 class="wow-testimonial-name"><a {{ value.name_link.link ? "href="+value.name_link.link : "" }} {{ value.name_link.window ? "target=_blank" : "" }} {{ value.name_link.nofolow ? "rel=nofolow" : "" }}>{{{value.name}}}</a></h4>
												<# } else { #>
													<h4 class="wow-testimonial-name">{{{value.name}}}</h4>
												<# } #>
												<span class="wow-testimonial-designation">{{{value.designation}}}</span>
											</div>
										</div>
									</div>
								<# }); #>

						<# } else {  #>

							<#  _.forEach(data.testimonial_list, function(value, key) { #>
								<div class="wow-testimonial-content">
									<div class="wow-testimonial-content-in">
										<div class="wow-testimonial-introtext">{{{value.introtext}}}</div>
										<div class="wow-testimonial-information">
											<# if ( value.image ) { #>
												<div class="wow-testimonial-image">
													<img class="wow-testimonial-addon-img" src="{{value.image.url}}">
												</div>
											<# } #>
											<div class="wow-testimonial-title">
												<# if( value.name_link ){ #>
													<h4 class="wow-testimonial-name"><a {{ value.name_link.link ? "href="+value.name_link.link : "" }} {{ value.name_link.window ? "target=_blank" : "" }} {{ value.name_link.nofolow ? "rel=nofolow" : "" }}>{{{value.name}}}</a></h4>
												<# } else { #>
													<h4 class="wow-testimonial-name">{{{value.name}}}</h4>
												<# } #>
												<span class="wow-testimonial-designation">{{{value.designation}}}</span>
											</div>
										</div>
									</div>
								</div>

							<# }); #>

						<# } #>

					</div>
				</div>
			</div>
		';
		return $output;
	}

}