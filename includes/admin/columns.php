<?php 
function lr_recipe_columns($columns)
{
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Título',
        'count' => 'Qt. de votos',
        'average' => 'Média',
        'author' => 'Autor',
        'date' => 'Data'
    );

    return $new_columns;
}

function lr_manage_recipe_columns($column, $post_id)
{
    $recipe_data = get_post_meta($post_id, 'recipe_data', true);
    if ($column == 'count') {
        echo $recipe_data['count'];
        return;
    }

    if ($column == 'average') {
        echo number_format($recipe_data['avg'], 2);
        return;
    }
}