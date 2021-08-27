<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Heading{

	public function get_name(){
		return 'wow_heading';
	}
	public function get_title(){
		return 'Heading';
	}
	public function get_icon() {
		return 'wow-font-heading';
	}

	// headline Settings Fields
	public function get_settings() {

		$settings = array(

			'title' => array(
				'type' => 'textarea',
				'title' => __('Title','wow-pagebuilder'),
				'std' => 'This is Title',
			),

			'title_selector' => array(
				'type' => 'select',
				'title' => __('Title Tag','wow-pagebuilder'),
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
				'std' => 'h2',
			),
			'title_link' => array(
				'type' => 'link',
				'title' => __('Link','wow-pagebuilder'),
				'std' =>   array('link'=>'','window'=>false,'nofolow'=>false),
			),
			'align' => array(
				'type' => 'alignment',
				'title' => __('Alignment','wow-pagebuilder'),
				'responsive' => true,
				'selector' => '{{SELECTOR}} .wow-addon-title { text-align: {{data.align}}; }'
			),
			'title_color' => array(
				'type' => 'color2',
				'title' => __('Color','wow-pagebuilder'),
				'tab' => 'style',
				'clip' => true,
				'std' => array( 'colorType' => 'color', 'clip' => true, 'colorColor' => '' ),
				'selector' => '{{SELECTOR}} .wow-addon-title, {{SELECTOR}} .wow-addon-title a'
			),
			'title_link_hcolor' => array(
				'type' => 'color',
				'title' => __('link hover color','wow-pagebuilder'),
				'tab' => 'style',
				'selector' => '{{SELECTOR}} .wow-addon-title a:hover{ color: {{data.title_link_hcolor}}; }'
			),
			'title_fontstyle' => array(
				'type' => 'typography',
				'title' => __('Typography','wow-pagebuilder'),
				'std' => array(
					'fontFamily' => '',
					'fontSize' => array( 'md'=>'28px', 'sm'=>'', 'xs'=>'' ),
					'lineHeight' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
					'fontWeight' => '700',
					'textTransform' => '',
					'fontStyle' => '',
					'letterSpacing' => array( 'md'=>'', 'sm'=>'', 'xs'=>'' ),
				),
				'selector' => '{{SELECTOR}} .wow-addon-title',
				'tab' => 'style',
			)

		);

		return $settings;
	}

	// Headline Render HTML
	public function render($data = null){
		$settings 		= $data['settings']; 
		$title_selector = isset($settings["title_selector"]) ? $settings["title_selector"] : 'h2';
		$title 			= isset($settings["title"]) ? $settings["title"] : '';
		$title_link 	= isset($settings["title_link"]) ? $settings["title_link"] : array();

		$output = '';

		$target = !empty($title_link['window']) ? 'target=_blank' : "";
		$nofolow = !empty($title_link['nofolow']) ? 'rel=nofolow' : "";

			$output  .= '<div class="wow-headline-addon">';
				$output  .= '<div class="wow-headline-content">';
				if( !empty($title_link['link']) ){
					$output .= '<' .esc_attr($title_selector). ' class="wow-addon-title"><a '.esc_attr($nofolow).' href="'.esc_url($title_link['link']).'" '.esc_attr($target).'>' . wp_kses_post($title) .'</a></' . esc_attr($title_selector) . '>';
				} else {
					$output .= '<' .esc_attr($title_selector ). ' class="wow-addon-title">' . wp_kses_post($title) .'</' . esc_attr($title_selector) . '>';
				}
				$output .= '</div>';
			$output .= '</div>';
		return $output;
	}

	// headline Template
	public function getTemplate(){
		$output = '
		<# var title_selector = data.title_selector ? data.title_selector : "h2" #>
			<div class="wow-headline-addon">
				<div class="wow-headline-content">
					<# if( !__.isEmpty(data.title_link) && data.title_link.link ) { #>
						<{{ title_selector }} class="wow-addon-title"><a {{ data.title_link.link ? "href="+data.title_link.link : "" }} {{ data.title_link.window ? "target=_blank" : "" }} {{ data.title_link.nofolow ? "rel=nofolow" : "" }} >{{{ data.title }}}</a></{{ title_selector }}>
					<# } else { #>
						<{{ title_selector }} class="wow-addon-title">{{{ data.title }}}</{{ title_selector }}>
					<# } #>
				</div>
			</div>
		';
		return $output;
	}

}
