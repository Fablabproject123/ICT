<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package 8Store Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'eightstore-lite'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="top-header py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="header-callto col">
                        <?php
                        //call to section
                        $header_callto = get_theme_mod('callto_text');
                        ?>
                        <?php echo wp_kses_post($header_callto); ?>
                    </div>

                    <div class="top-menu col text-right">
                        <?php wp_nav_menu(array('theme_location' => 'top', 'menu_id' => 'top-menu')); ?>
                    </div>
                </div>
            </div>
        </div><!-- Top Header -->

        <div class="main-header">

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php if (get_header_image()) : ?>
                            <a class="header-image" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <img src="<?php header_image(); ?>"
                                     width="<?php echo esc_attr(get_custom_header()->width); ?>"
                                     height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="">
                            </a>
                        <?php endif; // End header image check. ?>
                    </div>
                    <div class="col-md-9 d-flex align-items-center">
                        <div id="header-links" class="w-100">
                            <div class="row">

                                <?php
                                if (is_active_sidebar('widget-header-link')) {
                                    ?>
                                    <?php dynamic_sidebar('widget-header-link'); ?>
                                    <?php
                                }
                                ?>


                                <div class="col-6 col-md-3 right-links text-left text-md-right mb-3 mb-md-0">
                                    <?php if (get_theme_mod('hide_header_search') != '1') { ?>
                                        <div class="header-search">
                                            <a href="javascript:void(0)"><i class="fa fa-search"></i></a>
                                            <div class="search-box">
                                                <div class="close"> &times;</div>
                                                <?php get_template_part('searchform-header'); ?>
                                            </div>
                                        </div> <!--  search-form-->
                                    <?php } ?>

                                    <div class="my-account">
                                        <i class="fa fa-unlock-alt"></i>
                                        <div class="welcome-user">
                                            <?php
                                            //if user is logged in
                                            if (is_user_logged_in()) {
                                                global $current_user;
                                                wp_get_current_user();
                                                ?>
                                                <?php _e('Xin chào', 'eightstore-lite') . " "; ?>
                                                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
										<span class="user-name">
											<?php echo $current_user->display_name; ?>
										</span>
                                                </a>
                                                <?php _e('!', 'eightstore-lite'); ?>
                                                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout">
                                                    <?php _e('Đăng xuất', 'eightstore-lite'); ?>
                                                </a>
                                                <?php
                                            } else {
                                                if (is_woocommerce_available()) {
                                                    woocommerce_login_form();
                                                    ?>
                                                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"
                                                       class="register">
                                                        <?php _e('Đăng kí', 'eightstore-lite'); ?>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"
                                                       class="login">
                                                        <?php _e('Login', 'eightstore-lite'); ?>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- Cart Link -->
                                    <div class="cart-box">
                                        <?php
                                        if (is_woocommerce_available()):
                                            ?>
                                            <a class="cart-contents"
                                               href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : $woocommerce->cart->get_cart_url()); ?>"
                                               title="<?php _e('View your shopping cart', 'eightstore-lite'); ?>">
                                                <div class="count">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span class="cart-count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'eightstore-lite'), WC()->cart->get_cart_contents_count())); ?></span>
                                                </div>
                                            </a>
                                            <?php the_widget('WC_Widget_Cart', 'title='); ?>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Main Header -->
        <div class="store-menu" style="clear: both;">
            <div class="store-wrapper">
                <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg" role="navigation">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'navbar-nav',
                        )); ?>
                        </div>
                    </div>
                </nav><!-- #site-navigation -->
                <div class="clear"></div>
            </div>
        </div><!-- Main Header -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">
