<?php 

function lr_add_dashboard_widgets()
{
    wp_add_dashboard_widget(
        'lr_recipes_last_votes_widget',
        'Ultimos Votos de Receitas',
        'lr_recipes_last_votes_display'
    );    
}

function lr_recipes_last_votes_display()
{
    global $wpdb;

    $last_votes = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."recipes_votes ORDER BY ID DESC LIMIT 5");

    echo "<ul>";
    foreach ($last_votes as $vote) {
        $title = get_the_title($vote->recipe_id);
        $permalink = get_the_permalink($vote->recipe_id);
        $score = $vote->vote;
?>

<li>
    <a href="<?php echo $permalink;?>"><?php echo $title?></a> recebeu um voto de <?php echo $score?>
</li>

<?php
    }
    echo "</ul>";
}