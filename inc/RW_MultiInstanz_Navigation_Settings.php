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
        self::set_defaults();

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
            'rw-multiinstanz-navigation-setting-page', false,false,'section_1'
        );



        /* --- Create form fiels to the first Section 1 ----- */

        /**
         * TODO Eingabefelder für Optionen
         *  Beispiele: 
         */

        /* --- Checkbox loginbutton ----- */

        function rw_checkbox_activate_header_bar_draw(  ) {

            $optname = 'headerbar';

            $options = RW_MultiInstanz_Navigation_Settings::$options;   //read exiting value from wp options table
            $checked = ( isset( $options[$optname] ) && $options[$optname] ) ? true : false;
            ?>
            <input class="rw-multiinstanz-navigation-option-checkbox" type='checkbox' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[<?php echo $optname;?>]' <?php checked( $checked ); ?> value='1'>
            <?php _e('If activated, a header cross site rpi-virtuell bar will be displayed on each blog page.',RW_MultiInstanz_Navigation::get_textdomain()) ; ?>
            <?php

        }
        add_settings_field(
	        'headerbar',                                              // Option Index
            __( 'Enable Header-Bar', RW_MultiInstanz_Navigation::get_textdomain() ),   // Label
            'rw_checkbox_activate_header_bar_draw',                         // function to draw HTML Input
            'section_1',                                            // section slug
            'rw-multiinstanz-navigation-setting-page'               // id der setting page
        );



        function rw_checkbox_loginbutton_draw(  ) {

            $optname = 'loginbutton';

            $options = RW_MultiInstanz_Navigation_Settings::$options;   //read exiting value from wp options table
            $checked = ( isset( $options[$optname] ) && $options[$optname] ) ? true : false;
            ?>
            <input class="rw-multiinstanz-navigation-option-checkbox" type='checkbox' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[<?php echo $optname;?>]' <?php checked( $checked ); ?> value='1'>
            <?php _e('If activated, signup buttons will be displayed in the cross-site navigation',RW_MultiInstanz_Navigation::get_textdomain()) ; ?>
            <?php

        }
        add_settings_field(
	        'loginbutton',                                              // Option Index
            __( 'Anmeldung', RW_MultiInstanz_Navigation::get_textdomain() ),   // Label
            'rw_checkbox_loginbutton_draw',                         // function to draw HTML Input
            'section_1',                                            // section slug
            'rw-multiinstanz-navigation-setting-page'               // id der setting page
        );


        function rw_checkbox_bosstheme_draw(  ) {

            $optname = 'bosstheme';

            $options = RW_MultiInstanz_Navigation_Settings::$options;   //read exiting value from wp options table
            $checked = ( isset( $options[$optname] ) && $options[$optname] ) ? true : false;
            ?>
            <input class="rw-multiinstanz-navigation-option-checkbox" type='checkbox' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[<?php echo $optname;?>]' <?php checked( $checked ); ?> value='1'>
            <?php _e('If activated, inject boss theme',RW_MultiInstanz_Navigation::get_textdomain()) ; ?>
            <?php

        }
        add_settings_field(
            'bosstheme',                                              // Option Index
            __( 'Use Boss Theme', RW_MultiInstanz_Navigation::get_textdomain() ),   // Label
            'rw_checkbox_bosstheme_draw',                         // function to draw HTML Input
            'section_1',                                            // section slug
            'rw-multiinstanz-navigation-setting-page'               // id der setting page
        );


        /* --- Textfield ----- */

        function rw_bp_url_draw(  ) {

            $option='buddypress-url';
            $options = RW_MultiInstanz_Navigation_Settings::$options;
            ?>
            <input style="width:400px;" class="rw-multiinstanz-navigation-option-textfield" type='text' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name.'['.$option.']'; ?>' value='<?php echo $options[$option]; ?>'>
            <?php
        }

        add_settings_field(
	        'buddypress-url',
            __( 'Url to Buddypress Instanz', RW_MultiInstanz_Navigation::get_textdomain() ),
            'rw_bp_url_draw',
            'section_1',
            'rw-multiinstanz-navigation-setting-page'
        );

        function rw_rpi_button_doms_elector_draw(  ) {

            $option='selector';
            $options = RW_MultiInstanz_Navigation_Settings::$options;
            ?>
            <input style="width:400px;" class="rw-multiinstanz-navigation-option-textfield" type='text' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name.'['.$option.']'; ?>' value='<?php echo $options[$option]; ?>'><br>
            specify a jQuery.Selector (z.B.:  '.right-col .header-notifications.notifications' or '#navelem' ), where to put the rpi-button before
            <?php
        }

        add_settings_field(
            'selector',
            __( 'rpi Button Target', RW_MultiInstanz_Navigation::get_textdomain() ),
            'rw_rpi_button_doms_elector_draw',
            'section_1',
            'rw-multiinstanz-navigation-setting-page'
        );








        /* --- Selectbox ----- */


        function rw_selectfield_draw(  ) {
            $options = RW_MultiInstanz_Navigation_Settings::$options;

            $service = $options['service'];

            $select_options[ 'Kein' ] = 'none' ;
            $select_options[ 'News' ] = 'news' ;
            $select_options[ 'Webspace' ] = 'blogs' ;
            $select_options[ 'Materialpool' ] = 'materialpool' ;
            $select_options[ 'Gruppen' ] = 'gruppen' ;

            $select_option = '';

            foreach ( $select_options as $k=>$v ) {
                $selected = ($v == $service)? ' selected':'';
                $select_option .= '<option value="' . $v  . '"'.$selected.'>';
                $select_option .= $k;
                $select_option .= '</option>';

            }

            ?>
            <select class="rw-multiinstanz-navigation-option-select" type='text' name='<?php echo RW_MultiInstanz_Navigation_Settings::$option_name; ?>[service]' selected='<?php echo $options['service']; ?>'>
                <option><?php  echo __('Please choose',RW_MultiInstanz_Navigation::get_textdomain()); ?></option>
                <?php  echo $select_option; ?>
            </select>
            <?php
        }


        add_settings_field(
            'service',
            __( 'Select rpi-virtuell Kontext', RW_MultiInstanz_Navigation::get_textdomain() ),
            'rw_selectfield_draw',
            'section_1',
            'rw-multiinstanz-navigation-setting-page'
        );

    }

    /**
     *
     * @usedBy: add_options_page()
     * @since 0.0.2
     */
    static public function the_options_form(){

        ?>
        <h1><?php _e('Settings'); ?> > RPI Multi-Instanz Navigation </h1>
	    <?php  _e('Settings for RPI Multi-Instanz Navigation',RW_MultiInstanz_Navigation::get_textdomain());?>

	    <hr>

	    <form class="rw-multiinstanz-navigation-option-form" action='options.php' method='post'>
            <?php
            settings_fields( 'section_1' );
            do_settings_sections( 'section_1' );
            submit_button();
            self::print_set_defaults_button();
            ?>
        </form>


        <hr>
        RPI Multi-Instanz Navigation <?php echo __('was developed by',RW_MultiInstanz_Navigation::get_textdomain()); ?> Joachim Happel (rpi-virtuell).
        <?php
    }

    /**
     * set default values for this plugin in the wp options table
     *
     * @since 0.0.2
     */
    static public function set_defaults(){

        RW_MultiInstanz_Navigation_Settings::$options = get_option( RW_MultiInstanz_Navigation_Settings::$option_name );

        if(!RW_MultiInstanz_Navigation_Settings::$options){

            update_option(RW_MultiInstanz_Navigation_Settings::$option_name,array(
                'loginbutton'=>1,
                'buddypress-url'=>'http://gruppen.rpi-virtuell.de'
            ));

        }

    }

	/**
	 * get option value
	 *
	 * @since 0.0.2
	 */
	static public function get($option){

		RW_MultiInstanz_Navigation_Settings::$options = get_option( RW_MultiInstanz_Navigation_Settings::$option_name );

		if(isset(RW_MultiInstanz_Navigation_Settings::$options[$option])){
			return RW_MultiInstanz_Navigation_Settings::$options[$option];
        }
		return false;

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
