<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop');?>
<?php
global $post, $product;
?>
<style>
.swiper-button-prev:not(.swiper-button-disabled),
.swiper-button-next:not(.swiper-button-disabled) {
    background: url('<?php echo wp_get_attachment_image_url(108); ?>') no-repeat;
}

.single-product-main .flex-next,
.single-product-main .flex-prev {
    display: block;
    height: 36px;
    text-indent: -99999em;
    width: 36px;
    overflow: hidden;
    background-size: cover !important;
}

.single-product-main .flex-next {
    background: url('<?php echo wp_get_attachment_image_url(313); ?>') no-repeat;
}

.single-product-main .flex-prev {
    background: url('<?php echo wp_get_attachment_image_url(312); ?>') no-repeat;
}
</style>
<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
// echo '<div class="max-width">';
do_action('woocommerce_before_main_content');
// echo '</div>';
?>

<?php while (have_posts()): ?>
<?php

echo '<div class="max-width single-product-main">'; ?>
<?php the_post();?>
<?php wc_get_template_part('content', 'single-product');?>


<?php $terms = get_the_terms($product->get_id(), 'product_cat');
foreach ($terms as $term) {
    $product_cat_id = $term->term_id;
    break;
}

$product_id = $product->get_id();

?>

<?php endwhile; // end of the loop. ?>

<?php echo '</div>'; ?>

<section class="pb-40">
    <div class="row info-select py-4">
        <div class="col-12 d-flex gap-5 max-width align-items-center">
            <a class="about-link ">Apie</a>
            <a class="specifications-link ">Specifikacijos</a>
        </div>
    </div>
    <div class=" row py-4 max-width about-info">
        <div class="col col-12 col-md-2">
            <p class="fw-bold">Apie</p>
        </div>
        <div class="col col-12 col-md-10">
            <p><?php the_content();?></p>
        </div>
    </div>
    <div class="row py-4 max-width specifications-info">
        <div class="col col-12 col-md-2">
            <p class="fw-bold">Specifikacijos</p>
        </div>
        <div class="col col-12 col-md-10">
            <?php

echo '<ul>';
// Loop through WooCommerce registered product attributes
foreach (wc_get_attribute_taxonomies() as $values) {
    // Get the array of term names for each product attribute
    $term_names = get_terms(array('taxonomy' => 'pa_' . $values->attribute_name, 'fields' => 'names'));
    echo '<li class="pb-3"><strong>' . $values->attribute_label . '</strong>: ' . implode(', ', $term_names);
}
echo '</ul>'; ?>
        </div>
    </div>
</section>




<!-- <section>
    <div class="row">
        <div class="col col-6">

        </div>
        <div class="col col-6">

            <div class="slider slider-for">
                <?php //foreach ($attachment_ids as $attachment_id) {?>
                <div>
                    <img src="<?php //echo wp_get_attachment_url($attachment_id); ?>" alt="" width="100%">
                </div>
                <?php //}?>
            </div>
            <div class="slider slider-nav">
                <?php// foreach ($attachment_ids as $attachment_id) {?>
                <div>
                    <img src="<?php// echo wp_get_attachment_url($attachment_id); ?>" alt="" width="100%">
                </div>
                <?php// }?>
            </div>

        </div>

    </div>



</section> -->

<section class="light-background py-40">
    <div class="row">
        <div class="col-12">
            <?php echo do_shortcode('[latest-recipes]') ?>
        </div>
    </div>
</section>
<section class="light-background product-section">
    <div class="row max-width mt-3">
        <div class="col-12 d-flex justify-content-between">
            <h2><span class="first-letter">Panašūs</span> produktai</h2>
            <div class="d-flex gap-4 related-nav">
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-related-swiper-button-prev" class="swiper-button-prev swiper-navigation" width="8"
                        height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-related-swiper-button-next" class="swiper-button-next" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <?php
getSliderProducts('related', $product_id, $product_cat_id);?>
        </div>
    </div>
</section>

<?php

$terms = get_the_terms($post->ID, 'product_cat');
foreach ($terms as $term) {
    if ($term->slug == 'prekes-tik-atsiemimui-sandelyje-vilniuje') {
        ?>
<script>
swal({
    title: "Dėmesio",
    text: "Šis produktas produktas gali būti atsiimtas tik Vilniuje",
    type: "warning",
    icon: "warning",
    buttons: {
        confirm: {
            text: 'Supratau',
            color: "#FF8200",
        },
    },
})
</script>
<?php
}
}

?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
?>
<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */