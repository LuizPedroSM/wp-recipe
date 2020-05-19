<?php 

function lr_admin_enqueue()
{
    global $typenow;

    if ($typenow != 'recipe') {
        return;
    }

    // Registers
    wp_register_style(
        'lr_style_admin',
        plugins_url('/assets/css/admin.css', RECIPE_PLUGIN_URL)
    );
    
    // Uses
    wp_enqueue_style('lr_style_admin');
}   