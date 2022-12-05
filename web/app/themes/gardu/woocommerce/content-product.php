<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product);?>>

    <?php
/**
 * Hook: woocommerce_before_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
do_action('woocommerce_before_shop_loop_item');
echo '<div class="position-relative">';
/**
 * Hook: woocommerce_before_shop_loop_item_title.
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */

$newness_days = 30;
$created = strtotime($product->get_date_created());
if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
    echo '<p class="on-sale product-badge position-absolute p-2 fw-bold">' . esc_html__('Naujiena', 'woocommerce') . '</p>';
}

if (!$product->is_in_stock()) {
    echo '<p class="product-badge position-absolute p-2 fw-bold end-0">Neturime</p>';
}

do_action('woocommerce_before_shop_loop_item_title');
if ($product->is_type('variable')) {
    $percentages = array();

    // Get all variation prices
    $prices = $product->get_variation_prices();

    // Loop through variation prices
    foreach ($prices['price'] as $key => $price) {
        // Only on sale variations
        if ($prices['regular_price'][$key] !== $price) {
            // Calculate and set in the array the percentage for each variation on sale
            $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
        }
    }

    // print_r($prices);
    // We keep the highest value
    // $percentage = max($percentages) . '%';
    $percentage = '';

} else {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();

    if ($sale_price != 0 || !empty($sale_price)) {
        $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
        echo '<p class="sale-badge position-absolute p-2">' . $percentage . '</p>';
    } else {
    }

    if (get_field('product_status')) {
        echo '<p class="eshop-status position-absolute p-2 fw-bold end-0">Tik el. parduotuvėje.</p>';
    }

}
echo '</div>';

/**
 * Hook: woocommerce_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_product_title - 10
 */

do_action('woocommerce_shop_loop_item_title');

/**
 * Hook: woocommerce_after_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_rating - 5
 * @hooked woocommerce_template_loop_price - 10
 */
do_action('woocommerce_after_shop_loop_item_title');

/**
 * Hook: woocommerce_after_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_close - 5
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */
do_action('woocommerce_after_shop_loop_item');
?>
</li>