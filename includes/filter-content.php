<?php 
 function lr_filter_recipe_content($content)
 {
    if (!is_singular('recipe')) {
        return $content;
    }
    global $post;

    $recipe_html = wp_remote_get(
        plugins_url('includes/recipe-template.php', RECIPE_PLUGIN_URL)
    );
    $recipe_html = wp_remote_retrieve_body($recipe_html);

    $origem = wp_get_post_terms($post->ID, 'origem');
    $t_url = '';
    if (isset($origem[0])) {
        $t_url = get_term_meta($origem[0]->term_id, 'url', true);
    }    

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

    $recipe_opts = get_option('lr_recipe_opts');
    if (!is_user_logged_in() && $recipe_opts['vote_login'] == 1) {
        $recipe_html = str_replace('RECIPE_READONLY_PH', 'true', $recipe_html);
    } else {
        $recipe_html = str_replace('RECIPE_READONLY_PH', 'false', $recipe_html);
    }
    
    $recipe_html = str_replace('INGREDIENTS_PH', $recipe_data['ingredients'], $recipe_html);
    $recipe_html = str_replace('TIME_PH', $recipe_data['time'], $recipe_html);
    $recipe_html = str_replace('UTENSILS_PH', $recipe_data['utensils'], $recipe_html);
    $recipe_html = str_replace('DIFFICULTY_PH', $recipe_data['difficulty'], $recipe_html);
    $recipe_html = str_replace('TYPE_PH', $recipe_data['type'], $recipe_html);
    $recipe_html = str_replace('RECIPE_ID_PH', $post->ID, $recipe_html);
    $recipe_html = str_replace('SCORE_PH', number_format($recipe_data['avg'], 2), $recipe_html);
    $recipe_html = str_replace('QT_PH', $recipe_data['count'], $recipe_html);
    
    if (isset($origem[0])) {
        $link = '<a href="'.$t_url.'" target="_blank">'.$origem[0]->name.'</a>';
        $recipe_html = str_replace('ORIGEM_PH', $link, $recipe_html);        
    } else {
        $recipe_html = str_replace('ORIGEM_PH', 'Nenhuma', $recipe_html);
    }

    return $recipe_html.$content;
 }