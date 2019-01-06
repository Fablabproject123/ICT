<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<div class="my-3">
    <label for=""><b>Giá:</b> </label>
    <?php if ( $product->get_price() == 0 || empty($product->get_price()) ) : ?>
        <div class="text"><?php _e( 'Liên hệ', 'eightstore-lite' ) ?></div>
    <?php else : ?>
        <span class="price"><?php echo $product->get_price_html(); ?></span>
    <?php endif; ?>
</div>


