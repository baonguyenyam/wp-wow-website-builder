<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Alert{

	public function get_name(){
		return 'wow_alert';
	}
	public function get_title(){
		return 'Alert';
	}
	public function get_icon() {
		return 'wow-font-alert';
	}

	// Settings Fields
	public function get_settings() {

		$settings = array(
			'alert_title' => array(
				'type' => 'text',
				'title' => __('Title','wow-pagebuilder'),
				'std' => 'Alert Addon',
			),
			'alert_description' => array(
				'type' => 'textarea',
				'title' => __('Description','wow-pagebuilder'),
				'std' => 'Duis mollis est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.',
			),
			'alert_close' => array(
				'type' => 'switch',
				'title' => __('Show Close Button','wow-pagebuilder'),
				'std' => '1'
			),
			//style tab
			'alert_style' => array(
				'type' => 'select',
				'title' => __('Alert style','wow-pagebuilder'),
				'values' => array(
					'primary' => __('Primary','wow-pagebuilder'),
					'success' => __('Success','wow-pagebuilder'),
					'info' => __('Info','wow-pagebuilder'),
					'warning' => __('Warning','wow-pagebuilder'),
					'danger' => __('Danger','wow-pagebuilder'),
					'light' => __('Light','wow-pagebuilder'),
					'dark' => __('Dark','wow-pagebuilder'),
					'custom' => __('Custom','wow-pagebuilder'),
				),
				'std' => 'info',
				'tab' => 'style',
			),
			'content_color' => array(
				'type' => 'color',
				'title' => __('Content background color','wow-pagebuilder'),
				'tab' => 'style',
				'depends' => array( array( 'alert_style', '=', 'custom' ) ),
				'selector' => '{{SELECTOR}} .wow-alert-addon-content{ background: {{data.content_color}}; }'
			),
			'close_color' => array(
				'type' => 'color',
				'title' => __('Close color','wow-pagebuilder'),
				'tab' => 'style',
				'std' => '#e02e2e',
				'selector' => '{{SELECTOR}} .wow-close-alert { color: {{data.close_color}}; }'
			),
			'close_hcolor' => array(
				'type' => 'color',
				'title' => __('Close hover color','wow-pagebuilder'),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-close-alert:hover { color: {{data.close_hcolor}}; }'
			),

			'title_color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Title',
				'depends' => array( array( 'alert_style', '=', 'custom' ) ),
				'selector' => '{{SELECTOR}} .wow-alert-title { color: {{data.title_color}}; }'
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
				'selector' => '{{SELECTOR}} .wow-alert-title',
				'tab' => 'style',
				'section' => 'Title',
			),

			'desc_color' => array(
				'type' => 'color',
				'title' => __('Description color','wow-pagebuilder'),
				'tab' => 'style',
				'section' => 'Description',
				'depends' => array( array( 'alert_style', '=', 'custom' ) ),
				'selector' => '{{SELECTOR}} .wow-alert-desc { color: {{data.desc_color}}; }'
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
				'selector' => '{{SELECTOR}} .wow-alert-desc',
				'tab' => 'style',
				'section' => 'Description',
			),

			'alert_padding' => array(
				'type' => 'dimension',
				'title' => 'Padding',
				'unit' => array( 'px','em','%' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Spacing',
				'selector' => '{{SELECTOR}} .wow-alert-addon-content { padding: {{data.alert_padding}}; }'
			),
			'alert_radius' => array(
				'type' => 'dimension',
				'title' => __('Border radius','wow-pagebuilder'),
				'unit' => array( 'px','%','em' ),
				'responsive' => true,
				'tab' => 'style',
				'section' => 'Spacing',
				'selector' => '{{SELECTOR}} .wow-alert-addon-content { border-radius: {{data.alert_radius}}; }'
			),
		);

		return $settings;
	}


	// Alert Render HTML
	public function render($data = null){
		$settings 				= $data['settings'];
		$alert_title 			= isset($settings['alert_title']) ? sanitize_text_field( $settings['alert_title'] ) : '';
		$alert_description 		= isset($settings['alert_description']) ? sanitize_text_field( $settings['alert_description'] ) : '';
		$alert_close 			= (bool) isset($settings['alert_close']) ? $settings['alert_close'] : false;
		$alert_style 			= isset($settings['alert_style']) ? sanitize_text_field( $settings['alert_style'] ) : 'info';
		$output = '';

		$output  .= '<div class="wow-alert-addon">';
			$output  .= '<div class="wow-alert-addon-content wow-alert-'.esc_attr($alert_style).'">';
			if ($alert_title) {
				$output .= '<span class="wow-alert-title">' . esc_attr($alert_title) .'</span>';
			}
			if ($alert_description) {
				$output .= '<span class="wow-alert-desc">' . esc_attr($alert_description) . '</span>';
			}
			if ($alert_close == 1) {
				$output .= '<button type="button" class="wow-close-alert" data-dismiss="wow-alert"><span aria-hidden="true">&times;</span></button>';
			}
			$output .= '</div>';
		$output .= '</div>';
		return $output;
	}

	// alert Template
	public function getTemplate(){
		$output = '
			<div class="wow-alert-addon">
				<div class="wow-alert-addon-content wow-alert-{{ data.alert_style }}">
					<# if(data.alert_title) { #>
					<span class="wow-alert-title">{{ data.alert_title }}</span>
					<# } #>
					<# if(data.alert_description) { #>
					<span class="wow-alert-desc">{{ data.alert_description }}</span>
					<# } #>
					<# if(data.alert_close == 1) { #>
						<button type="button" class="wow-close-alert" data-dismiss="wow-alert"><span aria-hidden="true">&times;</span></button>
					<# } #>
				</div>
			</div>';
		return $output;
	}

}