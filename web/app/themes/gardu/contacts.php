<?php
/**
 * Template Name: Kontaktai
 **/
get_header();
$page_title = get_the_title();

?>

<section class="py-80 light-background">
    <div class="row max-width align-items-center">
        <?php echo '<h1 class="mb-4">' . $page_title . '</h1>'; ?>
        <div class="col col-12 col-md-6 single-content">
            <?php the_content();?>
        </div>
        <div class="col col-12 col-md-6 contact-col">
            <?php echo do_shortcode('[contact-form-7 id="404" title="Kontaktai"]'); ?>
        </div>

    </div>
</section>

<?php

get_footer();