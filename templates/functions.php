<?php
/**
 * @example display independend top navigation
 * @param $post_object
 * @filter rw_rpi_navi_template_filter
 * @action rw_multiinstanz_navigation_action
 */
function rw_multiinstanz_navigation_action( $post_object ) {
    ?>
        <div class="rw-multiinstanz-navigation-message">
            <?php include(  apply_filters('rw_rpi_navi_template_filter','rpi-header.php')  );?>
        </div>
    <?php
    do_action( 'rw_multiinstanz_navigation_action' );
}
add_action( 'wp_head', 'rw_multiinstanz_navigation_action' );
