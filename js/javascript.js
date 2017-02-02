/**
 * @package   RPI Multi-Instanz Navigation
 * @author    Joachim Happel
 * @license   GPL-2.0+
 * @link      https://github.com/rpi-virtuell/rw-multiinstanz-navigation
 */

jQuery(document).ready(function($){

    $("#rpi-services-button").toggle(function () {
        $("#more-rpi-container-dialog").dialog('open');
    },function () {
        $("#more-rpi-container-dialog").dialog('close');
    });

    $("#more-rpi-container-dialog").dialog({
        width: 400,
        autoOpen: false,
        dialogClass: "rpi-header-dialog",
        modal: false,
        responsive: true,
        show: {
            effect: "fadeIn",
            duration: 250
        },
        hide: {
            effect: "fadeOut",
            duration: 250
        },
        position:{
            my: "right top-0",
            at: "right top+70",
            of: $('#rw-mn')
        },
        draggable: false,
    });

    $.ajax({
        type: 'POST',
        url: rw_mn_ajax.ajaxurl,     // the variable ajaxurl is prepared by wp core
        data: {
            action: 'rw_multiinstanz_navigation_core_ajaxresponse',
            user: reliwerk_cas_user_account
        },
        success: function (data, textStatus, XMLHttpRequest) {

            readData = $.parseJSON(data);
            console.log($.parseJSON(data));

            switch (readData.status ){
                case 'not-logged-in-user':
                    if($('#rpi-user-name')){

                        $('#rpi-user-name').html(  readData.name  );
                        $('#rpi-user-avatar').html(  readData.avatar  );
                        $('#rpi-user-status').html(  'Du bist als ' + reliwerk_cas_user_account + ' am Loginserver angemeldet!'  );

                    }
                    break;
                case 'logged-in':
                    if($('#rpi-user-name')){

                        $('#rpi-user-name').html(  readData.name  );
                        $('#rpi-user-avatar').html(  readData.avatar  );

                    }
                    break;
                case 'do-loggin':
                    document.location.href='/wp-login.php';
                    break;
                default: //unknown

            }




        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });


    
});

