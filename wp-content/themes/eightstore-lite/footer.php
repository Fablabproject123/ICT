<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package 8Store Lite
 */

?>

</div><!-- #content -->
<div class="clear"></div>
<footer id="colophon" class="site-footer" role="contentinfo">
    <?php

    if (is_active_sidebar('footer-2')) {
        ?>
        <section id="section-footer" class="clear">
            <div class="container">
                <div class="store-wrapper">
                    <div class="row">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
    <div class="store-footer">
        <div class="store-wrapper">
            <div class="footer-copyrt">
                <div class="site-info">
                    <?php
                    if (get_theme_mod('footer_copyright_text') && get_theme_mod('footer_copyright_text') != "") {
                        echo wp_kses_post(get_theme_mod('footer_copyright_text'));
                    } ?>

                </div><!-- .site-info -->
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
<div id="es-top"></div>
<?php wp_footer(); ?>

</body>
</html>
