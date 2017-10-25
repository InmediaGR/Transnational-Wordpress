<?php
/*
Plugin Name: Transnational NMI
Version: 1.0
Description: use the 3 step method for makeing charges with Transnational
Author: Jared Piro
*/

add_action( 'wp_ajax_step1', 'init_step1' );
function init_step1(){
    
}

require_once(dirname(__FILE__).'/admin/admin.php');

