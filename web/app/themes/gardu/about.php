<?php
/**
 * Template Name: Apie Mus
 **/
get_header();
$page_title = get_the_title();

?>
<section class="py-80 light-background">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php echo '<h1 class="mb-4">' . $page_title . '</h1>'; ?>
            <?php the_content();?>
            <div class="d-flex align-items-center gap-2">
                <?php get_template_part('partials/about-social');?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();