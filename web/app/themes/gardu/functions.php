<?php
include 'includes/billing_company.php';
add_theme_support('woocommerce');

add_action('admin_enqueue_scripts', 'load_admin_style');
function load_admin_style()
{
    wp_enqueue_style('select-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false, '1.0.0');
}

function my_enqueue()
{
    wp_enqueue_script('select2-custom-js', 'vendor/select2/dist/js/select2.min.js');
    wp_enqueue_script('jquery-admin', 'https://code.jquery.com/jquery-3.6.1.min.js');
}

// add_action('admin_enqueue_scripts', 'my_enqueue');

function custom_styles()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/dist/css/bootstrap.css');
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/dist/css/main.css');
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css');
    wp_enqueue_style('slick-add', get_template_directory_uri() . '/assets/dist/css/slick-add.css');

}
add_action('wp_enqueue_scripts', 'custom_styles');

function custom_scripts()
{

    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', '', '', true);
    wp_enqueue_script('jquery', '    https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', '', '', true);
    wp_enqueue_script('swiper-custom', get_template_directory_uri() . '/assets/dist/js/swiper.js', '', '', true);
    wp_enqueue_script('additional-js', get_template_directory_uri() . '/assets/dist/js/additional-js.js', '', '', true);
    wp_enqueue_script('bootstrap-min-js', get_template_directory_uri() . '/assets/dist/js/bootstrap.min.js', '', '', false);
    wp_enqueue_script('bootstrap-bundle-js', get_template_directory_uri() . '/assets/dist/js/bootstrap.bundl.min.js', '', '', false);
    wp_enqueue_script('jquery-custom', get_template_directory_uri() . '/assets/dist/js/jquery-custom.js', '', '', true);
    wp_enqueue_script('header', get_template_directory_uri() . '/assets/dist/js/header.js', '', '', true);
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', '', '', true);
    wp_enqueue_script('sweetalert', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js', '', '', false);
}

add_action('wp_enqueue_scripts', 'custom_scripts');

add_theme_support('custom-logo');

function addMenu()
{
    register_nav_menu('top-menu', __('Top Menu'));
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('bottom-menu', __('Bottom Menu'));
    register_nav_menu('recipes-menu', __('Receptų Menu'));
    register_nav_menu('footer-about', __('Apie Mus Footer'));
    register_nav_menu('footer-shop', __('Parduotuvė Footer'));

}
add_action('init', 'addMenu');

function mlnc_wp_nav_menu_objects($items, $args)
{
    // loop
    echo '<ul>';
    foreach ($items as $item) {
        // vars
        $icon = get_field('menu_icon', $item);
        echo '<li class="nav-link"><a class="d-flex align-items-center gap-2" href="' . $item->url . '" title="' . $item->title . '">';
        echo '<img src="' . $icon . '" width="20px"';
        echo '<span>' . $item->title . '</span>';
        echo '</a></li>';

    }
    echo '</ul>';
    // return
    return $items;

}

add_filter('wp_nav_menu_objects', 'mlnc_wp_nav_menu_objects', 10, 2);

function getSliderProducts($type, $product_id = null, $product_cat_id = null)
{
    ?>
<div class="woocommerce quick-sale">
    <ul class="products columns-1">
        <?php
if ($type == 'popular') {
        $args = array(
            'posts_per_page' => 12,
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        );
    } elseif ($type == 'new') {
        $args = array(
            'posts_per_page' => 12,
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        );
    } elseif ($type == 'sale') {
        $args = array(
            'posts_per_page' => 12,
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'order' => 'DESC',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ),
                array(
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ),
            ),
        );

    } elseif ($type = 'related') {
        $args = array(
            'posts_per_page' => 12,
            'post_type' => 'product',
            'post__not_in' => array($product_id),
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $product_cat_id,
                ),
            ),
        );

    }

    $loop = new WP_Query($args);

    ?>
        <div #swiperRef="" class="swiper productSwiper <?php
if ($type == 'popular') {
        echo 'productPopularSwiper';
    } elseif ($type == 'new') {
        echo 'productNewSwiper';
    } elseif ($type == 'sale') {
        echo 'productSaleSwiper';
    } elseif ($type == 'related') {
        echo 'productRelatedSwiper';
    }
    ?>">
            <div class="swiper-wrapper">
                <?php
if ($loop->have_posts()) {
        while ($loop->have_posts()): $loop->the_post();
            ?>
                <div class="swiper-slide">
                    <?php
    wc_get_template_part('content', 'product');
            ?>
                </div>
                <?php
    ?>
                <?php
endwhile;
    } else {
        echo __('Produktų šioje kategorijoje nėra.');
    }
    wp_reset_postdata();
    ?>
            </div>
        </div>
    </ul>
</div>
<?php
}

add_shortcode('slider-products', 'getSliderProducts');

add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text');
function woocommerce_custom_product_add_to_cart_text()
{
    return __('Į krepšelį', 'woocommerce');
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
function woocommerce_custom_single_add_to_cart_text()
{
    return __('Į krepšelį', 'woocommerce');
}

function add_image_insert_override($sizes)
{
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'add_image_insert_override');

function create_recipes_post_type()
{

    $args = array(
        'labels' => array(
            'name' => 'Receptai',
            'singular_name' => 'Receptai',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'publicly_queryable' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail', 'custom-fields'),
    );

    register_post_type('receptai', $args);
    register_taxonomy("categories", array("receptai"), array("hierarchical" => true, "label" => "Receptų kategorijos", "singular_label" => "Receptų kategorija", 'show_admin_column' => true, 'has_archive' => true, "rewrite" => array('slug' => 'receptu-kategorija', 'with_front' => false)));

}

add_action('init', 'create_recipes_post_type');

function mytheme_add_woocommerce_support()
{
    // add_theme_support( 'woocommerce' );

    add_theme_support('woocommerce', array(
        // 'thumbnail_image_width' => 150,
        // 'single_image_width' => 300,

        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 2,
            'max_rows' => 8,
            'default_columns' => 3,
            'min_columns' => 2,
            'max_columns' => 3,
        ),
    ));
}

// remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
// add_action('woocommerce_single_product_summary', 'woocommerce_show_product_thumbnails', 100);

// // Remove thumbnail
// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// // The sale tag because it's usually positioned over the image.
// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

function wp_register_sidebars()
{
    register_sidebar(array(
        'name' => 'shop_1',
        'id' => 'shop_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'wp_register_sidebars');

// function tg_include_custom_post_types_in_search_results($query)
// {
//     if ($query->is_main_query() && $query->is_search() && !is_admin()) {
//         $query->set('post_type', array('post', 'receptai'));
//     }
// }
// add_action('pre_get_posts', 'tg_include_custom_post_types_in_search_results');

function searchfilter($query)
{
    if ($query->is_search && !is_admin()) {
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
            if ($type == 'receptai') {
                $query->set('post_type', array('receptai'));
                if (isset($_GET['order-receptai'])) {
                    $order = $_GET['order-receptai'];
                    if ($order == 'ASC' || $order == 'DESC') {
                        $query->set('orderby', 'date');
                    } else {
                        if ($order == 'A-Z') {
                            $order = 'ASC';
                        } else {
                            $order = 'DESC';
                        }
                        $query->set('orderby', 'title');
                    }
                    $query->set('order', $order);
                }

                if (isset($_GET['cat_id'])) {
                    $cat = $_GET['cat_id'];

                    $taxquery = array(
                        array(
                            'taxonomy' => 'categories',
                            'field' => 'id',
                            'terms' => array($cat),
                        ),
                    );
                    if ($cat != 'all') {
                        $query->set('tax_query', $taxquery);
                    }

                }
            }
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'searchfilter');

add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter', 20);
function wcc_change_breadcrumb_delimiter($defaults)
{
    $defaults['delimiter'] = '&#65310;';
    return $defaults;
}

// add_action('woocommerce_before_add_to_cart_quantity', 'display_quantity_minus');
// function display_quantity_minus()
// {
//     echo '<div class="quantity-container"><div class="product-quantity d-flex"><button type="button" class="minus" >-</button>';
// }

// add_action('woocommerce_after_add_to_cart_quantity', 'display_quantity_plus');
// function display_quantity_plus()
// {
//     echo '<button type="button" class="plus" >+</button></div></div>';
// }

add_action('wp_footer', 'add_cart_quantity_plus_minus');
function add_cart_quantity_plus_minus()
{
    if (!is_product()) {
        return;
    }
    ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.wpcsb-product').on('click', 'button.plus, button.minus', function() {
        var qty = $(this).closest('.wpcsb-product').find('.qty');
        var val = parseFloat(qty.val());
        console.log(val);
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));
        if ($(this).is('.plus')) {
            if (max && (max <= val)) {
                qty.val(max);
                $('form .qty').val(max);
            } else {
                qty.val(val + step);
                $('form .qty').val(val + step);

            }
        } else {
            if (min && (min >= val)) {
                qty.val(min);
                $('form .qty').val(min);
            } else if (val > 1) {
                qty.val(val - step);
                $('form .qty').val(val - step);
            }
        }
    });
});
</script>
<?php
}

if (class_exists('WooCommerce')) {

    // add_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

}

// function replacing_template_loop_product_thumbnail()
// {

//     function wc_template_loop_product_replaced_thumb()
//     {

//     }
//     add_action('woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_replaced_thumb', 10);
// }

// add_action('woocommerce_init', 'replacing_template_loop_product_thumbnail');

add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text');
function wcc_change_breadcrumb_home_text($defaults)
{
    $defaults['home'] = 'Pagrindinis';
    return $defaults;
}

// add_filter('woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url');
// function woo_custom_breadrumb_home_url()
// {
//     return get_permalink(wc_get_page_id('shop'));
// }

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

function bbloomer_wc_product_cats_css_body_class($classes)
{
    global $product;
    if (is_product()) {
        if ($product->is_type('variable')) {
            $classes[] = 'product_variable';
        } else {
            $classes[] = 'product_simple';
        }
    }
    return $classes;
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_filter('woocommerce_product_tabs', 'my_remove_all_product_tabs', 100);

function my_remove_all_product_tabs($tabs)
{
    unset($tabs['description']);
    unset($tabs['additional_information']);
    return $tabs;
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
// add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

remove_action('woocommerce_single_product_summary',
    'woocommerce_template_single_add_to_cart', 30);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 29);

// function so_43922864_add_content()
// {
//     echo '<div class="top-qty">';
//     do_action('woocommerce_simple_add_to_cart');
//     echo '</div>';
// }
// add_action('woocommerce_single_product_summary', 'so_43922864_add_content', 25);

// function wc_remove_all_quantity_fields($return, $product)
// {
//     return true;
// }
// add_filter('woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2);

add_filter('woocommerce_get_price_html', 'lw_hide_variation_price', 10, 2);

function lw_hide_variation_price($v_price, $v_product)
{

    $v_product_types = array('variable');

    if (in_array($v_product->get_type(), $v_product_types) && !(is_shop())) {

        return '';

    }

// return regular price

    return $v_price;

}

add_filter('woocommerce_single_product_carousel_options', 'ud_update_woo_flexslider_options');

function ud_update_woo_flexslider_options($options)
{

    $options['directionNav'] = true;
    $options['draggable'] = true;

    return $options;
}

add_action('woocommerce_after_add_to_cart_quantity', 'mish_before_add_to_cart_btn');

function mish_before_add_to_cart_btn()
{
    global $product;
    echo '<div class="custom-price my-4 d-flex flex-column">';
    echo $product->get_price_html();

    echo '</div>';
}

function getLatestRecipes()
{

    global $post;

    $args = array(
        'post_type' => 'receptai',
        'posts_per_page' => 16,
        'order' => 'ASC',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()):
    ?>
<section class="recipes-section py-40">
    <div class="row max-width">
        <div class="col-12 d-flex justify-content-between">
            <h2>Siūlome išbandyti</h2>
            <div class="d-flex gap-4">
                <div class="d-flex justify-content-center align-items-center">
                    <svg class="swiper-button-prev-recipe swiper-navigation swiper-button-prev" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <svg class="swiper-button-next-recipe swiper-button-next" width="8" height="14" viewBox="0 0 8 14"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="row max-width mt-3">
        <div #swiperRef="" class="swiper recipesSwiper my-3">
            <div class="swiper-wrapper">
                <?php
while ($query->have_posts()): $query->the_post();
        $title = get_the_title();
        echo '<div class="swiper-slide">';
        if (has_post_thumbnail($post->ID)) {
            echo '<a href="' . get_permalink($post->ID) . '" title="' . esc_attr($post->post_title) . '">';
            echo '<img src="' . get_the_post_thumbnail_url() . '" width="100%" /> ';
            echo '</a>';
        }
        echo '<h2 class="mt-3 text-start">' . get_the_title() . '</h2>';
        echo '<h3 class="text-start">Autorius: ' . get_the_author() . '</h3>';
        ?>
            </div>
            <?php
endwhile;
    ?>
        </div>
    </div>
    </div>
    </div>
    <?php
endif;
}

add_shortcode('latest-recipes', 'getLatestRecipes');

// Single variable produccts pages - Sold out functionality
add_action('woocommerce_single_product_summary', 'replace_single_add_to_cart_button', 1);
function replace_single_add_to_cart_button()
{
    global $product;

    // For variable product types
    if ($product->is_type('variable')) {
        $is_soldout = true;
        foreach ($product->get_available_variations() as $variation) {
            if ($variation['is_in_stock']) {
                $is_soldout = false;
            }

        }
        if ($is_soldout) {
            remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
            add_action('woocommerce_single_variation', 'sold_out_button', 20);
        }
    }
}

// The sold_out button replacement
function sold_out_button()
{
    global $post, $product;

    ?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <?php
do_action('woocommerce_before_add_to_cart_quantity');

    woocommerce_quantity_input(array(
        'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
        'input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : $product->get_min_purchase_quantity(),
    ));

    do_action('woocommerce_after_add_to_cart_quantity');
    ?>
        <a
            class="single_sold_out_button button alt disabled wc-variation-is-unavailable"><?php _e("Sold Out", "woocommerce");?></a>
    </div>
    <?php
}

add_filter('woocommerce_get_availability', 'custom_get_stock', 1, 2);
function custom_get_stock($_product)
{
    global $product;
    if (!$product->is_in_stock()) {
        ?>
    <div class="quantity-container">
        <div class="product-quantity d-flex align-items-center gap-3">
            <button type="button" class="minus">-</button>

            <div class="quantity">
                <?php do_action('woocommerce_before_quantity_input_field');?>
                <input type="number" class="qty" id="" value="0" disabled />
                <?php do_action('woocommerce_after_quantity_input_field');?>
            </div>
            <button type="button" class="plus">+</button>
            <div>
                <span class="stock-left">
                    Šiuo metu prekės neturime.
                </span>
            </div>
            <?php

        ?>

        </div>
    </div>
    <div class="mt-3 out-of-stock-info">
        <p class="stock-left">Jeigu domina ši prekė, gali kreiptis:</p>
        <div class="contact-item d-flex justify-content-center justify-content-lg-start mt-3">
            <a class="gap-2 d-flex align-items-center" href="">
                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_71_423)">
                        <path
                            d="M3.31833 6.34885C4.63833 8.6553 6.765 10.5379 9.35917 11.7197L11.3758 9.9267C11.6233 9.70665 11.99 9.6333 12.3108 9.7311C13.3375 10.0326 14.4467 10.1957 15.5833 10.1957C16.0875 10.1957 16.5 10.5624 16.5 11.0106V13.855C16.5 14.3033 16.0875 14.67 15.5833 14.67C6.97583 14.67 0 8.46785 0 0.815C0 0.36675 0.4125 0 0.916667 0H4.125C4.62917 0 5.04167 0.36675 5.04167 0.815C5.04167 1.83375 5.225 2.81175 5.56417 3.72455C5.665 4.0098 5.59167 4.32765 5.335 4.55585L3.31833 6.34885Z"
                            fill="#222222" />
                    </g>
                    <defs>
                        <clipPath id="clip0_71_423">
                            <rect width="17" height="16" fill="#222222" />
                        </clipPath>
                    </defs>
                </svg>
                <span>+370 605 37 153</span>
            </a>
        </div>
        <div class="contact-item mt-3 text-center text-lg-start">
            <a class="gap-2  d-flex align-items-center" href="">
                <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.87889 0H15.1211C16.3704 0 17 0.59 17 1.79V10.21C17 11.4 16.3704 12 15.1211 12H1.87889C0.629629 12 0 11.4 0 10.21V1.79C0 0.59 0.629629 0 1.87889 0ZM8.495 8.6L15.231 3.07C15.4709 2.87 15.6608 2.41 15.361 2C15.0711 1.59 14.5414 1.58 14.1917 1.83L8.495 5.69L2.80835 1.83C2.45855 1.58 1.92887 1.59 1.63904 2C1.33921 2.41 1.5291 2.87 1.76896 3.07L8.495 8.6Z"
                        fill="#222222" />
                </svg>
                <span>info@gardugardu.lt</span>
            </a>
        </div>
    </div>
    <div class="custom-price my-4 d-flex flex-column">
        <?php if ($product->get_sale_price()) {
            ?>
        <del aria-hidden="true"><span
                class="woocommerce-Price-amount amount"><bdi><?php echo $product->get_regular_price(); ?>&nbsp;<span
                        class="woocommerce-Price-currencySymbol">€</span></bdi></span></del>
        <?php }
        ?>
        <ins><span class="woocommerce-Price-amount amount"><bdi><?php echo ($product->get_sale_price()) ? $product->get_sale_price() : $product->get_regular_price(); ?>&nbsp;<span
                        class="woocommerce-Price-currencySymbol">€</span></bdi></span></ins>
    </div>
    <div class="mt-4"><button class="btn out-of-stock-cart cart-btn" disabled>Į krepšelį</button></div>
    <?php
}

}

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();
    ?>
    <a class="cart-customlocation d-flex align-items-center gap-2" href="<?php echo wc_get_cart_url(); ?>"
        title="<?php _e('Krepšelis');?>">
        <?php
$cart_image = wp_get_attachment_image_src(14);
    if ($cart_image): ?>
        <img src="<?php echo wp_get_attachment_image_url(14); ?>" alt="" width="20px">
        <span><?php echo WC()->cart->get_cart_total(); ?>
            <?php endif;?>
    </a>
    <?php
$fragments['a.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields');
function addBootstrapToCheckoutFields($fields)
{
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group';

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}

add_filter('woocommerce_save_account_details_required_fields', 'change_class');

function change_class($fields)
{
    $fields['account_email']['class'][0] = 'form-control';

    return $fields;
}

if (!function_exists('getRecipeProducts')):

    add_filter('acf/load_field/name=product', 'getRecipeProducts');

    function getRecipeProducts($field)
{
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => array('ID' => 'ASC'),

        );
        ?>

    <?php $all_products = get_posts($args);
        wp_reset_query();

        $field['choices'] = array();

        foreach ($all_products as $key => $product) {
            // $field['choices'][$product->post_title] = $product->post_title;
            $field['choices'][$key] = $product->post_title . ' | ' . $product->ID;
            // $field['choices'][$key] = $product->post_title . ' | ' . $product->ID;

        }
        return $field;
    }
endif;

function splitTitle($title)
{
    $full_title = '';
    $split_title = explode(' ', $title);
    if (count($split_title) > 1) {
        foreach ($split_title as $key => $title_new) {
            if ($key === array_key_first($split_title)) {
                $full_title .= '<span class="first-letter">' . $title_new . '</span> ';
            } elseif ($key === array_key_last($split_title)) {
                $full_title .= $title_new;
            } else {
                $full_title .= $title_new . ' ';
            }
        }
    } else {
        return '<span class="first-letter">' . $title . '</span>';
    }

    return $full_title;
}

add_action('wp_footer', 'cart_update_qty_script', 1000);
function cart_update_qty_script()
{
    if (is_cart()):
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Enable update cart button upon successful ajax call
        $(document).ajaxSuccess(function() {
            $('div.woocommerce > form input[name="update_cart"]').prop('disabled', false);
        });
        // Enable update cart button on initial page load
        $('div.woocommerce > form input[name="update_cart"]').prop('disabled', false);

        // Update cart when quantity pulldown is changed
        $('body').on('change', '.qty', function() {
            var quantity_selected = $(".qty option:selected").val();
            $('#product_quantity').val(quantity_selected);

            jQuery("[name='update_cart']").removeAttr('disabled');
            jQuery("[name='update_cart']").trigger("click");

        });

    });
    </script>
    <?php
endif;
}

function remove_from_cart()
{

    $cart = WC()->cart->get_cart();

    if (isset($_GET['remove_item'])) {

        ?>
    <script type="text/javascript">
    </script>

    <?php

    }
}

add_action('woocommerce_cart_updated', 'remove_from_cart');

add_action('wp_footer', 'ajax_fetch');
function ajax_fetch()
{
    ?>
    <script type="text/javascript">
    function fetch() {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            data: {
                action: 'data_fetch',
                s: jQuery('#keyword').val()
            },
            success: function(data) {
                jQuery('#datafetch').html(data);
            }
        });
        document.getElementById("datafetch").style.display = "block";
    }
    </script>

    <?php }

add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');
function data_fetch()
{
    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field' => 'name',
        'operator' => 'NOT',
    );
    $query = new WC_Product_Query(
        array(
            'tax_query' => $tax_query,
            'posts_per_page' => 5,
            's' => esc_attr($_POST['s']),
            'post_type' => 'post',
        )
    );
    $products = $query->get_products();
    if ($products) {
        foreach ($products as $product) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');
            echo '<div class="product-item d-flex align-items-center py-3"><img src="' . $image[0] . '"/><a href=" ' . get_permalink($product->id) . ' "> ' . $product->get_name() . ' </a></div>';
        }
    }
    wp_reset_postdata();
    die();
}

function getTransliterator(string $string)
{
    $converted = transliterator_transliterate('Any-Latin; Latin-ASCII;', $string);
    return $converted;
}

/* SYNC */

require WP_CONTENT_DIR . '/themes/gardu/includes/EuroSkaitaIntegration.php';
add_action('delete_xml_files', 'deleteFiles');

add_action('woocommerce_order_status_processing', 'generateOrderXml');
// TODO after order status gets paid
// code below for testing (generate file when in admin)
// add_action('init', 'admin_only');

// function admin_only()
// {

//     if (is_admin()) {
//         generateOrderXml(17517);
//     }
// }

function checkFtp($host, $username, $password, $port = 21, $timeout = 10)
{
    $con = ftp_connect($host, $port, $timeout);
    if (false === $con) {
        throw new Exception('Unable to connect to FTP Server.');
    }
    $loggedIn = ftp_login($con, $username, $password);
    ftp_pasv($con, true);
    //ftp_close($con);
    if (true === $loggedIn) {
        return $con;
    } else {
        throw new Exception('Unable to log in.');
    }
}
function XML2Array(SimpleXMLElement $parent)
{
    $array = array();

    foreach ($parent as $name => $element) {
        ($node = &$array[$name])
        && (1 === count($node) ? $node = array($node) : 1)
        && $node = &$node[];

        $node = $element->count() ? XML2Array($element) : trim($element);
    }

    return $array;
}

add_action("wp_ajax_cron_run_import", "cron_run_import");
add_action("wp_ajax_nopriv_cron_run_import", "cron_run_import");

function cron_run_import()
{
    global $wpdb;

    $list = new PMXI_Import_List();
    $templates = new PMXI_Template_List();
    $importtable_name = $list->getTable();
    $templatettable_name = $templates->getTable();
    $cron_job_key = PMXI_Plugin::getInstance()->getOption('cron_job_key');

    $host = 'gardugardu.lt';
    $password = 'BcnHHDTK56UEFHTY';
    $username = 'atidavimas@gardugardu.lt';

    try {
        $con = checkFtp($host, $username, $password);
    } catch (Exception $e) {
        $result = $e->getMessage();
    }

    if ($con) {

        $file_list = ftp_nlist($con, "/export/");
        $date = date('Ymd');
        $filetyps = array('Products' => 'item', 'Prices' => 'item', 'ItemsBalance' => 'item', 'Invoice' => '', 'Stock_Purchase' => 'item');
        $templates = array('Products' => 'Products v2', 'Prices' => 'Prices v2', 'ItemsBalance' => 'Items v2', 'Invoice' => 'Invoice', 'Stock_Purchase' => 'Stocks v2');
        $upload_dir = wp_upload_dir();
        foreach ($file_list as $k => $file) {

            if ($file != '/export/.' && $file != '/export/..') {

                //&& strpos($file, $type) !== false
                if (strpos($file, $date) !== false) {

                    $type = '';

                    foreach ($filetyps as $key => $tag) {

                        if (strpos($file, $key) !== false) {$type = $key;}

                    }

                    if ($type && $templates[$type]) {

                        if ($type == 'Invoice') {
                            $local_file = $upload_dir['basedir'] . '/wpallimport/files/' . basename($file);
                            if (ftp_get($con, $local_file, $file, FTP_BINARY)) {

                                $data = file_get_contents($local_file);
                                $xml = simplexml_load_string($data);
                                $array = XML2Array($xml);
                                $array = array($xml->getName() => $array);
                                foreach ($array['INVOICE'] as $k => $v) {
                                    $parts = explode('-', $v['order_nr']);
                                    $orderid = $parts[0];
                                    $order = new WC_Order($orderid);
                                    $order->update_status('completed');
                                }

                            }

                        } else {
                            $results = $wpdb->get_results("SELECT * FROM $templatettable_name where name='" . $templates[$type] . "'");
                            if (!empty($results)) {
                                $options = $results[0]->options;

                                $local_file = $upload_dir['basedir'] . '/wpallimport/files/' . basename($file);
                                if (ftp_get($con, $local_file, $file, FTP_BINARY)) {

                                    //echo "Successfully written to $local_file\n";

                                    $doc = new DOMDocument();
                                    $doc->load($local_file, LIBXML_PARSEHUGE);
                                    $xp = new DOMXPath($doc);
                                    $count = $xp->evaluate('count(//' . $filetyps[$type] . ')');

                                    $wpdb->insert($importtable_name, array(
                                        'name' => basename($file),
                                        'path' => '/wpallimport/files/' . basename($file),
                                        'type' => 'file',
                                        'xpath' => '/' . $filetyps[$type],
                                        'options' => $options,
                                        'root_element' => $filetyps[$type],
                                        'count' => $count,
                                        'registered_on' => date('Y-m-d H:i:s'),
                                    ));

                                    $lastid = $wpdb->insert_id;
                                    $trigerurl = get_site_url() . "/wp-load.php?import_key=" . $cron_job_key . "&import_id=" . $lastid . "&action=trigger";
                                    $lines = file($trigerurl);
                                    print_r($lines);
                                    /*$ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $trigerurl);
                                    curl_setopt($ch, CURLOPT_HEADER, 0);
                                    $output=curl_exec($ch);
                                    print_r($output);
                                    curl_close($ch);*/
                                    echo "<br>" . $trigerurl;

                                } else {

                                    echo "<br>Download Failed " . $file;

                                }

                            }
                        }

                    }

                }

            }

        }

    } else {
        print 'fail';
    }

    echo 'cron_run_import';exit;

}

add_action("wp_ajax_cron_run_proccesing", "cron_run_proccesing");
add_action("wp_ajax_nopriv_cron_run_proccesing", "cron_run_proccesing");

function cron_run_proccesing()
{
    global $wpdb;

    $list = new PMXI_Import_List();
    $importtable_name = $list->getTable();

    $cron_job_key = PMXI_Plugin::getInstance()->getOption('cron_job_key');
    set_time_limit(0);
    $results = $wpdb->get_results("SELECT * FROM " . $importtable_name . " where triggered='1' ");

    if (!empty($results)) {

        echo '<pre>';

        foreach ($results as $k => $val) {
            print_r($val);
            $lastid = $val->id;
            echo $proccesurl = get_site_url() . "/wp-load.php?import_key=" . $cron_job_key . "&import_id=" . $lastid . "&action=processing";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $proccesurl);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $output = curl_exec($ch);
            print_r($output);
//mail("jramakrishna122@gmail.com","cron_run_proccesing",$proccesurl.print_r($output,true));
            curl_close($ch);
//http://localhost/wordpress/wp-load.php?import_key=fu6s2k5&import_id=13&action=processing
        }
        echo '</pre>';

    }

    echo 'cron_run_proccesing';exit;

}

add_action("wp_ajax_cron_run_stock_purchases", "cron_run_stock_purchases");
add_action("wp_ajax_nopriv_cron_run_stock_purchases", "cron_run_stock_purchases");

function cron_run_stock_purchases()
{
    global $wpdb;

    $list = new PMXI_Import_List();
    $templates = new PMXI_Template_List();
    $importtable_name = $list->getTable();
    $templatettable_name = $templates->getTable();
    $cron_job_key = PMXI_Plugin::getInstance()->getOption('cron_job_key');

    $host = 'gardugardu.lt';
    $password = 'BcnHHDTK56UEFHTY';
    $username = 'atidavimas@gardugardu.lt';

    try {
        $con = checkFtp($host, $username, $password);
    } catch (Exception $e) {
        $result = $e->getMessage();
    }

    if ($con) {

        $file_list = ftp_nlist($con, "/export/");
        $date = date('Ymd');

        $filetyps = array('Stock_Purchase' => 'item');
        $templates = array('Stock_Purchase' => 'Stocks v2');
        $upload_dir = wp_upload_dir();
        foreach ($file_list as $k => $file) {

            if ($file != '/export/.' && $file != '/export/..') {

                //&& strpos($file, $type) !== false
                if (strpos($file, $date) !== false) {

                    $type = '';

                    foreach ($filetyps as $key => $tag) {
                        if (strpos($file, $key) !== false) {$type = $key;}
                    }

                    if ($type && $templates[$type]) {

                        $results = $wpdb->get_results("SELECT * FROM $templatettable_name where name='" . $templates[$type] . "'");
                        if (!empty($results)) {
                            $options = $results[0]->options;

                            $local_file = $upload_dir['basedir'] . '/wpallimport/files/' . basename($file);
                            if (ftp_get($con, $local_file, $file, FTP_BINARY)) {

                                $doc = new DOMDocument();
                                $doc->load($local_file, LIBXML_PARSEHUGE);
                                $xp = new DOMXPath($doc);
                                $count = $xp->evaluate('count(//' . $filetyps[$type] . ')');

                                $wpdb->insert($importtable_name, array(
                                    'name' => basename($file),
                                    'path' => '/wpallimport/files/' . basename($file),
                                    'type' => 'file',
                                    'xpath' => '/' . $filetyps[$type],
                                    'options' => $options,
                                    'root_element' => $filetyps[$type],
                                    'count' => $count,
                                    'registered_on' => date('Y-m-d H:i:s'),
                                ));

                                $lastid = $wpdb->insert_id;
                                $trigerurl = get_site_url() . "/wp-load.php?import_key=" . $cron_job_key . "&import_id=" . $lastid . "&action=trigger";
                                $lines = file($trigerurl);
                                print_r($lines);
                                echo "<br>" . $trigerurl;

                            } else {

                                echo "<br>Download Failed " . $file;

                            }

                        }

                    }

                }

            }

        }

    } else {
        print 'fail';
    }

    echo 'cron_run_import';exit;

}

add_action("wp_ajax_cron_run_invoice", "cron_run_invoice");
add_action("wp_ajax_nopriv_cron_run_invoice", "cron_run_invoice");

function cron_run_invoice()
{
    global $wpdb;

    $list = new PMXI_Import_List();
    $templates = new PMXI_Template_List();
    $importtable_name = $list->getTable();
    $templatettable_name = $templates->getTable();

    $host = 'gardugardu.lt';
    $password = 'BcnHHDTK56UEFHTY';
    $username = 'atidavimas@gardugardu.lt';

    try {
        $con = checkFtp($host, $username, $password);
    } catch (Exception $e) {
        $result = $e->getMessage();
    }

    if ($con) {

        $file_list = ftp_nlist($con, "/export/");
        $date = date('Ymd');

        $filetyps = array('Invoice' => 'INVOICE');
        $upload_dir = wp_upload_dir();
        foreach ($file_list as $k => $file) {
            if ($file != '/export/.' && $file != '/export/..') {
                //&& strpos($file, $type) !== false
                if (strpos($file, $date) !== false) {

                    $type = '';

                    foreach ($filetyps as $key => $tag) {
                        if (strpos($file, $key) !== false) {$type = $key;}
                    }

                    if ($type == 'Invoice') {

                        $local_file = $upload_dir['basedir'] . '/wpallimport/files/' . basename($file);
                        if (ftp_get($con, $local_file, $file, FTP_BINARY)) {

                            $data = file_get_contents($local_file);
                            $xml = simplexml_load_string($data);
                            $array = XML2Array($xml);
                            $array = array($xml->getName() => $array);
                            foreach ($array['INVOICE'] as $k => $v) {
                                $parts = explode('-', $v['order_nr']);
                                $orderid = $parts[0];
                                echo $orderid . '<br>';
                                $order = new WC_Order($order_id);
                                $order->update_status('completed');

                            }

                        }

                    }

                }

            }

        }

    } else {
        print 'fail';
    }

    echo 'cron_run_invoice';exit;

}