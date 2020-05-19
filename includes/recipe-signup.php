<?php 

function lr_recipes_signup()
{
    $array = array('status' => 1);

    if (
        empty($_POST['name']) || 
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        !is_email($_POST['email'])
    ) {
        $array['status'] = 'Dados Inválidos';
        wp_send_json($array);
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    $username = explode('@', $email);
    $username = $username[0];

    if (username_exists($username) || email_exists($email)) {
        $array['status'] = 'Usuário ou e-mail já existe';
        wp_send_json($array);
    }

    $user_id = wp_insert_user(array(
        'user_login' => $username,
        'user_email' => $email,
        'user_pass' => $password,
        'user_nicename' => $username
    ));

    if (is_wp_error($user_id)) {
        wp_send_json($array);
    }

    $user = get_user_by('id', $user_id);
    wp_set_current_user($user_id, $user->user_login);
    wp_set_auth_cookie($user_id, false);
    do_action('wp_login', $user->user_login, $user);
    $array['status'] = 2;
    wp_send_json($array);
}