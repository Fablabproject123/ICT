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
		<?php
		//load slider
		do_action('eightstore_lite_homepage_slider'); 
		
		//block below slider
		$eightstore_lite_category_promo_setting_category = get_theme_mod('es_category_promo_setting_category');
		if(!empty($eightstore_lite_category_promo_setting_category)){
			?>
			<section id="section-below-slider" class="clear">
				<div class="store-wrapper">
					<?php
					$loop = new WP_Query(array(
						'cat' => $eightstore_lite_category_promo_setting_category,
						'posts_per_page' => 4,
						'order' => 'ASC' 
						));
					if($loop->have_posts()) { 
						$i=1;
						while($loop->have_posts()) {
							$loop-> the_post();
							if($i==1 || $i==4){
								?>
								<div class="block-large">
									<a href="<?php the_permalink(); ?>">
										<?php
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eightstore-promo-large', false );
										?>
										<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
										<div class="block-title"><?php the_title(); ?></div>
									</a>
								</div>
								<?php 
							}
							else
							{
								if($i==2){ ?><div class="small-wrap"><?php }
									?>
								<div class="block-small">
									<a href="<?php the_permalink(); ?>">
										<?php
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eightstore-promo-small', false );
										?>
										<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
										<div class="block-title"><?php the_title(); ?></div>
									</a>
								</div>
								<?php 
								if($i==3){ ?></div><?php }
							}
						$i++;
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	}
	?>
	<?php
		//product section 1
	if(is_active_sidebar('widget-product-1')){
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
