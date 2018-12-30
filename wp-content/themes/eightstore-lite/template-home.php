<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Home
 * @package 8Store Lite
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="container">
            <?php

            //load slider
            do_action('eightstore_lite_homepage_slider');

            //load sub slider
            do_action('eightstore_lite_homepage_sub_slider');

            //block below slider
            $eightstore_lite_category_promo_setting_category = get_theme_mod('es_category_promo_setting_category');
            if (!empty($eightstore_lite_category_promo_setting_category)) {
                ?>
                <section id="section-below-slider" class="mt-5">
                    <div class="store-wrapper">

                        <?php
                        $category_name = get_category($eightstore_lite_category_promo_setting_category)->name;
                        $loop = new WP_Query(array(
                            'cat' => $eightstore_lite_category_promo_setting_category,
                            'posts_per_page' => 4,
                            'order' => 'ASC'
                        ));
                        ?>
                        <h3 class="sale-off"><span><?php echo $category_name; ?></span></h3>
                        <div class="row wrapper-post">
                            <?php
                            if ($loop->have_posts()) {
                                $i = 1;
                                while ($loop->have_posts()) {
                                    $loop->the_post();
                                    ?>
                                    <div class="block-large col-md-4">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightstore-promo-large', false);
                                            ?>

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <img width="100%" src="<?php echo esc_url($image[0]); ?>"
                                                         alt="<?php the_title_attribute(); ?>"/>
                                                </div>

                                                <div class="block-title col-md-7"><?php the_title(); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </section>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.wrapper-post').slick({
                            slidesToShow: 3,
                            arrows: true,
                            dots: false,
                            nextArrow: '<div class="next-custom"><i class="fa fa-angle-right"></i></div>',
                            prevArrow: '<div class="pre-custom"><i class="fa fa-angle-left"></i></div>',
                            slidesToScroll: 1,
                            responsive: [
                                {
                                    breakpoint: 992,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: true,
                                        adaptiveHeight: true
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        infinite: true,
                                        adaptiveHeight: true
                                    }
                                }
                            ]
                        });
                    })
                </script>
                <?php
            }
            ?>
        </div>

        <?php
        //product section 1
        if (is_active_sidebar('widget-product-1')) {
            ?>
            <section id="section-product1" class='clear'>
                <div class="store-wrapper">
                    <?php dynamic_sidebar('widget-product-1'); ?>
                </div>
            </section>
            <?php
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
