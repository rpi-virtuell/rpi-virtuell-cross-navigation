<?php
/**
 * put your custom functions here
 */

/**
 * @example create top message on a Blogsite
 *
 * @param $post_object
 */
function rw_multiinstanz_navigation_action( $post_object ) {
    ?>
        <div class="rw-multiinstanz-navigation-message">
        Message to the <a href="#">World</a>
    </div>
    <?php
}
add_action( 'wp_head', 'rw_multiinstanz_navigation_action' );
do_action( 'rw_multiinstanz_navigation_action' );