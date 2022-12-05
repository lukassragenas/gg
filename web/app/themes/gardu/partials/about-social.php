<?php

if (have_rows('about_social')):
    while (have_rows('about_social')): the_row();
        ?>
<a href="<?php echo get_sub_field('url'); ?>" target="_blank"><img src="<?php echo get_sub_field('image'); ?>" alt=""
        width="<?php echo get_sub_field('image_width'); ?>px"></a>
<?php
    endwhile;
endif;