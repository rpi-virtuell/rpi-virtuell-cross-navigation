<?php
/**
 * Class RW_MultiInstanz_Navigation_Core
 *
 * Autoloader for the plugin
 *
 * @package   RPI Multi-Instanz Navigation
 * @author    Joachim Happel
 * @license   GPL-2.0+
 * @link      https://github.com/rpi-virtuell/rw-multiinstanz-navigation
 */
class RW_MultiInstanz_Navigation_Core {

    /**
     * Constructor
     *
     * @since   0.0.2
     * @access  public
     */
    function __construct() {

    }
    /**
     * runs on action hook init
     *
     * @since   0.0.2
     * @access  public
     * @static
     * @return  void
     * @use_action: init
     */
    public static function init() {



    }


    /**
     * Load custom Stylesheet
     *
     * @since   0.0.2
     * @access  public
     * @static
     * @return  void
     * @use_action: wp_enqueue_scripts
     */
    public static function enqueue_style() {
        wp_enqueue_style( 'customStyle',RW_MultiInstanz_Navigation::$plugin_url . 'css/style.css' );
        wp_enqueue_style( 'font-awesome',RW_MultiInstanz_Navigation::$plugin_url . 'css/font-awesome.min.css' );
        wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

        if ( RW_MultiInstanz_Navigation_Settings::get( 'bosstheme' ) ) {

            wp_enqueue_style( 'bossStyle',RW_MultiInstanz_Navigation::$plugin_url . 'css/bosstheme.css');


        }

        $style = "";

        $current_theme = wp_get_theme()->get('Name');
        if($current_theme == 'RW Social Learner'){

        }


        if ( RW_MultiInstanz_Navigation_Settings::get( 'headerbar' ) || RW_MultiInstanz_Navigation_Settings::get( 'bosstheme' ) ){
            switch (RW_MultiInstanz_Navigation_Settings::get('service')){
                case 'materialpool':
                    $bg_main  = '#D95821';
                    $bg       = '#EB8154';
                    $bg_hover = '#8E320B';
                    break;
                case 'blogs':
                    $bg_main  = '#D98521';
                    $bg       = '#EBA654';
                    $bg_hover = '#8E520B';
                    break;
                case 'news':
                    $bg_main  = '#169361';
                    $bg       = '#47C894';
                    $bg_hover = '#07613D';
                    break;
                case 'gruppen':
                    $bg_main  = '#734F89';
                    $bg       = '#5B4667';
                    $bg_hover = '#411A59';
                    break;
                default:
                  //  $bg_main  = '#1B638A';
                    $bg_main  = '#6AA4C3';
                    $bg       = '#6AA4C3';
                    $bg_hover = '#093E5A';
            }

            $style = "
                .rpi-header-blogname{
                    background: $bg_main; /* Old browsers */
                    background: -moz-linear-gradient(to top, $bg_main 1%, $bg_main 26%, transparent 26%, transparent 26%, transparent 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(to top, $bg_main 1%,$bg_main 26%,transparent 26%,transparent 26%,transparent 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to top, $bg_main 1%,$bg_main 26%,transparent 26%,transparent 26%,transparent 100%) ; /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$bg_main', endColorstr='transparent',GradientType=1 ); /* IE6-9 */
                
                }
                
                #rw-mn nav ul li ul{
                    background: $bg_main;
                }
                #rw-mn nav ul li ul li:hover a {
                   background: $bg;
                }
                
                /* nav buttons */
                #rw-mn .rpi-header-more-rpi a{
                    background-color: $bg_main;
                    color: white;
                }
                #rw-mn .rpi-header-more-rpi a:hover{
                    background-color: $bg_hover;
                }
                
                #rw-mn .rw-search-wrapper button{
                    background-color: $bg;
                }
                
                #rw-mn .rw-search-wrapper button:hover{
                    background-color: $bg_hover;
                }
                
                #rw-mn .rpi-header-button a{
                    background-color: $bg_main;
                }
                #rw-mn .rpi-header-button a:hover{
                    background-color: $bg_hover !important;
                    color: #ffffff;
                    
                }  
                #wp-admin-bar-my-account{
                    opacity: 0;
                }
                
                /*bosstheme*/
                
                a#search-open{
                    background-color: $bg!important;
                    color:#fff!important;
                }
                #rpi-services-button{
                    background-color: $bg_main!important;
                    color:#fff!important;
                }
                #rpi-services-button:hover{
                    background-color: $bg_hover!important;
                 }
                #rpi-services-button i:hover{
                    transform: rotate(90deg) scale(2,2);
                    -webkit-transition: .6s;
                    -moz-transition: .6s;
                    -o-transition: .6s;
                    transition: .6s;
                    
                }
                a#search-open:hover,.header-links #rpi-services-button:hover{
                    background-color: $bg_hover!important;
                }
                .pop a, #adminbar-links a{
                    color: $bg_hover!important;
                    
                }
                .pop *{
                    opacity:1!important;
                }
                #mastlogo, #masthead .right-col{
                    background: #1B638A !important;
                }
                
                
            ";

            wp_add_inline_style( 'customStyle', $style );
        }

        $style .= "
                #wpadminbar #wp-admin-bar-wp-logo > .ab-item{
                    background-image:url( ".RW_MultiInstanz_Navigation::$plugin_url."assets/rpi-logo-trans.png );
                    background-size: contain;
                }
                #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                    content: '';
                }

                ";
        wp_add_inline_style( 'customStyle', $style );


    }

    /**
     * Load custom javascript
     *
     * @since   0.0.2
     * @access  public
     * @static
     * @return  void
     * @use_action: wp_enqueue_scripts
     */
    public static function enqueue_js() {

        wp_enqueue_script( 'rw_cas_accunt_script','//login.reliwerk.de/account.php',array() ,'0.0.2', true );
        wp_enqueue_script( 'rw_multiinstanz_sidebar_script',RW_MultiInstanz_Navigation::$plugin_url . 'js/jquery.sidebar.min.js' ,array() ,'0.0.2', true);
        wp_enqueue_script( 'rw_multiinstanz_navigation_javascript',RW_MultiInstanz_Navigation::$plugin_url . 'js/javascript.js' ,array() ,'0.0.3', false);
        wp_localize_script( 'rw_multiinstanz_navigation_ajax_script', 'rw_mn_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

        if ( RW_MultiInstanz_Navigation_Settings::get( 'bosstheme' ) ) {
            wp_enqueue_script( 'rw_multiinstanz_bosstheme_script',RW_MultiInstanz_Navigation::$plugin_url . 'js/bosstheme.js' ,array() ,'0.0.2', true);
        }



    }

    //TODO: add wp_ajax-response-actions in rootfile
    //TODO: add javasript ajax calls
    //TODO: add corresponding response functions like this
    /**
     * Example of Ajax response
     *
     * @since   0.0.2
     * @access  public
     * @static
     * @return  void
     * @use_action: wp_ajax_rw_multiinstanz_navigation_core_ajaxresponse
     */
    public static function ajaxresponse(){

        $login_name = $_POST['user'];

        $user = get_user_by('login',$login_name);
        if($user && is_a($user,'WP_User')){



            if(is_user_logged_in() && wp_get_current_user() == $user){
                $status = 'logged-in';
            }elseif(is_user_logged_in() && wp_get_current_user() != $user){
                $status = 'not-logged-in-user';
            }else{
                $status = 'do-loggin';
            }

            echo json_encode(array(
                'success' =>  true
                ,'name'=>$user->display_name
                ,'status'=>$status
                ,'avatar'=>get_avatar($user->ID)
            ));
        }else{
            echo json_encode(array(
                'success' =>  false
                ,'name'=>'anonym'
                ,'status'=> 'unknown user'

            ));
        }
        die();
    }
}