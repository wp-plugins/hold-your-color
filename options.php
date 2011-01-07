<?php

// Insert the admin menu
if(is_admin()) {
	add_action('admin_menu', 'colors_admin_link');
	
	// Save datas
	add_action('admin_init', 'register_color_options');
	
	// JS Scripts & CSS Style
	add_action('admin_init', 'color_js_scripts');
	add_action('admin_head', 'admin_color_header');
}

function colors_admin_link() {
    add_options_page(__('Hold your color Settings', 'hyc'), __('Hold your color', 'hyc'), 'manage_options', __FILE__, 'colors_options');
}

function color_js_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('hyc-colorpicker', plugins_url('/js/colorpicker.js', __FILE__), array('jquery'));
	wp_enqueue_script('hyc', plugins_url('/js/hyc.js', __FILE__), array('jquery'));
}

// Admin Header
function admin_color_header() {
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo plugins_url('/css/colorpicker.css', __FILE__); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo plugins_url('/css/color-layout.css', __FILE__); ?>" />

<script type="text/javascript">
	var j = jQuery.noConflict(); 
	
	j(document).ready(function() {
		hyc.init();
	});
</script>
<?php	
}

// The options page
function colors_options() {
?>

<div class="wrap">
	<h2><?php echo __('Hold your color', 'hyc'); ?></h2>
	
	<form method="post" action="options.php">
		<?php settings_fields('hyc-settings'); ?>
		
		<?php 
		$args = array(
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		
		$colors = get_terms('colors', $args);
		
		if($colors):
		?>
		<p><i><?php printf(__('To add more colors, click <a href="%s">here</a>.', 'hyc'), get_bloginfo('url') . '/wp-admin/edit-tags.php?taxonomy=colors'); ?></i></p>
		
		<p><?php echo __('For each color, enter the hexadecimal code for the color widget:', 'hyc'); ?></p>
		
		<table class="form-table form-table-color">
			<?php foreach($colors as $color): ?>
			<tr valign="top">
				<th scope="row"><label for="hyc_color_<?php echo $color->slug; ?>"><?php echo $color->name; ?>: </label></th>
				<td>#<input type="text" name="hyc_color_<?php echo $color->slug; ?>" id="hyc_color_<?php echo $color->slug; ?>" value="<?php echo get_option('hyc_color_' . $color->slug); ?>" class="color-input" /></td>
				<td><div class="colorpickerSelect" id="colorpicker_<?php echo $color->slug; ?>"><div></div></div></td>
			</tr>
			<?php endforeach; ?>
		</table>
				
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
		<?php else: ?>
		<p><i><?php printf(__('There are no colors yet. Click <a href="%s">here</a> to add somes.', 'hyc'), get_bloginfo('url') . '/wp-admin/edit-tags.php?taxonomy=colors'); ?></i></p>
		<?php endif; ?>
	</form>
</div>

<?php
}

// The `save color options` function
function register_color_options() {
	$args = array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	
	$colors = get_terms('colors', $args);
	
	foreach($colors as $color) {
		register_setting('hyc-settings', 'hyc_color_' . $color->slug);
	}
}
?>