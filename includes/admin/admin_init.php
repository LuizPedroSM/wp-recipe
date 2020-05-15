<?php 

include 'metabox_lr_recipe_option.php';

function lr_recipes_admin_init()
{
    add_action('add_meta_boxes_recipe', 'lr_recipes_metaboxes');
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