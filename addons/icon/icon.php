<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Icon{

	public function get_name(){
		return 'wow_icon';
	}
	public function get_title(){
		return 'Icon';
	}
	public function get_icon() {
		return 'wow-font-heart-thin';
	}

	// Icon Settings Fields
	public function get_settings() {

		$settings = array(
			'icon_list' => array(
				'type' => 'icon',
				'title' => __('Icon','wow-pagebuilder'),
				'std' => 'fas fa-home'
			),
			'icon_link' => array(
				'type' => 'link',
				'std' => array( 'link'=>'','window'=>false,'nofolow'=>false ),
				'title' => __('Link','wow-pagebuilder'),
			),
			'icon_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'std' => array( 'md' => 'center', 'sm' => 'center', 'xs' => 'center' ),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-icon-content { text-align: {{data.icon_align}}; }'
			),

			// Style Area
			'icon_size' => array(
				'type' => 'slider',
				'title' => __('Size','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 200,
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
					'md' => '36px',
					'sm' => '',
					'xs' => '',
				),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner i { font-size: {{data.icon_size}}; }'
			),
			'icon_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
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
				'std' => array(
					'md' => '100px',
					'sm' => '',
					'xs' => '',
				),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner { width: {{data.icon_width}}; }'
			),

			'icon_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
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
				'std' => array(
						'md' => '100px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'selector' => array(
					'{{SELECTOR}} .wow-icon-content .wow-icon-inner { height: {{data.icon_height}}; }',
					'{{SELECTOR}} .wow-icon-content .wow-icon-inner i { line-height: {{data.icon_height}}; }',
				)
			),
			'icon_line_height' => array(
				'type' => 'slider',
				'title' => __('Line Height','wow-pagebuilder'),
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
				'std' => array(
						'md' => '100px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner { line-height: {{data.icon_line_height}}; }',
			),
			'icon_color' => array(
				'type' => 'color2',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'clip' => true,
				'std' => array(
					'clip' => true,
					'colorType' => 'color',
					'colorColor' => '#ffffff',
				),
				'section' => 'Color',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner i, {{SELECTOR}} .wow-icon-content .wow-icon-inner a i'
			),
			'icon_hcolor' => array(
				'type' => 'color2',
				'title' => __('Hover Color','wow-pagebuilder'),
				'tab' => 'style',
				'clip' => true,
				'std' => array(
					'clip' => true,
					'colorType' => 'color',
					'colorColor' => '#ffffff',
				),
				'section' => 'Color',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner:hover i, {{SELECTOR}} .wow-icon-content .wow-icon-inner:hover a i'
			),
			'icon_bg' => array(
				'type' => 'color2',
				'title' => __('background','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Color',
				'clip' => false,
				'std' => array(
					'clip' => false,
					'colorType' => 'color',
					'colorColor' => '#0080FE',
				),
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner'
			),
			'icon_hover_bg' => array(
				'type' => 'color2',
				'title' => __('Hover background','wow-pagebuilder'),
				'tab' => 'style',
				'clip' => false,
				'std' => array(
					'clip' => false,
					'colorType' => 'color',
					'colorColor' => '#0170dc',
				),
				'section' => 'Color',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner:before, {{SELECTOR}} .wow-icon-content .wow-icon-inner:hover'
			),
			'icon_border' => array(
				'type' => 'border',
				'title' => 'Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner'
			),
			'border_hcolor' => array(
				'type' => 'border',
				'title' => 'Hover Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner:hover, {{SELECTOR}} .wow-icon-content .wow-icon-inner:before'
			),
			'icon_radius' => array(
				'type' => 'dimension',
				'title' => 'Border radius',
				'unit' => array( 'px','em','%' ),
				'std' => array(
					'md' => array( 'top' => '100px', 'right' => '100px', 'bottom' => '100px', 'left' => '100px' ), 
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
				),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Border Radius',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner, {{SELECTOR}} .wow-icon-content .wow-icon-inner:before { border-radius: {{data.icon_radius}}; }',
			),
			'icon_hover_radius' => array(
				'type' => 'dimension',
				'title' => 'Hover Border radius',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'std' => array(
					'md' => array( 'top' => '100px', 'right' => '100px', 'bottom' => '100px', 'left' => '100px' ), 
					'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
					'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
				),
				'tab' => 'style',
				'section' => 'Border Radius',
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner:hover, {{SELECTOR}} .wow-icon-content .wow-icon-inner:hover:before { border-radius: {{data.icon_hover_radius}}; }',
			),
			'icon_boxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'Icon box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner, {{SELECTOR}} .wow-icon-content .wow-icon-inner:before',
				'tab' => 'style',
				'section' => 'Box Shadow',
			),
			'icon_hboxshadow' => array(
				'type' => 'boxshadow',
				'title' => 'Icon hover box shadow',
                'std' => array(
                    'shadowValue' => array( 'top' => '0px', 'right' => '0px', 'bottom' => '5px', 'left' => '0px' ),
                    'shadowColor' => 'rgba(0,0,0,.3)'
                ),
				'selector' => '{{SELECTOR}} .wow-icon-content .wow-icon-inner:hover, {{SELECTOR}} .wow-icon-content .wow-icon-inner:hover:before',
				'tab' => 'style',
				'section' => 'Box Shadow',
			),
		);

		return $settings;
	}

	// Icon Render HTML
	public function render($data = null){
		$settings 			= $data['settings']; 
		$icon_list 			= isset($settings["icon_list"]) ? $settings["icon_list"] : '';
		$icon_link 	    	= isset($settings["icon_link"]) ? $settings["icon_link"] : array();

		$output = '' ;

		$target = $icon_link['window'] ? 'target=_blank' : "";
		$nofolow = $icon_link['nofolow'] ? 'rel=nofolow' : "";

		$output  .= '<div class="wow-icon-addon">';
			$output  .= '<div class="wow-icon-content">';
			if($icon_link['link']) {
				$output  .= '<span class="wow-icon-inner"><a '.esc_attr($nofolow).' href="'.esc_url($icon_link['link']).'" '.esc_attr($target).'>';
				$output  .= '<i class="' . esc_attr($icon_list) . '"></i>';
				$output  .= '</a></span>';
			} else {
				$output  .= '<span class="wow-icon-inner"><i class="' . esc_attr($icon_list) . '"></i></span>';
			}
			$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}

	// Icon Template
	public function getTemplate(){
		$output = '
			<div class="wow-icon-addon">
				<div class="wow-icon-content">
					<# if( !__.isEmpty(data.icon_link.link) ) { #>
						<span class="wow-icon-inner"><a {{ data.icon_link.link ? "href="+data.icon_link.link : "" }} {{ data.icon_link.window ? "target=_blank" : "" }} {{ data.icon_link.nofolow ? "rel=nofolow" : "" }}>
						<i class=" {{data.icon_list}}"></i>
						</a></span>
					<# } else { #>	
						<span class="wow-icon-inner"><i class=" {{data.icon_list}}"></i></span>
					<# } #>
				</div>
			</div>
		';
		return $output;
	}

}
