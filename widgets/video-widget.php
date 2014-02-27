<?php

// Video widget for hemingway WordPress theme

class hemingway_video_widget extends WP_Widget {

	function hemingway_video_widget() {
		parent::WP_Widget(false, $name = 'Video widget', array('description' => __('Displays a video of your choosing.', 'hemingway') ));
	}

	function widget($args, $instance) {

		// Outputs the content of the widget
		extract($args); // Make before_widget, etc available.

		$widget_title = apply_filters('widget_title', $instance['widget_title']);
		$video_url = $instance['video_url'];

		echo $before_widget;


		if (!empty($widget_title)) {

			echo $before_title . $widget_title . $after_title;

		} ?>

			<?php if (strpos($videourl,'.mp4') !== true) : ?>

				<?php

					$embed_code = wp_oembed_get($videourl);

					echo $embed_code;

				?>

			<?php elseif (strpos($videourl,'.mp4') !== false) : ?>

				[video src="<?php echo $videourl; ?>"]

			<?php endif; ?>

		<?php echo $after_widget;
	}


	function update($new_instance, $old_instance) {

		//update and save the widget
		return $new_instance;

	}

	function form($instance) {

		// Get the options into variables, escaping html characters on the way
		$widget_title = $instance['widget_title'];
		$video_url = $instance['video_url'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php  _e('Title', 'hemingway'); ?>:
			<input id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" class="widefat" value="<?php echo $widget_title; ?>" /></label>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('video_url'); ?>"><?php  _e('Video URL', 'hemingway'); ?>:
			<input id="<?php echo $this->get_field_id('video_url'); ?>" name="<?php echo $this->get_field_name('video_url'); ?>" type="text" class="widefat" value="<?php echo $video_url; ?>" /></label>
		</p>

		<?php
	}
}
register_widget('hemingway_video_widget'); ?>