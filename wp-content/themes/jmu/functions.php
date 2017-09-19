<?php

// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');
require_once( 'lib/init.php' );

// Calls the theme's constants & files
jmu_init();

// Editor Styles
add_editor_style( 'editor-style.css' );


// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'jmu_add_viewport_meta_tag' );
function jmu_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Force Stupid IE to NOT use compatibility mode
add_filter( 'wp_headers', 'jmu_keep_ie_modern' ); 
function jmu_keep_ie_modern( $headers ) {
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
                $headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
        }
        return $headers;
}

// Load Moderinzr script for IE and Gravity Forms placeholders
add_action( 'get_header', 'jmu_load_modernizr' );
function jmu_load_modernizr() {
    wp_enqueue_script( 'modernizr', CHILD_URL . '/lib/js/modernizr.min.js', array( 'jquery' ), '0.4.0', TRUE );
}

// Load Non-Breaking Hyphen javascript fix
add_action( 'get_header', 'jmu_load_hyphen_fix' );
function jmu_load_hyphen_fix() {
    wp_enqueue_script( 'hyphen_fix', CHILD_URL . '/lib/js/hyphen_fix.js', array( 'jquery' ), '1.0.0', TRUE );
}

?>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
// function myFunction() {
    // document.getElementByClassName("myDropdown").classList.toggle("show");
// }

// // Close the dropdown if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.dropbtn')) {

//     var dropdowns = document.getElementsByClassName("dropdown-content");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// }
// $(".menu-item-has-children").on("click", function() {
//   $(this).toggleClass("open-sub-menu");
// });
</script>

<?php


// Add new image sizes
add_image_size( 'Blog Thumbnail', 269, 137, TRUE );
add_image_size( 'logo', 213, 59, TRUE );

//* Reposition the post image (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 5 );

// Customize the Search Box
add_filter( 'genesis_search_button_text', 'custom_search_button_text' );
function custom_search_button_text( $text ) {
    return esc_attr( 'Go' );
}

//* Customize search form input box text
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return 'Search JMU';
}


// Modify the author box display
add_filter( 'genesis_author_box', 'jmu_author_box' );
function jmu_author_box() {
	$authinfo = '';
	$authdesc = get_the_author_meta('description');
	
	if( !empty( $authdesc ) ) {
		$authinfo .= sprintf( '<section %s>', genesis_attr( 'author-box' ) );
		$authinfo .= '<h3 class="author-box-title">' . __( 'About the Author', 'jmu' ) . '</h3>';
		$authinfo .= get_avatar( get_the_author_id() , 90, '', get_the_author_meta( 'display_name' ) . '\'s avatar' ) ;
		$authinfo .= '<div class="author-box-content" itemprop="description">';
		$authinfo .= '<p>' . get_the_author_meta( 'description' ) . '</p>';
		$authinfo .= '</div>';
		$authinfo .= '</section>';
	}
	if ( is_author() || is_single() ) {
		echo $authinfo;
	}
}

//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter( $post_info ) {
if ( is_singular( 'post' )) {
$post_info = '[post_date before="" format="m.d.y"] [post_categories before=""]';
return $post_info;
}
else {
	$post_info = '[post_date before="" format="m.d.y"]';
	return $post_info;
}
}

//* Reposition the entry meta in the entry header (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 8 );


// Customize the post meta function
add_filter( 'genesis_post_meta', 'post_meta_filter' );
function post_meta_filter( $post_meta ) {
	if ( ! is_singular( 'post' ) )  return;
    $post_meta = '[post_tags sep=", " before="Tags: "]';
    return $post_meta;
}

// Add Read More button to blog page and archives
add_filter( 'excerpt_more', 'jmu_add_excerpt_more' );
add_filter( 'get_the_content_more_link', 'jmu_add_excerpt_more' );
add_filter( 'the_content_more_link', 'jmu_add_excerpt_more' );
function jmu_add_excerpt_more( $more ) {
    return '<span class="more-link"><a href="' . get_permalink() . '" rel="nofollow">Read More</a></span>';
}

add_action( 'genesis_before_entry', 'jmu_remove_post_content' );
function jmu_remove_post_content() {
if ( ! is_single() && ! is_page() ) {
	//* Remove the post content (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
}
}


/* 
 * Add support for targeting individual browsers via CSS
 * See readme file located at /lib/js/css_browser_selector_readm.html
 * for a full explanation of available browser css selectors.
 */
add_action( 'get_header', 'jmu_load_scripts' );
function jmu_load_scripts() {
    wp_enqueue_script( 'browserselect', CHILD_URL . '/lib/js/css_browser_selector.js', array('jquery'), '0.4.0', TRUE );
}

// Structural Wrap
add_theme_support( 'genesis-structural-wraps', array( 
	'header', 
	'nav', 
	'site-inner', 
	'footer-widgets', 
	'footer',
) );


// Changes Default Navigation to Primary & Footer

add_theme_support ( 'genesis-menus' , 
	array ( 
		'primary' => 'Primary Navigation Menu' , 
		'secondary' => 'Secondary Navigation Menu' ,
		'footer' => 'Footer Navigation Menu', 
	) 
);

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header_right', 'genesis_do_subnav' );

/**
* Search Icons in Menu
*/
add_filter( 'genesis_nav_items', 'be_search_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'be_search_icons', 10, 2 );

function be_search_icons($menu, $args) {
	$args = (array)$args;
	if ( 'secondary' !== $args['theme_location']  )
	return $menu;
	ob_start();	
	get_search_form();
	$search = ob_get_clean();
	
	$menu_right  .= '<li class="search menu-item last">' . $search . '</li>';
	return $menu . $menu_right;
}


//* Unregister Layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for 4-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4);


// Setup Sidebars
unregister_sidebar( 'header-right' );

genesis_register_sidebar( array(
	'id'			=> 'rotator',
	'name'			=> __( 'Rotator', 'jmu' ),
	'description'	=> __( 'This is the image rotator section.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-top-left',
	'name'			=> __( 'Home Top Left', 'jmu' ),
	'description'	=> __( 'This is the home page top section.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-top-right',
	'name'			=> __( 'Home Top Right', 'jmu' ),
	'description'	=> __( 'This is the home page top section.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-main-left',
	'name'			=> __( 'Home Main Left', 'jmu' ),
	'description'	=> __( 'This is the home page main section.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-main-right',
	'name'			=> __( 'Home Main Right', 'jmu' ),
	'description'	=> __( 'This is the home page main section.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'blog-sidebar',
	'name'			=> __( 'Blog Sidebar', 'jmu' ),
	'description'	=> __( 'This is the Blog Page Sidebar.', 'jmu' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'page-sidebar',
	'name'			=> __( 'Page Sidebar', 'jmu' ),
	'description'	=> __( 'This is the Page Sidebar.', 'jmu' ),
) );

// Remove edit link from TablePress tables for logged in users
add_filter( 'tablepress_edit_link_below_table', '__return_false' );


// Display Category Title
add_filter( 'genesis_term_meta_headline', 'be_default_category_title', 10, 2 );
function be_default_category_title( $headline, $term ) {
if( ( is_category() || is_tag() || is_tax() ) && empty( $headline ) )
$headline = $term->name;
return $headline;
}

// add logo before secondary sidebar
//add_action( 'genesis_before_sidebar_widget_area', 'jmu_sidebar_home_logo', 5 );
//function jmu_sidebar_home_logo() {
//if( !is_front_page() ) return;
//	echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/sidebar-logo.png" alt="" class="logo-sidebar-alt" />';
//}

// add logo before secondary sidebar
add_action( 'genesis_after_header', 'jmu_company_headline', 10 );
function jmu_company_headline() {
		
		global $post;
		
		$heading = genesis_get_option( 'wsm_heading', 'jmu-settings' );
		$replace_heading = get_post_meta( $post->ID, '_jmu_heading_text', true);
		
		
		if ( !empty( $replace_heading ) ) { echo '<div class="heading-section"><div class="wrap"><h3 class="heading">'. $replace_heading .'</h3></div></div>'; }
		
		else {
			if ( !empty( $heading) ) { echo '<div class="heading-section"><div class="wrap"><h3 class="heading">'. $heading .'</h3></div></div>'; }
		}
}

//* Add extra classes to post entry
 
add_filter( 'post_class', 'be_archive_post_class' );
function be_archive_post_class( $classes ) {

	// Don't run on single posts or pages
	if( is_singular() )
		return $classes;

	$classes[] = 'grid';
	global $wp_query;
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 )
		$classes[] = 'left';
	return $classes;
}


add_filter('widget_title', 'do_shortcode');
add_shortcode('b', 'jmu_shortcode_btag');
function jmu_shortcode_btag( $attr, $content ){
return '<b>'. $content . '</b>';
}

// Make JMU Logo link to jmu.edu
// Added by Andrew 8/12/15
add_filter( 'genesis_seo_title', 'child_header_title', 10, 3 );
/**
 * Change default Header URL.
 *
 * @author Jen Baumann
 * @link http://dreamwhisperdesigns.com/genesis-tutorials/change-genesis-header-home-link/
 */
function child_header_title( $title, $inside, $wrap ) {
	$inside = sprintf( '<a href="http://jmu.edu/" title="%s">%s</a>', esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );
	return sprintf( '<%1$s class="site-title">%2$s</%1$s>', $wrap, $inside );
}


// Swap sidebars on sidebar-content page layout
// Added by Annette 7/28

add_action( 'get_header', 'be_change_sidebar_order' );
/**
 * Swap Primary and Secondary Sidebars on Sidebar-Content
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/switch-genesis-sidebars/
 */
function be_change_sidebar_order() {
 
    $site_layout = genesis_site_layout();
 
    if ( 'sidebar-content' == $site_layout ) {
    // Remove default genesis sidebars

	    // Remove the Primary Sidebar from the Primary Sidebar area (SS).
        remove_action( 'genesis_sidebar', 'ss_do_sidebar' );
        // Remove the Primary Sidebar from the Primary Sidebar area.
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
 
        // Remove the Secondary Sidebar from the Secondary Sidebar area (SS).
        remove_action( 'genesis_sidebar_alt', 'ss_do_sidebar_alt' );
        // Remove the Secondary Sidebar from the Secondary Sidebar area.
        remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
 
        // Place the Secondary Sidebar into the Primary Sidebar area.
        add_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );
 
    }
    else {
		// Reposition Sidebar Alt
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
		add_action( 'genesis_before_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
	    
    }
 
}

// Customize logo on the WP login page
// @author Annette Liskey 7/12/2017
// @ link https://codex.wordpress.org/Customizing_the_Login_Form#Change_the_Login_Logo

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/pawprint-purple-wp.png);
		height:65px;
		width:320px;
		background-size: 80px 80px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
