<?php
$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations['footer-about'];
$primaryNav = wp_get_nav_menu_items($menuID);
if ($menuID) {
    foreach ($primaryNav as $key => $navItem) {
        ?>
<a class="<?php echo $key == array_key_first($primaryNav) ? '' : 'mt-3'; ?>" href="<?php echo $navItem->url; ?>">
    <?php echo $navItem->title; ?> </a>
<?php
}
}