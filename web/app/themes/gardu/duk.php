<?php
/**
 * Template Name: DUK
 **/
get_header();
$page_title = get_the_title();
?>

<style>
/* DUK */
.accordion-button:not(.collapsed) {
    color: #fff !important;
    background: #FF8200 !important;
}

.accordion-item:first-of-type .accordion-button,
.accordion-button:focus {
    border: 0 !important;
    box-shadow: none !important;
}
</style>

<section class="py-80 light-background duk-section">
    <div class="row max-width align-items-center">
        <div class="col col-12">
            <?php echo '<h1 class="mb-4">' . $page_title . '</h1>'; ?>
        </div>
        <div class="col col-12">
            <div class="accordion" id="accordionPanelsStayOpenExample">

                <?php
$count_loop = 0;
if (have_rows('duk')):
    while (have_rows('duk')): the_row();
        ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $count_loop; ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse<?php echo $count_loop; ?>" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <?php echo get_sub_field('question'); ?>

                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse<?php echo $count_loop; ?>"
                        class="accordion-collapse collapse <?php echo $count_loop == 0 ? 'show' : ''; ?>"
                        aria-labelledby="panelsStayOpen-heading<?php echo $count_loop; ?>">
                        <div class="accordion-body">

                            <?php echo get_sub_field('answer'); ?>

                        </div>
                    </div>
                </div>
                <?php
        $count_loop++;
    endwhile;
endif;

?>
            </div>
        </div>
    </div>
</section>






<?php
get_footer();