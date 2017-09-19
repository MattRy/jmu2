<?php 

// Execute custom child loop
add_action( 'genesis_entry_content', 'staff_member_loop_helper' ); 
function staff_member_loop_helper() {
	
global $post;

	$staff_title = get_post_meta($post->ID, '_staff_member_title', true);
	$staff_email = get_post_meta($post->ID, '_staff_member_email', true);
	$staff_phone = get_post_meta($post->ID, '_staff_member_phone', true);
	$staff_fb = get_post_meta($post->ID, '_staff_member_fb', true);
	$staff_tw = get_post_meta($post->ID, '_staff_member_tw', true);
	$staff_bio = get_post_meta($post->ID, '_staff_member_bio', true);
	$photo_url = _staff_member_meta( $post->ID, '_staff_member_image');
	
	
	
	if ( !empty( $staff_title  ) ) { echo '<p class="staff-member-position">'. $staff_title .'</p>'; }
		if ( !empty( $staff_phone  ) ) { echo '<p class="staff-member-phone"><a class="genericon genericon-handset" href="tel:'. esc_attr( $staff_phone ) .'">'. esc_attr( $staff_phone ) .'</a></p>'; }
	if ( !empty( $staff_email ) ) { echo '<a class="staff-member-email genericon genericon-mail" href="mailto:'. esc_attr( $staff_email ) .'">Email</a> '; }
	if ( !empty( $staff_fb ) ) { echo '<a class="staff-member-facebook genericon genericon-facebook-alt" href="'. esc_url( $staff_fb ) .'">Facebook</a> '; }
	if ( !empty( $staff_tw ) ) { echo '<a class="staff-member-twitter genericon genericon-twitter" href="'. esc_url( $staff_tw ) .'">Twitter</a> '; }
	
	
	echo '<div class="staff-member-bio">';
	
	if ( !empty( $photo_url ) ) { echo '<img class="alignright staff-member-photo" src="' . $photo_url .' " alt="">'; }	
	if ( !empty( $staff_bio ) ) { echo $staff_bio; }
	
	echo '</div>';
		
}

//* Remove the entry meta in the entry header (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 8 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );


genesis();