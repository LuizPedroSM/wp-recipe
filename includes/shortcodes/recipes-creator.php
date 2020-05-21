<?php 

function lr_recipe_creator_shortcode()
{
    $creatorHTML = wp_remote_get(
        plugins_url('includes/shortcodes/recipes-creator-template.php', RECIPE_PLUGIN_URL)
    );
    $creatorHTML = wp_remote_retrieve_body($creatorHTML);

    // $creatorHTML = file_get_contents('recipes-creator-template.php', true);

    ob_start();
    wp_editor('', 'recipe_creator_editor');
    $editor = ob_get_clean();

    $creatorHTML = str_replace(
        '{EDITOR}',
        $editor,
        $creatorHTML
    );
    
    return $creatorHTML;
}