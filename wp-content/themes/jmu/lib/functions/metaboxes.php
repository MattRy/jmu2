<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
 
if( isset($_GET['post'] ) || isset($_POST['post_ID']) )

$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

if ( file_exists( CHILD_DIR . '/lib/metabox/init.php' ) ) {
	require_once CHILD_DIR . '/lib/metabox/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


if ( $template_file == 'page_events.php') {
add_action( 'cmb2_init', 'wsm_register_rss_metabox' );
}

/*
 * Site Heading Metabox.
 */
function wsm_register_rss_metabox() {

	$prefix = '_jmu_rss_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_rss_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'RSS Feed', 'cmb2' ),
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	
	) );

	$cmb_rss_page->add_field( array(
		'name' => __( 'Feed URL', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
	) );
	
	$cmb_rss_page->add_field( array(
		'name' => __( 'Items to display?', 'cmb2' ),
		'id'   => $prefix . 'count',
		'type' => 'text_small',
	) );
	
	$cmb_rss_page->add_field( array(
		'name' => __( 'More Text', 'cmb2' ),
		'id'   => $prefix . 'more_text',
		'type' => 'text_medium',
	) );
	$cmb_rss_page->add_field( array(
		'name' => __( 'More Link', 'cmb2' ),
		'id'   => $prefix . 'more_link',
		'type' => 'text',
	) );
	$cmb_rss_page->add_field( array(
		'name'    => __( 'Link Target', 'cmb2' ),
		'id'      => $prefix . 'target',
		'type'    => 'select',
		'options' => array(
			'_self' => __( '_self', 'cmb2' ),
			'_blank'   => __( '_blank', 'cmb2' ),
		),
	) );
	
}


add_action( 'cmb2_init', 'wsm_register_heading_metabox' );

/*
 * Site Heading Metabox.
 */
function wsm_register_heading_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_jmu_heading_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_about_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Heading Setting', 'cmb2' ),
		'object_types' => array( 'page','post', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	
	) );

	$cmb_about_page->add_field( array(
		'name' => __( 'Replace Default Site Heading', 'cmb2' ),
		'id'   => $prefix . 'text',
		'type' => 'text',
	) );

}


add_action( 'cmb2_init', 'wsm_register_top_image_metabox' );
/*
 * Top Image Metabox.
 */
function wsm_register_top_image_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_wsm_top_image_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_about_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Top Image Settings', 'cmb2' ),
		'object_types' => array( 'page','post', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	
	) );

	$cmb_about_page->add_field( array(
		'name' => __( 'Replace Default Top Image', 'cmb2' ),
		'desc' => __( 'size: 1252 x 324 PX', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'file',
	) );

}