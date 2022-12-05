<!doctype html>
<html lang="<?php echo get_locale() ?>">

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|');?></title>
    <?php wp_head();?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!-- <meta name="facebook-domain-verification" content="r20y6n3e43cp2ufjmlg7um1qx2t9ty" /> -->
</head>

<body <?php body_class();?>>
    <?php
$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations['main-menu'];

?>
    <div class="header">

        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <?php
if ($menuID) {
    echo '<ul>';
    $primaryNav = wp_get_nav_menu_items($menuID);
    foreach ($primaryNav as $navItem) {
        echo '<li class="nav-item p-3" style="width:100% !important"><a href="' . $navItem->url . '" title="' . $navItem->title . '" class="active">' . $navItem->title . '</a></li>';
    }
    $menuLocations = get_nav_menu_locations();
    $menuID = $menuLocations['top-menu'];
    $primaryNav = wp_get_nav_menu_items($menuID);
    if ($menuID) {
        foreach ($primaryNav as $navItem) {
            echo '<li class="nav-item p-3" style="width:100% !important"><a href="' . $navItem->url . '" title="' . $navItem->title . '" class="active">' . $navItem->title . '</a></li>';
        }
    }
    echo '</ul>';
}?>
        </div>


        <div class="row top-bar align-items-center max-width py-2 d-none d-lg-flex">
            <div class="col col-6">
                <div class="row">
                    <div class="col-12 d-flex gap-5 left-top">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo wp_get_attachment_image_url(15); ?>" alt="" width="16px">
                            <span>
                                <?php echo get_field('working_hours', 492) ? get_field('working_hours', 492) : '' ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 phone-number">
                            <a
                                href="tel:<?php echo get_field('phone_number', 492) ? get_field('phone_number', 492) : '' ?>">
                                <svg xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
                                    width="17" height="17" viewBox="0 0 17 17" fill="none">
                                    <g clip-path="url(#clip0_71_300)">
                                        <path
                                            d="M3.31833 6.84885C4.63833 9.1553 6.765 11.0379 9.35917 12.2197L11.3758 10.4267C11.6233 10.2066 11.99 10.1333 12.3108 10.2311C13.3375 10.5326 14.4467 10.6957 15.5833 10.6957C16.0875 10.6957 16.5 11.0624 16.5 11.5106V14.355C16.5 14.8033 16.0875 15.17 15.5833 15.17C6.97583 15.17 0 8.96785 0 1.315C0 0.86675 0.4125 0.5 0.916667 0.5H4.125C4.62917 0.5 5.04167 0.86675 5.04167 1.315C5.04167 2.33375 5.225 3.31175 5.56417 4.22455C5.665 4.5098 5.59167 4.82765 5.335 5.05585L3.31833 6.84885Z"
                                            fill="#222222" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_71_300">
                                            <rect width="16" height="16" fill="white" transform="translate(0 0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>
                                    <?php echo get_field('phone_number', 492) ? get_field('phone_number', 492) : '' ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-6">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end gap-5">
                        <div class="d-flex align-items-center">

                            <a class="cart-customlocation d-flex align-items-center gap-2"
                                href="<?php echo home_url() . '/krepselis'; ?>" title="<?php _e('Krepšelis');?>">
                                <?php
$cart_image = wp_get_attachment_image_src(14);
if ($cart_image): ?>
                                <img src="<?php echo wp_get_attachment_image_url(14); ?>" alt="" width="20px">
                                <span><?php echo WC()->cart->get_cart_total(); ?>
                                    <?php endif;?>
                            </a>
                        </div>
                        <?php $user_img = wp_get_attachment_image_url(16);?>
                        <a class="d-flex justify-content-center align-items-center gap-2"
                            href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                            title="<?php _e('My Account', 'woothemes');?>">
                            <img src="<?php echo $user_img ?>" alt="" width="22px">
                            <span>
                                <?php if (is_user_logged_in()) {?>
                                <?php $current_user = wp_get_current_user();?>
                                <?php echo $current_user->display_name; ?></a>
                        <?php } else {?>
                        <?php _e('Prisijungti / Registruotis', 'woothemes');?>
                        <?php }?>
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main-header py-3 max-width align-items-center light-background">
            <div class="col-2">
                <a href="<?php echo home_url(); ?>">
                    <?php $custom_logo_id = get_theme_mod('custom_logo');?>
                    <?php if ($custom_logo_id) {
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    echo '<img src="' . $image[0] . '" alt="" width="100px">';
}?>
                </a>
            </div>
            <div class="col-5">
                <div class="announcement w-100 p-1 d-none d-lg-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-mark"
                        width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#FF8201" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 19v.01" />
                        <path d="M12 15v-10" />
                    </svg>
                    <p class="m-0 text-uppercase">Gardu Gardu fizinė parduotuvė adresu...</p>
                </div>
            </div>
            <div class="col-5 d-flex align-items-center justify-content-end gap-4 fw-bold">
                <?php
$menuID = $menuLocations['top-menu'];
$menuLocations = get_nav_menu_locations();
$primaryNav = wp_get_nav_menu_items($menuID);
if ($menuID) {
    echo '<ul class="d-none d-lg-flex justify-content-end gap-4">';
    foreach ($primaryNav as $navItem) {
        echo '<li class="nav-item"><a href="' . $navItem->url . '" title="' . $navItem->title . '">' . $navItem->title . '</a></li>';
    }
    echo '</ul>';
}?>

                <a class="d-flex flex-column justify-space-between d-lg-none cart-customlocations  align-items-center gap-2"
                    href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart');?>">
                    <img src="<?php echo wp_get_attachment_image_url(14); ?>" alt="" width="30px">
                </a>
                <div class="d-flex flex-column justify-space-between d-lg-none align-items-center gap-2">
                    <?php $user_img = wp_get_attachment_image_url(16);?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                        title="<?php _e('Prisijungti / Registruotis', 'woothemes');?>">
                        <img src="<?php echo $user_img ?>" alt="" width="30px">

                    </a>
                </div>
                <img src="<?php echo wp_get_attachment_image_url(110); ?>" width="28px" class="openbtn d-lg-none"
                    onclick="openNav()" />

            </div>
        </div>
        <nav class="row max-width pb-4 light-background">
            <div class="col-9 d-none d-lg-flex">
                <?php
$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations['main-menu'];
$primaryNav = wp_get_nav_menu_items($menuID);
if ($menuID) {
    echo '<ul class="d-flex gap-3">';
    foreach ($primaryNav as $navItem) {
        $icon = get_field('menu_icon', $navItem);
        echo '<li class="nav-link"><a class="d-flex align-items-center gap-2" href="' . $navItem->url . '" title="' . $navItem->title . '" target="' . $navItem->target . '">';
        if ($icon) {
            echo '<img src="' . $icon . '" width="20px"';
        }
        echo '<span>' . $navItem->title . '</span>';
        echo '</a></li>';
    }
    echo '</ul>';

}?>

            </div>
            <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-end align-items-center">
                <form role="search" method="get" class="woocommerce-product-search d-flex ps-2 position-relative"
                    action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="screen-reader-text" for="s"><?php _e('Search for:', 'woocommerce');?></label>
                    <input type="text" name="s" id="keyword" onkeyup="fetch()" class="search-field"
                        placeholder="<?php echo esc_attr_x('Ieškoti produktų', 'placeholder', 'woocommerce'); ?>"
                        value="<?php echo get_search_query(); ?>"
                        title="<?php echo esc_attr_x('Search for:', 'label', 'woocommerce'); ?>" />
                    <div class="position-absolute top-5 p-1" id="datafetch"></div>
                    <button class="btn" type="submit"><img src="<?php echo wp_get_attachment_image_url(35); ?>"
                            alt=""></button>
                    <input type="hidden" name="post_type" value="product" />
                </form>
            </div>
        </nav>

        <?php
set_query_var('menu_type', 'bottom-menu');
get_template_part('partials/bottom_bar');
set_query_var('menu_type', false);
set_query_var('menu_type', 'recipes-menu');
get_template_part('partials/bottom_bar');
?>



    </div>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">