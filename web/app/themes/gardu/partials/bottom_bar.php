<?php

?>
<div class="bottom-bar<?php echo ($menu_type == 'recipes-menu' ? '-recipes-menu' : ''); ?> row py-3 max-width">
    <div class="col-12">
        <ul class="gap-4 d-flex justify-content-center align-items-center">
            <?php
$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations[$menu_type];

$menu_items = wp_get_nav_menu_items($menuID);
$bool = true;
foreach ($menu_items as $menu_item) {
    if ($menu_item->menu_item_parent == 0) {

        $parent = $menu_item->ID;

        $menu_array = array();
        foreach ($menu_items as $submenu) {
            if ($submenu->menu_item_parent == $parent) {
                $bool = true;
                $menu_array[] = '<li><a class="dropdown-item" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
            }
        }
        if ($bool == true && count($menu_array) > 0) {

            echo '<li class="nav-item dropdown">' . "\n";
            echo '<a href="' . $menu_item->url . '" class="nav-link dropdown-toggle" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' . "\n";

            echo '<ul class="dropdown-menu">' . "\n";
            echo implode("\n", $menu_array);
            echo '</ul>' . "\n";

        } else {

            echo '<li class="nav-item">' . "\n";
            echo '<a class="nav-link" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' . "\n";
        }

    }

    echo '</li>' . "\n";
}

?>
        </ul>
    </div>
</div>