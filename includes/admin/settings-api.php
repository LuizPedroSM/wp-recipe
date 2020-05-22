<?php 

function settings_api()
{
    register_setting('lr_opts_group', 'lr_recipe_opts');

    add_settings_section(
        'recipe_settings',
        'Config das Receitas',
        'lr_settings_section',
        'lr_opts_section'
    );

    add_settings_field(
        'vote_login',
        'O usuário pode votar SEM estar logado?',
        'lr_vote_login_input',
        'lr_opts_section',
        'recipe_settings'
    );

    add_settings_field(
        'recipe_login',
        'O usuário pode adicionar receitas SEM estar logado?',
        'lr_recipe_login_input',
        'lr_opts_section',
        'recipe_settings'
    );
}

function lr_settings_section()
{
    echo "Opçoes";
}

function lr_vote_login_input()
{
    $recipe_opts = get_option('lr_recipe_opts');
?>
<select id="vote_login" name="lr_recipe_opts[vote_login]">
    <option value="1" <?php echo ($recipe_opts['vote_login'] == '1')?'selected = "selected"':'';?>>Não</option>
    <option value="2" <?php echo ($recipe_opts['vote_login'] == '2')?'selected = "selected"':'';?>>Sim</option>
</select>
<?php 
}

function lr_recipe_login_input()
{
    $recipe_opts = get_option('lr_recipe_opts');
?>
<select id="recipe_login" name="lr_recipe_opts[recipe_login]">
    <option value="1" <?php echo ($recipe_opts['recipe_login'] == '1')?'selected = "selected"':'';?>>Não</option>
    <option value="2" <?php echo ($recipe_opts['recipe_login'] == '2')?'selected = "selected"':'';?>>Sim</option>
</select>
<?php 
}