<?php 

function lr_recipe_auth_form_shortcode()
{
    if (is_user_logged_in()) {
        return 'Você já está logado';
    }
    
    $formHTML = file_get_contents('recipe-auth-template.php', true);
    $formHTML = str_replace(
        'SHOW_SIGNUP_FORM_PH',
        (get_option('users_can_register') == '0')? 'lr_hide_form': '',
        $formHTML
    );
    
    return $formHTML;
}