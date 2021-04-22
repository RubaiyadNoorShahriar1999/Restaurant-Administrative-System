<?php
session_start();
if (!$_SESSION['login']) {
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['searchinput']) && isset($_GET['sortby'])) {

    require_once("../model/database.php");

    $search_input = $_GET['searchinput'];
    $sort_by = $_GET['sortby'];

    $json_data = [];


    if(!empty($search_input)){
        $datas = read("management", "w_id", "w_id, w_type, NID, e_id, p_id", "w_id = '$search_input'", $sort_by);
    } else {
        $datas = read("management", "w_id", "w_id, w_type, NID, e_id, p_id", null, $sort_by);
    }

    foreach($datas as $key => $value){
        $email = read("email", "e_id", "email", "e_id = '" . $value['e_id'] . "'")[0]['email'];
        $phone = read("phone", "p_id", "phone", "p_id = '" . $value['p_id'] . "'")[0]['phone'];

        $temp = [
            "w_id" => $value['w_id'],
            "w_type" => $value['w_type'],
            "NID" => $value['NID'],
            "email" => $email,
            "phone" => $phone
        ];

        array_push($json_data, $temp);

        // echo $email . '<br>';
        // echo $phone . '<br>';
        // echo '<pre>';
        // var_dump($value);
        // echo '</pre>';
    }

    // echo '<pre>';
    // var_dump(json_encode($json_data));
    // echo '</pre>';

    // array of associative array to json
    $json_data = json_encode($json_data);

    echo $json_data;

} else {
    echo'{ "message": "Error API" }';
    exit();
}

// [
//     {
//         "w_id": "1",
//         "w_type": "Manger",
//         "email": "nobir@admin.com",
//         "phone": "12345678901",
//         "NID": "1234567890"
//     },
//     {
//         "w_id": "2",
//         "w_type": "Waiter",
//         "email": "nobir@fucker.com",
//         "phone": "12345678901",
//         "NID": "1234567890"
//     },
//     {
//         "w_id": "3",
//         "w_type": "Fucker",
//         "email": "fucker@fucker.com",
//         "phone": "12345678901",
//         "NID": "1234567890"
//     }
// ]