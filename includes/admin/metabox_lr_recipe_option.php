<?php 

function lr_recipe_option($post)
{
    $recipe_data = get_post_meta($post->ID, 'recipe_data', true);
    if (empty($recipe_data)) {
        $recipe_data = array(
            'ingredients' => '',
            'time' => '',
            'utensils' => '',
            'difficulty' => '0',
            'type' => '',
        );
    }
?>

<label for="lr_ingredients">Ingredientes: </label> <br />
<input type="text" name="lr_ingredients" id="lr_ingredients" value="<?php echo $recipe_data['ingredients'];?>"> <br />

<label for="lr_time">Tempo: </label> <br />
<input type="text" name="lr_time" id="lr_time" value="<?php echo $recipe_data['time'];?>"><br />

<label for="lr_utensils">Utensílios: </label> <br />
<input type="text" name="lr_utensils" id="lr_utensils" value="<?php echo $recipe_data['utensils'];?>"><br />

<label for="lr_difficulty">Nível: </label> <br />
<select name="lr_difficulty" id="lr_difficulty">
    <option value="0" <?php echo ($recipe_data['difficulty'] == '0')? 'selected="selected"':'';?>>Iniciante</option>
    <option value="1" <?php echo ($recipe_data['difficulty'] == '1')? 'selected="selected"':'';?>>Intermediário</option>
    <option value="2" <?php echo ($recipe_data['difficulty'] == '2')? 'selected="selected"':'';?>>Avançado</option>
</select> <br />

<label for="lr_type">Tipo: </label> <br />
<input type="text" name="lr_type" id="lr_type" value="<?php echo $recipe_data['type'];?>"><br />

<?php 
}