<?php

get_header();?>
<style>

</style>
<div id="primary" class="content-area">
    <main id="main" class="site-main py-40" role="main">

        <?php
// Start the loop.
while (have_posts()): the_post();
    echo '<div class="row product-section">';
    echo '<div class="col col-12 col-lg-6 d-flex align-items-center">';
    echo '<div><h1>' . get_the_title() . '</h1>';
    echo '<hr class="recipe-divider">';
    echo '</div>';
    echo '</div>';
    echo '<div class="col col-12 col-lg-6">';
    echo '<img class="img-radius" src="' . get_the_post_thumbnail_url() . '" width="100%"/>';
    echo '</div>';
    echo '</div>';
    echo '<div class="row max-width">';
    echo '<div class="col col-12 col-lg-6"">';
    if (have_rows('ingredients')):
        // echo '<h2>Ingridientai</h2><hr class="w-50">';
        while (have_rows('ingredients')): the_row();
            ?>
        <h3 class="mt-4"><?php echo get_sub_field('recipe_part') ? get_sub_field('recipe_part') : '' ?></h3>
        <?php
            if (have_rows('ingredient_part')):
                while (have_rows('ingredient_part')): the_row();
                    ?>
        <div class="mb-2">
            <input type="checkbox">
            <?php if (get_sub_field('simple_ingredient') != null) {?>
            <span for=""><?php echo get_sub_field('qty') ? get_sub_field('qty') : '' ?>
                <?php echo get_sub_field('simple_ingredient') ?></span>
            <?php } else {
                        $field = get_sub_field_object('product');
                        $value = $field['value'];
                        $label = $field['choices'][$value];
                        $product = wc_get_product($value);
                        $product_id = explode('|', $label);
                        $product = wc_get_product($product_id[1]);

                        ?>
            <a class="active-link" href="<?php echo $product->get_permalink(); ?>"><span
                    for=""><?php echo get_sub_field('qty') ? get_sub_field('qty') : '' ?>
                    <?php echo $product_id[0]; ?></a>
            </span>

            <?php }?>
        </div>

        <?php
                endwhile;
            endif;
        endwhile;
    endif;
    echo '</div>';
    echo '<div class="col col-12 col-lg-6 prepare mt-3 mt-md-0">';

    if (have_rows('prepare')):
        echo '<ul class="prepare">';
        $count = 1;
        while (have_rows('prepare')): the_row();
            ?>
        <li class="p-3 mb-3 gap-4 d-flex align-items-center justify-content-center">
            <span><?php echo $count; ?></span><span><?php echo get_sub_field('step'); ?></span>
        </li>
        <?php
            $count++;
        endwhile;
        echo '</ul>';
    endif;

    echo '</div>';
    echo '<hr class="my-3">';
    echo '<div class="custom-navigation">';
    the_post_navigation(
        array(
            'next_text' =>
            '<div class="prev-div d-flex gap-3 justify-content-center align-items-center"><span class="post-title">%title</span><img src="' . wp_get_attachment_image_url(313) . '" /></div>',
            'prev_text' =>
            '<div class="next-div d-flex gap-3 justify-content-center align-items-center"><img src="' . wp_get_attachment_image_url(312) . '" /><span class="post-title">%title</span></div>',
        )
    );
    echo '</div>';
    echo '</div>';

    if (comments_open() || get_comments_number()):
        comments_template();
    endif;

endwhile;
?>

    </main>
</div>

<?php get_footer();?>