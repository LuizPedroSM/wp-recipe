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
include('includes/init.php');
include('includes/activate.php');
include('includes/admin/admin_init.php');
include('includes/filter-content.php');
include('includes/enqueue.php');
include('includes/recipe-vote.php');
include(dirname(RECIPE_PLUGIN_URL).'/includes/widgets.php');
include('includes/widgets/daily_recipe.php');
include('includes/cron.php');
include('includes/deactivate.php');
include('includes/shortcodes/recipes-creator.php');
include('includes/recipe-submit.php');
include('includes/shortcodes/recipe-auth.php');
include('includes/recipe-signup.php');
include('includes/recipe-signin.php');
include('includes/admin/dashboard-widgets.php');
include('includes/admin/menus.php');
include('includes/admin/recipe_opts_page.php');

// Hooks
register_activation_hook(RECIPE_PLUGIN_URL, 'lr_activate_plugin');
register_deactivation_hook(RECIPE_PLUGIN_URL, 'lr_deactivate_plugin');
add_action('init', 'lr_recipes_init');
add_action('admin_init', 'lr_recipes_admin_init');
add_action('save_post_recipe', 'lr_save_post_admin', 10, 3);
add_filter('the_content', 'lr_filter_recipe_content');
add_filter('wp_enqueue_scripts', 'lr_enqueue_scripts', 100);
add_filter('widgets_init', 'lr_widgets_init');
add_filter('lr_recipe_daily_hook', 'lr_generate_daily_recipe');
add_filter('wp_dashboard_setup', 'lr_add_dashboard_widgets');
add_filter('admin_menu', 'lr_admin_menus');

// Ajax
add_filter('wp_ajax_lr_vote_recipe', 'lr_vote_recipe');
add_filter('wp_ajax_nopriv_lr_vote_recipe', 'lr_vote_recipe');

add_filter('wp_ajax_lr_recipes_submit', 'lr_recipes_submit');
add_filter('wp_ajax_nopriv_lr_recipes_submit', 'lr_recipes_submit');

add_filter('wp_ajax_nopriv_lr_recipes_signup', 'lr_recipes_signup');
add_filter('wp_ajax_nopriv_lr_recipes_signin', 'lr_recipes_signin');

// Shortcodes
add_shortcode('recipe_creator', 'lr_recipe_creator_shortcode');
add_shortcode('recipe_auth_form', 'lr_recipe_auth_form_shortcode');