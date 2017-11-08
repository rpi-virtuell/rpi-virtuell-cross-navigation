/**
 * Created by Joachim on 12.04.2017.
 */
jQuery(document).ready(function($){


    $('#logo').remove();

    $('.left-col .header-links').append('<a id="rpi-services-button" class="arrow-down" href="#mehr-rpi-virtuell"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>');
    $('#rpi-services-button').insertBefore('#left-menu-toggle');
    $('#left-menu-toggle').remove();

    jQuery("#rpi-services-button.arrow-down").on("click", function () {
        jQuery("#more-rpi-container-sidebar").trigger("sidebar:toggle");
        return false;
    });

});