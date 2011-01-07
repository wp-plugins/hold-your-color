<?php
/*
 * Plugin Name: Hold your color
 * Plugin URI: http://www.lmenu.fr
 * Description: Add custom color tag to your posts.
 * Version: 1.0.0
 * Author: Laurent Menu
 * Author URI: http://www.lmenu.fr
 * Text Domain: hyc
 * Domain Path: /lang/
*/

$dir = dirname(__FILE__);
$plugin_dir = basename($plugin_dir_path);

$lang = get_locale();
load_plugin_textdomain('hyc','wp-content/plugins/' . $plugin_dir . '/lang/');

// Register the custom tags
require_once $dir . '/register.php';

// Register the menu page
require_once $dir . '/options.php';

// Widget
require_once $dir . '/widget.php';

// Function to show colors tags in post
function the_colors($bull = true, $before = null, $separator = ' ', $after = null) {
	global $post;

	$colors = wp_get_post_terms($post->ID, 'colors');

	if($colors) {
		
		$return = array();
		
		echo $before;
		
		foreach($colors as $color): 
	
			if($bull == true) {
				$return[] = '<a href="' . get_term_link($color->slug, 'colors') . '" class="hyc_color hyc_color-entry" style="background-color: #' . get_option('hyc_color_' . $color->slug) . '; border-color: #' . get_option('hyc_color_' . $color->slug) . '"></a>';
			}
			else {
				$return[] = '<a href="' . get_term_link($color->slug, 'colors') . '">' . $color->name . '</a>';
			}
		
		endforeach;
		
		echo implode($separator, $return);
		
		echo $after;
		
	}
	else {
		echo __('No colors', 'hyc');
	}
}

// Function to return the colors array
function get_the_colors($post_ID = null) {
	global $post;
	
	if($post_ID == null) { $id = $post->ID; }
	else $id = $post_ID;
	
	$colors = wp_get_post_terms($id, 'colors');
	
	return $colors;
}
?>