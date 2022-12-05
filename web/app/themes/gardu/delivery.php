<?php
/**
 * Template Name: Pristatymas / Atsiskatymo būdai
 **/
get_header();
$page_title = get_the_title();

?>
<section class="py-80 light-background delivery">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php echo '<h1 class="mb-4">' . $page_title . '</h1>'; ?>
            <?php the_content();?>
        </div>
    </div>
</section>
<?php
get_footer();