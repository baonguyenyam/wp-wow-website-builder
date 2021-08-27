<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WOW_Addon_Video{

	public function get_name(){
		return 'wow_video';
	}
	public function get_title(){
		return 'Video';
	}
	public function get_icon() {
		return 'wow-font-video';
	}

	// Video Settings Fields
	public function get_settings() {
		$settings = array(
			'video_type' => array(
				'type' => 'select',
				'title' => __('Video Source','wow-pagebuilder'),
				'values' => array(
					'youtube' => __('Youtube','wow-pagebuilder'),
					'vimeo' => __('Vimeo','wow-pagebuilder'),
					'self-hosted' => __('Self-hosted','wow-pagebuilder'),
				),
				'std' => 'youtube',
			),
			'video_url' => array(
				'type' => 'text',
				'title' => __('Video URL','wow-pagebuilder'),
				'std' => 'https://www.youtube.com/watch?v=_dhApw73KYU'
			),
			'video_hide_logo' => array(
				'type' => 'switch',
				'title' => __('Logo','wow-pagebuilder'),
				'std' => '1',
				'depends' => array(array('video_type', '=', 'youtube')),
			),
			'video_controls' => array(
				'type' => 'switch',
				'title' => __('Controls','wow-pagebuilder'),
				'std' => '1',
				'depends' => array(array('video_type', '=', 'youtube')),
			),
			//style
			'video_width' => array(
				'type' => 'slider',
				'title' => __('Width','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'std' => array(
					'md' => '100%',
					'sm' => '',
					'xs' => '',
				),
				'unit' => array( 'px','%','em' ),
				'range' => array(
					'em' => array(
						'min' => 0,
						'max' => 90,
						'step' =>.1,
					),
					'px' => array(
						'min' => 0,
						'max' => 500,
						'step' =>1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
					),
				),
				'selector' => '{{SELECTOR}} .wow-video-block.wow-embed-responsive iframe { width: {{data.video_width}}; }'
			),
			'video_height' => array(
				'type' => 'slider',
				'title' => __('Height','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'std' => array(
					'md' => '100%',
					'sm' => '',
					'xs' => '',
				),
				'unit' => array( 'px','%','em' ),
				'range' => array(
						'em' => array(
							'min' => 0,
							'max' => 90,
							'step' =>.1,
						),
						'px' => array(
							'min' => 0,
							'max' => 500,
							'step' =>1,
						),
						'%' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
				),
				'selector' => '{{SELECTOR}} .wow-video-block.wow-embed-responsive iframe { height: {{data.video_height}}; }'
			),
			'video_radius' => array(
				'type' => 'dimension',
				'title' => __('Border Radius','wow-pagebuilder'),
				'responsive' => true,
				'tab' => 'style',
				'unit' => array( 'px','%','em' ),
				'selector' => '{{SELECTOR}} .wow-video-block.wow-embed-responsive{ border-radius: {{data.video_radius}}; }'
			),
		);

		return $settings;
	}


	// Video Render HTML
	public function render($data = null){
		$settings 		= $data['settings'];
		$video_url 		= isset($settings['video_url']) ? $settings['video_url'] : '';
		$video_controls = isset($settings['video_controls']) ? $settings['video_controls'] : '';
		$video_hide_logo = isset($settings['video_hide_logo']) ? $settings['video_hide_logo'] : '';
		$output = '';
		if($video_url) {
			$video = parse_url($video_url);

			switch($video['host']) {
				case 'youtu.be':
				$id = trim($video['path'],'/');
				$src = '//www.youtube.com/embed/' . $id.'?controls='.esc_attr($video_controls).'&modestbranding='.esc_attr($video_hide_logo);
				break;

				case 'www.youtube.com':
				case 'youtube.com':
				parse_str($video['query'], $query);
				$id = $query['v'];
				$src = '//www.youtube.com/embed/' . $id.'?controls='.esc_attr($video_controls).'&modestbranding='.esc_attr($video_hide_logo);
				break;

				case 'vimeo.com':
				case 'www.vimeo.com':
				$id = trim($video['path'],'/');
				$src = "//player.vimeo.com/video/{$id}";
			}
			$output  .= '<div class="wow-video-addon">';
			$output  .= '<div class="wow-video-content">';
			$output .= '<div class="wow-video-block wow-embed-responsive wow-embed-responsive-16by9">';
			$output .= '<iframe class="wow-embed-responsive-item" src="' . $src . '" allowFullScreen></iframe>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
		return $output;
	}

	
	// headline Template
	public function getTemplate(){
		$output = '
		<#
			let videoUrl = data.video_url || ""
			let embedSrc = ""

			if ( videoUrl ) {
				let tempAchor = document.createElement("a")
						tempAchor.href = videoUrl

				let videoObj = {
						host    :   tempAchor.hostname,
						path    :   tempAchor.pathname,
						query   :   tempAchor.search.substr(tempAchor.search.indexOf("?") + 1)
					}

				switch( videoObj.host ){
					case "youtu.be":
						var videoId = videoObj.path.trim();
								embedSrc = "//www.youtube.com/embed"+ videoId + "?controls="+data.video_controls+"&modestbranding="+data.video_hide_logo
						break;

					case "www.youtube.com":
					case "youtube.com":
						var queryStr = videoObj.query.split("=");
								embedSrc = "//www.youtube.com/embed/"+ queryStr[1] + "?controls="+data.video_controls+"&modestbranding="+data.video_hide_logo
						break;

					case "www.vimeo.com":
					case "vimeo.com":
						var videoId = videoObj.path.trim();
								embedSrc = "//player.vimeo.com/video"+ videoId
						break;
				}
			}
		#>
		<div class="wow-video-addon">
			<div class="wow-video-content">
				<div class="wow-iframe-drag-overlay"></div>
				<div class="wow-video-block wow-embed-responsive wow-embed-responsive-16by9">
				<# if(embedSrc){ #>
					<iframe class="wow-embed-responsive-item" src=\'{{ embedSrc }}\' allowFullScreen></iframe>
				<# } #>
				</div>
			</div>
		</div>
		';
		return $output;
	}

}