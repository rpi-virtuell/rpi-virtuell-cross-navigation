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
            if(jQuery('#masthead .navigation-top').length && jQuery('#masthead .navigation-top').position().top < 33 ){
                var nav = jQuery('#site-navigation').html();
                jQuery('#rpi-top-menu').html(nav);
                jQuery('#rpi-top-menu').show();
            }else{
                jQuery('#rpi-top-menu').hide();
            }
        });


    }

    if($("#more-rpi-container-sidebar").length>0){

        var  setbutton = function(){

            var btn = jQuery("#rpi-container-sidebar-button");
            var bar = jQuery(".rpi-container-sidebar-content");
            var l = btn.position().left;
            var w = bar.outerWidth();
            $("#more-rpi-container-sidebar").css('width',w);
            $("#more-rpi-container-sidebar .rpi-container-sidebar-wrapper").css({'width':w, 'padding':'0'});
            if(l>w){
                var d = 30 + (l-w);
            }else{
                var d = 30;
            }
            $("#rpi-container-sidebar-button").css('left', (w-d)+'px');


        };

        var maxwith = ($( window ).width()); left= '';

        var left =  '-400px';
        var width = '400px';

        if (maxwith < 420){    //phone

            maxwith -=30;

            left =  (maxwith*-1)+'px';
            width = (maxwith)+'px';
        }




        $("#more-rpi-container-sidebar").css('width',width);
        $("#more-rpi-container-sidebar .rpi-container-sidebar-wrapper").css({'width':width, 'padding':'0'});
        $("#more-rpi-container-sidebar").sidebar();
        $("#more-rpi-container-sidebar").css('display','block');
        $("#more-rpi-container-sidebar").css('left', left);

        $("#more-rpi-container-sidebar").trigger("sidebar:close");

        $("#more-rpi-container-sidebar").on("sidebar:closed", function () {
            $("#more-rpi-container-sidebar").css('left', left);
            setbutton();
        });

        jQuery("#rpi-services-button").on("click", function () {
            jQuery("#more-rpi-container-sidebar").trigger("sidebar:toggle");
            return false;
        });
        jQuery("#rpi-container-sidebar-button").on("click", function () {
            jQuery("#more-rpi-container-sidebar").trigger("sidebar:toggle");
            return false;
        });

        $("#more-rpi-container-sidebar").on("sidebar:opened", function () {
        });

        jQuery("#more-rpi-container-sidebar .rpi-container-sidebar-content").on("click", function () {
        });
    }




});

