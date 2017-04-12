/**
 * @package   RPI Multi-Instanz Navigation
 * @author    Joachim Happel
 * @license   GPL-2.0+
 * @link      https://github.com/rpi-virtuell/rw-multiinstanz-navigation
 */

jQuery(document).ready(function($){

    if(jQuery('#rw-mn').length>0){
        if(jQuery('#wpadminbar').length!=0 && jQuery('body.wp-admin').length==0){
            jQuery('html').attr('style', 'margin-top: 100px !important');
            jQuery('.navbar-default').css('margin-top','100px');
            jQuery('#rw-mn').css('top','32px');
        }else if(jQuery('body.wp-admin').length==0){
            jQuery('html').attr('style', 'margin-top: 70px');
            jQuery('.navbar-default').css('margin-top','70px');
        }

        /**
         * DIVI Hack
         */

        if(jQuery('body.et_divi_theme').length>0){
            function setdiviheader(){
                if(jQuery('#wpadminbar').length!=0 && jQuery('body.wp-admin').length==0){
                    jQuery('body.et_divi_theme #page-container header#main-header').attr('style', 'top: 100px');
                }else if(jQuery('body.wp-admin').length==0){
                    jQuery('body.et_divi_theme #page-container header#main-header').attr('style', 'top: 70px');
                }
            }

            jQuery(document).on('scroll', setdiviheader);
            jQuery(document).on('load', setdiviheader);
            jQuery(document).on('resize', setdiviheader);

            setTimeout(setdiviheader, 1000);
        }



        jQuery('#rw-mn #searchsubmit').on('mouseover', function () {
            var inp = jQuery('#rw-mn .rw-search-wrapper input')[0];
            inp.focus();
            jQuery('#rpi-top-menu').hide();
            jQuery('#rw-mn #s').attr('placeholder','Suchbegriff eingeben');

        });
        jQuery('#rw-mn #searchsubmit').on('mouseout', function () {
            jQuery('#rw-mn #s').attr('placeholder','');
        });

        jQuery('#rw-mn #s').on('keydown', function () {
            jQuery('#rw-mn #s').attr('placeholder','');
            jQuery('#rpi-top-menu').hide();
        });
        jQuery('#rw-mn #s').on('click', function () {
            jQuery('#rw-mn #s').attr('placeholder','');
            jQuery('#rpi-top-menu').hide();
        })

        /**
         * menu
         */
        $('nav li ul').hide().removeClass('fallback');
        $('nav li').hover(
            function () {
                $('ul', this).stop().slideDown(100);
            },
            function () {
                $('ul', this).stop().slideUp(100);
            }
        );

        /**
         * sdminbar User-Menu unter User-Bild einbauen
         */
        if(jQuery('body.wp-admin').length==0 && jQuery('#wp-admin-bar-user-actions').length>0){
            jQuery('#wp-admin-bar-user-actions').children().insertBefore('#rpi-header-menu');
            jQuery('#wp-admin-bar-user-info').remove();
            jQuery('#wp-admin-bar-logout').remove();
        }


        /**
         * twentyseventeen top-menu beim down-scrollen in der Suchleiste anzeigen
         */

        jQuery(document).on( 'scroll', function(e){
            if(jQuery('#masthead .navigation-top').position().top < 33 ){
                var nav = jQuery('#site-navigation').html();
                jQuery('#rpi-top-menu').html(nav);
                jQuery('#rpi-top-menu').show();
            }else{
                jQuery('#rpi-top-menu').hide();
            }
        });
    }

    //mehr von rpi-virtuell dienste sidebar

    jQuery("#more-rpi-container-sidebar").css('display','block')
    jQuery("#more-rpi-container-sidebar").sidebar();
    jQuery("#rpi-services-button").on("click", function () {


        jQuery("#more-rpi-container-sidebar").trigger("sidebar:toggle");
        return false;
    });




    /**
     * checken ob der vom loginserver übergebende user "reliwerk_cas_user_account" auf dieser Instanz existiert
     * ggf. Anmelden
     */



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

