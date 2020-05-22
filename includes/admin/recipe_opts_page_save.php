<?php 

function lr_recipe_opts_save()
{
    if (!current_user_can('edit_theme_options')) {
        wp_die('Acesso Negado!');
    }

    check_admin_referer('lr_recipe_opts_verify');

    $recipe_opts = get_option('lr_recipe_opts');
    $recipe_opts['vote_login'] = absint($_POST['vote_login']);
    $recipe_opts['recipe_login'] = absint($_POST['recipe_login']);

    update_option('lr_recipe_opts', $recipe_opts);

    wp_redirect(admin_url('admin.php?page=lr_recipe_opts&status=1'));
}