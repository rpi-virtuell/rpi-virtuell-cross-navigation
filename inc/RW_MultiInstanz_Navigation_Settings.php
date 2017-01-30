<?php
/**
* Class RW_MultiInstanz_Navigation_Settings
*
* Creates s setting page and a menu entry in wp backend
*
* @package      RPI Multi-Instanz Navigation
* @author       Joachim Happel
* @license      GPL-2.0+
* @link         https://github.com/rpi-virtuell/rw-multiinstanz-navigation
* @since        0.0.2
*/
class RW_MultiInstanz_Navigation_Settings {

    static public $option_name = 'rw-multiinstanz-navigation';
    static public $options;

    static public function init(){

        self::check_nonce_requests();
        self::init_options();

        add_action( 'admin_menu', array('RW_MultiInstanz_Navigation_Settings','options_page') );
        add_action( 'network_admin_menu', array('RW_MultiInstanz_Navigation_Settings','options_page') );

        //enable custum dashboard widget
        //add_action('wp_dashboard_setup', array('RW_MultiInstanz_Navigation_Settings', 'dashboard_widgets') );
    }


    /**
     * @TODO: Create the form fields in one or more sections
     * @use_action: admin_menu
    */
    static public function options_page(  ) {

        //add a options page 
        add_options_page( 'rw-multiinstanz-navigation', 'RPI Multi-Instanz Navigation', 'manage_options', 'rw-multiinstanz-navigation', array('RW_MultiInstanz_Navigation_Settings', 'the_options_form') );


        /* --- Create a first Section 1 ----- */
        
        //@TODO Titel des Optionsbereich 1
        $section_title = 'Choose Plugin Options';

        /**
         * @TODO Einleitungstext im Optionsbereich 1
         */

        register_setting( 'section_1', RW_MultiInstanz_Navigation_Settings::$option_name );

        add_settings_section(
            'rw-multiinstanz-navigation-setting-page',                                          // id of the setting page
            __( 'Sample Options', RW_MultiInstanz_Navigation::get_textdomain() ),        // section title
            function(){                                                             // intro text before the input fields
                _e( 'Section intro Description....', RW_MultiInstanz_Navigation::get_textdomain() );
            },
            'section_1'
        );


        /* --- Create form fiels to the first Section 1 ----- */

        /**
         * TODO Eingabefelder für Optionen
         *  Beispiele: 
         */

        /* --- Checkbox 1 ----- */

        function rw_checkbox_1_draw(  ) {

            $optname = 'option1';

            $options = RW_MultiInstanz_Navigation_Settings::$options;   //read exiting value from wp options table
            $checked = ( isset( $options[$optname] ) && $options[$optname] ) ? true : false;
            ?>
            <input class="rw-multiinstanz-navigation-option-checkbox" type='checkbox' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[<?php echo $optname;?>]' <?php checked( $checked ); ?> value='1'>
            <?php _e('If activated ... ',RW_MultiInstanz_Navigation::get_textdomain()) ; ?>
            <?php

        }
        add_settings_field(
            'option1',                                              // Option Index
            __( 'Check this', RW_MultiInstanz_Navigation::get_textdomain() ),   // Label
            'rw_checkbox_1_draw',                                   // function to draw HTML Input
            'section_1',                                            // section slug
            'rw-multiinstanz-navigation-setting-page'                           // id der setting page
        );

        /* --- Textfield ----- */
        function rw_textfield_draw(  ) {
            $options = RW_MultiInstanz_Navigation_Settings::$options;
            ?>
            <input class="rw-multiinstanz-navigation-option-textfield" type='text' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[option2]' value='<?php echo $options['option2']; ?>'>
            <?php
        }

        add_settings_field(
            'option2',
            __( 'A Textbox', RW_MultiInstanz_Navigation::get_textdomain() ),
            'rw_textfield_draw',
            'section_1',
            'rw-multiinstanz-navigation-setting-page'
        );

        /* --- Selectbox ----- */

        function rw_selectfield_draw(  ) {
            $options = RW_MultiInstanz_Navigation_Settings::$options;

            $pages = get_pages();
            foreach ( $pages as $page ) {
                $selected = ($options['option3'] == $page->ID)? ' selected':'';
                $select_option = '<option value="' . $page->ID  . '"'.$selected.'>';
                $select_option .= $page->post_title;
                $select_option .= '</option>';

            }

            ?>
            <select class="rw-multiinstanz-navigation-option-select" type='text' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[option3]' selected='<?php echo $options['option3']; ?>'>
                <option><?php  echo __('Please Choose',RW_MultiInstanz_Navigation::get_textdomain()); ?></option>
                <?php  echo $select_option; ?>
            </select>
            <?php
        }


        add_settings_field(
            'option3',
            __( 'Select a Page', RW_MultiInstanz_Navigation::get_textdomain() ),
            'rw_selectfield_draw',
            'section_1',
            'rw-multiinstanz-navigation-setting-page'
        );

    }

    /**
     * @TODO Create the settings form
     *
     * @usedBy: add_options_page()
     * @since 0.0.2
     */
    static public function the_options_form(){

        ?>
        <form class="rw-multiinstanz-navigation-option-form" action='options.php' method='post'>

            <h1><?php _e('Settings'); ?> > RPI Multi-Instanz Navigation </h1>
            <?php
            _e('Settings for RPI Multi-Instanz Navigation',RW_MultiInstanz_Navigation::get_textdomain());

            echo '<hr>';

            //slot for js/ajax messages
            echo '<div class="notice notice-info"><p id="rw-multiinstanz-navigation-setting-page-ajaxresponse" ></p></div>';

            settings_fields( 'section_1' );
            do_settings_sections( 'section_1' );


            echo '<hr>';

            submit_button();

            self::print_set_defaults_button();

            ?>

        </form>
        <hr>
        RPI Multi-Instanz Navigation <?php echo __('was developed by',RW_MultiInstanz_Navigation::get_textdomain()); ?> Demo Autor (rpi-virtuell).
        <?php
    }

    /**
     * set default values for this plugin in the wp options table
     *
     * @since 0.0.2
     */
    static public function init_options(){

        RW_MultiInstanz_Navigation_Settings::$options = get_option( RW_MultiInstanz_Navigation_Settings::$option_name );
        if(!RW_MultiInstanz_Navigation_Settings::$options){

            update_option(RW_MultiInstanz_Navigation_Settings::$option_name,array(
                'option1'=>0,
                'option2'=>'default wert',
                'option3'=>''
            ));

        }

    }

    /**
     * checks incomming url request
     *
     */
    static function check_nonce_requests () {

        //Beispiel: Alle Plugin Einstellungen in der DB löschen set_defaults_button()

        if (isset($_GET['rw_multiinstanz_navigation_nonce']) && wp_verify_nonce($_GET['rw_multiinstanz_navigation_nonce'], 'set_defaults_button' ) ) {

            delete_option(RW_MultiInstanz_Navigation_Settings::$option_name);

            wp_redirect(admin_url( 'options-general.php?page=rw-multiinstanz-navigation&action=set_defaults_button' ));

        }elseif (isset($_GET['action']) && $_GET['action']=='set_defaults_button') {

            $url = admin_url( 'options-general.php?page=rw-multiinstanz-navigation' );
            RW_MultiInstanz_Navigation::notice_admin('success',RW_MultiInstanz_Navigation::$plugin_name. ': alle Einstellungen wurden zurückgesetzt. <b>[<a href="'.$url.'">Ok. Hide Notice.</a>]</b>');

        }
    }

    /**
     * Button (link) used in the form of settings page
     *
     * @since 0.0.2
     */
    static function print_set_defaults_button () {

        //use Wordpress Nonces for url based commands ( https://codex.wordpress.org/Wordpress_Nonce_Implementation )

        $nonce_url = wp_nonce_url( admin_url( 'options-general.php?page=rw-multiinstanz-navigation' ), 'set_defaults_button', 'rw_multiinstanz_navigation_nonce' );

        if (!isset($_GET['rw_multiinstanz_navigation_nonce'])) {
            ?>
            <a href="<?php print $nonce_url; ?>" class="button">
                <?php echo __('Reset all settings to default', RW_MultiInstanz_Navigation::get_textdomain()); ?>
            </a>
            <?php
        }
    }


    /**
     * Add a custom Dashboard widget to the rop of the widgets
     * @use_action wp_dashboard_setup
     *
     * @link https://codex.wordpress.org/Dashboard_Widgets_API
     */
    public static  function dashboard_widgets(){
        global $wp_meta_boxes;

        wp_add_dashboard_widget('rw_multiinstanz_navigation_widget',  __( 'RPI Multi-Instanz Navigation Help' , RW_MultiInstanz_Navigation::get_textdomain()), function(){
            echo __( 'Some Instructions to config this plugin...' , RW_MultiInstanz_Navigation::get_textdomain());
        });

        $origin_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
        $my_widget = array( 'example_dashboard_widget' => $origin_dashboard['rw_multiinstanz_navigation_widget'] );

        unset( $origin_dashboard['rw_multiinstanz_navigation_widget'] );
        $new_dashboard = array_merge( $my_widget, $origin_dashboard );
        // Save the sorted array back into the original metaboxes
        $wp_meta_boxes['dashboard']['normal']['core'] = $new_dashboard;

        //remove wordpress feeds widget
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    }


}
