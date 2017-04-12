/**
 * Created by Joachim on 12.04.2017.
 */
jQuery(document).ready(function($){

    $('#logo').remove();
    //$('#left-menu-toggle').remove();

    $('.left-col .header-links').append('<a id="rpi-services-button" href="#mehr-rpi-virtuell"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>');

    $('#rpi-services-button').insertBefore('#left-menu-toggle');




});