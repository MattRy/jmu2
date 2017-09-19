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
			'cta1-text' => '',
			'cta1-url' => '',
			'cta2-text' => '',
			'cta2-url' => '',
			'cta3-text' => '',
			'cta3-url' => '',
			'cta4-text' => '',
			'cta4-url' => ''
		) );

		echo $before_widget.'<div class="cta-main">';

			if (!empty($instance['title'])) {
				echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
			}
			
			echo '<ul class="cta">';

			if(!empty($instance['cta1-text'])) { 
				if(!empty($instance['cta1-url'])) : ?>
				<li class="cta1"><a href="<?php echo esc_url( $instance['cta1-url'] ); ?>"><?php echo strip_tags( $instance['cta1-text'] ); ?></a></li>
			<?php else : ?>
				<li class="cta1"><a href="#"><?php echo strip_tags( $instance['cta1-text'] ); ?></a></li>
			<?php endif;

			}
			
			if(!empty($instance['cta2-text'])) { 
				if(!empty($instance['cta2-url'])) : ?>
				<li class="cta2"><a href="<?php echo esc_url( $instance['cta2-url'] ); ?>"><?php echo strip_tags( $instance['cta2-text'] ); ?></a></li>
			<?php else : ?>
				<li class="cta2"><a href="#"><?php echo strip_tags( $instance['cta2-text'] ); ?></a></li>
			<?php endif;

			}
			
			if(!empty($instance['cta3-text'])) { 
				if(!empty($instance['cta3-url'])) : ?>
				<li class="cta3"><a href="<?php echo esc_url( $instance['cta3-url'] ); ?>"><?php echo strip_tags( $instance['cta3-text'] ); ?></a></li>
			<?php else : ?>
				<li class="cta3"><a href="#"><?php echo strip_tags( $instance['cta3-text'] ); ?></a></li>
			<?php endif;

			}
			
			if(!empty($instance['cta4-text'])) { 
				if(!empty($instance['cta4-url'])) : ?>
				<li class="cta4"><a href="<?php echo esc_url( $instance['cta4-url'] ); ?>"><?php echo strip_tags( $instance['cta4-text'] ); ?></a></li>
			<?php else : ?>
				<li class="cta4"><a href="#"><?php echo strip_tags( $instance['cta4-text'] ); ?></a></li>
			<?php endif;

			}
						
			echo '</ul>';

		echo '</div><!-- end .cta-main -->'.$after_widget;
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
		$new_instance['cta1-text'] = strip_tags( $new_instance['cta1-text'] );
		$new_instance['cta1-url'] = esc_url( $new_instance['cta1-url'] );
		$new_instance['cta2-text'] = strip_tags( $new_instance['cta2-text'] );
		$new_instance['cta2-url'] = esc_url( $new_instance['cta2-url'] );
		$new_instance['cta3-text'] = strip_tags( $new_instance['cta3-text'] );
		$new_instance['cta3-url'] = esc_url( $new_instance['cta3-url'] );
		$new_instance['cta4-text'] = strip_tags( $new_instance['cta4-text'] );
		$new_instance['cta4-url'] = esc_url( $new_instance['cta4-url'] );
		return $new_instance;
	}

	/** Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'cta1-text' => '',
			'cta1-url' => '',
			'cta2-text' => '',
			'cta2-url' => '',
			'cta3-text' => '',
			'cta3-url' => '',
			'cta4-text' => '',
			'cta4-url' => ''
		) );

?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('cta1-text'); ?>"><?php _e('1st Call To Action Text', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta1-text'); ?>" name="<?php echo $this->get_field_name('cta1-text'); ?>" value="<?php echo esc_attr( $instance['cta1-text'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cta1-url'); ?>"><?php _e('1st Call To Action URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta1-url'); ?>" name="<?php echo $this->get_field_name('cta1-url'); ?>" value="<?php echo esc_url( $instance['cta1-url'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cta2-text'); ?>"><?php _e('2nd Call To Action Text', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta2-text'); ?>" name="<?php echo $this->get_field_name('cta2-text'); ?>" value="<?php echo esc_attr( $instance['cta2-text'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cta2-url'); ?>"><?php _e('2nd Call To Action URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta2-url'); ?>" name="<?php echo $this->get_field_name('cta2-url'); ?>" value="<?php echo esc_url( $instance['cta2-url'] ); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('cta3-text'); ?>"><?php _e('3rd Call To Action Text', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta3-text'); ?>" name="<?php echo $this->get_field_name('cta3-text'); ?>" value="<?php echo esc_attr( $instance['cta3-text'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cta3-url'); ?>"><?php _e('3rd Call To Action URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta3-url'); ?>" name="<?php echo $this->get_field_name('cta3-url'); ?>" value="<?php echo esc_url( $instance['cta3-url'] ); ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('cta4-text'); ?>"><?php _e('4th Call To Action Text', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta4-text'); ?>" name="<?php echo $this->get_field_name('cta4-text'); ?>" value="<?php echo esc_attr( $instance['cta4-text'] ); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cta4-url'); ?>"><?php _e('4th Call To Action URL', 'genesis'); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('cta4-url'); ?>" name="<?php echo $this->get_field_name('cta4-url'); ?>" value="<?php echo esc_url( $instance['cta4-url'] ); ?>" class="widefat" />
		</p>

	<?php
	}
}