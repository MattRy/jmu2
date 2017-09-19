<?php
/**
 * Social Widget
 *
 * Displays links to Facebook, Twitter and Youtube
 *
 */
class wsm_Social_Widget extends WP_Widget {
	
    /**
     * Constructor
     *
     * @return void
     **/
	function wsm_Social_Widget() {
		$widget_ops = array( 'classname' => 'widget-social', 'description' => 'Social icon widget' );
		$this->WP_Widget( 'social-widget', 'Web Savvy - Social Widget', $widget_ops );
	}

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme 
     * @param array  An array of settings for this widget instance 
     * @return void Echoes it's output
     **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		
		if ( ! empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		
		if (!empty( $instance['wsm_custom_text'] ) ) {
		$text = wp_kses_post($instance['wsm_custom_text']);
		echo '<div class="social-custom-text">';
		echo $instance['filter'] ? wpautop($text) : $text;		
		echo '</div>';
		}			
		echo '<div class="social-icons">';
		if (!empty( $instance['wsm_instagram'] ) ) { echo '<a href="'. $instance['wsm_instagram'] .'" class="genericon genericon-instagram" target="_blank" title="Instagram">Instagram</a>';}
		if (!empty( $instance['wsm_linkedin'] ) ) { echo '<a href="'. $instance['wsm_linkedin'] .'" class="genericon genericon-linkedin" target="_blank" title="Linkedin">Linkedin</a>'; }
		if (!empty( $instance['wsm_googleplus'] ) ) { echo '<a href="'. $instance['wsm_googleplus'] .'" class="genericon genericon-googleplus-alt" target="_blank" title="Google +">Google +</a>';}
		if (!empty( $instance['wsm_youtube'] ) ) { echo '<a href="'. $instance['wsm_youtube'] .'" class="genericon genericon-youtube" target="_blank" title="Youtube">Youtube</a>'; }
		if (!empty( $instance['wsm_facebook'] ) ) { echo '<a href="'. $instance['wsm_facebook'] .'" class="genericon genericon-facebook-alt" target="_blank" title="Facebook">Facebook</a>';}
		if (!empty( $instance['wsm_pinterest'] ) ) { echo '<a href="'. $instance['wsm_pinterest'] .'" class="genericon genericon-pinterest" target="_blank" title="Pinterest">Pinterest</a>';}
		if (!empty( $instance['wsm_twitter'] ) ) { echo '<a href="'. $instance['wsm_twitter'] .'" class="genericon genericon-twitter" target="_blank" title="Twitter">Twitter</a>'; }
		if (!empty( $instance['wsm_flickr'] ) ) { echo '<a href="'. $instance['wsm_flickr'] .'" class="genericon genericon-flickr" target="_blank" title="Flickr">Flickr</a>';}
		if (!empty( $instance['wsm_vimeo'] ) ) { echo '<a href="'. $instance['wsm_vimeo'] .'" class="genericon genericon-vimeo" target="_blank" title="Vimeo">Vimeo</a>';}
		if (!empty( $instance['wsm_wordpress'] ) ) { echo '<a href="'. $instance['wsm_wordpress'] .'" class="genericon genericon-wordpress" target="_blank" title="WordPress">WordPress</a>';}
		if (!empty( $instance['wsm_behance'] ) ) { echo '<a href="'. $instance['wsm_behance'] .'" class="genericon genericon-behance" target="_blank" title="Behance">Behance</a>';}
		echo '</div>';
		echo $after_widget;
	}

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings 
     * @return array The validated and (if necessary) amended settings
     **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['wsm_custom_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['wsm_custom_text']) ) );
		$instance['wsm_facebook'] = esc_url( $new_instance['wsm_facebook'] );
		$instance['wsm_twitter'] = esc_url( $new_instance['wsm_twitter'] );
		$instance['wsm_linkedin'] = esc_url( $new_instance['wsm_linkedin'] );
		$instance['wsm_youtube'] = esc_url( $new_instance['wsm_youtube'] );
		$instance['wsm_googleplus'] = esc_url( $new_instance['wsm_googleplus'] );
		$instance['wsm_pinterest'] = esc_url( $new_instance['wsm_pinterest'] );
		$instance['wsm_instagram'] = esc_url( $new_instance['wsm_instagram'] );
		$instance['wsm_flickr'] = esc_url( $new_instance['wsm_flickr'] );
		$instance['wsm_vimeo'] = esc_url( $new_instance['wsm_vimeo'] );
		$instance['wsm_wordpress'] = esc_url( $new_instance['wsm_wordpress'] );
		$instance['wsm_behance'] = esc_url( $new_instance['wsm_behance'] );
		return $instance;
	}

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
	function form( $instance ) {
	
		$defaults = array( 'title'=> '', 'wsm_custom_text'=> '', 'wsm_facebook' => '', 'wsm_twitter' => '', 'wsm_youtube' => '', 'wsm_linkedin' => '', 'wsm_googleplus' => '','wsm_pinterest' => '','wsm_instagram' => '', );
		
		$text = esc_textarea($instance['wsm_custom_text']);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'genesis' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id('wsm_custom_text'); ?>"><?php _e('Custom Text:'); ?></label>
		<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id('wsm_custom_text'); ?>" name="<?php echo $this->get_field_name('wsm_custom_text'); ?>"><?php echo $text; ?></textarea></p>
		

		<p><label for="<?php echo $this->get_field_id( 'wsm_facebook' ); ?>">Facebook URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_facebook' ); ?>" name="<?php echo $this->get_field_name( 'wsm_facebook' ); ?>" value="<?php echo $instance['wsm_facebook']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_twitter' ); ?>">Twitter URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_twitter' ); ?>" name="<?php echo $this->get_field_name( 'wsm_twitter' ); ?>" value="<?php echo $instance['wsm_twitter']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_linkedin' ); ?>">LinkedIn URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'wsm_linkedin' ); ?>" value="<?php echo $instance['wsm_linkedin']; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id( 'wsm_youtube' ); ?>">Youtube URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_youtube' ); ?>" name="<?php echo $this->get_field_name( 'wsm_youtube' ); ?>" value="<?php echo $instance['wsm_youtube']; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id( 'wsm_googleplus' ); ?>">Google+ URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_googleplus' ); ?>" name="<?php echo $this->get_field_name( 'wsm_googleplus' ); ?>" value="<?php echo $instance['wsm_googleplus']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_pinterest' ); ?>">Pinterest URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'wsm_pinterest' ); ?>" value="<?php echo $instance['wsm_pinterest']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_instagram' ); ?>">Instagram URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_instagram' ); ?>" name="<?php echo $this->get_field_name( 'wsm_instagram' ); ?>" value="<?php echo $instance['wsm_instagram']; ?>" /></label></p>
	
		<p><label for="<?php echo $this->get_field_id( 'wsm_flickr' ); ?>">Flickr URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_flickr' ); ?>" name="<?php echo $this->get_field_name( 'wsm_flickr' ); ?>" value="<?php echo $instance['wsm_flickr']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_vimeo' ); ?>">Vimeo URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_vimeo' ); ?>" name="<?php echo $this->get_field_name( 'wsm_vimeo' ); ?>" value="<?php echo $instance['wsm_vimeo']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'wsm_wordpress' ); ?>">WordPress URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_wordpress' ); ?>" name="<?php echo $this->get_field_name( 'wsm_wordpress' ); ?>" value="<?php echo $instance['wsm_wordpress']; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id( 'wsm_behance' ); ?>">Behance URL: <input class="widefat" id="<?php echo $this->get_field_id( 'wsm_behance' ); ?>" name="<?php echo $this->get_field_name( 'wsm_behance' ); ?>" value="<?php echo $instance['wsm_behance']; ?>" /></label></p>

		<?php

	}
}

add_action( 'widgets_init', create_function( '', "register_widget('wsm_Social_Widget');" ) );