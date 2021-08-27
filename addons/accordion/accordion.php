<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Accordion{

	public function get_name(){
		return 'wow_accordion';
	}
	public function get_title(){
		return 'Accordion';
	}
	public function get_icon() {
		return 'wow-font-accordian';
	}

	// Accordion Settings Fields
	public function get_settings() {

		$settings = array(

			'accordion_list' => array(
				'title' => __('Accordion','wow-pagebuilder'),
				'type'  => 'repeatable',
				'label' => 'title',
				'std' => array(
					array( 
						'title' => 'Page Builder',
						'icon_list' => 'far fa-star',
						'icon_position' => 'left',
						'content' => 'Reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),
					array( 
						'title' => 'Drag and Drop',
						'icon_list' => 'fas fa-arrows-alt',
						'icon_position' => 'right',
						'content' => 'Anim pariatur cliche reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),
					array( 
						'title' => 'WordPress Theme',
						'icon_position' => 'right',
						'content' => 'Cliche reprehenderit enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor',
					),
				),
				'attr' => array(
					'title' => array(
						'type' => 'text',
						'title' => __('Item title','wow-pagebuilder'),
						'std' => '1 year customer support',
					),
					'icon_list' => array(
						'type' => 'icon',
						'title' => __('Icon','wow-pagebuilder'),
						'std' => '',
					),
					'icon_position' => array(
						'type' => 'select',
						'title' => __('Title icon position','wow-pagebuilder'),
						'depends' => array(array('icon_list', '!=', '')),
						'values' => array(
							'left' => __('Left','wow-pagebuilder'),
							'right' => __('Right','wow-pagebuilder'),
						),
						'std' => 'left',
					),
					'content' => array(
						'type' => 'editor',
						'title' => __('Contents','wow-pagebuilder'),
						'std' => '1 year customer support',
					),
				),
			),
			'openitem' => array(
				'type' => 'select',
				'title' => __('Behavior','wow-pagebuilder'),
				'values' => array(
					'' => __('Open first item','wow-pagebuilder'),
					'show' => __('Open all items','wow-pagebuilder'),
					'hide' => __('Close all items','wow-pagebuilder'),
				),
				'std' => '',
			),
			'navigation' => array(
				'type' => 'select',
				'title' => __('Navigation style','wow-pagebuilder'),
				'values' => array(
					'' => __('None','wow-pagebuilder'),
					'fas fa-plus' => __('Plus','wow-pagebuilder'),
					'fas fa-plus-circle' => __('Plus circle','wow-pagebuilder'),
					'fas fa-plus-square' => __('Plus fill square','wow-pagebuilder'),
					'fas fa-arrow-circle-right' => __('Arrow fill circle','wow-pagebuilder'),
					'fas fa-angle-right' => __('Angle','wow-pagebuilder'),
					'fas fa-angle-double-right' => __('Angle double','wow-pagebuilder'),
					'fas fa-chevron-right' => __('Chevron','wow-pagebuilder'),
					'fas fa-chevron-circle-right' => __('Chevron circle','wow-pagebuilder'),
					'fas fa-caret-right' => __('Caret','wow-pagebuilder'),
				),
				'std' => 'fas fa-angle-right',
			),
			'navigation_direction' => array(
				'type' => 'select',
				'title' => __('Navigation Direction','wow-pagebuilder'),
				'values' => array(
					'left' => __('Left','wow-pagebuilder'),
					'right' => __('Right','wow-pagebuilder'),
				),
				'std' => 'right',
			),

			// Style Area
			'title_style' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'14px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-accordion-title',
				'section' => 'Title',
			),

			'title_color' => array(
				'type' => 'color2',
				'title' => 'Color',
				'clip' => true,
				'selector' => '{{SELECTOR}} .wow-accordion-title-content',
				'tab' =>'style',
				'std' => array(
					'colorType' => 'color',
					'clip' => true,
					'colorColor' => '#666666',
				),
				'section' => 'Title',
			),
			
			'title_bg2' => array(
				'type' => 'color2',
				'title' => 'Background color',
				'selector' => '{{SELECTOR}} .wow-accordion-title',
				'tab' =>'style',
				'clip' => false,
				'std' => array(
					'colorType' => 'color',
					'colorColor' => '#f8f8f8',
					'clip' => false
				),
				'section' => 'Title',
				'selector' => '{{SELECTOR}} .wow-accordion-title',
			),

			'title_active_color' => array(
				'type' => 'color2',
				'title' => __('Active color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Title',
				'clip' => true,
				'std' => array(
					'colorType' => 'color',
					'clip' => true,
					'colorColor' => '#101010',
				),
				'selector' => '{{SELECTOR}} .wow-accordion-title.active .wow-accordion-title-content'
			),

			'title_active_bg'=> array(
				'type' => 'color2',
				'title' => 'Active background',
				'selector' => '{{SELECTOR}} .wow-accordion-title.active',
				'tab' => 'style',
				'clip' => false,
				'std' => array(
					'clip' => false,
					'colorType' => 'color',
					'colorColor' => '#f8f8f8',
				),
				'section' => 'Title',
			),
			'title_active_border'=> array(
				'type' => 'color',
				'std' => '#f8f8f8',
				'title' => 'Active Border',
				'tab' => 'style',
				'section' => 'Title',
				'std'	=> '#e5e5e5',
				'selector' => '{{SELECTOR}} .wow-accordion-title.active { border-color: {{data.title_active_border}}; }'
			),
			'title_border_radius' => array(
				'type' => 'dimension',
				'title' => 'Title border radius',
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Title',
				'selector' => '{{SELECTOR}} .wow-accordion-title { border-radius: {{data.title_border_radius}}; }'
			),
			'title_sept_space' => array(
				'type' => 'slider',
				'title' => __('Title separator spacing','wow-pagebuilder'),
				'unit' => array( 'px','em' ),
				'range' => array(
						'em' => array(
							'min' => -10,
							'max' => 20,
							'step' => 1,
						),
						'px' => array(
							'min' => -20,
							'max' => 150,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '-1px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Title',
				'selector' => '{{SELECTOR}} .wow-accordion-title:not(.active) { margin-top: {{data.title_sept_space}}; }',
			),
			'title_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'std' => array(
						'md' => array( 'top' => '10px', 'right' => '30px', 'bottom' => '10px', 'left' => '15px' ),
						'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Title',
				'selector' => '{{SELECTOR}} .wow-accordion-title { padding: {{data.title_padding}}; }'
			),
			'icon_size' => array(
				'type' => 'slider',
				'title' => __('Icon Size','wow-pagebuilder'),
				'unit' => array( 'px','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 100,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '12px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'section' => 'Icon',
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-accordion-title > i{ font-size: {{data.icon_size}}; }',
			),
			'icon_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Icon',
				'std'       => '#666666',
				'selector' => '{{SELECTOR}} .wow-accordion-title > i{ color: {{data.icon_color}}; }'
			),
			'icon_active_color' => array(
				'type' => 'color',
				'title' => __('Active color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Icon',
				'std'       => '#101010',
				'selector' => '{{SELECTOR}} .wow-accordion-title.active > i { color: {{data.icon_active_color}}; }'
			),
			'nav_icon_size' => array(
				'type' => 'slider',
				'title' => __('Navigation Icon Size','wow-pagebuilder'),
				'unit' => array( 'px','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 100,
							'step' => .1,
						),
						'px' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
					),
				'std' => array(
						'md' => '14px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Icon',
				'selector' => '{{SELECTOR}} .wow-accordion-title .wow-toggle-direction{ font-size: {{data.nav_icon_size}}; }',
			),
			'nav_icon_color' => array(
				'type' => 'color',
				'title' => __('Navigation icon color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Icon',
				'std'       => '#666666',
				'selector' => '{{SELECTOR}} .wow-accordion-title .wow-toggle-direction{ color: {{data.nav_icon_color}}; }'
			),

			'nav_icon_active_color' => array(
				'type' => 'color',
				'title' => __('Navigation icon active color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Icon',
				'std'       => '#000000',
				'selector' => '{{SELECTOR}} .wow-accordion-title.active .wow-toggle-direction{ color: {{data.nav_icon_active_color}}; }'
			),

			'content_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Content',
				'std'       => '#888888',
				'selector' => '{{SELECTOR}} .wow-accordion-content { color: {{data.content_color}}; }'
			),
			'content_bgcolor' => array(
				'type' => 'color',
				'title' => __('Background color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Content',
				'std'       => '#ffffff',
				'selector' => '{{SELECTOR}} .wow-accordion-content { background: {{data.content_bgcolor}}; }'
			),
			'content_style' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'14px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-accordion-content',
				'section' => 'Content',
			),
			'content_border_radius' => array(
				'type' => 'dimension',
				'title' => 'Content border radius',
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Content',
				'selector' => '{{SELECTOR}} .wow-accordion-content { border-radius: {{data.content_border_radius}}; }'
			),
			'content_margin' => array(
				'type' => 'dimension',
				'title' => 'Content margin',
				'std' => array(
						'md' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
					),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Content',
				'selector' => '{{SELECTOR}} .wow-accordion-content { margin: {{data.content_margin}}; }'
			),
			'content_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'std' => array(
						'md' => array( 'top' => '15px', 'right' => '15px', 'bottom' => '15px', 'left' => '15px' ),
						'sm' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ),
						'xs' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ), 
					),
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Content',
				'selector' => '{{SELECTOR}} .wow-accordion-content{ padding: {{data.content_padding}}; }'
			),
			'content_align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Content',
				'selector' => '{{SELECTOR}} .wow-accordion-content { text-align: {{data.content_align}}; }'
			),
			'item_border' => array(
				'type' => 'border',
				'title' => 'Title Border',
				'std' => array(
					'itemOpenBorder' => 1,
					'borderWidth' => array( 'top' => '1px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#e5e5e5' 
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-accordion-title'
			),
			'content_border' => array(
				'type' => 'border',
				'title' => 'Content Border',
				'std' => array(
					'itemOpenBorder' => 1,
					'borderWidth' => array( 'top' => '0px', 'right' => '1px', 'bottom' => '1px', 'left' => '1px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#e5e5e5' 
				),
				'tab' => 'style',
				'section' => 'Border',
				'selector' => '{{SELECTOR}} .wow-accordion-content'
			),

		);

		return $settings;
	}

	// Accordion Render HTML
	public function render($data = null){
		$settings 			= $data['settings'];
		$accordion_list 	= isset($settings["accordion_list"]) ? $settings["accordion_list"] : array();
		$openitem 			= isset($settings["openitem"]) ? $settings["openitem"] : '';
		$navigation 		= isset($settings["navigation"]) ? $settings["navigation"] : 'fa-angle-right';
		$navigation_direction = isset($settings["navigation_direction"]) ? $settings["navigation_direction"] : 'right';

		$output = '';

		$output  .= '<div class="wow-accordion-addon">';
		$output  .= '<div class="wow-accordion-addon-content">';
		$output  .= '<div class="wow-accordion-items">';
		if (is_array($accordion_list) && count($accordion_list)){
			foreach ( $accordion_list as $key => $value ) {
				$output  .= '<div class="wow-accordion-item repeater-'.$key.'">';
				$activeClass = (($key == 0 || $openitem == "show") &&  $openitem != "hide") ? "active" : "";
				$output  .= '<div class="wow-accordion-title wow-toggle-'.$navigation_direction.' '.$activeClass.'">';
				if( $navigation_direction == 'left' ) {
					if($navigation) {
						$output  .= '<span class="wow-toggle-direction wow-toggle-'.$navigation_direction.'"><i class="fas '.$navigation.'"></i></span>';
					}
				}
				if(get_wow_array_value_by_key($value, 'icon_position') == "left" ) {
					if(! empty($value['icon_list'])){
						$output  .= '<i class="'.$value['icon_list'].'"></i>';
					}
				}
				if( get_wow_array_value_by_key($value, 'title') ){
					$output  .= '<span class="wow-accordion-title-content">'.$value['title'].'</span>';
				}
				if(get_wow_array_value_by_key($value, 'icon_position') == "right" ) {
					if(! empty($value['icon_list'])){
						$output  .= '<i class="'.$value['icon_list'].'"></i>';
					}
				}
				if( $navigation_direction == 'right' ) {
					if($navigation) {
						$output  .= '<span class="wow-toggle-direction wow-toggle-'.$navigation_direction.'"><i class="fas '.$navigation.'"></i></span>';
					}
				}


				$output  .= '</div>';//wow-accordion-title

				$panelStyle = (($key != 0 || $openitem == "hide") && $openitem != "show") ? "display: none;" : "";
				$output  .= '<div class="wow-panel-collapse" style="'.$panelStyle.'">';
				$output  .= '<div class="wow-accordion-content">'.wp_kses_post( $value['content'] ).'</div>';
				$output  .= '</div>';//wow-panel-collapse
				$output  .= '</div>';
			}
		}

		$output  .= '</div>';
		$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}

	// Accordion Template
	public function getTemplate(){
		$output = '
			<div class="wow-accordion-addon">
				<div class="wow-accordion-addon-content">
					<div class="wow-accordion-items">
						<#  __.forEach(data.accordion_list, function(value, key) { #>
							<div class="wow-accordion-item repeater-{{key}}">

								<# var navigation_direction = data.navigation_direction ? data.navigation_direction : "right" #>
								<# var activeClass = ((key == 0 || data.openitem == "show") &&  data.openitem != "hide") ? "active" : ""; #>
								
								<div class="wow-accordion-title wow-toggle-{{navigation_direction}} {{ activeClass }}">
									<# if(navigation_direction == "left") { #>
										<# if(data.navigation) { #>
											<span class="wow-toggle-direction wow-toggle-{{navigation_direction}}"><i class="fas {{data.navigation}}"></i></span>
										<# } #>	
									<# } #>	
									<# if(value.icon_position == "left" && !__.isEmpty(value.icon_list)) { #> <i class="{{ value.icon_list }}"></i><# } #><span class="wow-accordion-title-content">{{value.title}}</span><# if(value.icon_position == "right" && !__.isEmpty(value.icon_list)) { #> <i class=" {{ value.icon_list }}"></i><# } #>

									<# if(navigation_direction == "right") { #>
										<# if(data.navigation) { #>
											<span class="wow-toggle-direction wow-toggle-{{navigation_direction}}"><i class="fas {{data.navigation}}"></i></span>
										<# } #>	
									<# } #>	
								</div>

								<# var panelStyle = ((key != 0 || data.openitem == "hide") && data.openitem != "show") ? "display: none;" : ""; #>
								<div class="wow-panel-collapse" style="{{ panelStyle }}">
									<div class="wow-accordion-content">{{{value.content}}}</div>
								</div>

							</div>
						<# }); #>
					</div>
				</div>
			</div>
		';
		return $output;
	}

}
