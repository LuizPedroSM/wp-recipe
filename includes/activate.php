<?php 

function lr_activate_plugin()
{
    if (version_compare(get_bloginfo('version'), '4.5', '<')) {
        wp_die(__('Você precisa atualizar o WordPress para usar este plugin', 'recipes'));
    }
}