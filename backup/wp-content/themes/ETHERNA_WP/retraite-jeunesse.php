<?php 
/*

  Template Name: Retraite jeunesse

 */
 

    $data = array(
        "cmd" => '_cart'
        , 'business' => 'administration@gospelvie.com'
        , 'lc' => 'CA'
        , 'upload' => '1'
        , 'currency_code' => 'CAD'
        , 'charset' => 'utf-8'
    );

        $data['item_name_1'] = 'Retraite jeunesse';
        $data['amount_1'] = '92';
        $data['quantity_1'] = 1;

    header("Location: https://www.paypal.com/cgi-bin/webscr?" . http_build_query($data));
    exit();

?>