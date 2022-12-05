<?php
/*
 * Template Name: Featured Article
 * Template Post Type: post, page
 */
get_header();
the_post();
?>




<section class="max-width mt-5">
    <div class="row">
        <div class="col-12 text-center default-post">
            <h1><?php the_title();?></h1>
            <?php echo '<p class="m-0">Paskelbta: <span class="fst-italic">' . get_the_date() . '</span> &nbsp;| Autorius: <span class="fst-italic">' . get_the_author() . '</span></p>'; ?>
            <?php echo '<p class="mt-2">Kategorija: <span class="category-name">' . get_the_category()[0]->name . '</span></p>'; ?>
            <hr class="mx-auto my-4" style="width:50px">
            <?php if (has_post_thumbnail($post->ID)): ?>
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');?>
            <img src="<?php echo $image[0]; ?>" alt="">
            <?php endif;?>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-12">
            <p><?php echo get_the_content() ?></p>
        </div>
    </div>
    </div>
</section>

<div class="max-width mt-2 mb-5">
    <?php
echo '<hr class="my-3">';
echo '<div class="custom-navigation">';
the_post_navigation(
    array(
        'next_text' =>
        '<div class="prev-div d-flex gap-3 justify-content-center align-items-center"><span
                class="post-title">%title</span><img src="' . wp_get_attachment_image_url(313) . '" /></div>',
        'prev_text' =>
        '<div class="next-div d-flex gap-3 justify-content-center align-items-center"><img
                src="' . wp_get_attachment_image_url(312) . '" /><span class="post-title">%title</span></div>',
    )
);
echo '</div>';
?>
</div>

<?php

get_footer();