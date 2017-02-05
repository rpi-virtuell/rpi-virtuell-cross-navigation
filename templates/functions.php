<?php
/**
 * @example display independend top navigation
 * @param $post_object
 * @filter rw_rpi_navi_template_filter
 * @action rw_multiinstanz_navigation_action
 */
function rw_multiinstanz_navigation_get_searchfield(){
    return '
    <form>
        <div class="rw-search-wrapper">
            <label class="screen-reader-text" for="s">Suchen nach:</label>
            <input type="text" value="" name="s" id="s" class="ui-autocomplete-input" autocomplete="off">
            <button type="submit" id="searchsubmit" title="Suchen"><i class="fa fa-search"></i></button>
        </div>
    </form>';
}

/**
 * draw the rpi top header
 * @param $post_object
 */
function rw_multiinstanz_navigation_header_action($post_object ) {
    include(  apply_filters('rw_services_template_filter','rpi-services.php')  );

    if ( RW_MultiInstanz_Navigation_Settings::get( 'headerbar' ) ) :?>
        <div id="rw-mn">
              <?php include(  apply_filters('rw_rpi_navi_template_filter','rpi-header.php')  );?>
        </div><?php
    else:
        include(  apply_filters('rw_rpi_service_button_template_filter','boss-button.php')  );

    endif;
}
add_action( 'pre_top_navigation', 'rw_multiinstanz_navigation_header_action' );


function rw_multiinstanz_navigation_footer_action(){
    if ( !RW_MultiInstanz_Navigation_Settings::get( 'headerbar' ) && RW_MultiInstanz_Navigation_Settings::get( 'selector' ) ){
        ?>
        <script>
            jQuery(document).ready(function($) {
                if (jQuery('<?php echo RW_MultiInstanz_Navigation_Settings::get('selector');?>')) {
                    jQuery('#rpi-header-services-button')
                        .insertBefore('<?php echo RW_MultiInstanz_Navigation_Settings::get('selector');?>');
                }
            });
        </script>
        <?php
    }?>
        <script>
            jQuery(document).ready(function($) {


            });
        </script>
    <?php
}
add_action( 'wp_footer', 'rw_multiinstanz_navigation_footer_action' );