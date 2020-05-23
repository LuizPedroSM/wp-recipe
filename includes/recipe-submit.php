<?php 

function lr_recipes_submit()
{
    $array = array('status' => 1);

    $recipe_opts = get_option('lr_recipe_opts');
    if (!is_user_logged_in() && $recipe_opts['recipe_login'] == 1) {
        wp_send_json($array);exit;
    }

    if (
        empty($_POST['title']) || 
        empty($_POST['content']) ||
        empty($_POST['ingredients']) ||
        empty($_POST['time']) ||
        empty($_POST['utensils']) ||
        empty($_POST['difficulty']) ||
        empty($_POST['type']) 
    ) {
        wp_send_json($array);
    }

    $title = sanitize_text_field($_POST['title']);
    $content = wp_kses_post($_POST['content']);

    $recipe_data = array(
        'ingredients' => sanitize_text_field($_POST['ingredients']),
        'time' => sanitize_text_field($_POST['time']),
        'utensils' => sanitize_text_field($_POST['utensils']),
        'difficulty' => sanitize_text_field($_POST['difficulty']),
        'type' => sanitize_text_field($_POST['type']),
        'avg' => 0,
        'count' => 0,
    );

    $post_id = wp_insert_post(array(
        'post_title' => $title,
        'post_name' => $name,
        'post_content' => $content,
        'post_status' => 'pending',
        'post_type' => 'recipe'
    ));

    if (!empty($_POST['anexo_id'])) {
        include_once(ABSPATH.'/wp-admin/includes/image.php');
        set_post_thumbnail($post_id, $_POST['anexo_id']);
    }
    update_post_meta($post_id, 'recipe_data', $recipe_data);

    $array['status'] = 2;
    wp_send_json($array);
}