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
include('includes/filter-content.php');
include('includes/enqueue.php');
include('includes/recipe-vote.php');
include(dirname(RECIPE_PLUGIN_URL).'/includes/widgets.php');
include('includes/widgets/daily_recipe.php');

// Hooks
register_activation_hook(RECIPE_PLUGIN_URL, 'lr_activate_plugin');
add_action('init', 'lr_recipes_init');
add_action('admin_init', 'lr_recipes_admin_init');
add_action('save_post_recipe', 'lr_save_post_admin', 10, 3);
add_filter('the_content', 'lr_filter_recipe_content');
add_filter('wp_enqueue_scripts', 'lr_enqueue_scripts', 100);
add_filter('wp_ajax_lr_vote_recipe', 'lr_vote_recipe');
add_filter('wp_ajax_nopriv_lr_vote_recipe', 'lr_vote_recipe');
add_filter('widgets_init', 'lr_widgets_init');

// Shortcodes