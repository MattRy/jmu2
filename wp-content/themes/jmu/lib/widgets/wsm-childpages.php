<?php

/**
 * Modification of the Genesis Featured Page Widget
 * to add customizable text area option.
 *
 */


add_action( 'widgets_init', create_function( '', "register_widget( 'WSM_Childpages_Widget' );" ) );


class WSM_Childpages_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {

		$this->defaults = array(
			'title'           => '',

		);

		$widget_ops = array(
			'classname'   => 'wsm-childpages',
			'description' => __( 'Displays list of child pages', 'genesis' ),
		);

		$control_ops = array(
			'id_base' => 'wsm-childpages',
			'width'   => 200,
			'height'  => 250,
		);

		parent::__construct( 'wsm-childpages', __( 'Web Savy - Chid Pages List', 'genesis' ), $widget_ops, $control_ops );

	}


	/**
	 * Echo the widget content.
	 *
	 * @since 0.1.8
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		extract( $args );

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		
		global $post;
		
		$post_id = get_the_ID();
		
			$p = $post->post_parent;
			$pc = $post->ID;
			while ($p != 0) :
			$pp = get_post($p); 
			$p = $pp->post_parent; 
			$pc = $pp->ID;
			$permalink = get_permalink($pp->ID);
			 endwhile;
		
	if ( ! empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
	
		if ($post->post_parent) :
			
			 $post_grand = get_post($post->post_parent);
			 
			 
			if ($post_grand->post_parent) : ?>
			
				<ul>
					<?php if( !empty($instance['dept-link']) && !empty($instance['dept-logo-url']) ) { echo  '<li class="dept-logo"><a href="' . $instance['dept-link'] .'"><img src="' . $instance['dept-logo-url'] .'" alt="" /></a></li>'; } ?>
		
						<?php wp_list_pages(array('title_li' => '', 'child_of' => $post_grand->post_parent, 'depth' => 2)); ?>
					</ul>
				<?php else : ?>
					<?php $posts_children = get_posts(array('post_parent' => $post_id, 'post_type' => 'page')); ?>
					
					<?php if (count($posts_children) == 0) : ?>
						<ul>
							<?php if( !empty($instance['dept-link']) && !empty($instance['dept-logo-url']) ) { echo  '<li class="dept-logo"><a href="' . $instance['dept-link'] .'"><img src="' . $instance['dept-logo-url'] .'" alt="" /></a></li>'; } ?>
							<?php wp_list_pages(array('title_li' => '', 'child_of' => $post->post_parent, 'depth' => 1)); ?>
						</ul>
					<?php else : ?>
						<ul>
							<?php if( !empty($instance['dept-link']) && !empty($instance['dept-logo-url']) ) { echo  '<li class="dept-logo"><a href="' . $instance['dept-link'] .'"><img src="' . $instance['dept-logo-url'] .'" alt="" /></a></li>'; } ?>
							<?php wp_list_pages(array('title_li' => '', 'child_of' => $post->post_parent, 'depth' => 2)); ?>
						</ul>
					<?php endif; ?>
				
				<?php endif; ?>
			
			<?php else : ?>
				<ul>
					<?php if( !empty($instance['dept-link']) && !empty($instance['dept-logo-url']) ) { echo  '<li class="dept-logo"><a href="' . $instance['dept-link'] .'"><img src="' . $instance['dept-logo-url'] .'" alt="" /></a></li>'; } ?>
					<?php wp_list_pages(array('title_li' => '', 'child_of' => $post_id, 'depth' => 1)); ?>
				</ul>
			<?php endif;
	
		echo $after_widget;

	}
	


	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 0.1.8
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {

		$new_instance['title']     = strip_tags( $new_instance['title'] );
		$new_instance['dept-logo-url']     = strip_tags( $new_instance['dept-logo-url'] );
		$new_instance['dept-link']     = strip_tags( $new_instance['dept-link'] );
		return $new_instance;

	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 0.1.8
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'genesis' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dept-logo-url' ); ?>"><?php _e( 'Department Logo', 'genesis' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'dept-logo-url' ); ?>" name="<?php echo $this->get_field_name( 'dept-logo-url' ); ?>" value="<?php echo esc_attr( $instance['dept-logo-url'] ); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dept-link' ); ?>"><?php _e( 'Department Link', 'genesis' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'dept-link' ); ?>" name="<?php echo $this->get_field_name( 'dept-link' ); ?>" value="<?php echo esc_attr( $instance['dept-link'] ); ?>" class="widefat" />
		</p>

		<?php
	}

}