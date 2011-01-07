<?php

add_action('init', 'color_widget_scripts');

function color_widget_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('hyc', plugins_url('/js/hyc.js', __FILE__), array('jquery'));
}

add_action('wp_head', 'hyc_header');

function hyc_header() {
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo plugins_url('/css/hyc-widget.css', __FILE__); ?>" />

<script type="text/javascript">
	var j = jQuery.noConflict(); 
	
	j(document).ready(function() {
		hyc.widget.init();
	});
</script>

<?php
}

add_action('widgets_init', 'hyc_widget_init');

function hyc_widget_init() {
	register_widget('HYC_Widget');
}

// Widget
class HYC_Widget extends WP_Widget {

	function HYC_Widget() {
		$widget_ops = array(
			'classname' => 'hyc-widget',
			'description' => __('Show the custom color tags in your sidebar', 'hyc')
		);
		
		$this->WP_Widget('hyc-widget', 'Hold your color Widget', $widget_ops);
	}

	function widget($args, $d) {
		extract($args);
		
		echo $before_widget;
		
		$title = $d['title'];
		if($title != ''): echo $before_title . $title . $after_title; endif;
		
		if($d['hide_empty']) {
			$args = array(
				'hide_empty' => true
			);
		}
		else {
			$args = array(
				'hide_empty' => false
			);
		}
		
		$colors = get_terms('colors', $args);
		if($d['show'] == 'on') {
?>

<select name="hyc_dropdown" id="hyc_dropdown">
	<?php foreach($colors as $color): if($d['color_' . $color->slug] == 'on'): ?>
	<option value="<?php echo $color->slug; ?>" id="<?php echo get_term_link($color->slug, 'colors'); ?>"><?php echo $color->name; ?></option>
	<?php endif; endforeach; ?>
</select>

<?php
		}
		else {
			if($colors) {
				foreach($colors as $color):
					if($d['color_' . $color->slug] == 'on'):
?>
		
<a href="<?php echo get_term_link($color->slug, 'colors'); ?>" class="hyc_color" style="background-color: #<?php echo get_option('hyc_color_' . $color->slug); ?>; border-color: #<?php echo get_option('hyc_color_' . $color->slug); ?>"></a>

<?php		
					endif;
				endforeach;
			
				echo '<div class="clear"></div>';
			}
		}
		
		echo $after_widget;		
	}

	function update($new, $old) {
		return $new;
	}

	function form($instance) {
		$args = array(
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		
		$colors = get_terms('colors', $args);
		
		foreach($colors as $color) {
			//if(empty($instance['color_' . $color->slug])) $instance['color_' . $color->slug] = 'on';
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', 'hyc'); ?></label>
			<input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name('show'); ?>" id="<?php echo $this->get_field_id('show'); ?>" <?php if($instance['show'] == 'on') echo 'checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('show'); ?>"><?php echo __('Show as dropdown', 'hyc'); ?></label>
			
			<br />
			
			<input type="checkbox" name="<?php echo $this->get_field_name('hide_empty'); ?>" id="<?php echo $this->get_field_id('hide_empty'); ?>" <?php if($instance['hide_empty'] == 'on') echo 'checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php echo __('Hide empty', 'hyc'); ?></label>
		</p>
		
		<p>
			<?php echo __('Colors to show:', 'hyc'); ?><br />
			<?php foreach($colors as $color): ?>
			<input type="checkbox" name="<?php echo $this->get_field_name('color_' . $color->slug); ?>" id="<?php echo $this->get_field_id('color_' . $color->slug); ?>" <?php if($instance['color_' . $color->slug] == 'on') echo 'checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('color_' . $color->slug); ?>"><?php echo $color->name; ?></label>
			<br />
			<?php endforeach; ?>						
		</p>
<?php
	}
}
?>