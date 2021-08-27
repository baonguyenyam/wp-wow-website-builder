<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Image_Hover{

	public function get_name(){
		return 'wow_image_hover';
	}
	public function get_title(){
		return 'Image Hover';
	}
	public function get_icon() {
		return 'wow-font-image3';
	}

	// Feature Box Settings Fields
	public function get_settings() {

		$settings = array(
			'layout' => array(
				'type' => 'radioimage',
				'title' => __('Select layout','wow-pagebuilder'),
				'values' => array(
					'one' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover1.png',
					'three' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover2.png',
					'four' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover3.png',
					'five' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover4.png',
					'six' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover5.png',
					'seven' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover6.png',
					'eight' =>  WOW_DIR_URL.'addons/image_hover/img/image_hover7.png',
				),
				'std' => 'one'
			),
			'content_position' => array(
				'type' => 'select',
				'title' => __('Content Position','wow-pagebuilder'),
				'values' => array(
					'topleft' => __('Top Left','wow-pagebuilder'),
					'topcenter' => __('Top Center','wow-pagebuilder'),
					'topright' => __('Top Right','wow-pagebuilder'),
					'middletop' => __('Middle Left','wow-pagebuilder'),
					'middlecenter' => __('Middle Center','wow-pagebuilder'),
					'middleright' => __('Middle Right','wow-pagebuilder'),
					'bottomleft' => __('Bottom Left','wow-pagebuilder'),
					'bottomcenter' => __('Bottom Center','wow-pagebuilder'),
					'bottomright' => __('Bottom Right','wow-pagebuilder'),
				),
				'depends' => array(array('layout', '=', array('one'))),
				'std' => 'bottomleft',
			),

			'title_show' => array(
				'type' => 'switch',
				'title' => __('Show Title','wow-pagebuilder'),
				'std' => '1',
				'section' => 'Title',
			),
			'title' => array(
				'type' => 'text',
				'title' => __('Title','wow-pagebuilder'),
				'std' =>   'Feature Box',
				'depends' => array(array('title_show', '=', '1')),
				'section' => 'Title',
			),
			'heading_selector' => array(
				'type' => 'select',
				'title' => __('Title HTML Element','wow-pagebuilder'),
				'values' => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'span' => 'span',
					'p' => 'p',
					'div' => 'div',
				),
				'std' => 'h3',
				'depends' => array(array('title_show', '=', '1')),
				'section' => 'Title',
			),
			'title_link' => array(
				'type' => 'link',
				'std' => array( 'link'=>'','window'=>false,'nofolow'=>false ),
				'title' => __('Add title link','wow-pagebuilder'),
				'depends' => array(array('title_show', '=', '1')),
				'section' => 'Title',
			),

			//subtitle
			'subtitle_show' => array(
				'type' => 'switch',
				'title' => __('Show Sub Title','wow-pagebuilder'),
				'std' => '1',
				'section' => 'Sub Title',
			),
			'subtitle' => array(
				'type' => 'textarea',
				'title' => __('Sub title','wow-pagebuilder'),
				'std' =>   'Feature Box sub title',
				'depends' => array(array('subtitle_show', '=', '1')),
				'section' => 'Sub Title',
			),
			'subheading_selector' => array(
				'type' => 'select',
				'title' => __('Sub title HTML Element','wow-pagebuilder'),
				'values' => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'span' => 'span',
					'p' => 'p',
					'div' => 'div',
				),
				'std' => 'h4',
				'depends' => array(array('subtitle_show', '=', '1')),
				'section' => 'Sub Title',
			),

			'button_show' => array(
				'type' => 'switch',
				'title' => __('Hide button','wow-pagebuilder'),
				'std' => '0',
				'section' => 'Button',
			),
			'button_text' => array(
				'type' => 'text',
				'title' => __('Button text','wow-pagebuilder'),
				'std' =>   'Learn More',
				'depends' => array(array('button_show', '=', '1')),
				'section' => 'Button',
			),
			'button_link' => array(
				'type' => 'link',
				'title' => __('Add button link','wow-pagebuilder'),
				'std' => array( 'link'=>'#','window'=>false,'nofolow'=>false ),
				'depends' => array(array('button_show', '=', '1')),
				'section' => 'Button',
			),
			'btn_icon_list' => array(
				'type' => 'icon',
				'title' => __('Button icon','wow-pagebuilder'),
				'depends' => array(array('button_show', '=', '1')),
				'std' => '',
				'section' => 'Button',
			),
			'icon_position' => array(
				'type' => 'select',
				'title' => __('Button icon position','wow-pagebuilder'),
				'depends' => array(array('btn_icon_list', '!=', '')),
				'values' => array(
					'left' => __('Left','wow-pagebuilder'),
					'right' => __('Right','wow-pagebuilder'),
				),
				'std' => 'left',
				'section' => 'Button',
			),
			'front_bg' => array(
				'type' => 'background',
				'title' => __('Background','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-bg',
				'std' => array(
					'bgType' => 'image',
					'bgImage' => array( 'url' => WOW_DIR_URL.'assets/img/placeholder/wow-large.jpg'),
				),
				'section' => 'Background',
                'disableHover' => true
			),
            'overlay_bg' => array(
                'type' => 'color',
                'title' => __('Overlay Background','wow-pagebuilder'),
                'std' => '#0180fe',
                'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-image-hover-overlay { background: {{data.overlay_bg}}; }',
                'section' => 'Background',
            ),
            'back_bg' => array(
                'type' => 'color',
                'title' => __('Overlay Hover Background','wow-pagebuilder'),
                'std' => '#377133',
                'selector' => '{{SELECTOR}} .wow-image-hover-content:hover .wow-image-hover-overlay{ background-color: {{data.back_bg}}; }',
                'section' => 'Background',
            ),

			//box title
			'image_hover_effect' => array(
				'type' => 'select',
				'title' => __('Animation image effect','wow-pagebuilder'),
				'values' => array(
					'slideright' => __('Slide from Right','wow-pagebuilder'),
					'slideleft' => __('Slide From Left','wow-pagebuilder'),
					'slidetop' => __('Slide From Top','wow-pagebuilder'),
					'slidebottom' => __('Slide From Bottom','wow-pagebuilder'),
					'zoomin' => __('Zoom Out','wow-pagebuilder'),
					'zoomout' => __('Zoom In','wow-pagebuilder'),
				),
				'tab'=> 'style',
				'std' => 'slideleft',
			),
			'image_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 70,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 800,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'std' => array(
					'md' => '300px',
					'sm' => '',
					'xs' => '',
				),
				'responsive' => true,
				'tab'=> 'style',
				'selector' => '{{SELECTOR}} .wow-image-hover-content { height: {{data.image_height}}; }'
			),
			'wrap_padding' => array(
				'type' => 'dimension',
				'title' => __('Wrap padding','wow-pagebuilder'),
				'tab'=> 'style',
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'selector' => '{{SELECTOR}} .wow-image-hover-content { padding: {{data.wrap_padding}}; }'
			),

			//title
			'box_title_color' => array(
				'type' => 'color',
				'title' => 'Title Color',
				'std'  => '#fff',
				'selector' => '{{SELECTOR}} .wow-image-hover-title, {{SELECTOR}} .wow-image-hover-title a { color: {{data.box_title_color}}; }',
				'tab'=> 'style',
				'section' => __('Title','wow-pagebuilder'),
				'depends' => array(array('title_show', '=', '1')),
			),
			'box_title_hcolor' => array(
				'type' => 'color',
				'title' => 'Title hover color',
				'std'  => '#fff',
				'selector' => '{{SELECTOR}} .wow-image-hover-title a:hover { color: {{data.box_title_hcolor}};}',
				'tab'=> 'style',
				'section' => __('Title','wow-pagebuilder'),
				'depends' => array(array('title_show', '=', '1')),
			),
			'box_title_bg' => array(
				'type' => 'color',
				'title' => 'Title Background Color',
				'std'  => '#0180fe',
				'selector' => '{{SELECTOR}} .wow-image-hover-four .wow-image-hover-intro-four .wow-image-hover-title { background: {{data.box_title_bg}}; }',
				'tab'=> 'style',
				'section' => __('Title','wow-pagebuilder'),
				'depends' => array(
				    array('layout', '=', array('four')),
                    array('title_show', '=', '1')
                ),
			),
			'box_title_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std'		=> array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'20px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '500',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-title',
				'section' => __('Title','wow-pagebuilder'),
				'tab'=> 'style',
				'depends' => array(array('title_show', '=', '1')),
			),
			'title_margin' => array(
				'type' => 'dimension',
				'title' => __('Title margin','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Title','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'depends' => array(array('title_show', '=', '1')),
				'selector' => '{{SELECTOR}} .wow-image-hover-title, {{SELECTOR}} .feature-icontitle-six .wow-image-hover-title { margin: {{data.title_margin}}; }'
			),
			'title_padding' => array(
				'type' => 'dimension',
				'title' => __('Title padding','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Title','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'depends' => array(array('layout', '!=', array('four'))),
				'depends' => array(array('title_show', '=', '1')),
				'selector' => '{{SELECTOR}} .wow-image-hover-title, {{SELECTOR}} .feature-icontitle-six .wow-image-hover-title, {{SELECTOR}} .wow-image-hover-four .wow-image-hover-intro-four .wow-image-hover-title { padding: {{data.title_padding}}; }'
			),

			//sub title
			'box_subtitle_color' => array(
				'type' => 'color',
				'title' => 'Sub title Color',
				'clip'		=> true,
				'std'  => '#fff',
				'selector' => '{{SELECTOR}} .wow-image-hover-subtitle { color: {{data.box_subtitle_color}}; }',
				'tab'=> 'style',
				'section' => __('Sub Title','wow-pagebuilder'),
				'depends' => array(array('subtitle_show', '=', '1')),
			),
			'box_subtitle_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std'		=> array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'20px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '500',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-subtitle',
				'section' => __('Sub Title','wow-pagebuilder'),
				'tab'=> 'style',
				'depends' => array(array('subtitle_show', '=', '1')),
			),
			'subtitle_margin' => array(
				'type' => 'dimension',
				'title' => __('Sub title margin','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Sub Title','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-subtitle { margin: {{data.subtitle_margin}}; }',
				'depends' => array(array('subtitle_show', '=', '1')),
			),
			'subtitle_padding' => array(
				'type' => 'dimension',
				'title' => __('Title padding','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Sub Title','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( 'px','em','%' ),
				'selector' => '{{SELECTOR}} .wow-image-hover-subtitle { padding: {{data.subtitle_padding}}; }',
				'depends' => array(array('subtitle_show', '=', '1')),
			),

			//button
			'button_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std'		=> array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'14px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons',
				'section' => __('Button','wow-pagebuilder'),
				'tab'=> 'style',
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_color' => array(
				'type' => 'color',
				'title' => 'Button Color',
				'std'  => '#fff',
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons { color: {{data.button_color}}; }',
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_hcolor' => array(
				'type' => 'color',
				'title' => 'Button hover Color',
				'std'  => '#fff',
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons:hover { color: {{data.button_hcolor}}; }',
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_bg' => array(
				'type' => 'color2',
				'title' => 'Button background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#2e56ff',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons',
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_hover_bg' => array(
				'type' => 'color2',
				'title' => 'Button hover background',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#2347e2',
					'clip' => false
				),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-image-hover:before',
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_border' => array(
				'type' => 'border',
				'title' => 'Button Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle'	=>'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons',
				'depends' => array(array('button_show', '=', '1')),
			),
			'border_hcolor' => array(
				'type' => 'border',
				'title' => 'Button hover Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle'	=>'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons:hover',
				'depends' => array(array('button_show', '=', '1')),
			),
			'buttom_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'std' => array(
					'md' => array( 'top' => '3px', 'right' => '3px', 'bottom' => '3px', 'left' => '3px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons { border-radius: {{data.buttom_radius}}; }',
				'depends' => array(array('button_show', '=', '1')),
			),
			'buttom_hradius' => array(
				'type' => 'dimension',
				'title' => __('Border hover radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'std' => array(
					'md' => array( 'top' => '3px', 'right' => '3px', 'bottom' => '3px', 'left' => '3px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons:hover { border-radius: {{data.buttom_hradius}}; }',
				'depends' => array(array('button_show', '=', '1')),
			),
			'button_padding'   => array(
				'type' => 'dimension',
				'title' => 'Button Padding',
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '5px', 'right' => '15px', 'bottom' => '5px', 'left' => '15px' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive'=> true,
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons { padding: {{data.button_padding}}; }',
				'depends' => array(array('button_show', '=', '1')),
			),
			'btn_margin' => array(
				'type' => 'dimension',
				'title' => __('Button margin','wow-pagebuilder'),
				'tab'=> 'style',
				'section' => __('Button','wow-pagebuilder'),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-image-hover-content .wow-btn-addons { margin: {{data.btn_margin}}; }',
				'depends' => array(array('button_show', '=', '1')),
			),

			//layout three
			'three_border_top' => array(
				'type' => 'border',
				'title' => 'Border top & bottom',
				'std' => array(
					'borderWidth' => array( 'top' => '1px', 'right' => '0px', 'bottom' => '1px', 'left' => '0px' ), 
					'borderStyle'	=>'solid', 
					'borderColor' => '#fff' 
				),
				'tab'=> 'style',
				'depends' => array(array('layout', '=', array('three','seven'))),
				'section' => __('Border','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-three .wow-image-hover-intro:before, {{SELECTOR}} .wow-image-hover-seven .wow-image-hover-content .wow-image-hover-intro::before'
			),
			'three_border_left' => array(
				'type' => 'border',
				'title' => 'Border left & right',
				'std' => array(
					'borderWidth' => array( 'top' => '0px', 'right' => '1px', 'bottom' => '0px', 'left' => '1px' ), 
					'borderStyle'	=>'solid', 
					'borderColor' => '#fff' 
				),
				'tab'=> 'style',
				'depends' => array(array('layout', '=', array('three','seven'))),
				'section' => __('Border','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-three .wow-image-hover-intro:after, {{SELECTOR}} .wow-image-hover-seven .wow-image-hover-content .wow-image-hover-intro::after'
			),
			'five_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle'	=>'solid', 
					'borderColor' => '#fff' 
				),
				'tab'=> 'style',
				'depends' => array(array('layout', '=', array('five'))),
				'section' => __('Border','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-five .wow-image-hover-content .wow-image-hover-intro::before'
			),
			'six_border' => array(
				'type' => 'color2',
				'title' => 'Background',
				'tab'=> 'style',
				'depends' => array(array('layout', '=', array('six'))),
				'section' => __('Border','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-six .wow-image-hover-title:after'
			),
			'six_border_width' => array(
				'type' => 'slider',
				'title' => __('Bar Height','wow-pagebuilder'),
				'unit' => array( 'px','em','%', ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 30,
						'step' => .1,
					),
					'px' => array(
						'min' => 0,
						'max' => 400,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'std' => array(
						'md' => '3px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab'=> 'style',
				'section' => __('Border','wow-pagebuilder'),
				'depends' => array(array('layout', '=', array('six'))),
				'selector' => '{{SELECTOR}} .wow-image-hover-six .wow-image-hover-title:after { height: {{data.six_border_width}}; }'
			),
			'eight_border' => array(
				'type' => 'color2',
				'title' => 'Background',
				'tab'=> 'style',
				'depends' => array(array('layout', '=', array('eight'))),
				'section' => __('Border','wow-pagebuilder'),
				'selector' => '{{SELECTOR}} .wow-image-hover-eight .wow-image-hover-title::after'
			),
			'eight_border_width' => array(
				'type' => 'slider',
				'title' => __('Bar Height','wow-pagebuilder'),
				'unit' => array( 'px','em','%', ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 30,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 400,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '3px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab'=> 'style',
				'section' => __('Border','wow-pagebuilder'),
				'depends' => array(array('layout', '=', array('eight'))),
				'selector' => '{{SELECTOR}} .wow-image-hover-eight .wow-image-hover-title::after { height: {{data.eight_border_width}}; }'
			),

		);

		return $settings;
	}


	// Feature box Render HTML
	public function render($data = null){
		$settings 				= $data['settings'];

		$layout 				= isset($settings['layout']) ? $settings['layout'] : '';
		$title 					= isset($settings['title']) ? $settings['title'] : '';
		$selector 				= isset($settings["heading_selector"]) ? $settings["heading_selector"] : '';
		$subtitle 				= isset($settings['subtitle']) ? $settings['subtitle'] : '';
		$subselector 			= isset($settings["subheading_selector"]) ? $settings["subheading_selector"] : '';
		$title_link 			= isset($settings['title_link']) ? $settings['title_link'] : array();
		$button_text 			= isset($settings["button_text"]) ? $settings["button_text"] : '';
		$button_link 			= isset($settings['button_link']) ? $settings['button_link'] : array();
		$btn_icon_list 			= isset($settings["btn_icon_list"]) ? $settings["btn_icon_list"] : '';
		$icon_position 			= isset($settings["icon_position"]) ? $settings["icon_position"] : '';
		$content_position 		= isset($settings['content_position']) ? $settings['content_position'] : '';
		$title_show 			= isset($settings['title_show']) ? $settings['title_show'] : '';
		$subtitle_show 			= isset($settings['subtitle_show']) ? $settings['subtitle_show'] : '';
		$button_show 			= isset($settings['button_show']) ? $settings['button_show'] : '';
		$image_hover_effect 	= isset($settings['image_hover_effect']) ? $settings['image_hover_effect'] : '';

		$output = $img_url = $data_media = $data_title = $data_number = $data_subtitle = $data_intro = $btndata = $button = '' ;
		$title_show = (isset($title_show) && $title_show) ? '1' : '0';
		$subtitle_show = (isset($subtitle_show) && $subtitle_show) ? '1' : '0';
		$button_show = (isset($button_show) && $button_show) ? '1' : '0';
		$image_hover_effect = (isset($image_hover_effect) && $image_hover_effect) ? $image_hover_effect : "slideleft";

		$data_media .= '<div class="wow-image-hover-background image-hover-'.$image_hover_effect.'"><div class="wow-image-hover-bg"></div><div class="wow-image-hover-overlay"></div></div>';

		$selector = $selector ? $selector : "h3";
		$subselector = $subselector ? $subselector : "h4";

		if( $title_show == '1'){
			if( ( $title ) ){
				if( !empty($title_link['link']) ){
					$target = $title_link['window'] ? 'target=_blank' : "";
					$nofolow = $title_link['nofolow'] ? 'rel=nofolow' : "";
					$data_title .= '<' .esc_attr($selector). ' class="wow-image-hover-title wow-image-hover-title-'.esc_attr($title_show).'"><a '.esc_attr($nofolow).' href="'.esc_url($title_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($title) .'</a></' . esc_attr($selector) . '>';
				} else {
					$data_title .= '<' .esc_attr($selector). ' class="wow-image-hover-title wow-image-hover-title-'.esc_attr($title_show).'">' . wp_kses_post($title) .'</' . esc_attr($selector) . '>';
				}
			}
		}

		if( $subtitle_show == '1'){
			if( !empty( $subtitle ) ){
				$data_subtitle .= '<' .esc_attr($subselector). ' class="wow-image-hover-subtitle wow-image-hover-subtitle-'.esc_attr($subtitle_show).'">' . wp_kses_post($subtitle) .'</' . esc_attr($subselector) . '>';
			}
		}

		if($icon_position == 'left') {
			$button = (esc_attr($btn_icon_list)) ? '<i class="' . esc_attr($btn_icon_list) . '"></i> <span>' . esc_attr($button_text).'</span>' : '<span>' . esc_attr($button_text). '</span>';
		} else {
			$button = (esc_attr($btn_icon_list)) ? '<span>' . esc_attr($button_text) . '</span> <i class="' . esc_attr($btn_icon_list) . '"></i><span>' : esc_attr($button_text).'</span>';
		}

		if($button_show == '1') {
			if( !empty($button_link['link']) ){
				$btntarget = ( isset($button_link['window']) && $button_link['window'] ) ? 'target=_blank' : 'target=_self';
				$btnnofolow = ( isset($button_link['nofolow']) && $button_link['nofolow'] ) ? 'rel=nofolow' : "";
				$btndata  = '<a '.esc_attr($btntarget).' href="'.esc_url($button_link['link']).'" '.esc_attr($btnnofolow).' class="wow-btn-addons wow-btn-image-hover">' . $button  . '</a>';
			}
		}

		$output  .= '<div class="wow-image-hover-addon wow-image-hover-'.esc_attr($layout).' wow-image-hover-'.esc_attr($content_position).'">';
			$output  .= '<div class="wow-image-hover-content">';
			if ( $layout == "three" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= '<div class="wow-image-hover-intro-three">';
						$output  .= $data_title;
						$output  .= $data_subtitle;
						$output  .= $btndata;
					$output  .= '</div>';
				$output  .= '</div>';
			}
			elseif ( $layout == "four" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= $data_subtitle;
						$output  .= $btndata;
						$output  .= '<div class="wow-image-hover-intro-four">';
						$output  .= $data_title;
					$output  .= '</div>';
				$output  .= '</div>';
			} elseif ( $layout == "five" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= '<div class="wow-image-hover-intro-five">';
						$output  .= $data_title;
						$output  .= $data_subtitle;
						$output  .= $btndata;
					$output  .= '</div>';
				$output  .= '</div>';
			} elseif ( $layout == "six" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= $data_title;
						$output  .= '<div class="wow-image-hover-intro-six">';
						$output  .= $data_subtitle;
						$output  .= $btndata;
					$output  .= '</div>';
				$output  .= '</div>';
			} elseif ( $layout == "seven" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= '<div class="wow-image-hover-intro-seven">';
						$output  .= $data_title;
						$output  .= $data_subtitle;
						$output  .= $btndata;
					$output  .= '</div>';
				$output  .= '</div>';
			} elseif ( $layout == "eight" ) {
				$output  .= $data_media;
					$output  .= '<div class="wow-image-hover-intro">';
						$output  .= '<div class="wow-image-hover-intro-eight">';
						$output  .= $data_title;
						$output  .= $data_subtitle;
						$output  .= $btndata;
					$output  .= '</div>';
				$output  .= '</div>';
			} else {
				$output  .= $data_media;
				$output  .= '<div class="wow-image-hover-intro">';
					$output  .= $data_title;
					$output  .= $data_subtitle;
					$output  .= $btndata;
				$output  .= '</div>';
			}
			$output  .= '</div>';//wow-image-hover-content
		$output  .= '</div>';//wow-image-hover-addon

		return $output;
	}

	// Feature Bix Template
	public function getTemplate(){
		$output = '
		<#
		var data_media = "";
		var data_title = "";
		var data_subtitle = "";
		var data_number = "";
		var data_intro = "";

		var heading_selector = data.heading_selector ? data.heading_selector : "h3";
		var subheading_selector = data.subheading_selector ? data.subheading_selector : "h4";
		var image_hover_effect = data.image_hover_effect ? data.image_hover_effect : "slideleft";

		var title_show = data.title_show ? "1" : "0";
		var subtitle_show = data.subtitle_show ? "1" : "0";
		var button_show = data.button_show ? "1" : "0";

		if(data.title_show == "1"){
			if(data.title){
				if( !_.isEmpty( data.link ) ){
					data_title += "<"+data.heading_selector+" class=\'wow-image-hover-title wow-image-hover-title-"+ data.title_show+"\'><a href=\'"+ data.link+"\'>"+data.title+"</a></"+data.heading_selector+">";
				} else {
					data_title += "<"+data.heading_selector+" class=\'wow-image-hover-title wow-image-hover-title-"+ data.title_show+"\'>"+data.title+"</"+data.heading_selector+">";
				}
			}
		}

		if(data.subtitle_show == "1"){
			if(data.subtitle){
				data_subtitle += "<"+data.subheading_selector+" class=\'wow-image-hover-subtitle wow-image-hover-subtitle-"+ data.subtitle_show+"\'>"+data.subtitle+"</"+data.subheading_selector+">";
			}
		}
		
		data_media  += "<div class=\'wow-image-hover-background image-hover-"+data.image_hover_effect+"\'><div class=\'wow-image-hover-bg\'></div><div class=\'wow-image-hover-overlay\'></div></div>";
		 
		#>

		<div class="wow-addon wow-image-hover-addon wow-image-hover-{{data.layout}} wow-image-hover-{{data.content_position}}">
			<div class="wow-image-hover-content">
				<# if(data.layout == "three"){ #>	
					{{{data_media}}}
					<div class="wow-image-hover-intro">
						<div class="wow-image-hover-intro-three">
							{{{data_title}}}
							{{{data_subtitle}}}
							<# if( data.button_show == "1" ) { #>
								<# if( !__.isEmpty(data.button_link.link) ) { #>
									<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
										<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
									</a>
								<# } #>
							<# } #>
						</div>
					</div>
				<# } else if(data.layout == "four"){ #>		
					{{{data_media}}}
					<div class="wow-image-hover-intro">
						{{{data_subtitle}}}
						<# if( data.button_show == "1" ) { #>
							<# if( !__.isEmpty(data.button_link.link) ) { #>
								<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
									<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
								</a>
							<# } #>
						<# } #>
						<div class="wow-image-hover-intro-four">
							{{{data_title}}}
						</div>
					</div>
					<# } else if(data.layout == "five"){ #>		
						{{{data_media}}}
						<div class="wow-image-hover-intro">
							<div class="wow-image-hover-intro-five">
								{{{data_title}}}
								{{{data_subtitle}}}
								<# if( data.button_show == "1" ) { #>
									<# if( !__.isEmpty(data.button_link.link) ) { #>
										<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
											<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
										</a>
									<# } #>
								<# } #>
							</div>
						</div>
					<# } else if(data.layout == "six"){ #>		
						{{{data_media}}}
						<div class="wow-image-hover-intro">
							{{{data_title}}}
							<div class="wow-image-hover-intro-six">
								{{{data_subtitle}}}
								<# if( data.button_show == "1" ) { #>
									<# if( !__.isEmpty(data.button_link.link) ) { #>
										<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
											<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
										</a>
									<# } #>
								<# } #>
							</div>
						</div>
				<# } else if(data.layout == "seven"){ #>		
					{{{data_media}}}
					<div class="wow-image-hover-intro">
						<div class="wow-image-hover-intro-seven">
							{{{data_title}}}
							{{{data_subtitle}}}
							<# if( data.button_show == "1" ) { #>
								<# if( !__.isEmpty(data.button_link.link) ) { #>
									<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
										<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
									</a>
								<# } #>
							<# } #>
						</div>
					</div>
				<# } else if(data.layout == "eight"){ #>		
					{{{data_media}}}
					<div class="wow-image-hover-intro">
						<div class="wow-image-hover-intro-eight">
							{{{data_title}}}
							{{{data_subtitle}}}
							<# if( data.button_show == "1" ) { #>
								<# if( !__.isEmpty(data.button_link.link) ) { #>
									<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
										<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
									</a>
								<# } #>
							<# } #>
						</div>
					</div>
				<# } else { #>	
					{{{data_media}}}
					<div class="wow-image-hover-intro">
						{{{data_title}}}
						{{{data_subtitle}}}
						<# if( data.button_show == "1" ) { #>
							<# if( !__.isEmpty(data.button_link.link) ) { #>
								<a {{ data.button_link.link ? "href="+data.button_link.link : "" }} {{ data.button_link.window ? "target=_blank" : "" }} {{ data.button_link.nofolow ? "rel=nofolow" : "" }} class="wow-btn-addons wow-btn-image-hover">
									<# if(data.icon_position == "left" && !_.isEmpty(data.btn_icon_list)) { #><i class="{{ data.btn_icon_list }}"></i> <# } #><span>{{ data.button_text }}</span><# if(data.icon_position == "right" && !_.isEmpty(data.btn_icon_list)) { #> <i class="{{ data.btn_icon_list }}"></i><# } #>
								</a>
							<# } #>
						<# } #>
					</div>
				<# } #>
			</div>
		</div>
		';
		return $output;
	}

}