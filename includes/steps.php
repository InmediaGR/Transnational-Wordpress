<?php
require_once(dirname(__FILE__).'/ArrayToXml.php');
function step1($data, $start){
    $xmlMaker = new ArrayToXML();
    $xml = $xmlMaker->buildXML($data, $start);
    
    $options = array(
        'method' => 'POST',
        'blocking' => true,
        'headers' => array(
            'Content-Type' => 'text/xml; charset=utf-8'
        ),
        'body' => $xml,
        'cookies' => array()
    );

    $response = wp_remote_post("https://secure.tnbcigateway.com/api/v2/three-step", $options);
    return $response;
}

function step2($body, $url){
    
    $options = array(
        'method' => 'POST',
        'blocking' => true,
        'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ),
        'body' => $body,
        'cookies' => array()
    );

    $response = wp_remote_post($url, $options);
    return $response;
}

function step3($data){
    $xmlMaker = new ArrayToXML();
    $xml = $xmlMaker->buildXML($data, "complete-action");
    echo "sent xml is ". $xml;
    $options = array(
        'method' => 'POST',
        'blocking' => true,
        'headers' => array(
            'Content-Type' => 'text/xml; charset=utf-8'
        ),
        'body' => $xml,
        'cookies' => array()
    );

    $response = wp_remote_post("https://secure.tnbcigateway.com/api/v2/three-step", $options);
    return $response;

}