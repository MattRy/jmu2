<?php
/**
 * Modification of the Genesis Featured Page Widget
 * to add customizable text area option.
 * 
 */


add_action( 'widgets_init', create_function( '', "register_widget('WSM_Featured_Widget');" ) );


class WSM_Featured_Widget extends WP_Widget {

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function WSM_Featured_Widget() {
		$widget_ops = array( 'classname' => 'wsm-featured-widget', 'description' => __('Displays featured image/video and customizable text and Link', 'genesis') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'wsm-featured-widget' );
		$this->WP_Widget( 'wsm-featured-widget', __('Web Savvy - Featured Widget', 'genesis'), $widget_ops, $control_ops );
	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget($args, $instance) {
		extract($args);

		$instance = wp_parse_args( (array) $instance, array(
			'wsm-title' => '',
			'wsm-content' => '',
			'wsm-moretext' => '',
			'wsm-morelink' => '',
			'wsm-moretarget' => '',
		) );
		
		
		echo $before_widget;
									
		if ( ! empty( $instance['wsm-title'] ) ) {
			$heading = wp_kses_post($instance['wsm-title']);
			echo '<h4 class="widget-title widgettitle">'. $heading .'</h4>';
		}
		

		if( !empty($instance['wsm-content']) ) {
					$text = wp_kses_post($instance['wsm-content']); 
					echo '<div class="featured-content">';	
					echo do_shortcode($text); 	
					if(!empty($instance['wsm-moretext'])) :
					echo '<span class="more-link"><a href="'. $instance['wsm-morelink'] .'" target="'. $instance['wsm-moretarget'] .'">' . $instance['wsm-moretext'] .'</a></span>';
					endif;
			echo '</div>';
		}
		
		
		echo "\n\n";


		echo $after_widget;
		wp_reset_query();
	}

	/** Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update($new_instance, $old_instance) {
		$new_instance['wsm-title'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['wsm-title']) ) );
		$new_instance['wsm-content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['wsm-content']) ) );
		$new_instance['wsm-moretext'] = strip_tags( $new_instance['wsm-moretext'] );
		$new_instance['wsm-morelink'] = strip_tags( $new_instance['wsm-morelink'] );
		$new_instance['wsm-moretarget'] = strip_tags( $new_instance['wsm-moretarget'] );
		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, array(
			'wsm-title' => '',
			'wsm-content' => '',
			'wsm-moretext' => '',
			'wsm-morelink' => '',
			'wsm-moretarget' => '',
		) );
		
		$title = esc_attr($instance['wsm-title']);
		$content = esc_attr($instance['wsm-content']);
	
	?>
	
		<p><label for="<?php echo $this->get_field_id('wsm-title'); ?>"><?php _e('Title ', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('wsm-title'); ?>" name="<?php echo $this->get_field_name('wsm-title'); ?>" value="<?php echo $title; ?>" class="widefat" /></p>
		
		<p><label for="<?php echo $this->get_field_id('wsm-content'); ?>"><?php _e('Custom Text:'); ?></label><textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('wsm-content'); ?>" name="<?php echo $this->get_field_name('wsm-content'); ?>"><?php echo $content; ?></textarea></p>
		
		<p><label for="<?php echo $this->get_field_id('wsm-moretext'); ?>"><?php _e('More Text', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('wsm-moretext'); ?>" name="<?php echo $this->get_field_name('wsm-moretext'); ?>" value="<?php echo esc_attr( $instance['wsm-moretext'] ); ?>" class="widefat" /></p>
			
		<p><label for="<?php echo $this->get_field_id('wsm-morelink'); ?>"><?php _e('More Link', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('wsm-morelink'); ?>" name="<?php echo $this->get_field_name('wsm-morelink'); ?>" value="<?php echo esc_attr( $instance['wsm-morelink'] ); ?>" class="widefat" /></p>
		
		<p><label for="<?php echo $this->get_field_id('wsm-moretarget'); ?>"><?php _e('Link Target', 'genesis'); ?>: </label>
			<select id="<?php echo $this->get_field_id('wsm-moretarget'); ?>" name="<?php echo $this->get_field_name('wsm-moretarget'); ?>">
				<option value="_self" <?php selected('_self', $instance['wsm-moretarget']); ?>><?php _e('_self', 'genesis'); ?></option>
				<option value="_blank" <?php selected('_blank', $instance['wsm-moretarget']); ?>><?php _e('_blank', 'genesis'); ?></option>
			</select>
		</p>

		<?php
	}
}