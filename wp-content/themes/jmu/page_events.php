<?php 

/*
 * Template Name: Events
 *
 */


// Remove the standard loop 
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action ('genesis_loop','events_rss_loop');
function events_rss_loop() {

global $post;

echo '<h2 class="entry-title events-title">' . get_the_title() . '</h2>';

$feed_url = get_post_meta($post->ID, '_jmu_rss_url', true);
$feed_count = get_post_meta($post->ID, '_jmu_rss_count', true);
$rss_button_text = get_post_meta($post->ID, '_jmu_rss_more_text', true);
$rss_button_link = get_post_meta($post->ID, '_jmu_rss_more_link', true);
$rss_button_target = get_post_meta($post->ID, '_jmu_rss_target', true);

if ( !empty($feed_url) ) {
$feed = $feed_url;
}


$rss = fetch_feed($feed);
$rss->enable_order_by_date(false);
$maxitems = $rss->get_item_quantity($feed_count);
$rss_items = $rss->get_items(0, $maxitems);

if (!is_wp_error( $rss ) ) :		
    if ($rss_items):
	 echo '<ul class="rss-feed">';
	 if ($maxitems == 0) {
	 echo '<li>Content not available.</li>';
	 }
	 
	 else {
        foreach ( $rss_items as $item ) :
		
				$pubDate = date_i18n('D, j M Y', strtotime( $item->get_date() ) - 8 );	
                  printf('<li><a href="%s">%s</a><pubDate> %s </pubDate><p> %s</p></li>',$item->get_permalink(), $item->get_title(), $pubDate,  $item->get_description() );
        endforeach;
		}
		
        echo "</ul>\n";
		
		if( !empty($rss_button_text) && !empty($rss_button_link)) {
			echo '<div class="more-link"><a href="'. $rss_button_link . '" target="'. $rss_button_target .'">'. $rss_button_text .'</a></div>';
		}
		
    endif;
endif;

}

genesis();