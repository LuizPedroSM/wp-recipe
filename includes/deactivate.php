<?php 

function lr_deactivate_plugin()
{
    wp_clear_scheduled_hook('lr_recipe_daily_hook');
}