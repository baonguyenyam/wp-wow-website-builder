<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Person{

	public function get_name(){
		return 'wow_person';
	}
	public function get_title(){
		return 'Person';
	}
	public function get_icon() {
		return 'wow-font-person';
	}

	// Person Settings Fields
	public function get_settings() {

		$settings = array(
			'person_layout' => array(
				'type' => 'radioimage',
				'title' => 'Layout',
				'values'=> array(
					'one' =>  WOW_DIR_URL.'addons/person/img/person-img1.png',
					'two' =>  WOW_DIR_URL.'addons/person/img/person-img2.png',
					'three' =>  WOW_DIR_URL.'addons/person/img/person-img3.png',
					'four' =>  WOW_DIR_URL.'addons/person/img/person-img4.png',
					'five' =>  WOW_DIR_URL.'addons/person/img/person-img5.png',
				),
				'std' => 'one',
			),
			'person_image' => array(
				'type' => 'media',
				'title' => __('Image','wow-pagebuilder'),
				'std'=> array( 'url' =>  WOW_DIR_URL.'assets/img/placeholder/wow-large.jpg' ),
			),
			'name' => array(
				'type' => 'text',
				'title' => __('Name','wow-pagebuilder'),
				'std' => 'John Doe',
			),
			'name_link' => array(
				'type' => 'link',
				'std' =>   array('link'=>'','window'=>true,'nofolow'=>false),
				'title' => __('Profile URL','wow-pagebuilder'),
			),
			'designation' => array(
				'type' => 'text',
				'title' => __('Designation','wow-pagebuilder'),
				'std' => 'Creative Designer',
			),
			'email' => array(
				'type' => 'text',
				'title' => __('Email','wow-pagebuilder'),
				'placeholder' => 'example@example.com',
			),
			'introtext' => array(
				'type' => 'textarea',
				'title' => __('Intro text','wow-pagebuilder'),
				'std' => 'Photographs are a way of preserving a moment in our lives for the rest of our lives.',
			),
			'show_social' => array(
				'type' => 'switch',
				'title' => __('Show Social Media','wow-pagebuilder'),
				'std' => '1'
			),

			// Repeatable Items
			'social_item' => array(
				'title' => __('Social Media URL','wow-pagebuilder'),
				'depends' => array(array('show_social', '!=', '')),
				'type' => 'repeatable',
				'label' => 'icon_list',
				'std' => array(
					array( 
						'icon_list' => 'fab fa-facebook-f',
						'socialurl' => '#'
					),
					array(
						'icon_list' => 'fab fa-linkedin',
						'socialurl' => '#'
					),
					array(
						'icon_list' => 'fab fa-flickr',
						'socialurl' => '#'
					)
				),
				'attr' => array(
					'icon_list' => array(
						'type' => 'iconsocial',
						'title' => __('Icon List','wow-pagebuilder'),
						'std' => 'fab fa-facebook-f'
					),
					'socialurl' => array(
						'type' => 'text',
						'title' => __('Social URL','wow-pagebuilder'),
						'std' => '#'
					),
					'icon_color' => array(
						'type' => 'color',
						'title' => __('Color','wow-pagebuilder'),
						'selector' =>'{{SELECTOR}} .wow-person-social-list a { color: {{data.icon_color}}; }',
					),
					'icon_hcolor' => array(
						'type' => 'color',
						'title' => __('Hover color','wow-pagebuilder'),
						'selector' => '{{SELECTOR}}  .wow-person-social-list a:hover { color: {{data.icon_hcolor}}; }',
					),
					'icon_bg' => array(
						'type' => 'color2',
						'title' => __('background','wow-pagebuilder'),
						'clip' => false,
						'std' => array(
							'colorType' => 'color',
							'colorColor' => '#3D88E4',
						),
						'selector' => '{{SELECTOR}} .wow-person-social-list a'
					),
					'icon_hover_bg' => array(
						'type' => 'color2',
						'title' => __('Hover background','wow-pagebuilder'),
						'clip' => false,
						'std' => array(
							'colorType' => 'color',
							'colorColor' => '#3D88E4',
						),
						'selector' => '{{SELECTOR}} .wow-person-social-list a:hover'
					),
				),
			),
			'persion_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-person-addon-content{ text-align: {{data.persion_align}}; }'
			),

			//style
			'img_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 40,
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
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-person-addon-img, {{SELECTOR}} .person-layout-one .wow-person-addon-img, {{SELECTOR}} .person-layout-four .wow-person-addon-img, {{SELECTOR}} .person-layout-three .wow-person-addon-img { width: {{data.img_width}}; }',
			),
			'img_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 40,
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
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-person-addon-img, {{SELECTOR}} .person-layout-one .wow-person-addon-img, {{SELECTOR}} .person-layout-four .wow-person-addon-img, {{SELECTOR}} .person-layout-three .wow-person-addon-img { height: {{data.img_height}}; }',
			),
			'img_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Image',
				'selector' => '{{SELECTOR}} .wow-person-addon-img, {{SELECTOR}} .person-layout-one .wow-person-addon-img, {{SELECTOR}} .person-layout-four .wow-person-addon-img, {{SELECTOR}} .person-layout-three .wow-person-addon-img { border-radius: {{data.img_radius}}; }',
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
				'selector' => '{{SELECTOR}} .wow-person-addon-img'
			),
			'image_margin' => array(
				'type' => 'dimension',
				'title' => 'Image Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-person-addon-img { margin: {{data.image_margin}}; }',
				'section' => 'Image',
			),

			//name
			'name_color' => array(
				'type' => 'color2',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'clip' => true,
				'std' => array( 'colorType' => 'color', 'clip' => true, 'colorColor' => '' ),
				'section' => 'Name',
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-name, {{SELECTOR}} .wow-person-name a, {{SELECTOR}} .wow-person-five-overlay .wow-person-name'
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
				'selector' => '{{SELECTOR}} .wow-person-name',
				'section' => 'Name',
				'tab' => 'style',
			),
			'name_margin' => array(
				'type' => 'dimension',
				'title' => 'Name Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-person-name { margin: {{data.name_margin}}; }',
				'section' => 'Name',
			),

			//desg
			'desgn_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Designation',
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-designation, {{SELECTOR}} .wow-person-five-overlay .wow-person-designation { color: {{data.desgn_color}}; }'
			),
			'desgn_fontstyle' => array(
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
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-designation',
				'section' => 'Designation',
				'tab' => 'style',
			),
			'desgn_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-designation { margin: {{data.desgn_margin}}; }',
				'section' => 'Designation',
			),

			//email
			'email_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Email',
				'selector' => '{{SELECTOR}} .wow-person-email, {{SELECTOR}} .wow-person-five-overlay .wow-person-email { color: {{data.email_color}}; }'
			),
			'email_fontstyle' => array(
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
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-email',
				'section' => 'Email',
				'tab' => 'style',
			),
			'email_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-person-information .wow-person-email { margin: {{data.email_margin}}; }',
				'section' => 'Email',
			),


			//Intro
			'intro_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Intro Text',
				'selector' => '{{SELECTOR}} .wow-person-introtext, {{SELECTOR}} .wow-person-five-overlay .wow-person-introtext { color: {{data.intro_color}}; }'
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
				'selector' => '{{SELECTOR}} .wow-person-introtext',
				'section' => 'Intro Text',
				'tab' => 'style',
			),

			//social
			'icon_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' =>'{{SELECTOR}} .wow-person-social li a { color: {{data.icon_color}}; }',
			),
			'icon_hcolor' => array(
				'type' => 'color',
				'title' => __('Hover color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' =>'{{SELECTOR}}  .wow-person-social li a i:hover { color: {{data.icon_hcolor}}; }',
			),
			'icon_bg' => array(
				'type' => 'color',
				'title' => __('background','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a { background: {{data.icon_bg}}; }'
			),
			'icon_hover_bg' => array(
				'type' => 'color',
				'title' => __('Hover background','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a:hover{ background: {{data.icon_hover_bg}}; }'
			),
			'icon_size' => array(
				'type' => 'slider',
				'title' => __('Size','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 200,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '18px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a { font-size: {{data.icon_size}}; }'
			),
			'icon_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
						'md' => '',
						'sm' => '',
						'xs' => '',
					),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 25,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 200,
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
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a { width: {{data.icon_width}}; }'
			),
			'icon_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => array(
					'{{SELECTOR}} .wow-person-social li a { height: {{data.icon_height}}; }',
					'{{SELECTOR}} .wow-person-social li a { line-height: {{data.icon_height}}; }',
				)
			),
			'icon_line_height' => array(
				'type' => 'slider',
				'title' => __('Line Height','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a { line-height: {{data.icon_line_height}}; }'
			),
			'icon_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'std' => array(
					'md' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a { border-radius: {{data.icon_radius}}; }'
			),
			'icon_border' => array(
				'type' => 'border',
				'title' => 'Icon Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a'
			),
			'border_hcolor' => array(
				'type' => 'border',
				'title' => 'Border hover color',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Social Share',
				'selector' => '{{SELECTOR}} .wow-person-social li a:hover'
			),
			'social_margin' => array(
				'type' => 'dimension',
				'title' => 'Social margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-person-social-list { margin: {{data.social_margin}}; }',
				'section' => 'Social Share',
			),
			'content_background' => array(
				'type' => 'color2',
				'title' => __('Background Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Content wrap',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => 'rgba(4, 190, 254, 1)',
					'clip' => false
				),
				'depends' => array(array('person_layout', '=', array('two','five'))),
				'selector' => '{{SELECTOR}} .person-layout-two .wow-person-information-wrap,{{SELECTOR}} .wow-person-five-overlay:after'
			),
			'content_boxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'Box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'tab' => 'style',
				'section' => 'Content wrap',
				'depends' => array(array('person_layout', '=', array('five'))),
				'selector' => '{{SELECTOR}} .wow-person-five-overlay, {{SELECTOR}} .wow-person-five-overlay:after'
			),
			'content_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Content wrap',
				'depends' => array(array('person_layout', '=', array('five'))),
				'selector' => '{{SELECTOR}} .wow-person-five-wrap .wow-person-image img, {{SELECTOR}} .wow-person-five-overlay,{{SELECTOR}} .wow-person-five-overlay:after { border-radius: {{data.content_radius}}; }'
			),
			'content_wrap' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .person-layout-one, {{SELECTOR}} .person-layout-two .wow-person-information-wrap,{{SELECTOR}} .wow-person-five-overlay { padding: {{data.content_wrap}}; }',
				'section' => 'Content wrap',
			),
		);
		return $settings;
	}


	// Persion Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
		$person_image 	= isset($settings['person_image']) ? $settings['person_image'] : array();
		$person_layout 	= isset($settings['person_layout']) ? $settings['person_layout'] : '';
		$name 			= isset($settings['name']) ? $settings['name'] : '';
		$name_link 		= isset($settings['name_link']) ? $settings['name_link'] : array();
		$designation 	= isset($settings['designation']) ? $settings['designation'] : '';
		$email 			= isset($settings['email']) ? $settings['email'] : '';
		$introtext 		= isset($settings['introtext']) ? $settings['introtext'] : '';
		$show_social 	= isset($settings['show_social']) ? $settings['show_social'] : '';
		$social_item 	= isset($settings['social_item']) ? $settings['social_item'] : array();

		$output = $img_url = '' ;

		if(! empty($person_image['url'])){
			$img_url = $person_image['url'];
		}
		$target = $name_link['window'] ? 'target=_blank' : "";
		$nofolow = $name_link['nofolow'] ? 'rel=nofolow' : "";

		$output  .= '<div class="wow-person-addon">';
			$output  .= '<div class="wow-person-addon-content person-layout-'.esc_attr($person_layout).'">';

				if( $person_layout == "two" ){
					if($img_url) {
						$output  .= '<div class="wow-person-image">';
						$output  .= '<img class="wow-person-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($name) .'">';
						$output  .= '</div>';//wow-person-image
					}
					$output  .= '<div class="wow-person-information-wrap">';
						$output  .= '<div class="wow-person-information">';
							if( $name_link['link'] ){
								$output .= '<span class="wow-person-name"><a '.esc_attr($nofolow).' href="'.esc_url($name_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($name) .'</a></span>';
							} else {
								$output .= '<span class="wow-person-name">' . wp_kses_post($name) .'</span>';
							}
							if($designation) { $output  .= '<span class="wow-person-designation">' . wp_kses_post($designation) . '</span>'; }
							if($email) { $output  .= '<span class="wow-person-email">' . sanitize_email($email) . '</span>'; }
							if($introtext) { $output  .= '<div class="wow-person-introtext">' . wp_kses_post($introtext) . '</div>'; }
						$output  .= '</div>';//wow-person-information
						if( $show_social == 1 ) {
							$output  .= '<ul class="wow-person-social">';
							foreach ( $social_item as $key => $value ) {
								$output  .= '<li class="repeater-'.$key.'"><span class="wow-person-social-list"><a href="'.esc_url($value['socialurl']).'" target="_blank"><i class="'.esc_attr($value['icon_list']).'"></i></a></span></li>';
							}
							$output  .= '</ul>';
						}
					$output  .= '</div>';

				} elseif ( $person_layout == "three" ) {
					$output  .= '<div class="wow-person-media">';
						if($img_url) {
							$output  .= '<div class="wow-person-image">';
							$output  .= '<img class="wow-person-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($name) .'">';
							$output  .= '</div>';//wow-person-image
						}
						$output  .= '<div class="wow-person-media-body">';
							$output  .= '<div class="wow-person-information">';
								if( $name_link['link'] ){
									$output .= '<span class="wow-person-name"><a '.esc_attr($nofolow).' href="'.esc_url($name_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($name) .'</a></span>';
								} else {
									$output .= '<span class="wow-person-name">' . wp_kses_post($name) .'</span>';
								}
								if($designation) { $output  .= '<span class="wow-person-designation">' . wp_kses_post($designation) . '</span>'; }
								if($email) { $output  .= '<span class="wow-person-email">' . sanitize_email($email) . '</span>'; }
								if($introtext) { $output  .= '<div class="wow-person-introtext">' . wp_kses_post($introtext) . '</div>'; }
							$output  .= '</div>';//wow-person-information
							if( $show_social == 1 ) {
								$output  .= '<ul class="wow-person-social">';
								foreach ( $social_item as $key => $value ) {
									$output  .= '<li class="repeater-'.$key.'"><span class="wow-person-social-list"><a href="'.esc_url($value['socialurl']).'" target="_blank"><i class="'.esc_attr($value['icon_list']).'"></i></a></span></li>';
								}
								$output  .= '</ul>';
							}
						$output  .= '</div>';
					$output  .= '</div>';
					
				} elseif ( $person_layout == "four" ) {
					$output  .= '<div class="wow-person-media">';
						if($img_url) {
							$output  .= '<div class="wow-person-image">';
							$output  .= '<img class="wow-person-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($name) .'">';
							$output  .= '</div>';//wow-person-image
						}
						$output  .= '<div class="wow-person-media-body">';
							$output  .= '<div class="wow-person-information">';
								if( $name_link['link'] ){
									$output .= '<span class="wow-person-name"><a '.esc_attr($nofolow).' href="'.esc_url($name_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($name) .'</a></span>';
								} else {
									$output .= '<span class="wow-person-name">' . wp_kses_post($name) .'</span>';
								}
								if($designation) { $output  .= '<span class="wow-person-designation">' . wp_kses_post($designation) . '</span>'; }
								if($email) { $output  .= '<span class="wow-person-email">' . sanitize_email($email) . '</span>'; }
								if($introtext) { $output  .= '<div class="wow-person-introtext">' . wp_kses_post($introtext) . '</div>'; }
							$output  .= '</div>';//wow-person-information
							if( $show_social == 1 ) {
								$output  .= '<ul class="wow-person-social">';
								foreach ( $social_item as $key => $value ) {
									$output  .= '<li class="repeater-'.$key.'"><span class="wow-person-social-list"><a href="'.esc_url($value['socialurl']).'" target="_blank"><i class="'.esc_attr($value['icon_list']).'"></i></a></span></li>';
								}
								$output  .= '</ul>';
							}
						$output  .= '</div>';
					$output  .= '</div>';
				} elseif ( $person_layout == "five" ) {
					$output  .= '<div class="wow-person-five-wrap">';
						if($img_url) {
							$output  .= '<div class="wow-person-image">';
							$output  .= '<img class="wow-person-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($name) .'">';
							$output  .= '</div>';//wow-person-image
						}
						$output  .= '<div class="wow-person-information-wrap wow-person-five-overlay">';
							if( $show_social == 1 ) {
								$output  .= '<ul class="wow-person-social">';
								foreach ( $social_item as $key => $value ) {
									$output  .= '<li class="repeater-'.$key.'"><span class="wow-person-social-list"><a href="'.esc_url($value['socialurl']).'" target="_blank"><i class="'.esc_attr($value['icon_list']).'"></i></a></span></li>';
								}
								$output  .= '</ul>';
							}
							$output  .= '<div class="wow-person-information">';
								if( $name_link['link'] ){
									$output .= '<span class="wow-person-name"><a '.esc_attr($nofolow).' href="'.esc_url($name_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($name) .'</a></span>';
								} else {
									$output .= '<span class="wow-person-name">' . wp_kses_post($name) .'</span>';
								}
								if($designation) { $output  .= '<span class="wow-person-designation">' . wp_kses_post($designation) . '</span>'; }
								if($email) { $output  .= '<span class="wow-person-email">' . sanitize_email($email) . '</span>'; }
								if($introtext) { $output  .= '<div class="wow-person-introtext">' . wp_kses_post($introtext) . '</div>'; }
							$output  .= '</div>';//wow-person-information
						$output  .= '</div>';
					$output  .= '</div>';
					
				} else {
					if($img_url) {
						$output  .= '<div class="wow-person-image">';
						$output  .= '<img class="wow-person-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($name) .'">';
						$output  .= '</div>';//wow-person-image
					}
					$output  .= '<div class="wow-person-information">';
						if( $name_link['link'] ){
							$output .= '<span class="wow-person-name"><a '.esc_attr($nofolow).' href="'.esc_url($name_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($name) .'</a></span>';
						} else {
							$output .= '<span class="wow-person-name">' . wp_kses_post($name) .'</span>';
						}
						if($designation) { $output  .= '<span class="wow-person-designation">' . wp_kses_post($designation) . '</span>'; }
						if($email) { $output  .= '<span class="wow-person-email">' . sanitize_email($email) . '</span>'; }
						if($introtext) { $output  .= '<div class="wow-person-introtext">' . wp_kses_post($introtext) . '</div>'; }
					$output  .= '</div>';//wow-person-information
					if( $show_social == 1 ) {
						$output  .= '<ul class="wow-person-social">';
						foreach ( $social_item as $key => $value ) {
							$output  .= '<li class="repeater-'.$key.'"><span class="wow-person-social-list"><a href="'.esc_url($value['socialurl']).'" target="_blank"><i class="'.esc_attr($value['icon_list']).'"></i></a></span></li>';
						}
						$output  .= '</ul>';
					}
				}
			$output  .= '</div>';//wow-person-addon-content
		$output  .= '</div>';//wow-person-addon

		return $output;
	}

	// Person Template
	public function getTemplate(){
		$output = '
		<div class="wow-person-addon">
			<div class="wow-person-addon-content person-layout-{{data.person_layout}}">

			<# if( data.person_layout == "two" ){ #>

				<# if( data.person_image.url ) { #>
					<div class="wow-person-image">
						<img class="wow-person-addon-img" src="{{data.person_image.url}}">
					</div>
				<# } #>

				<div class="wow-person-information-wrap">

					<div class="wow-person-information">
						<# if( !__.isEmpty(data.name_link.link) ) { #>
							<span class="wow-person-name"><a {{ data.name_link.link ? "href="+data.name_link.link : "" }} {{ data.name_link.window ? "target=_blank" : "" }} {{ data.name_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.name }}}</a></span>
						<# } else { #>
							<span class="wow-person-name">{{{ data.name }}}</span>
						<# } #>
						<# if( data.designation ) { #>
							<span class="wow-person-designation">{{data.designation}}</span>
						<# } #>
						<# if( data.email ) { #>
							<span class="wow-person-email">{{data.email}}</span>
						<# } #>
						<# if( data.introtext ) { #>
							<span class="wow-person-introtext">{{data.introtext}}</span>
						<# } #>
					</div>

					<# if( data.show_social == 1 ) { #>
						<ul class="wow-person-social">
							<#  _.forEach(data.social_item, function(value, key) { #>
								<li class="repeater-{{key}}">
									<span class="wow-person-social-list"><a href="{{value.socialurl}}" target="_blank"><i class="{{value.icon_list}}"></i></a></span>
								</li>
							<# }); #>
						</ul>
					<# } #>
				</div>

			<# } else if( data.person_layout == "three" ){ #>

				<div class="wow-person-media">
					<# if( data.person_image.url ) { #>
						<div class="wow-person-image">
							<img class="wow-person-addon-img" src="{{data.person_image.url}}">
						</div>
					<# } #>
					<div class="wow-person-media-body">
						<div class="wow-person-information">
							<# if( !__.isEmpty(data.name_link.link) ) { #>
								<span class="wow-person-name"><a {{ data.name_link.link ? "href="+data.name_link.link : "" }} {{ data.name_link.window ? "target=_blank" : "" }} {{ data.name_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.name }}}</a></span>
							<# } else { #>
								<span class="wow-person-name">{{{ data.name }}}</span>
							<# } #>
							<# if( data.designation ) { #>
								<span class="wow-person-designation">{{data.designation}}</span>
							<# } #>
							<# if( data.email ) { #>
								<span class="wow-person-email">{{data.email}}</span>
							<# } #>
							<# if( data.introtext ) { #>
								<span class="wow-person-introtext">{{data.introtext}}</span>
							<# } #>
						</div>

						<# if( data.show_social == 1 ) { #>
							<ul class="wow-person-social">
								<#  _.forEach(data.social_item, function(value, key) { #>
									<li class="repeater-{{key}}">
										<span class="wow-person-social-list"><a href="{{value.socialurl}}" target="_blank"><i class="{{value.icon_list}}"></i></a></span>
									</li>
								<# }); #>
							</ul>
						<# } #>
					</div>
				</div>

			<# } else if( data.person_layout == "four" ){ #>

				<div class="wow-person-media">
					<# if( data.person_image.url ) { #>
						<div class="wow-person-image">
							<img class="wow-person-addon-img" src="{{data.person_image.url}}">
						</div>
					<# } #>
					<div class="wow-person-media-body">

						<div class="wow-person-information">
							<# if( !__.isEmpty(data.name_link.link) ) { #>
								<span class="wow-person-name"><a {{ data.name_link.link ? "href="+data.name_link.link : "" }} {{ data.name_link.window ? "target=_blank" : "" }} {{ data.name_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.name }}}</a></span>
							<# } else { #>
								<span class="wow-person-name">{{{ data.name }}}</span>
							<# } #>
							<# if( data.designation ) { #>
								<span class="wow-person-designation">{{data.designation}}</span>
							<# } #>
							<# if( data.email ) { #>
								<span class="wow-person-email">{{data.email}}</span>
							<# } #>
							<# if( data.introtext ) { #>
								<span class="wow-person-introtext">{{data.introtext}}</span>
							<# } #>
						</div>

						<# if( data.show_social == 1 ) { #>
							<ul class="wow-person-social">
								<#  _.forEach(data.social_item, function(value, key) { #>
									<li class="repeater-{{key}}">
										<span class="wow-person-social-list"><a href="{{value.socialurl}}" target="_blank"><i class="{{value.icon_list}}"></i></a></span>
									</li>
								<# }); #>
							</ul>
						<# } #>
					</div>
				</div>

				<# } else if( data.person_layout == "five" ){ #>
					<div class="wow-person-five-wrap">
						<# if( data.person_image.url ) { #>
							<div class="wow-person-image">
								<img class="wow-person-addon-img" src="{{data.person_image.url}}">
							</div>
						<# } #>
						<div class="wow-person-information-wrap wow-person-five-overlay">
							<# if( data.show_social == 1 ) { #>
								<ul class="wow-person-social">
									<#  _.forEach(data.social_item, function(value, key) { #>
										<li class="repeater-{{key}}">
											<span class="wow-person-social-list"><a href="{{value.socialurl}}" target="_blank"><i class="{{value.icon_list}}"></i></a></span>
										</li>
									<# }); #>
								</ul>
							<# } #>
							<div class="wow-person-information">
								<# if( !__.isEmpty(data.name_link.link) ) { #>
									<span class="wow-person-name"><a {{ data.name_link.link ? "href="+data.name_link.link : "" }} {{ data.name_link.window ? "target=_blank" : "" }} {{ data.name_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.name }}}</a></span>
								<# } else { #>
									<span class="wow-person-name">{{{ data.name }}}</span>
								<# } #>
								<# if( data.designation ) { #>
									<span class="wow-person-designation">{{data.designation}}</span>
								<# } #>
								<# if( data.email ) { #>
									<span class="wow-person-email">{{data.email}}</span>
								<# } #>
								<# if( data.introtext ) { #>
									<span class="wow-person-introtext">{{data.introtext}}</span>
								<# } #>
							</div>
						</div>
					</div>

			<# } else {  #>	

				<# if( data.person_image.url ) { #>
					<div class="wow-person-image">
						<img class="wow-person-addon-img" src="{{data.person_image.url}}">
					</div>
				<# } #>
				<div class="wow-person-information">
					<# if( !__.isEmpty(data.name_link.link) ) { #>
						<span class="wow-person-name"><a {{ data.name_link.link ? "href="+data.name_link.link : "" }} {{ data.name_link.window ? "target=_blank" : "" }} {{ data.name_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.name }}}</a></span>
					<# } else { #>
						<span class="wow-person-name">{{{ data.name }}}</span>
					<# } #>
					<# if( data.designation ) { #>
						<span class="wow-person-designation">{{data.designation}}</span>
					<# } #>
					<# if( data.email ) { #>
						<span class="wow-person-email">{{data.email}}</span>
					<# } #>
					<# if( data.introtext ) { #>
						<span class="wow-person-introtext">{{data.introtext}}</span>
					<# } #>
				</div>

				<# if( data.show_social == 1 ) { #>
					<ul class="wow-person-social">
						<#  _.forEach(data.social_item, function(value, key) { #>
							<li class="repeater-{{key}}">
								<span class="wow-person-social-list"><a href="{{value.socialurl}}" target="_blank"><i class="{{value.icon_list}}"></i></a></span>
							</li>
						<# }); #>
					</ul>
				<# } #>
			<# } #>

			</div>
		</div>
		';
		return $output;
	}

}