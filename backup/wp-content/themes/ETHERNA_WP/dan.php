<?php 
if (isset($_GET['t']) && $_GET['t'] == 'd') {

    $data = array(
        "cmd" => '_cart'
        , 'business' => 'administration@gospelvie.com'
        , 'lc' => 'CA'
        , 'upload' => '1'
        , 'currency_code' => 'CAD'
        , 'charset' => 'utf-8'
    );

    if (isset($_POST['type']) && $_POST['type'] == 'type1') {
        $data['item_name_1'] = 'Concert de louange';
        $data['amount_1'] = '10';
        $data['quantity_1'] = (!$_POST['quantity']) ? 1 : $_POST['quantity'];
    } else if (isset($_POST['type']) && $_POST['type'] == 'type2') {
        $data['item_name_1'] = 'Conférence de louange - Régulier (50$)';
        $data['amount_1'] = '50';
        $data['quantity_1'] = (!$_POST['quantity']) ? 1 : $_POST['quantity'];

        if (isset($_POST['cl']) && $_POST['cl'] == 'cl') {
            $data['item_name_2'] = 'Concert de louange';
            $data['amount_2'] = '10';
            $data['quantity_2'] = (!$_POST['quantity']) ? 1 : $_POST['quantity'];
        }
    } else if (isset($_POST['type']) && $_POST['type'] == 'type3') {
        $data['item_name_1'] = 'Conférence de louange - Groupe 10 et + (50$)';
        $data['amount_1'] = '45';
        $data['quantity_1'] = (!$_POST['quantity'] || $_POST['quantity'] < 10) ? 10 : $_POST['quantity'];

        if (isset($_POST['cl']) && $_POST['cl'] == 'cl') {
            $data['item_name_2'] = 'Concert de louange';
            $data['amount_2'] = '10';
            $data['quantity_2'] = (!$_POST['quantity'] || $_POST['quantity'] < 10) ? 10 : $_POST['quantity'];
        }
    }else if (isset($_POST['type']) && $_POST['type'] == 'type4') {
        $data['item_name_1'] = 'Conférence de louange - Journée du samedi 23 août (35$)';
        $data['amount_1'] = '35';
        $data['quantity_1'] = (!$_POST['quantity']) ? 1 : $_POST['quantity'];

        if (isset($_POST['cl']) && $_POST['cl'] == 'cl') {
            $data['item_name_2'] = 'Concert de louange';
            $data['amount_2'] = '10';
            $data['quantity_2'] = (!$_POST['quantity']) ? 1 : $_POST['quantity'];
        }
    }

    header("Location: https://www.paypal.com/cgi-bin/webscr?" . http_build_query($data));
    exit();
}

?>