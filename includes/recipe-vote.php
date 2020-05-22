<?php 

function lr_vote_recipe()
{
    global $wpdb;

    $array  = array(
        'status' => 0
    );

    $recipe_opts = get_option('lr_recipe_opts');
    if (!is_user_logged_in() && $recipe_opts['vote_login'] == 1) {
        wp_send_json($array);exit;
    }
    
    $post_id = absint($_POST['id']);
    $vote = floatval($_POST['vote']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $sql = $wpdb->prepare("SELECT COUNT(*) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = %d AND user_ip = %s", $post_id, $ip);
    $qt = $wpdb->get_var($sql);

    if ($qt > 0) {
        wp_send_json($array);
    }

    $wpdb->insert(
        $wpdb->prefix.'recipes_votes',
        array(
            'recipe_id' => $post_id,
            'vote' => $vote,
            'user_ip' => $ip
        )
    );

    $recipe_data = get_post_meta($post_id, 'recipe_data', true);
    $sql = $wpdb->prepare("SELECT COUNT(*) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = %d", $post_id);
    $recipe_data['count'] = $wpdb->get_var($sql);
    
    $sql = $wpdb->prepare("SELECT AVG(vote) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = %d", $post_id);
    $recipe_data['avg'] = $wpdb->get_var($sql);   

    update_post_meta($post_id, 'recipe_data', $recipe_data);

    do_action('recipe_vote', array(
        'post_id' => $post_id,
        'vote' => $vote
    ));

    $array['status'] = 1;

    wp_send_json($array);
}