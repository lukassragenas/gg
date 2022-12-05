<?php
/**
 * Template Name: Home Page
 **/
get_header();

?>


<style>
.swiper-button-prev:not(.swiper-button-disabled),
.swiper-button-next:not(.swiper-button-disabled) {
    background: url('<?php echo wp_get_attachment_image_url(108); ?>') no-repeat;
}
</style>

<section>
    <div class="swiper main-section">
        <div class="swiper-wrapper">
            <?php
if (have_rows('slider')): while (have_rows('slider')): the_row();
        if (have_rows('slider_repeater')): while (have_rows('slider_repeater')): the_row();?>
            <div class="swiper-slide" style="background:url('<?php echo get_sub_field('image'); ?>')">
                <div class="row max-width">
                    <div class="col col-12">
                        <div class="main-title p-3">
                            <h1 class=" text-uppercase text-center text-lg-start fw-light m-0">
                                <?php echo get_sub_field('title'); ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            endwhile;
        endif;
    endwhile;
endif;
?>
        </div>
    </div>
</section>

<section class="product-section light-background pt-80">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <h2>Populiariausi</h2>
            <div class="d-flex gap-4 popular-nav">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="background-rotate">
                        <svg id="product-popular-swiper-button-prev" class="swiper-button-prev swiper-navigation"
                            width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1 7L7 13" stroke="#222222" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-popular-swiper-button-next" class="swiper-button-next" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <?php getSliderProducts('popular');?>
        </div>
    </div>
</section>
<section class="product-section light-background py-40">
    <div class="row max-width">
        <div class="col-12 d-flex justify-content-between">
            <h2>Naujienos</h2>
            <div class="d-flex gap-4 new-nav">
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-new-swiper-button-prev" class="swiper-button-prev swiper-navigation" width="8"
                        height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-new-swiper-button-next" class="swiper-button-next" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <?php getSliderProducts('new');?>
        </div>
    </div>
</section>

<?php
if (have_rows('top_recipes')):
    while (have_rows('top_recipes')): the_row();
        ?>
<section class="py-40 light-background">
    <div class="row d-flex flex-column-reverse flex-lg-row max-width align-items-center">
        <div class="col col-12 col-lg-6">
            <img class="mt-4 mt-lg-0 img-radius" src="<?php echo get_sub_field('image'); ?>" alt="" width="100%">
        </div>
        <div class="col col-12 col-lg-6">
            <?php $title = get_sub_field('title');?>
            <h2 class="mb-4"><?php echo splitTitle($title); ?></h2>
            <h3 class="mb-4"><?php echo get_sub_field('subtitle'); ?> </h3>
            <p class="mb-4"><?php echo get_sub_field('content'); ?></p>
            <a class="btn-primary"
                href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('read_more'); ?></a>
        </div>
    </div>
</section>
<?php
    endwhile;
endif;
?>



<section class="product-section light-background py-40">
    <div class="row max-width">
        <div class="col-12 d-flex justify-content-between">
            <h2>Akcijos</h2>
            <div class="d-flex gap-4 sale-nav">
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-new-swiper-button-prev" class="swiper-button-prev swiper-navigation" width="8"
                        height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <svg id="product-new-swiper-button-next" class="swiper-button-next" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <?php getSliderProducts('sale');?>
        </div>
    </div>
</section>



<?php
if (have_rows('video_recipes')):
    while (have_rows('video_recipes')): the_row();
        ?>

<section class="py-40 light-background">
    <div class="row max-width align-items-center">
        <div class="col col-12 col-lg-6">
            <?php $title = get_sub_field('title');?>
            <h2 class="mb-4"><?php echo $title; ?></h2>
            <h3 class="mb-4"><?php echo get_sub_field('subtitle'); ?> </h3>
            <p class="mb-4"><?php echo get_sub_field('content'); ?></p>
            <a class="btn-primary" href="<?php echo get_sub_field('url'); ?>"
                target="_blank"><?php echo get_sub_field('read_more'); ?></a>
        </div>
        <div class="col col-12 col-lg-6 d-flex mt-5 mt-lg-0 justify-content-end video-col">
            <?php echo get_sub_field('video_url'); ?>
        </div>
    </div>
</section>
<?php
    endwhile;
endif;
?>


<?php
if (have_rows('chef_club')):
    while (have_rows('chef_club')): the_row();
        ?>
<section class="pb-80 light-background">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php $title = get_sub_field('title');?>
            <h2 class="mb-4"><?php echo $title; ?></h2>
        </div>
        <div class="col col-12 position-relative">
            <a href="<?php echo get_sub_field('url'); ?>">
                <div class="chef-background d-flex justify-content-center align-items-center"
                    style="background:url(<?php echo get_sub_field('background_image'); ?>);background-position: 50% 50%">
                    <img class="position-absolute chef-logo" src="<?php echo get_sub_field('logo_image'); ?>" alt="">
                </div>
            </a>
        </div>
    </div>
</section>
<?php
    endwhile;
endif;
?>






<?php get_footer();?>