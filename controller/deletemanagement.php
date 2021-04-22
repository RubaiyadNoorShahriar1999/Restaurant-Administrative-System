<?php

if(isset($_GET['id'])) {
    require_once("../model/database.php");

    $erros_code = [];

    $id = !empty($_GET['id']) ? $_GET['id'] : array_push($erros_code, "emptyid");
    ;

    $id = !empty(filter_var($id, FILTER_SANITIZE_STRING)) ? filter_var($id, FILTER_SANITIZE_STRING) : array_push($erros_code, "notvalid");

    $id = !empty($id) && filter_var($id, FILTER_VALIDATE_INT) ? filter_var($id, FILTER_VALIDATE_INT) : array_push($erros_code, "notintid");


    $url = "";
    if (count($erros_code)) {
        $url .= "?errors=";
        // $url = "";
        for ($i = 0; $i < count($erros_code); ++$i) {
            $url .= $erros_code[$i];

            if ($i !== count($erros_code)-1) {
                $url .= ',';
            }
        }

        // url = http://localhost/registration_ra.php?errors=name,duplicate,password,

        // echo '<pre>';
        // var_dump($url);
        // echo '</pre>';

        header("Location: ../viewmanagementprofile.php$url");
        // if($url === "emptyid"){
        //     echo '{"error":"Empty Delete ID"}';
        // } elseif ($url === "notvalid") {
        //     echo '{"error":"Delte ID is not valid"}';
        // } elseif ($url === "notintid") {
        //     echo '{"error":"Delete ID is not numeric"}';
        // }

        exit();
    }

    // echo '<pre>';
    // var_dump($id);
    // echo '</pre>';

    $is_deleted = delete("management", "w_id = $id") ? true : false;

    if (!$is_deleted) {
        header("Location: ../viewmanagementprofile.php?errors=deleteunsuccessfull");
        // echo '{"error":"Delete Unsuccessfull"}';
        exit();
    }

    // echo $is_deleted;
    
    header("Location: ../viewmanagementprofile.php?successfull=true");
    exit();

} else {
    header("Location: ../viewmanagementprofile.php");
    // echo '{"error":"Invalie URL"}';
    exit();
}