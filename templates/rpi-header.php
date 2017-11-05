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
                        <a href="//rpi-virtuell.de/"><img src="<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/rpi-logo-trans.png"></a>
                        <div class="rpi-header-blogname" >
                            <!--style="background: url('<?php echo RW_MultiInstanz_Navigation::$plugin_url;?>/assets/blogs.png') no-repeat 10px center; background-size: 50px"-->
                            <a href="<?php echo get_site_url(); ?>">
                                <?php echo get_bloginfo('name');?>
                            </a>
                            <!-- mehr rpi-virtuell -->
                        </div>
                        <div class="rpi-header-more-rpi">
                            <a id="rpi-services-button" href="#mehr-rpi-virtuell">
                                <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div><!--.header-links-->

                </div><!--.left-col-->

                <div class="rpi-center-col">
                    <div id="rpi-top-menu">

                    </div>
                    <div class="header-navigation">
                        <?php echo apply_filters('rw_multiinstanz_navigation_get_searchfield',rw_multiinstanz_navigation_get_searchfield());?>
                    </div>
                </div><!--.center-col-->

                <div class="rpi-right-col">
                    <div class="header-navigation">


                        <?php if(!is_user_logged_in()):?>
                        <nav class="mobile">
                            <ul class="rpi-header-account">
                                <li class="rpi-header-avatar">
                                    <div id="rpi-user-avatar">
                                        <i class="fa fa-user" aria-hidden="true" style="margin-left:10px; color: #7a9dbc; font-size:80px!important; float:right"></i>
                                    </div>
                                    <ul class="fallback">
                                        <li id="rpi-header-account-register" class="rpi-header-account-register">
                                            <a href="<?php echo wp_registration_url(); ?>">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                <span>Registrieren</span>
                                            </a>
                                        </li>
                                        <li id="rpi-header-account-login" class="rpi-header-account-login">
                                            <a href="<?php echo wp_login_url(); ?>">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                                <span>Anmelden</span>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </nav>
                        <ul class="rpi-header-signon">
                            <?php if ( RW_MultiInstanz_Navigation_Settings::get( 'loginbutton' ) ) :?>
                                <li class="rpi-header-button register-button">
                                    <?php if ( get_option( 'users_can_register' ) ) {
                                        $url = '<a href="' . wp_registration_url() . '" title="Registrieren">Registrieren</a>';
                                    } else {
                                        $url = '<a href="' . "https://about.rpi-virtuell.de/bei-rpi-virtuell-registrieren/" . '" title="Registrieren">Registrieren</a>';

                                    }
                                    echo apply_filters( 'register', $url );
                                    ?>
                                </li>
                                <li class="rpi-header-button login-button">
                                    <a href="<?php echo wp_login_url(); ?>" title="Anmelden">Anmelden</a>
                                </li>
                            <?php endif;?>

                        </ul>

                        <?php else: $user=wp_get_current_user();?><nav>
                        <ul class="rpi-header-account">
                            <!-- Notification -->
                            <li class="rpi-header-notifications icon-button">
                                <a class="rpi-notification-link fa fa-bell no-alert" href="//gruppen.rpi-virtuell.de/members/<?php echo $user->user_login; ?>/notifications/">
                                    <span id="rpi-pending-notifications" class="count">0</span>
                                </a>
                            </li>

                            <li class="rpi-header-avatar">

                                <div class="rpi-user-name"><span id="rpi-user-name" class="name"></span></div>
                                <div id="rpi-user-avatar"></div>
                                <ul class="fallback">
                                    <li id="rpi-header-menu" class="rpi-header-menu">
                                        <a href="<?php echo wp_logout_url(); ?>">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <span>Abmelden</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>


                        </ul></nav>
                        <?php endif;?>
                    </div>
                </div>
            </div>
    </div>
</header>