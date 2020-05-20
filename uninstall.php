<?php 
if (!defined("WP_UNISTALL_PLUGIN")) {
    exit;
}

global $wpbd;
$wpbd->query("DROP TABLE IF EXISTS ".$wpbd->prefix."recipes_votes");