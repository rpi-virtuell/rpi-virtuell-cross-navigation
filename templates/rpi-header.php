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
        <div class="rpi-header-outher">

            <div class="rpi-header-inner">
                <div class="rpi-left-col">
                    <div class="rpi-table">

                        <div class="rpi-header-links">

                            <!-- Menu Button -->
                            <a href="#" class="rpi-toggle icon" id="rpi-left-menu-toggle" title="Menü">
                                <i class="fa fa-bars"></i>
                            </a><!--.menu-toggle-->


                        </div><!--.header-links-->
                        <div class="header-navigation">
                            <p></p>
                        </div><!--.header-links-->
                        <div id="rpi-header-space">
                            <!--.header-mitte-->
                        </div>
                    </div>
                </div><!--.left-col-->

                <div class="rpi-right-col hide open">


                    <!-- mehr rpi-virtuell -->
                    <div class="rpi-header-services">
                        <a class="rpi-notification-link fa fa-th-large" href="http://about.rpi-virtuell.de"></a>
                    </div>
                    <!-- Notification -->
                    <div class="rpi-header-notifications">
                        <a class="rpi-notification-link fa fa-bell" href="http://gruppen.rpi-virtuell.de/members/<?php echo $user_login; ?>/notifications/">
                            <span id="rpi-pending-notifications" class="count no-alert">0</span>
                        </a>
                    </div>

                    <div class="rpi-header-account-login">


                        <a class="user-link" href="http://gruppen.rpi-virtuell.de/members/joachim-happel/">
                            <span id="rpi-user-name" class="name"></span>
                            <span id="rpi-user-avatar"></span>
                            <span id="rpi-user-status"></span>
                        </a>

                        <div class="pop">

                            <!-- Dashboard links -->

                            <!-- Adminbar -->
                            <div id="adminbar-links" class="bp_components">
                                <span class="logout">
                                    <a href="/wp-login.php?action=logout">Abmelden</a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- .header-wrap -->
    </div><!-- .header-outher -->

</header>