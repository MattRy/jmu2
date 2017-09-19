<?php
/**
 * JMU Settings
 *
 * This file registers all of JMU's specific Theme Settings, accessible from
 * Genesis --> JMU Settings.
 *
 * NOTE: Change out "JMU" in this file with name of theme and delete this note
 */ 
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package wsm
 * @subpackage JMU_Settings
 */
class JMU_Settings extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'wsm';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'JMU Settings', 'wsm' ),
				'menu_title'  => __( 'JMU Settings', 'wsm' ),
				'capability' => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', 'jmu-settings' );
		$settings_field = 'jmu-settings';
		
		// Set the default values
		$default_settings = array(
			'wsm_heading' => 'Site Title Here',
			'wsm_logo_hide' => '',
			'wsm_logo_url' => '/wp-content/themes/jmu/images/logo.png',
			'wsm_body_font_color' => '#3b3b3c',
			'wsm_body_font_size' => '15',
			'wsm_info' => '800 S. Main St. Harrisonburg, Virgina 22870',
			'wsm_default_blog_bg' => '/wp-content/themes/jmu/images/deafult-top-image.jpg',
			'wsm_default_page_bg' => '/wp-content/themes/jmu/images/deafult-top-image.jpg',
		);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
		
		add_action( 'admin_init', array( $this, 'ga_load_scripts' ) );
			
	}

	/** 
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */	
	function sanitization_filters() {
		
		genesis_add_option_filter( 'no_html', $this->settings_field,
			array(
				'wsm_heading',
				'wsm_body_font_color',
				'wsm_body_font_size',
				'wsm_default_blog_bg',
				'wsm_default_page_bg',
				'wsm_logo_hide',
				'wsm_logo_url'
			) );
			
		genesis_add_option_filter( 'safe_html', $this->settings_field,
			array(
				'wsm_info',
			) );
	}
	
	/**
	 * Set up Help Tab
	 * @since 1.0.0
	 *
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'sample-help', 
			'title'   => 'Sample Help',
			'content' => '<p>Help content goes here.</p>',
		) );
	 }
	 
	  /**
	 * Add action to load styles and scripts
	 *
	 * @return null
	 */
	function ga_load_scripts() {

		add_action( 'load-' . $this->pagehook, array( $this, 'ga_scripts' ) );

	}

	/**
	 * Load styles and scripts for Option page.
	 *
	 * @return null
	 */
	function ga_scripts() {

		wp_enqueue_style( 'ga-colorpicker',  CHILD_URL . '/lib/color-picker-metabox/css/jquery.minicolors.css' );
		wp_enqueue_script( 'ga-colorpicker', CHILD_URL . '/lib/color-picker-metabox/js/jquery.minicolors.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'ga-custom',      CHILD_URL . '/lib/color-picker-metabox/js/ga-custom.js', array( 'ga-colorpicker' ), null, true );

	}
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {
		add_meta_box('wsm_logo_meatabox', 'Logo Settings', array( $this, 'wsm_logo_meatabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('wsm_body_font_meatabox', 'Body Font Settings', array( $this, 'wsm_body_font_meatabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('wsm_heading_meatabox', 'Heading Setting', array( $this, 'wsm_heading_meatabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('wsm_top_image_metabox', 'Inside Page Top image', array( $this, 'wsm_top_image_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('wsm_footer_info_metabox', 'Footer Info', array( $this, 'wsm_footer_info_metabox' ), $this->pagehook, 'main', 'high');
	}
	
	/**
	 * Logo Metabox
	 * @since 1.0.0
	 */
	function wsm_logo_meatabox() {
	
		echo '<input type="checkbox" name="' . $this->get_field_name( 'wsm_logo_hide' ) . '" id="' . $this->get_field_id( 'wsm_logo_hide' ) . '" value="1"';
        checked( 1, $this->get_field_value( 'wsm_logo_hide' ) ); echo '/>';
                
        echo '<label for="' . $this->get_field_id( 'wsm_logo_hide' ) . '">' . __( 'Replace Default Logo</strong>', 'wsm' ) . '</label>';
        echo '<p><em>' . __( 'By default, leaving this unchecked will apply default image logo or just use a text logo', 'wsm' ) . '</em></p>';
	
		echo '<p><strong>Logo URL:</strong></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'wsm_logo_url' ) . '" id="' . $this->get_field_id( 'wsm_logo_url' ) . '" value="' . esc_attr( $this->get_field_value( 'wsm_logo_url' ) ) . '" size="70" /></p>';
	}

	
	/**
	 * Body Font Settings
	 * @since 1.0.0
	 */
	 
	function wsm_body_font_meatabox() {
	
		echo '<p><strong>Body Font Color:</strong> ';
		echo '<input type="text" name="'. $this->get_field_id( 'wsm_body_font_color' ) .'" id="'. $this->get_field_id( 'wsm_body_font_color' ) .'" value="'. esc_attr( $this->get_field_value( 'wsm_body_font_color' ) ) .'" size="6" class="ga-color" /></p>';
			
		echo '<p><strong>Body Font Size:</strong> ';
		echo '<input type="text" name="'. $this->get_field_id( 'wsm_body_font_size' ) .'" id="'. $this->get_field_id( 'wsm_body_font_size' ) .'" value="'. esc_attr( $this->get_field_value( 'wsm_body_font_size' ) ) .'" size="2"/> PX</p>';

	}
	
	/**
	 * Site heading
	 * @since 1.0.0
	 */
	function wsm_heading_meatabox() {
		echo '<p><strong>Site Name:</strong></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'wsm_heading' ) . '" id="' . $this->get_field_id( 'wsm_heading' ) . '" value="' . esc_attr( $this->get_field_value( 'wsm_heading' ) ) . '" size="70" /></p>';
	}

	
	/**
	 * Top Image
	 * @since 1.0.0
	 */
	function wsm_top_image_metabox() {

		echo '<p><strong>Blog Pages Default Top Image:</strong><br/><small>size: 1252 x 324 PX</small></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'wsm_default_blog_bg' ) . '" id="' . $this->get_field_id( 'wsm_default_blog_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'wsm_default_blog_bg' ) ) . '" size="70" /></p>';

		echo '<p><strong>Inner Pages Default Top Image:</strong><br/><small>size: 1252 x 324 PX</small></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'wsm_default_page_bg' ) . '" id="' . $this->get_field_id( 'wsm_default_page_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'wsm_default_page_bg' ) ) . '" size="70" /></p>';

	}
	
	
	/**
	 * Footer Info Metabox
	 * @since 1.0.0
	 */
	function wsm_footer_info_metabox() {

		echo '<p><strong>Contact Info:</strong></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'wsm_info' ) . '" id="' . $this->get_field_id( 'wsm_info' ) . '" value="' . esc_attr( $this->get_field_value( 'wsm_info' ) ) . '" size="70" /></p>';
	
	}

	
}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function jmu_add_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new JMU_Settings;	 	
}
add_action( 'genesis_admin_menu', 'jmu_add_settings' );

/**
 * Add Soliloquy key
 *
 * @since 1.0.0
 */
// Soliloquy License
if ( ! get_option( 'soliloquy_license_key' ) )
	update_option( 'soliloquy_license_key', SOLILOQUY_LICENSE_KEY );
