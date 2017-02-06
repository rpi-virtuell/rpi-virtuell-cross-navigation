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
        //wp_enqueue_script( 'jquery-ui','//code.jquery.com/ui/1.12.1/jquery-ui.js'  ,array() ,null, true);
        wp_enqueue_script( 'rw_multiinstanz_sidebar_script',RW_MultiInstanz_Navigation::$plugin_url . 'js/jquery.sidebar.min.js' ,array() ,'0.0.2', true);
        wp_enqueue_script( 'rw_multiinstanz_navigation_ajax_script',RW_MultiInstanz_Navigation::$plugin_url . 'js/javascript.js' ,array() ,'0.0.2', true);
        wp_localize_script( 'rw_multiinstanz_navigation_ajax_script', 'rw_mn_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


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