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
        </div><div id="rw-mn-shadow"></div><?php
    else:?>
        <?php include(  apply_filters('rw_rpi_services_filter','rpi-services.php')  );?>
    <?php endif;
}
add_action( 'wp_head', 'rw_multiinstanz_navigation_header_action' );


function rw_multiinstanz_navigation_footer_action(){
    if ( RW_MultiInstanz_Navigation_Settings::get( 'bosstheme' ) ){
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('#mastlogo').append('<div id="rw-boss-header-left-col" class="rpi-header-logo"><img id="rw-boss-logo" src="<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/rpi-logo-trans.png"><div class="rpi-header-blogname rw-boss-header-name"><?php echo get_bloginfo('name');?></div></div>');
                $('.mobile-site-title').html('<img id="rw-mobile-boss-logo" style="width: 58px;float: left;" src="<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/rpi-logo-trans.png"><div class="rpi-header-blogname rw-boss-mobile-header-name"><?php echo get_bloginfo('name');?></div>');

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