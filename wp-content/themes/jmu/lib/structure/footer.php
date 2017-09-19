<?php 

/**
 * Footer Functions
 *
 * This file controls the footer on the site. The standard Genesis footer
 * has been replaced with one that has menu links on the right side and
 * copyright and credits on the left side.
 *
 * @category     ChildTheme
 * @package      Admin
 * @author       Web Savvy Marketing
 * @copyright    Copyright (c) 2012, Web Savvy Marketing
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 *
 */

remove_action('genesis_footer', 'genesis_do_footer');

add_action('genesis_footer', 'jmu_child_do_footer');
function jmu_child_do_footer() {

 
		if ( has_nav_menu( 'footer' ) ) {

			$args = array(
				'theme_location' => 'footer',
				'container' => '',
				'menu_class' => genesis_get_option('nav_superfish') ? 'nav genesis-nav-menu superfish' : 'nav genesis-nav-menu',
				'echo' => 0
			);

			$nav = wp_nav_menu( $args );

			$nav_output = sprintf( '<div class="footer-nav">%1$s</div>', $nav);

			echo apply_filters( 'wsm_do_footer_nav', $nav_output, $nav, $args );
		
		}

	$info= genesis_get_option( 'wsm_info', 'jmu-settings' );
	
	if ( !empty( $info ) ) { 		
		echo '<div class="footer-info-container">';
		echo '<img id="footer-jimmy" src="' . get_stylesheet_directory_uri() . '/images/gray_jimmy_logo.png">';
		echo '<div class="footer-info-p-container"><p class="footer-info">' . genesis_get_option( 'wsm_info', 'jmu-settings' ) . '<br><a href="http://www.jmu.edu/contact-us.shtml">Contact Us</a></p></div>';
		echo '</div>';
	}

}