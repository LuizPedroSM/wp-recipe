<?php 

function lr_recipes_signin()
{
    $array = array('status' => 1);
    if (
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        !is_email($_POST['email'])
    ) {
        $array['status'] = 'Dados Inválidos';
        wp_send_json($array);
    }

    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    if (!email_exists($email)) {
        $array['status'] = 'E-mail não existe';
        wp_send_json($array);
    }

    $userdata = get_user_by('email', $email);

    $user = wp_signon(array(
        'user_login' => $userdata->user_login,
        'user_password' => $password,
        'remember' => true
    ));

    if (is_wp_error($user)) {
        $array['status'] = $user->get_error_message();
        wp_send_json($array);
    }

    $array['status'] = 2;
    wp_send_json($array);
}