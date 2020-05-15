<?php 
/*
Plugin Name: Recipes
Description: Um plugin simples para adição e configuração de receitas.
Version: 1.0
Author: Luiz
Author URI: https://luizpedrosm.github.io
Text Domain: recipes
*/

if (!function_exists('add_action')) {
    echo __("Opa! Eu sou só um plugin, não posso ser chamado diretamente!", 'recipes');
    exit;
}

// Setup
define('RECIPE_PLUGIN_URL', __FILE__);

// Includes
include('includes/activate.php');
include('includes/init.php');
include('includes/admin/admin_init.php');

// Hooks
register_activation_hook(RECIPE_PLUGIN_URL, 'lr_activate_plugin');
add_action('init', 'lr_recipes_init');
add_action('admin_init', 'lr_recipes_admin_init');

// Shortcodes