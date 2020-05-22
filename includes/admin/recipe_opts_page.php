<?php 

function lr_recipe_opts_page()
{
    $recipe_opts = get_option('lr_recipe_opts');
?>
<div class="wrap">
    <?php if (isset($_GET['status']) && $_GET['status'] == '1'):?>
    <div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">
        <p><strong>Configurações salvas.</strong></p><button type="button" class="notice-dismiss"><span
                class="screen-reader-text">Dispensar este aviso.</span></button>
    </div>
    <?php endif;?>
    <form action="admin-post.php" method="post">
        <input type="hidden" name="action" value="lr_recipe_opts_save" />
        <?php wp_nonce_field('lr_recipe_opts_verify');?>

        O usuário pode votar SEM estar logado? <br />
        <select name="vote_login">
            <option value="1" <?php echo ($recipe_opts['vote_login'] == '1')?'selected = "selected"':'';?>>Não</option>
            <option value="2" <?php echo ($recipe_opts['vote_login'] == '2')?'selected = "selected"':'';?>>Sim</option>
        </select>
        <br /><br />
        O usuário pode adicionar receitas SEM estar logado? <br />
        <select name="recipe_login">
            <option value="1" <?php echo ($recipe_opts['recipe_login'] == '1')?'selected = "selected"':'';?>>Não
            </option>
            <option value="2" <?php echo ($recipe_opts['recipe_login'] == '2')?'selected = "selected"':'';?>>Sim
            </option>
        </select>
        <br /><br />
        <input type="submit" value="Salvar">
    </form>
</div>
<?php 
}