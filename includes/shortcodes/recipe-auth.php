<?php 

function lr_recipe_auth_form_shortcode()
{
    $formHTML = file_get_contents('recipe-auth-template.php', true);

    return $formHTML;
}