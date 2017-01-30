/**
 * @package   RPI Multi-Instanz Navigation
 * @author    Joachim Happel
 * @license   GPL-2.0+
 * @link      https://github.com/rpi-virtuell/rw-multiinstanz-navigation
 */

jQuery(document).ready(function($){

    $('#rw-multiinstanz-navigation-setting-page-ajaxresponse').parent().hide();


    $( document ).on( 'click', 'body', function() {

        var d=new Date();

        $.ajax({
            type: 'POST',
            url: ajaxurl,     // the variable ajaxurl is prepared by wp core
            data: {
                action: 'rw_multiinstanz_navigation_core_ajaxresponse',
                message: d.toString()
            },
            success: function (data, textStatus, XMLHttpRequest) {

                readData = $.parseJSON(data);
                console.log($.parseJSON(data));

                if($('#rw-multiinstanz-navigation-setting-page-ajaxresponse')){
                    $('#rw-multiinstanz-navigation-setting-page-ajaxresponse').html(  readData.msg  );
                    $('#rw-multiinstanz-navigation-setting-page-ajaxresponse').parent().show();
                }


            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

    });    
    
});

