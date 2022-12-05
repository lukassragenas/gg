</main>
</div>
<footer class="p-footer">
    <div class="row p-0">
        <div class="col col-12 col-sm-6 col-lg-3 d-flex justify-content-center mt-5 mt-lg-0 ps-0 ps-sm-5 ps-lg-0">
            <div class="d-flex flex-column align-items-center align-items-lg-start social-col">
                <img src="<?php echo wp_get_attachment_image_url(95); ?>" alt="" width="80px">
                <?php
if (have_rows('footer_social', 453)):
    echo '<div class="d-flex gap-4 mt-4">';
    while (have_rows('footer_social', 453)): the_row();
        ?>

                <?php $logo = get_sub_field('icon', 'option');
        ?>
                <a href="<?php echo get_sub_field('url'); ?>" target="_blank">
                    <?php echo file_get_contents($logo); ?>
                </a>
                <?php
    endwhile;
    echo '</div>';
endif;
?>
                <p class="my-4">Mūsų remėjai ir partneriai:</p>

                <?php if (have_rows('footer_sponsor', 453)):
    echo '<div class="d-flex gap-4 mt-4">';
    while (have_rows('footer_sponsor', 453)): the_row();
        ?>
                <img src="<?php echo get_sub_field('image'); ?>" alt="">
                <?php
    endwhile;
    echo '</div>';
endif;
?>
            </div>
        </div>
        <div class="col col-12 col-sm-6 col-lg-3 d-flex justify-content-center mt-5 mt-lg-0 ps-0 ps-sm-5 ps-lg-0">
            <div class="d-flex flex-column align-items-center align-items-lg-start contact-col">
                <h4 class="mb-2 mb-lg-5">Kontaktai</h4>


                <?php if (have_rows('contacts', 453)):
    while (have_rows('contacts', 453)): the_row();
        ?>
                <p><?php echo get_sub_field('company_name') ?></p>
                <img src="<?php echo get_sub_field('image'); ?>" alt="">
                <div class="contact-item d-flex justify-content-center justify-content-lg-start mt-3">
                    <a class="gap-2 d-flex align-items-center" href="tel:<?php echo get_sub_field('phone_number'); ?>">
                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_71_423)">
                                <path
                                    d="M3.31833 6.34885C4.63833 8.6553 6.765 10.5379 9.35917 11.7197L11.3758 9.9267C11.6233 9.70665 11.99 9.6333 12.3108 9.7311C13.3375 10.0326 14.4467 10.1957 15.5833 10.1957C16.0875 10.1957 16.5 10.5624 16.5 11.0106V13.855C16.5 14.3033 16.0875 14.67 15.5833 14.67C6.97583 14.67 0 8.46785 0 0.815C0 0.36675 0.4125 0 0.916667 0H4.125C4.62917 0 5.04167 0.36675 5.04167 0.815C5.04167 1.83375 5.225 2.81175 5.56417 3.72455C5.665 4.0098 5.59167 4.32765 5.335 4.55585L3.31833 6.34885Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_71_423">
                                    <rect width="17" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span><?php echo get_sub_field('phone_number'); ?></span>
                    </a>
                </div>
                <div class="contact-item mt-3 text-center text-lg-start">
                    <a class="gap-2  d-flex align-items-center" href="mailto:<?php echo get_sub_field('email'); ?>">
                        <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.87889 0H15.1211C16.3704 0 17 0.59 17 1.79V10.21C17 11.4 16.3704 12 15.1211 12H1.87889C0.629629 12 0 11.4 0 10.21V1.79C0 0.59 0.629629 0 1.87889 0ZM8.495 8.6L15.231 3.07C15.4709 2.87 15.6608 2.41 15.361 2C15.0711 1.59 14.5414 1.58 14.1917 1.83L8.495 5.69L2.80835 1.83C2.45855 1.58 1.92887 1.59 1.63904 2C1.33921 2.41 1.5291 2.87 1.76896 3.07L8.495 8.6Z"
                                fill="white" />
                        </svg>
                        <span><?php echo get_sub_field('email'); ?></span>
                    </a>
                </div>


                <?php if (have_rows('location', 453)):
            while (have_rows('location', 453)): the_row();
                ?>
                <div class="contact-item mt-3 text-center text-lg-start">
                    <a class="gap-2 d-flex align-items-center" href="">
                        <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.25938 15.6C3.62813 13.5938 0 8.73125 0 6C0 2.68625 2.68625 0 6 0C9.3125 0 12 2.68625 12 6C12 8.73125 8.34375 13.5938 6.74062 15.6C6.35625 16.0781 5.64375 16.0781 5.25938 15.6ZM6 8C7.10313 8 8 7.10313 8 6C8 4.89688 7.10313 4 6 4C4.89687 4 4 4.89688 4 6C4 7.10313 4.89687 8 6 8Z"
                                fill="white" />
                        </svg>
                        <span><?php echo get_sub_field('address'); ?></span>

                    </a>
                </div>
                <?php
            endwhile;
        endif;
        ?>
                <div class="contact-item mt-3 text-center text-lg-start">
                    <span class="text-grey">Prekių atsiėmimas adresu:</span>
                </div>
                <?php if (have_rows('pickup_address', 453)):
            while (have_rows('pickup_address', 453)): the_row();
                ?>
                <div class="contact-item mt-3 text-center text-lg-start">
                    <a class="gap-2 d-flex align-items-center" href="">
                        <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.25938 15.6C3.62813 13.5938 0 8.73125 0 6C0 2.68625 2.68625 0 6 0C9.3125 0 12 2.68625 12 6C12 8.73125 8.34375 13.5938 6.74062 15.6C6.35625 16.0781 5.64375 16.0781 5.25938 15.6ZM6 8C7.10313 8 8 7.10313 8 6C8 4.89688 7.10313 4 6 4C4.89687 4 4 4.89688 4 6C4 7.10313 4.89687 8 6 8Z"
                                fill="white" />
                        </svg>
                        <span><?php echo get_sub_field('address'); ?></span>

                    </a>
                </div>
                <?php
            endwhile;
        endif;
        ?>


                <?php
    endwhile;
endif;
?>
            </div>
        </div>
        <div
            class="col col-12 mt-3 mt-lg-0 col-sm-6 col-lg-3 d-flex justify-content-center mt-5 mt-lg-0 ps-0 ps-sm-5 ps-lg-0">
            <div class="d-flex flex-column align-items-center align-items-lg-start">
                <h4 class="mb-2 mb-lg-5">Apie Mus</h4>
                <?php get_template_part('partials/footer-about');?>
            </div>
        </div>
        <div
            class="col col-12 mt-3 mt-lg-0 col-sm-6 col-lg-3 d-flex justify-content-center mt-5 mt-lg-0 ps-0 ps-sm-5 ps-lg-0">
            <div class="d-flex flex-column align-items-center align-items-lg-start">
                <h4 class="mb-2 mb-lg-5">Parduotuvė</h4>
                <?php get_template_part('partials/footer-shop');?>
            </div>
        </div>
    </div>
    <div class="row mt-5 mb-3 max-width">
        <hr class="divider">
    </div>
    <div class="row max-width align-items-center">
        <div class="col col-12 col-sm-6 justify-content-between justify-content-md-end align-items-center">
            <p class="text-grey mb-3 text-center text-md-start">
                © 2022 GarduGardu. Visos teisės saugomos.
            </p>
        </div>
        <div class="col col-12 col-sm-6 d-flex justify-content-between justify-content-md-end gap-4 align-items-center">
            <img src="<?php echo wp_get_attachment_image_url(99); ?>" alt="" width="40px">
            <img src="<?php echo wp_get_attachment_image_url(102); ?>" alt="" width="60px">
            <img src="<?php echo wp_get_attachment_image_url(101); ?>" alt="" width="100px">
        </div>
    </div>
</footer>
<?php wp_footer();?>

</body>

</html>