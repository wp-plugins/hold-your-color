<?php

// Register the custom color tag
add_action('init', 'register');

function register() {
	$args = array(
		'label' => __('Colors', 'hyc'),
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true
	);
	
	register_taxonomy('colors', 'post', $args );
}

// Add the `colors` column
add_filter('manage_posts_columns', 'color_column');

function color_column($default) {
	$add_column = array(
		$default['colors'] = __('Colors', 'hyc')
	);
			
	$new_columns = array();
	$pos = 0;
	
	foreach($default as $key => $value) {
		if($pos == 5) {
			$new_columns['colors'] = __('Colors', 'hyc');
		}
		else {
			$new_columns[$key] = $value;
		}
		
		if($key == 'colors') continue;
		
		$pos++;
	}
	
	return $new_columns;
}

// Add the `colors` data for each post in the tab
add_action('manage_posts_custom_column', 'color_data', 10, 2);

function color_data($column_name, $id) {
	if($column_name == 'colors') {
		$colors = wp_get_post_terms($id, 'colors');
		
		if($colors) {
			$return = array();
			
			foreach($colors as $color) {				
				$return[] = $color->name;
			}
			
			echo implode(', ', $return);
		}
		else {
			echo __('No Colors', 'hyc');
		}
	}
}

?>