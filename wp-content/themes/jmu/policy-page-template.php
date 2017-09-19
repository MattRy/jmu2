<?php
/**
* Template Name: Event Management Policy Page Template
* Description: Used as a page template to show policy contents, followed by a loop 
* through the "Policy" category
*/
// Add our custom loop
add_action( 'genesis_loop', 'policy_loop' );
function policy_loop() {
	// policy filter button colors
	$button_colors = ['#52050A', '#832161', '#1B065E', '#9B7EDE', '#76E7CD', '#BCD2EE', '#bf9f51'];
	$color_counter = 0;
	
	// get all policy tags
	$tags_array = get_tags( $args );
	echo '<div class="filters"><div class="policyFilter" data-filter-group="type"><button id="everything" class="button is-checked" data-filter="*">Everything</button>';
	
	// display all policy filter tag buttons
	foreach ( $tags_array as $tag ) {
		echo '<button data-filter=".' . $tag->name . '" class="button" id="' . $tag->name . '" style="background-color:' . $button_colors[$color_counter] . '">' . $tag->name . '</button>';
		$color_counter++;
	}
	echo '</div></div>';
	
	// retrieve policy posts and display them
	$args = array(
		'category_name' => 'policy',
		'orderby'       => 'post_title',
		'order'         => 'ASC',
		'posts_per_page'=> '30',
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {
		// loop through posts
		echo '<ul class="em-policies">';
		while( $loop->have_posts() ): $loop->the_post();
			$content = get_the_excerpt();
			$post_tags = get_the_tags();

			echo '<li class="em-policy';
			if ( $post_tags ) {
			    foreach( $post_tags as $tag ) {
			    echo ' ' . $tag->name; 
			    }
			}
			
			echo '" style="">';
			
			if ( $post_tags ) {
				echo '<span class="policy-tag"><i class="fa fa-tag" aria-hidden="true"> |</i>';
				foreach ($post_tags as $tag) {
					echo '<span> ' . $tag->name . ' |</span>';
				}
				echo '</span><div style="clear:both"></div>';
			}
			echo '<h4>' . get_the_title() . '</h4>';
			echo '<p>' . $content . '</p>';
		echo '</li>';
		endwhile;
		echo '</ul>';
	}
	wp_reset_postdata();
}
genesis();