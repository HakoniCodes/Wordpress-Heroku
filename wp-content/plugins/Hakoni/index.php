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
add_action('init', 'loadClasses', 0);

function loader_page()
{
	echo '<h1>Welcome to the Hakoni Site Setting Plugin!</h1>';
}

function loadClasses()
{
	$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
	
	foreach($iterator as $iter) {
		if($iter->isFile()) {
			$files[] = $iter->getPathname();
		}
	}

	foreach ($files as $file) {
		if(file_exists($file) && $file->getExtension() === 'php') {
			require_once $file->getPathname();
		}
	}
}