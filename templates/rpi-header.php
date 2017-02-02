<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 30.01.2017
 * Time: 13:33
 */
?>
<header id="rpi-masthead" class="rpi-site-header" role="banner" data-infinite="on">

    <div class="rpi-header-wrap">
        <div class="rpi-header">

                <div class="rpi-left-col">

                    <div class="rpi-header-logo">
                        <img src="<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/rpi-logo-trans.png">
                        <div class="rpi-header-blogname" >
                             <!--style="background: url('<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/blogs.png') no-repeat 10px center; background-size: 50px"-->
                            <span>blogs<?php //echo get_bloginfo('name');?></span>
                        </div>
                    </div><!--.header-links-->

                </div><!--.left-col-->

                <div class="rpi-center-col">
                    <div class="header-navigation">
                        <?php echo apply_filters('rw_multiinstanz_navigation_get_searchfield',rw_multiinstanz_navigation_get_searchfield());?>
                    </div>
                </div><!--.center-col-->

                <div class="rpi-right-col">
                    <div class="header-navigation">



                        <?php if(!is_user_logged_in()):?>
                        <ul class="rpi-header-signon">
                            <li class="rpi-header-services">
                                <a id="rpi-services-button" style="background: url('<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/rpi-button.png') no-repeat; background-size: contain"
                                   href="#rpi-virtuell"></a>
                            </li>
                            <?php if ( RW_MultiInstanz_Navigation_Settings::get( 'loginbutton' ) ) :?>
                                <?php if ( get_option( 'users_can_register' ) ) :?>
                                    <li class="rpi-header-button register-button">
                                        <a href="<?php echo wp_registration_url();?>" title="Registrieren">Registrieren</a>
                                    </li>
                                <?php endif;?>
                                <li class="rpi-header-button login-button">
                                    <a href="<?php echo wp_login_url(); ?>" title="Anmelden">Anmelden</a>
                                </li>
                                <?php endif;?>

                        </ul>
                        <?php else: $user=wp_get_current_user();?>
                        <ul class="rpi-header-account">
                            <!-- mehr rpi-virtuell -->
                            <li class="rpi-header-services">
                                <a id="rpi-services-button" style="background: url('<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/ci-rpi-button.png') no-repeat; background-size: contain"
                                   href="#rpi-virtuell"></a>
                            </li>
                            <!-- Notification -->
                            <li class="rpi-header-notifications icon-button">
                                <a class="rpi-notification-link fa fa-bell no-alert" href="http://gruppen.rpi-virtuell.de/members/<?php echo $user->user_login; ?>/notifications/">
                                    <span id="rpi-pending-notifications" class="count">0</span>
                                </a>
                            </li>

                            <li class="rpi-header-avatar">
                                <div class="rpi-user-name"><span id="rpi-user-name" class="name"></span></div>
                                <div id="rpi-user-avatar"></div>

                            </li>
                            <!--<li id="rpi-header-menu" class="rpi-header-menu">
                                <a href="<?php echo wp_logout_url(); ?>">Logout</a>
                            </li>-->
                        </ul>
                        <?php endif;?>
                    </div>
                </div>
            </div>
    </div>
</header>