<?php 
/**
 * @package hakoni
 * @version 1.0.0
 */
/*
Plugin Name: Hakoni
Description: Hakoni site wide settings plugin
Author: Makanaokeakua Hakoni Edwards
Version: 1.0.0
*/
namespace Hakoni;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HAKONI_DIR', dirname( __FILE__ ) );

require HAKONI_DIR . '/General/Settings.php';