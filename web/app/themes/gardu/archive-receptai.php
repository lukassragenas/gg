<?php
/**
 * Template Name: Receptai
 * Template Post Type: receptai
 **/

get_header();

echo '<div class="product-section recipe-page">';
echo '<h1 class="mb-5"><span class="first-letter">Gardu Gardu</span> receptai</h1>'
?>
<?php
$args = array(
    'taxonomy' => 'categories',
    'orderby' => 'name',
    'order' => 'ASC',
);

$cats = get_categories($args);

?>


<form role="search" method="get" class="search-form recipes-search" action="<?php echo home_url('/'); ?>">
    <div class="d-flex gap-4">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span>
        <select name="cat_id" id="search-cat">
            <option value="all">Visi</option>
            <?php foreach ($cats as $cat) {
    ?>
            <option value="<?php echo $cat->term_id; ?>"
                <?php if (isset($_GET['cat_id'])) {if ($_GET['cat_id'] == $cat->term_id) {echo 'selected';}}?>>
                <?php echo $cat->name; ?></option>
            <?php
}?>
        </select>
        <div class="d-flex recipes-container">
            <div class="d-flex form-order justify-content-between">
                <input type="search" class="search-field"
                    placeholder="<?php echo esc_attr_x('Ieškoti recepto …', 'placeholder') ?>"
                    value="<?php echo get_search_query() ?>" name="s"
                    title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
                <input type="hidden" name="post_type" value="receptai" />
                <select name="order-receptai" id="order-cat">
                    <option value="ASC">Naujausi pradžioje</option>
                    <option value="DESC">Seniausi pradžioje</option>
                    <option value="A-Z">Abecelės tvarka (A - Z)</option>
                    <option value="Z-A">Abecelės tvarka (Z - A)</option>
                </select>
            </div>
            <button type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button') ?>"><svg
                    width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21 21L16.514 16.506L21 21ZM19 10.5C19 12.7543 18.1045 14.9163 16.5104 16.5104C14.9163 18.1045 12.7543 19 10.5 19C8.24566 19 6.08365 18.1045 4.48959 16.5104C2.89553 14.9163 2 12.7543 2 10.5C2 8.24566 2.89553 6.08365 4.48959 4.48959C6.08365 2.89553 8.24566 2 10.5 2C12.7543 2 14.9163 2.89553 16.5104 4.48959C18.1045 6.08365 19 8.24566 19 10.5V10.5Z"
                        stroke="#fff" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>
</form>

<?php $args = array('post_type' => 'receptai', 'posts_per_page' => 20);
$loop = new WP_Query($args);

?>
<div class="row">

    <?php
while ($loop->have_posts()): $loop->the_post();?>
    <div class="col col-12 col-sm-4 pt-5">
        <?php
    echo '<a href="' . get_permalink($post->ID) . '" title="' . esc_attr($post->post_title) . '">';
    if (has_post_thumbnail($post->ID)) {
        echo '<img src="' . get_the_post_thumbnail_url() . '" />';
    }
    echo '<h2 class="mt-3">' . get_the_title() . '</h2>';
    echo '<h3>Autorius: ' . get_the_author() . '</h3>';
    echo '</a>';

    ?>
    </div>
    <?php endwhile;?>
</div>
<?php echo '</div>' ?>
<?php get_footer();?>