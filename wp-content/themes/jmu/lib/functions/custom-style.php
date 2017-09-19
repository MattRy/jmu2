<?php



/* Load inline Styles and Scripts for Genesis Child Theme */
add_action( 'wp_head', 'genesisawesome_childtheme_inline_styles' );


/**
 * Sight Machine Home Page Custom Stylings
 *
 * @since 1.0
 *
 * @return null
 */
 
function genesisawesome_childtheme_inline_styles() {

	// Body Custom Style
	$body_font_color = genesis_get_option( 'wsm_body_font_color', 'jmu-settings' );
	$body_font_size = genesis_get_option( 'wsm_body_font_size', 'jmu-settings' );
	
	
	$body_font_style  = '';
	$body_font_style .=  'body {';
	if ( !empty( $body_font_color ) ) { $body_font_style .=  ' color: '. $body_font_color .'; '; }
	if ( !empty( $body_font_size ) ) { $body_font_style .=  ' font-size: '. $body_font_size .'px; '; }
	$body_font_style .=  '}';
	
	echo '<style type="text/css">' . $body_font_style .'</style>';

}




// Add Body Class
add_action('wp_head', 'wsm_add_body_class');
function wsm_add_body_class() { 

	$logo_url = genesis_get_option( 'wsm_logo_url', 'jmu-settings' );
	$logo_replace_default = genesis_get_option( 'wsm_logo_hide', 'jmu-settings' );
	
	if ( !empty( $logo_replace_default ) && !empty( $logo_url ) ) {
	$logo_style  = '';
	$logo_style .=  '.header-image .site-title > a { background-image: url('. $logo_url .'); } ';
	}
	
	echo '<style type="text/css">' . $logo_style .'</style>';
	
	if ( !empty( $logo_url ) && !empty( $logo_replace_default ) ) { 	
	
	//* Add custom body class to the head
	add_filter( 'body_class', 'sp_body_class' );
	function sp_body_class( $classes ) {
		
	$classes[] = 'header-image';
	return $classes;
	
	}
	
	}
	
}
