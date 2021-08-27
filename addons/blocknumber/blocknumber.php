<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Blocknumber{

	public function get_name(){
		return 'wow_block_number';
	}
	public function get_title(){
		return 'Block Number';
	}
	public function get_icon() {
		return 'wow-font-block-number';
	}

	// Settings Fields
	public function get_settings() {

		$settings = array(
			'number' => array(
				'type' => 'text',
				'title' => __('Block Number','wow-pagebuilder'),
				'std' => '01'
			),
			'number_title' => array(
				'type' => 'text',
				'title' => __('Title','wow-pagebuilder'),
				'std' => 'Number Title'
			),
			'number_description' => array(
				'type' => 'textarea',
				'title' => __('Add Description','wow-pagebuilder'),
				'std' => 'Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.'
			),
			// tab style	
			'number_color' => array(
				'type' => 'color',
				'title' => __('Number color','wow-pagebuilder'),
				'tab' => 'style',
				'std'       => '#ffffff',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span{ color: {{data.number_color}}; }'
			),
			'number_bg' => array(
				'type' => 'color',
				'title' => __('Number background color','wow-pagebuilder'),
				'tab' => 'style',
				'std' => '#03E16D',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span{ background: {{data.number_bg}}; }'
			),
			'number_width' => array(
				'type' => 'slider',
				'title' => __('Number Width','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 15,
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
						'md' => '48px',
						'sm' => '',
						'xs' => ''
					),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span { width: {{data.number_width}}; }'
			),
			'number_height' => array(
				'type' => 'slider',
				'title' => __('Number Height','wow-pagebuilder'),
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
						'md' => '48px',
						'sm' => '',
						'xs' => '',
					),
				'responsive' => true,
				'tab' => 'style',
				'selector' => array(
					'{{SELECTOR}} .wow-blocknumber-number span { height: {{data.number_height}}; }',
					'{{SELECTOR}} .wow-blocknumber-number span { line-height: {{data.number_height}}; }',
				)
			),
			'number_border' => array(
				'type' => 'border',
				'title' => 'Number Border',
				'std' => array(
					'borderWidth' => array( 'top' => '2px', 'right' => '2px', 'bottom' => '2px', 'left' => '2px' ), 
					'borderStyle' => 'solid', 
					'borderColor' => '#cccccc' 
				),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span'
      ),
      'number_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'16px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '600',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span',
				'tab' => 'style',
      ),
			'number_radius' => array(
				'type' => 'dimension',
				'title' => __('Number border radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span { border-radius: {{data.number_radius}}; }'
			),
      'number_margin' => array(
				'type' => 'dimension',
				'title' => __('Number margin','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-blocknumber-number span { margin: {{data.number_margin}}; }'
			),
			'title_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Title',
				'std'       => '#000000',
				'selector' => '{{SELECTOR}} .wow-blocknumber-title { color: {{data.title_color}}; }'
			),
			'title_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'16px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '600',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'tab' => 'style',
				'section' => 'Title',
				'selector' => '{{SELECTOR}} .wow-blocknumber-title',
			),
			'descr_color' => array(
				'type' => 'color',
				'title' => __('Description color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Description',
				'std'       => '#666666',
				'selector' => '{{SELECTOR}} .wow-blocknumber-desc { color: {{data.descr_color}}; }'
			),
			'desc_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'16px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '600',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'tab' => 'style',
				'section' => 'Description',
				'selector' => '{{SELECTOR}} .wow-blocknumber-desc',
			),
		);
		return $settings;
	}

	// Block Number Render HTML
	public function render($data = null){
		$settings 				= $data['settings'];

		$number_title 	        = isset($settings['number_title']) ? $settings['number_title'] : '';
		$number_description 	= isset($settings['number_description']) ? $settings['number_description'] : '';
		$number 		        = isset($settings['number']) ? $settings['number'] : '';

		$output                 = '';
		$output  .= '<div class="wow-blocknumber-addon">';
			$output  .= '<div class="wow-blocknumber-addon-content">';
				$output  .= '<div class="wow-blocknumber-media">';
					if($number){
						$output .= '<div class="wow-blocknumber-number"><span>'.esc_attr($number).'</span></div>';
					}
					$output .= '<div class="wow-blocknumber-body">';
					if($number_title){
						$output .= '<h5 class="wow-blocknumber-title">'.esc_attr($number_title).'</h5>';
					}
					if($number_description){
						$output .= '<div class="wow-blocknumber-desc">'.esc_attr($number_description).'</div>';
					}
					$output .= '</div>';//wow-blocknumber-body
				$output  .= '</div>';//wow-blocknumber-media
			$output .= '</div>';//wow-blocknumber-addon-content
		$output .= '</div>';//wow-blocknumber-addon

		return $output;
	}

	// Block Number Template
	public function getTemplate(){
		$output = '
			<div class="wow-blocknumber-addon">
				<div class="wow-blocknumber-addon-content">
					<div class="wow-blocknumber-media">
						<# if(data.number) { #>
							<div class="wow-blocknumber-number"><span>{{data.number}}</span></div>
						<# } #>
						<# if( data.number_title || data.number_description ) { #>
							<div class="wow-blocknumber-body">	
								<# if(data.number_title) { #>
								<h5 class="wow-blocknumber-title">{{ data.number_title }}</h5>
								<# } #>
								<# if(data.number_description) { #>
									<div class="wow-blocknumber-desc">{{data.number_description}}</div>
								<# } #>
							</div>
						<# } #>
					</div>
				</div>
			</div>

		';
		return $output;
	}

}
