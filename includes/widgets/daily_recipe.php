<?php 

class Lr_Recipe_Of_The_Day_Widget extends WP_Widget 
{
    public function __construct()
    {
        $options = array(
            'description' => 'Mostra uma receita nova por dia'
        );

        parent::__construct('lr_recipe_of_the_day', 'Receita Do Dia', $options);
    }

    public function form($instance)
    {
        $default = array(
            'title' => 'Receita Do Dia'
        );
        $instance = wp_parse_args($instance, $default);

        $title_id = $this->get_field_id('title');
        $title_name = $this->get_field_name('title');
        $title_value = esc_attr($instance['title']);
        ?>
<p>
    <label for="<?php echo $title_id;?>">Título</label>
    <input type="text" class="widefat" name="<?php echo $title_name;?>" id="<?php echo $title_id;?>"
        value="<?php echo $title_value;?>" />
</p>
<?php   
    }

    public function update($new_instance, $old_instance)
    {
        $array = array(
            'title' => strip_tags($new_instance['title'])
        );
        return $array;
    }

    public function widget($args, $instance)
    {
        
    }
}