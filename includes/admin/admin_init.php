<?php 

include 'metabox_lr_recipe_option.php';
include 'enqueue.php';

function lr_recipes_admin_init()
{
    add_action('add_meta_boxes_recipe', 'lr_recipes_metaboxes');
    add_action('admin_enqueue_scripts', 'lr_admin_enqueue');
}

function lr_recipes_metaboxes()
{
    add_meta_box(
        'lr_recipe_option',
        __('Opções da receita', 'recipes'),
        'lr_recipe_option',
        'recipe',
        'normal',// normal, side, advanced
        'high' // high, default, low
    );
}

function lr_save_post_admin($post_id, $post, $update)
{
    if (!$update) {
        return;
    }

    $recipe_data = array(
        'ingredients' => $_POST['lr_ingredients'],
        'time' => $_POST['lr_time'],
        'utensils' => $_POST['lr_utensils'],
        'difficulty' => $_POST['lr_difficulty'],
        'type' => $_POST['lr_type'],
    );

    update_post_meta($post_id, 'recipe_data', $recipe_data);
}