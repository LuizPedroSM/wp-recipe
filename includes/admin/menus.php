<?php 

function lr_admin_menus()
{
    add_menu_page(
        'Opções de Receita',// Page Title
        'Config de Receitas',// Menu Title
        'edit_theme_options',// Capability
        'lr_recipe_opts',// Slug page
        'lr_recipe_opts_page'// create page function
    );
}