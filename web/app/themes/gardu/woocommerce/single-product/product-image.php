<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;
$attachment_ids = $product->get_gallery_image_ids();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>"
    data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <?php
$html = '';

if ($post_thumbnail_id) {
    ?>
    <div class="slider slider-for">

        <?php
if ($attachment_ids) {
        ?> <div><img src="<?php echo $image[0]; ?>" alt="" width="100%"> </div> <?php

        foreach ($attachment_ids as $attachment_id) {?>
        <div>
            <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="" width="100%">
        </div>
        <?php }
    } else {
        ?> <img src="<?php echo $image[0]; ?>"> <?php
}?>
    </div>

    <?php
} else {
    ?>
    <?php
}
?>
    <style>
    .slider-for .slick-slide {
        height: 400px !important;
    }

    .slider-for {
        margin-bottom: 15px !important;
    }

    .slick-slider {
        margin: 0;
    }

    .slider-nav .slick-slide {
        height: 130px !important;
        padding: 0 25px !important;
    }

    .slider-nav img {
        border-radius: 8px !important;
        height: 130px !important;
        object-fit: contain !important;
        cursor: pointer;
        transition: .5s;

    }

    .slider-nav img:hover {
        opacity: .7;
        transition: .5s;
    }

    .slick-next {
        background: url('<?php echo wp_get_attachment_image_url(313); ?>') no-repeat;
        background-size: cover !important;
        width: 36px;
        height: 36px;
        /* right: 0 !important; */
    }

    .slick-prev {
        background: url('<?php echo wp_get_attachment_image_url(312); ?>') no-repeat;
        background-size: cover !important;
        width: 36px;
        height: 36px;
        /* left: 0 !important; */
    }

    .slick-next:before {
        content: '' !important;
    }

    .slick-prev:before {
        content: '' !important;

    }


    .slick-next:hover,
    .slick-next:focus {
        background: url('<?php echo wp_get_attachment_image_url(313); ?>') no-repeat;
    }

    .slick-prev:hover,
    .slick-prev:focus {
        background: url('<?php echo wp_get_attachment_image_url(312); ?>') no-repeat;
    }

    .slick-track {
        margin-left: 0px !important;
    }

    .info-select .active-info {
        font-weight: 700 !important;
    }


    @media only screen and (max-width: 550px) {
        .slider-for .slick-slide {
            height: 245px !important;
        }

        .slick-slide img {
            height: 245px !important;
        }

        .slider-nav img {
            height: 60px !important;
        }

        .slick-next,
        .slick-prev {
            top: 30px !important;
            width: 20px !important;
            height: 20px !important;
        }

        .slick-next {
            right: -10px !important;
        }

        .slick-prev {
            left: -10px !important;
        }
    }
    </style>
    <div class="slider slider-nav">
        <?php
if ($attachment_ids) {
    ?> <img src="<?php echo $image[0]; ?>" alt="" width="100%"> <?php
foreach ($attachment_ids as $attachment_id) {?>
        <div>
            <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="" width="100%">
        </div>
        <?php
}
}
?>
    </div>

    <?php
echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

// do_action('woocommerce_product_thumbnails');
if ($product->product_type == 'simple') {
    do_action('woocommerce_simple_add_to_cart');
} elseif ($product->product_type == 'variable') {
    do_action('woocommerce_variable_add_to_cart');
}

?>
</div>