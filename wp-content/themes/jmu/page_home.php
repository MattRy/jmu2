<?php 

/*
 * Template Name: Home
 *
 */

do_action( 'genesis_home' );


add_action( 'genesis_after_header', 'wsm_home_top' ); 
function wsm_home_top() {
	genesis_widget_area( 'rotator', array( 'before' => '<div class="home-slider">', 'after' => '</div>') );
}

// Execute custom child loop
add_action( 'genesis_before_loop', 'jmu_home_top_section' ); 
function jmu_home_top_section() {
echo '<div class="home-top">';
	genesis_widget_area( 'home-top-left', array( 'before' => '<div class="home-top-left widget-area">', 'after' => '</div>') );
	genesis_widget_area( 'home-top-right', array( 'before' => '<div class="home-top-right widget-area">', 'after' => '</div>') );
echo '</div>';
}

// Remove the standard loop 
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute custom child loop
add_action( 'genesis_loop', 'jmu_home_loop_helper' ); 
function jmu_home_loop_helper() {
echo '<div class="home-main">';
	genesis_widget_area( 'home-main-left', array( 'before' => '<div class="home-main-left widget-area">', 'after' => '</div>') );
	genesis_widget_area( 'home-main-right', array( 'before' => '<div class="home-main-right widget-area">', 'after' => '</div>') );
echo '</div>';
}

remove_action( 'get_header', 'wsm_child_sidebars_init', 15 );
remove_action( 'genesis_sidebar', 'wsm_child_do_sidebar' );

genesis();