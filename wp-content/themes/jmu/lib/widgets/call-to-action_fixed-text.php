<?php
/**
 * Adds the Call to Action widget.
 *
 */

add_action( 'widgets_init', create_function( '', "register_widget('WSM_Call_to_Action');" ) );

class WSM_Call_to_Action extends WP_Widget {

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function WSM_Call_to_Action() {
		$widget_ops = array( 'classname' => 'call-to-action', 'description' => __('Displays call to action links', 'genesis') );
		$this->WP_Widget( 'call-to-action', __('Web Savvy - Call to Action', 'genesis'), $widget_ops );
	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget($args, $instance) {
		extract($args);

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'download' => '',
			'webinar' => '',
			'subscribe' => '',
			'twitter' => '',
			'facebook' => ''
		) );

		echo $before_widget.'<div class="cta">';

			if (!empty($instance['title']))
				echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
			
			echo '<ul class="big-bullet">';

			if(!empty($instance['download'])) { ?>
			<li class="download"><a href="<?php echo esc_url( $instance['download'] ); ?>"><span class="big">Download</span> a White Paper</a></li>
			<?php
			}
			
			if(!empty($instance['webinar'])) { ?>
			<li class="webinar"><a href="<?php echo esc_url( $instance['webinar'] ); ?>"><span class="big">Register</span> for a Webinar</a></li>
			<?php
			}
			
			if(!empty($instance['subscribe'])) { ?>
			<li class="subscribe"><a href="<?php echo esc_url( $instance['subscribe'] ); ?>"><span class="big">Subscribe</span> to our Newsletter</a></li>
			<?php
			}
			
			if(!empty($instance['twitter'])) { ?>
			<li class="twitter"><a href="<?php echo esc_url( $instance['twitter'] ); ?>"><span class="big">Follow us</span> on Twitter</a></li>
			<?php
			}
			
			if(!empty($instance['facebook'])) { ?>
			<li class="facebook"><a href="<?php echo esc_url( $instance['facebook'] ); ?>"><span class="big">Find us</span> on Facebook</a></li>
			<?php
			}
			
			echo '</ul>';

		echo '</div>'.$after_widget;
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
		$new_instance['title'] = strip_tags( $new_instance['title'] );
		$new_instance['download'] = esc_url( $new_instance['download'] );
		$new_instance['webinar'] = esc_url( $new_instance['webinar'] );
		$new_instance['subscribe'] = esc_url( $new_instance['subscribe'] );
		$new_instance['twitter'] = esc_url( $new_instance['twitter'] );
		$new_instance['facebook'] = esc_url( $new_instance['facebook'] );
		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'download' => '',
			'webinar' => '',
			'subscribe' => '',
			'twitter' => '',
			'facebook' => ''
		) );

?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('download'); ?>"><?php _e('Download URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('download'); ?>" name="<?php echo $this->get_field_name('download'); ?>" class="widefat" value="<?php echo esc_url( $instance['download'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('webinar'); ?>"><?php _e('Webinar URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('webinar'); ?>" name="<?php echo $this->get_field_name('webinar'); ?>" class="widefat" value="<?php echo esc_url( $instance['webinar'] ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('subscribe'); ?>"><?php _e('Newsletter URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('subscribe'); ?>" name="<?php echo $this->get_field_name('subscribe'); ?>" class="widefat" value="<?php echo esc_url( $instance['subscribe'] ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" class="widefat" value="<?php echo esc_url( $instance['twitter'] ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" class="widefat" value="<?php echo esc_url( $instance['facebook'] ); ?>" />
		</p>

	<?php
	}
}