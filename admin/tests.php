
<?php
require_once(dirname(__FILE__).'/../includes/steps.php');
require_once(dirname(__FILE__).'/../includes/XmlToArray.php');
function run_tests(){
    
    $res = test1();

    $body = xmlstr_to_array($res["body"]);
    $tokenId = test2($body["form-url"]);
    test3($tokenId);

    wp_die();
}
add_action( 'wp_ajax_nopriv_run_tests', 'run_tests' );
add_action( 'wp_ajax_run_tests', 'run_tests' );

function test1(){

    $xml = array(
        'api-key'=>'2F822Rw39fx762MaV7Yy86jXGTC7sCDy',
        'amount'=>5.55,
        'redirect-url'=>'https://wearehopecity.com/wp-admin/admin.php?page=Transnational%2Ftests'      
    );
    $res = step1($xml, "sale");
    echo "<h2>test 1</h2>";
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    return $res;
    
}

function test2($url){
    
    $body = array(
        'billing-cc-number' => '4111111111111111',
        'billing-cc-exp' => '10/25',
        'billing-cvv' => '433'
    );

    $res = step2($body, $url);
    $loc = urldecode($res["http_response"]->get_response_object()->url);
    preg_match('/token-id=(.*?)&/', $loc, $match);
    
    echo "<h2>test 2</h2>";
    echo "<pre>";
    echo urldecode($res["http_response"]->get_response_object()->url);
    echo "</pre>";
    echo "match is " .$match[1];
    return $match[1];

}

function test3($token){

    $body = array(
        'api-key' => '2F822Rw39fx762MaV7Yy86jXGTC7sCDy',
        'token-id' => $token
    );

    $res = step3($body);

    echo "<h2>test 3</h2>";
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    return $res;
}