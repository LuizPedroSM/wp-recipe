<?php 

function lr_generate_daily_recipe()
{
    global $wpdb;

    $sql = "SELECT ID FROM ".$wpdb->posts." WHERE post_type = 'recipe' AND post_status = 'publish' ORDER BY RAND() LIMIT 1";

    $recipe_id = $wpdb->get_var($sql);

    set_transient('lr_recipe_daily', $recipe_id, DAY_IN_SECONDS);
}