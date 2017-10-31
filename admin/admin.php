<?php
include_once( dirname(__FILE__).'/tests.php' );

wp_enqueue_script("jquery");
function nmi_settings_page(){
    include 'views/admin-view.php';
}
    
function nmi_tests_page(){ 
    include 'views/test-view.php';
}

function nmi_admin_menu(){
    add_menu_page( 'Transnational NMI', 'Transnational NMI', 'manage_options', 'Transnational/Transnational-admin-page.php', 'nmi_settings_page', 'dashicons-menu', 6 );
    add_submenu_page( 'Transnational/Transnational-admin-page.php', 'Tests', 'Tests', 'manage_options', 'Transnational/tests', 'nmi_tests_page' );
    add_option('nmi-key', 'Test Key');
}


function  set_nmi_key(){
    if(isset($_POST["nmi_setting"]) ==true){
        update_option('nmi-key', $_POST["txt-key"]);
    }
    
    
}

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    </script>';
}

add_action( 'admin_menu', 'nmi_admin_menu' );
add_action( 'init', 'set_nmi_key' );
add_action('wp_head', 'myplugin_ajaxurl');
?>