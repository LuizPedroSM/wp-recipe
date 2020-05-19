<?php 

function lr_vote_recipe()
{
    global $wpdb;

    $array  =array(
        'status' => 0
    );

    $post_id = absint($_POST['id']);
    $vote = floatval($_POST['vote']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $qt = $wpdb->get_var(
        "SELECT COUNT(*) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = ".$post_id." AND user_ip = '".$ip."' "
    );

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
    $recipe_data['count'] = $wpdb->get_var(
        "SELECT COUNT(*) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = ".$post_id.""
    );
    $recipe_data['avg'] = $wpdb->get_var(
        "SELECT AVG(vote) FROM ".$wpdb->prefix."recipes_votes WHERE recipe_id = ".$post_id.""
    );

    update_post_meta($post_id, 'recipe_data', $recipe_data);

    do_action('recipe_vote', array(
        'post_id' => $post_id,
        'vote' => $vote
    ));

    $array['status'] = 1;

    wp_send_json($array);
}