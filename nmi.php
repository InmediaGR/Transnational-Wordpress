<?php
/*
Plugin Name: Transnational NMI
Version: 1.0
Description: Use the 3 step method for makeing charges with Transnational
Author: Jared Piro
*/
require_once(dirname(__FILE__).'/admin/admin.php');

add_action( 'wp_ajax_nopriv_step1', 'init_step1' );
add_action( 'wp_ajax_step1', 'init_step1' );
function init_step1(){
    $testKey = get_option('nmi-key');

    $xml = array(
        'api-key'=>$testKey,
        'amount'=>$_POST["amount"],
        'redirect-url'=>$_POST["redirect-url"]
    );
    
    //====
    // billing info
    //====
    $billing = array();
    foreach($_POST as $key => $value) {
        if (strpos($key, 'billing-') === 0) {
            $billing[str_replace("billing-", "", $key)] = $value;
        }
    }
    if(count($billing) > 0)
        $xml["billing"] = $billing;

    //====
    // shipping info
    //====
    $shipping = array();
    foreach($_POST as $key => $value) {
        if (strpos($key, 'shipping-') === 0) {
            $shipping[str_replace("shipping-", "", $key)] = $value;
        }
    }
    if(count($shipping) > 0)
        $xml["shipping"] = $shipping;

    //====
    // product info
    //====
    $product = array();
    foreach($_POST as $key => $value) {
        if (strpos($key, 'product-') === 0) {
            $k = str_replace("product-", "", $key);
            $product[$k == "code"? "product-code" : $k ] = $value;
        }
    }
    if(count($product) > 0)
        $xml["product"] = $product;

    $res = step1($xml, "sale");
    $body = xmlstr_to_array($res["body"]);

    header('Content-Type: application/json');
    $json = json_encode($body);
    
    echo $json;

    wp_die();
}

//Dont use unless you want high pci
add_action( 'wp_ajax_nopriv_step2', 'init_step2' );
function init_step2(){
    
}

add_action( 'wp_ajax_nopriv_step3', 'init_step3' );
add_action( 'wp_ajax_step3', 'init_step3' );
function init_step3(){
    $testKey = get_option('nmi-key');
    
    $xml = array(
        'api-key' => $testKey,
        'token-id' => $_POST["token-id"]
    );

    $res = step3($xml);
    $body = xmlstr_to_array($res["body"]);
    
    header('Content-Type: application/json');
    echo json_encode($body);

    wp_die();
}


