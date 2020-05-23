<?php 

function lr_save_origem($term_id)
{
    if (isset($_POST['lr_url'])) {
        update_term_meta($term_id, 'url', esc_url_raw($_POST['lr_url']));
    }
}