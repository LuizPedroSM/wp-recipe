<?php 

function lr_activate_plugin()
{
    if (version_compare(get_bloginfo('version'), '4.5', '<')) {
        wp_die(__('Você precisa atualizar o WordPress para usar este plugin', 'recipes'));
    }

    global $wpdb;

    $sql = "CREATE TABLE ".$wpdb->prefix."recipes_votes(
        ID BIGINT(20) NOT NULL AUTO_INCREMENT,
        recipe_id BIGINT(20) NOT NULL,
        vote TINYINT(1) NOT NULL,
        user_ip VARCHAR(32) NOT NULL,
        PRIMARY KEY (ID)
    ) ".$wpdb->get_charset_collate();

    require_once(ABSPATH.'/wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // hourly, daily, twicedaily
    wp_schedule_event(time(), 'daily', 'lr_recipe_daily_hook');
}