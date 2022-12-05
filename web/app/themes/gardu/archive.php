<?php
/* Template Name: Custom Archive Template */
get_header();
?>
<main id="main" class="content-wrapper">
    <div class="product-section recipe-page">
        <h1 class="mb-5"><?php
echo get_the_archive_title();
?></h1>
        <div class="row">
            <?php if (have_posts()) {?>
            <?php while (have_posts()) {
    the_post();?>
            <div class="col col-12 col-sm-4 pt-5">
                <?php
echo '<a href="' . get_permalink($post->ID) . '" title="' . esc_attr($post->post_title) . '">';
    if (has_post_thumbnail($post->ID)) {
        echo '<img src="' . get_the_post_thumbnail_url() . '" width="100%" />';
    }
    echo '<h2 class="mt-3">' . get_the_title() . '</h2>';
    echo '<hr class="title-divider">';
    echo '<p>' . wp_trim_words(wp_strip_all_tags(get_the_content()), 20) . '</p>';
    echo '<p class="m-0 fst-italic">Autorius: ' . get_the_author() . '</p>';
    echo '<p class="mt-0 fst-italic">Paskelbta: ' . get_the_date() . '</p>';
    echo '</a>';
    echo '<a class="read-more" href="' . get_permalink($post->ID) . '">Plačiau</a>';

    ?>
            </div>
            <?php }

    echo '<div class="archive-pagination mt-5">';
    echo paginate_links();
    echo '</div>';

    wp_reset_postdata();
} else {?>
            <?php }?>
        </div>
    </div>
</main>
<?php
get_footer();