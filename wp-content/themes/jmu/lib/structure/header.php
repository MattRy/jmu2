<?php

/**
 * Header Functions
 *
 * This file controls the header display on the site to allow
 * social media icons in the header
 *
 * @category     ChildTheme
 * @package      Admin
 * @author       Web Savvy Marketing
 * @copyright    Copyright (c) 2012, Web Savvy Marketing
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 *
 */

remove_action ( 'genesis_header', 'genesis_do_header' );

add_action( 'genesis_header' , 'wsm_child_do_header' );

function wsm_child_do_header() {

	echo '<div class="title-area">';
	
	$logo_url = genesis_get_option( 'wsm_logo_url', 'jmu-settings' );
	$logo_replace_default = genesis_get_option( 'wsm_logo_hide', 'jmu-settings' );
		
	
	if ( !empty( $logo_url ) && !empty( $logo_replace_default ) ) { 		
			echo '<h1 itemprop="headline" class="site-title custom-logo"><a  style="background-image: url('. genesis_get_option( 'wsm_logo_url', 'jmu-settings' ) .');" href="http://www.jmu.edu/">' . get_bloginfo('name') .'</a></h1>';
	}
	
	else {
	
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	
	}
	
	echo '</div>';
	
	echo '<aside class="widget-area">';
	
	do_action( 'genesis_header_right' );

	dynamic_sidebar( 'header-right' );
	
	echo '</aside>';

}