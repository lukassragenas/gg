<?php
/**
 * Custom Loop Add to Cart.
 *
 * Template with quantity and ajax.
 */

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly.

global $product;
?>

<?php if (!$product->is_in_stock()): ?>

<a href="<?php echo apply_filters('out_of_stock_add_to_cart_url', get_permalink($product->id)); ?>"
    class="button"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Read More', 'woocommerce')); ?></a>

<?php else: ?>

<?php
$link = array(
    'url' => '',
    'label' => '',
    'class' => '',
);

switch ($product->product_type) {
    case "variable":
        $link['url'] = apply_filters('variable_add_to_cart_url', get_permalink($product->id));
        $link['label'] = apply_filters('variable_add_to_cart_text', __('Select options', 'woocommerce'));
        break;
    case "grouped":
        $link['url'] = apply_filters('grouped_add_to_cart_url', get_permalink($product->id));
        $link['label'] = apply_filters('grouped_add_to_cart_text', __('View options', 'woocommerce'));
        break;
    case "external":
        $link['url'] = apply_filters('external_add_to_cart_url', get_permalink($product->id));
        $link['label'] = apply_filters('external_add_to_cart_text', __('Read More', 'woocommerce'));
        break;
    default:
        if ($product->is_purchasable()) {
            $link['url'] = apply_filters('add_to_cart_url', esc_url($product->add_to_cart_url()));
            $link['label'] = apply_filters('add_to_cart_text', __('Add to cart', 'woocommerce'));
            $link['class'] = apply_filters('add_to_cart_class', 'add_to_cart_button');
        } else {
            $link['url'] = apply_filters('not_purchasable_url', get_permalink($product->id));
            $link['label'] = apply_filters('not_purchasable_text', __('Read More', 'woocommerce'));
        }
        break;
}

// If there is a simple product.
if ($product->product_type == 'simple') {
    ?>
<form action="<?php echo esc_url($product->add_to_cart_url()); ?>" class="cart" method="post"
    enctype="multipart/form-data">
    <?php
// Displays the quantity box.
    woocommerce_quantity_input();

    // Display the submit button.
    echo sprintf('<button type="submit" data-product_id="%s" data-product_sku="%s" data-quantity="1" class="%s button product_type_simple">%s</button>', esc_attr($product->id), esc_attr($product->get_sku()), esc_attr($link['class']), esc_html($link['label']));
    ?>
</form>
<?php
} elseif ($product->product_type == 'variable') {
    ?>
<form class="variations_form cart"
    action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
    method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>"
    data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok.   ?>">
    <?php do_action('woocommerce_before_variations_form');?>

    <?php if (empty($available_variations) && false !== $available_variations): ?>
    <p class="stock out-of-stock">
        <?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?>
    </p>
    <?php else: ?>
    <table class="variations" cellspacing="0" role="presentation">
        <tbody>
            <?php foreach ($attributes as $attribute_name => $options): ?>
            <tr>
                <th class="label"><label
                        for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); // WPCS: XSS ok.   ?></label>
                </th>
                <td class="value">
                    <?php
wc_dropdown_variation_attribute_options(
        array(
            'options' => $options,
            'attribute' => $attribute_name,
            'product' => $product,
        )
    );
    echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
    ?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php do_action('woocommerce_after_variations_table');?>

    <div class="single_variation_wrap">
        <?php
/**
     * Hook: woocommerce_before_single_variation.
     */
    do_action('woocommerce_before_single_variation');

    /**
     * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
     *
     * @since 2.4.0
     * @hooked woocommerce_single_variation - 10 Empty div for variation data.
     * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
     */
    do_action('woocommerce_single_variation');

    /**
     * Hook: woocommerce_after_single_variation.
     */
    do_action('woocommerce_after_single_variation');
    ?>
    </div>
    <?php endif;?>

    <?php do_action('woocommerce_after_variations_form');?>
</form>
<?php
} else {
    echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url($link['url']), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr($link['class']), esc_attr($product->product_type), esc_html($link['label'])), $product, $link);
}

?>

<?php endif;?>