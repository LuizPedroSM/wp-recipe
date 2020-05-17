<form action="" method="post">
    <label for="lr_title">Titulo: </label> <br />
    <input type="text" name="lr_title" id="lr_title" /> <br />

    <label>Modo de preparo: </label> <br />
    {EDITOR} <br />

    <label for="lr_ingredients">Ingredientes: </label> <br />
    <input type="text" name="lr_ingredients" id="lr_ingredients" /> <br />

    <label for="lr_time">Tempo: </label> <br />
    <input type="text" name="lr_time" id="lr_time" /><br />

    <label for="lr_utensils">Utensílios: </label> <br />
    <input type="text" name="lr_utensils" id="lr_utensils" /><br />

    <label for="lr_difficulty">Nível: </label> <br />
    <select name="lr_difficulty" id="lr_difficulty">
        <option value="0">Iniciante</option>
        <option value="1">Intermediário</option>
        <option value="2">Avançado</option>
    </select> <br />

    <label for="lr_type">Tipo: </label> <br />
    <input type="text" name="lr_type" id="lr_type"><br />
    <br />
    <input type="submit" value="Salvar">
</form>