<?php


// Remove the standard loop 
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Execute custom child loop
add_action( 'genesis_loop', 'jmu_staff_archive_loop' ); 
function jmu_staff_archive_loop() {

echo '<h1 itemprop="headline" class="entry-title">Members</h1>';

echo do_shortcode(' [simple-staff-list] ');	

}


genesis();