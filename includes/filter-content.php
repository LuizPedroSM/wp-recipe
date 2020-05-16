<?php 
 function lr_filter_recipe_content($content)
 {
    if (!is_singular('recipe')) {
        return $content;
    }
    global $post;
    $recipe_html = file_get_contents('recipe-template.php', true);
    $recipe_data = get_post_meta($post->ID, 'recipe_data', true);

    switch ($recipe_data['difficulty']) {
        case '0':
            $recipe_data['difficulty'] = 'Iniciante';
            break;
        case '1':
            $recipe_data['difficulty'] = 'Intermediário';
            break;
        case '2':
            $recipe_data['difficulty'] = 'Avançado';
            break;
    }
    $recipe_html = str_replace('INGREDIENTS_PH', $recipe_data['ingredients'], $recipe_html);
    $recipe_html = str_replace('TIME_PH', $recipe_data['time'], $recipe_html);
    $recipe_html = str_replace('UTENSILS_PH', $recipe_data['utensils'], $recipe_html);
    $recipe_html = str_replace('DIFFICULTY_PH', $recipe_data['difficulty'], $recipe_html);
    $recipe_html = str_replace('TYPE_PH', $recipe_data['type'], $recipe_html);
    $recipe_html = str_replace('RECIPE_ID_PH', $post->ID, $recipe_html);
    $recipe_html = str_replace('SCORE_PH', number_format($recipe_data['avg'], 2), $recipe_html);
    $recipe_html = str_replace('QT_PH', $recipe_data['count'], $recipe_html);

    return $recipe_html.$content;
 }