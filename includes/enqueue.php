<?php 

function lr_enqueue_scripts()
{
    // Registers
    wp_register_style(
        'lr_style',
        plugins_url('/assets/css/style.css', RECIPE_PLUGIN_URL)
    );

    wp_register_style(
        'lr_rateit',
        plugins_url('/assets/rateit/rateit.css', RECIPE_PLUGIN_URL)
    );
    
    wp_register_script(
        'lr_rateit',
        plugins_url('/assets/rateit/jquery.rateit.min.js', RECIPE_PLUGIN_URL),
        array('jquery'),
        '1.0',
        true
    );
    
    wp_register_script(
        'lr_script',
        plugins_url('/assets/js/script.js', RECIPE_PLUGIN_URL),
        array('jquery'),
        '1.0',
        true
    );

    wp_localize_script('lr_script','recipe_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'home_url' => home_url('/')
    ));
    
    // Uses
    wp_enqueue_style('lr_style');
    wp_enqueue_style('lr_rateit');
    wp_enqueue_script('lr_rateit');
    wp_enqueue_script('lr_script');
}