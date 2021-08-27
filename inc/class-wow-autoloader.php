<?php
namespace WPPB;

if ( ! defined( 'ABSPATH' ) ) exit;

class Wppb_autoloader {

	private static $classes_map = array(
		'WOW_Widget'			=> 'classes/Widget.php',
		'WOW_Editor_Management'=> 'classes/Editor_Management.php',
		'WOW_Helper'			=> 'classes/Helper.php',
		'WOW_Assets'			=> 'classes/Assets.php',
		'WOW_General'			=> 'classes/General.php',
		'WOW_Options'			=> 'classes/Options.php',
		'WOW_Ajax'				=> 'classes/Ajax.php',
		'WOW_Frontend' 		=> 'classes/Frontend.php',
		'WOW_Theme_Manager'	=> 'classes/Theme_Manager.php',
		'Compatibility'			=> 'classes/Compatibility.php',
		'WOW_Base_Data'		=> 'classes/Base_Data.php', //No need intensiet, it's contain initial data
	);

	public static function run() {
		spl_autoload_register([ __CLASS__, 'loader' ]);
	}

	private static function loader($className) {
		if ( ! class_exists($className)){
			$file_name = '';
			if ( ! empty( self::$classes_map[$className] )){
				$file_name = WOW_DIR_PATH.self::$classes_map[$className];
			}else{
				$className = strtolower(
					preg_replace(
						array('/([a-z])([A-Z])/', '/_/', '/\\\/'),
						array('$1-$2', '-', DIRECTORY_SEPARATOR),
						$className
					)
				);

				$file_name = WOW_DIR_PATH.'classes/'.$className.'.php';
			}

			if (file_exists($file_name) && is_readable( $file_name ) ) {
				require_once $file_name;
			}
		}
	}

}