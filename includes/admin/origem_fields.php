<?php 
function lr_origem_add_form_fiels()
{
?>

<div class="form-field">
    <label for="">URL</label>
    <input type="text" name="lr_url" id="lr_url">
    <p class="description">
        URL que o usuário pode clicar para saber mais.
    </p>
</div>

<?php 
}

function lr_origem_edit_form_fiels($term)
{
    $url = get_term_meta($term->term_id, 'url', true);
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="">URL</label>
    </th>
    <td>
        <input type="text" name="lr_url" id="lr_url" value="<?php echo esc_attr($url);?>" />
        <p class="description">
            URL que o usuário pode clicar para saber mais.
        </p>
    </td>
</tr>

<?php 
}