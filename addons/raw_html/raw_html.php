<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Raw_Html{

	public function get_name(){
		return 'wow_raw_html';
	}
	public function get_title(){
		return 'Raw HTML';
	}
	public function get_icon() {
		return 'wow-font-html5';
	}

	// image Settings Fields
	public function get_settings() {

		$settings = array(
			'rawhtml' => array(
				'type' => 'textarea',
				'title' => __('Content','wow-pagebuilder'),
				'std' => '<p>Insert raw html here.</p>'
			),

			'align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-raw-html-content { text-align: {{data.align}}; }'
			),

			//style
			'color' => array(
				'type' => 'color',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-raw-html-content { color: {{data.color}}; }'
			),
			'link_color' => array(
				'type' => 'color',
				'title' => __('Link Color','wow-pagebuilder'),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-raw-html-content a { color: {{data.link_color}}; }'
			),
			'link_hcolor' => array(
				'type' => 'color',
				'title' => __('Link Hover Color','wow-pagebuilder'),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-raw-html-content a:hover { color: {{data.link_hcolor}}; }'
			),

			'typo_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'14px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '400',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-raw-html-content',
				'tab' => 'style',
			)
		);

		return $settings;
	}


	// Raw HTML Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
		$rawhtml 		= isset($settings['rawhtml']) ? wp_kses_post( $settings['rawhtml'] ) : '';
		$output = '';
		$output  .= '<div class="wow-raw-html-addon">';
			if($rawhtml){
				$output .= '<div class="wow-raw-html-content">'. $rawhtml .'</div>';
			}
		$output .= '</div>';

		return $output;
	}

	// raw Template
	public function getTemplate(){
		$output = '
		<div class="wow-raw-html-addon">
			<div class="wow-raw-html-content">
				{{{ data.rawhtml }}}
			</div>
		</div>
		';
		return $output;
	}

}