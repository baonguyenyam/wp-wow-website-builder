<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Image{

	public function get_name(){
		return 'wow_image';
	}
	public function get_title(){
		return 'Image';
	}
	public function get_icon(){
		return 'wow-font-image';
	}

	public function get_enqueue_script(){
		return array('jquery.magnific-popup');
	}

	public function get_enqueue_style(){
		return array('magnific-popup');
	}

	// image Settings Fields
	public function get_settings() {

		$settings = array(

			'upload_image' => array(
				'type' => 'media',
				'title' => __('Upload image','wow-pagebuilder'),
				'std'=> array( 'url' => WOW_DIR_URL.'assets/img/placeholder/wow-medium.jpg' ),
			),
			'alt_text' => array(
				'type' => 'text',
				'title' => __('alt','wow-pagebuilder'),
				'std' => 'Image',
			),
			'caption_text' => array(
				'type' => 'text',
				'title' => 'caption',
				'std' => 'WPPB Image Addons',
			),
            'lightbox' => array(
                'type' => 'switch',
                'title' => __('Enable Popup','wow-pagebuilder'),
                'std' => '0'
            ),
            'lightbox_icon' => array(
                'type' => 'switch',
                'title' => __('Enable Icon','wow-pagebuilder'),
                'std' => '0'
            ),
			'image_link' => array(
				'type' => 'link',
				'title' => __('Link','wow-pagebuilder'),
				'std' =>   array('link'=>'','window'=>true,'nofolow'=>false),
				'depends' => array(array('lightbox', '!=', '1')),
			),
			'image_display' => array(
				'type' => 'select',
				'title' => __('Image display','wow-pagebuilder'),
				'values' => array(
					'imgblock' => __('Block','wow-pagebuilder'),
					'imginlineblock' => __('Inline Block','wow-pagebuilder'),
					'imginline' => __('Inline','wow-pagebuilder'),
				),
				'std' => 'imginlineblock',
			),
			'image_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-image-addon-content-wrap { text-align: {{data.image_align}}; }'
			),

			//style
			'image_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'unit' => array( 'px','em','%' ),
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
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'tab' => 'style',
				'responsive' => true,
				'selector' => array(
					'{{SELECTOR}} .wow-image-addon-img { width: {{data.image_width}}; }',
					'{{SELECTOR}} .wow-addon-image-overlay { width: {{data.image_width}}; }'
				),
			),
			'image_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'unit' => array( 'px','em','%' ),
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
				'std' => array(
					'md' => '',
					'sm' => '',
					'xs' => '',
				),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-image-addon-img, {{SELECTOR}} .wow-addon-image-overlay { height: {{data.image_height}}; }',
			),

			'border_radius' => array(
				'type' => 'dimension',
				'title' => __('border radius','wow-pagebuilder'),
				'unit' => array( '%','px','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Border Radius',
				'selector' => '{{SELECTOR}} .wow-image-addon-content, {{SELECTOR}} .wow-image-addon-img,{{SELECTOR}} .wow-addon-image-overlay  { border-radius: {{data.border_radius}}; }',
			),
			'border_hover_radius' => array(
				'type' => 'dimension',
				'title' => __('Hover border radius','wow-pagebuilder'),
				'responsive' => true,
				'unit' => array( '%','px','em' ),
				'tab' => 'style',
				'section' => 'Border Radius',
				'selector' => '{{SELECTOR}} .wow-image-addon-content:hover, {{SELECTOR}} .wow-image-addon-content:hover img, {{SELECTOR}} .wow-image-addon-content:hover .wow-addon-image-overlay { border-radius: {{data.border_hover_radius}}; }',
			),
			'image_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-image-addon-img, {{SELECTOR}} .wow-addon-image-overlay'
			),
			'image_border_hover' => array(
				'type' => 'border',
				'title' => 'hover Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ),
					'borderStyle' => 'solid',
					'borderColor' => '#cccccc'
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-image-addon-img:hover, {{SELECTOR}} .wow-addon-image-overlay:hover'
			),
			'image_boxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'Box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'selector' => '{{SELECTOR}} .wow-image-addon-img, {{SELECTOR}} .wow-addon-image-overlay',
				'tab' => 'style',
				'section' => 'Box Shadow',
			),
			'image_hboxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'hover box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'selector' => '{{SELECTOR}} .wow-image-addon-img:hover, {{SELECTOR}} .wow-addon-image-overlay:hover',
				'tab' => 'style',
				'section' => 'Box Shadow',
			),

			//light box
			'overlay_icon' => array(
				'type' => 'color',
				'title' => __('icon color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Overlay',
				'depends' => array(array('lightbox', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-addon-image-overlay-icon { color: {{data.overlay_icon}}; }'
			),

			'overlay_bg' => array(
				'type' => 'color',
				'title' => __('Background color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Overlay',
				'depends' => array(array('lightbox', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-addon-image-overlay{ background: {{data.overlay_bg}}; }'
			),

			//caption
			'caption_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Caption',
				'depends' => array(array('caption_text', '!=', '')),
				'selector' => '{{SELECTOR}} .wow-addon-image-caption{ color: {{data.caption_color}}; }'
			),
			'caption_fontstyle' => array(
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
				'selector' => '{{SELECTOR}} .wow-addon-image-caption',
				'section' => 'Caption',
				'tab' => 'style',
			),
			'caption_margin' => array(
				'type' => 'dimension',
				'title' => 'Margin',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Caption',
				'selector' => '{{SELECTOR}} .wow-addon-image-caption { margin: {{data.caption_margin}}; }',
			),

			'opacity' => array(
				'type' => 'slider',
				'title' => 'Opacity',
				'range' => array(
					'min' => 0,
					'max' => 1,
					'step' => .01,
				),
				'selector' => '{{SELECTOR}} img.wow-image-addon-img{ opacity:{{data.opacity}}; }',
				'tab' => 'style',
				'section' => 'Opacity',
			),

		);

		return $settings;
	}


	// Image Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
		$upload_image 	= isset($settings['upload_image']) ? $settings['upload_image'] : array();
		$lightbox 		= isset($settings['lightbox']) ? $settings['lightbox'] : '';
        $lightbox_icon 	= isset($settings['lightbox_icon']) ? $settings['lightbox_icon'] : '';
		$alt_text 		= isset($settings['alt_text']) ? $settings['alt_text'] : '';
		$caption_text 	= isset($settings['caption_text']) ? $settings['caption_text'] : '';
		$image_link 	= isset($settings['image_link']) ? $settings['image_link'] : array();
		$image_display  = isset($settings["image_display"]) ? $settings["image_display"] : 'imginlineblock';

		$img_url = '';
		$output = '';

		if(! empty($upload_image['url'])){
			$img_url = $upload_image['url'];
		}

		$target =  get_wow_array_value_by_key($image_link, 'window') ? 'target=_blank' : "";
		$nofolow = get_wow_array_value_by_key($image_link, 'window') ? 'rel=nofolow' : "";

		$output  .= '<div class="wow-image-addon">';
		$output  .= '<figure class="wow-image-addon-content-wrap">';
		$output  .= '<div class="wow-image-addon-content wow-'.esc_attr($image_display).'">';
		if($lightbox) {
		    $icon = $lightbox_icon == 1 ? '<i class="fas fa-plus wow-addon-image-overlay-icon" aria-hidden="true"></i>' : '';
            $output .= '<a class="wow-image-popup" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="'. esc_url($img_url) .'">';
			$output  .= '<div class="wow-addon-image-overlay">'.$icon.'</div>';
		}
		if( !$lightbox && get_wow_array_value_by_key($image_link, 'link') ) {
			$output  .= '<a '.esc_attr($nofolow).' href="'.esc_url(get_wow_array_value_by_key($image_link, 'link')).'" '.esc_attr($target).'>';
		}
		$output  .= '<img class="wow-image-addon-img" src="'.esc_url($img_url).'" alt="'. esc_attr($alt_text) .'">';
		if(  !$lightbox && get_wow_array_value_by_key($image_link, 'link') ) {
			$output .= '</a>';
		}
        if($lightbox) {
            $output .= '</a>';
        }
		$output .= '</div>';
		if($caption_text){
			$output .= '<figcaption class="wow-addon-image-caption">'. esc_attr($caption_text).'</figcaption>';
		}
		$output .= '</figure>';//wow-image-addon-content-wrap
		$output .= '</div>';

		return $output;
	}

	// Image Template
	public function getTemplate(){
		$output = '
		<div class="wow-image-addon">
			<figure class="wow-image-addon-content-wrap">
				<div class="wow-image-addon-content wow-{{ data.image_display }}">
					<# if( data.lightbox == 1 ) { #>
					    <a class="wow-image-popup" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="{{data.upload_image.url }}">
						<div class="wow-addon-image-overlay">
						    <# if(data.lightbox_icon) { #><i class="fas fa-plus wow-addon-image-overlay-icon" aria-hidden="true"></i> <# } #>
                        </div>
					<# } #>
					<# if( data.lightbox == 0 && !__.isEmpty(data.image_link.link) ) { #>
						<a {{ data.image_link.link ? "href="+data.image_link.link : "" }} {{ data.image_link.window ? "target=_blank" : "" }} {{ data.image_link.nofolow ? "rel=nofolow" : "" }}>
					<# } #>
					<# if( data.upload_image ) { #>
						<# if( data.upload_image.url ) { #>
							<img class="wow-image-addon-img" src="{{data.upload_image.url }}">
						<# } #>
					<# } #>
					<# if( data.lightbox == 0 && !__.isEmpty(data.image_link.link) ) { #>
						</a> 
					<# } #>
					<# if( data.lightbox == 1 ) { #>
					    </a>
					<# } #>
				</div>
				<# if(data.caption_text) { #>
				<figcaption class="wow-addon-image-caption">{{ data.caption_text }}</figcaption>
				<# } #>
			</figure>
			
		</div>
		';
		return $output;
	}
}