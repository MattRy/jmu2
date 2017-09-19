<?php
/**
 * Child after header
 *
 * @category     Child
 * @package      Structure
 * @author       Web Savvy Marketing
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        2.0.0
 */



// Add background image
add_action( 'genesis_after_header' , 'jmu_do_bg_image' , 12 );
function jmu_do_bg_image() {

	if ( is_front_page() || is_page_template( 'frontpage.php' ) || is_page_template( 'events_template.php' ) ) {
		return '';
	}

	elseif( is_page() ||!is_home() && !is_page_template( 'events_template.php' ) ) {
		
		global $post;
		
		$post_img_url = get_post_meta($post->ID, '_wsm_top_image_url', true);
		$inner_bg = genesis_get_option( 'wsm_default_page_bg', 'jmu-settings' );
	
		if ( !empty( $post_img_url ) ) {
		echo '<div class="top-image" style=" background-image: url(' . $post_img_url .');">';
		echo '</div>'; 
		}
		
		else { 
			if ( !empty( $inner_bg ) ) {
			echo '<div class="top-image" style=" background-image: url(' . genesis_get_option( 'wsm_default_page_bg', 'jmu-settings' ) .');">';
			echo '</div>'; }
		}
			
	}
	
	elseif( is_single() ) {
		
		global $post;
		
		$post_img_url = get_post_meta($post->ID, '_wsm_top_image_url', true);
		$blog_inner_bg = genesis_get_option( 'wsm_default_blog_bg', 'jmu-settings' );
	
		if ( !empty( $post_img_url ) ) {
		echo '<div class="top-image" style=" background-image: url(' . $post_img_url .');">';
		echo '</div>'; 
		}
		
		else { 
			if ( !empty( $blog_inner_bg ) ) {
			echo '<div class="top-image" style=" background-image: url(' . genesis_get_option( 'wsm_default_blog_bg', 'jmu-settings' ) .');">';
			echo '</div>';
			}
		}
			
	}
	

	else {
	
		$blog_inner_bg = genesis_get_option( 'wsm_default_blog_bg', 'jmu-settings' );
	
		if ( !empty( $blog_inner_bg ) ) {
			echo '<div class="top-image" style=" background-image: url(' . genesis_get_option( 'wsm_default_blog_bg', 'jmu-settings' ) .');">';
			echo '</div>';
			
		}
	
	}
	
}
