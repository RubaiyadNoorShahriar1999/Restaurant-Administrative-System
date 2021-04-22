<?php
session_start();

if (isset($_POST)) {
    require_once("../model/database.php");

    $notFound = true;
    $errors_code = [];
    $id = "";
    $name = "";
    $email_store = "";
    $location = "";
    $phone = "";
    $nid = "";
    $worktype = "";
    $purl = "";
    $user = [];
    $email = (isset($_POST['email'])) ? htmlentities(htmlspecialchars($_POST['email'])) : '';
    $password = (isset($_POST['password'])) ? htmlentities(htmlspecialchars($_POST['password'])) : '';

    $type = (isset($_POST['type'])) ? htmlentities(htmlspecialchars($_POST['type'])) : '';

    if (empty($email)) {
        array_push($errors_code, "emptyemail");
    }
    if (empty($password)) {
        array_push($errors_code, "emptypass");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
        array_push($errors_code, "email");
    }

    if (count($errors_code)) {
        $url = "?errors=";
        for ($i = 0; $i < count($errors_code); ++$i) {
            $url = $url . $errors_code[$i] . ',';
        }
        session_unset();
        session_destroy();
        header("Location:../login.php$url");
        exit();
    }
  
    if ($type === "restaurantadmin" && isExist("email", "email", "$email")) {
        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]['e_id'];

        $user = read("restaurant_admin", "r_id", "*", "e_id = '$e_id' AND password = '$password'");
        $user = (is_array($user) && count($user) > 0) ? $user[0] : [];

        if (count($user) > 0) {

            $L_id = $user['L_id'];
            $location = read("location", "L_id", "Location", "L_id = '$L_id'")[0]['Location'];
            $id = $user['r_id'];
            $name = $user['r_name'];
            $email_store = $email;
            $nid = $user['NID'];
            $location = $location;
            $purl = $user['purl'];
            $notFound = false;
        } else {
            session_unset();
            session_destroy();
            header("Location: ../login.php?errors=notlogin");
            exit();
        }
    } else if ($type === "management" && isExist("email", "email", "$email")) {
        # Sufian's code

    } else if ($type === "user" && isExist("email", "email", "$email")) {
        # Naimul's code

    } else if ($type === "admin" && isExist("email", "email", "$email")) {
        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]['e_id'];

        $user = read("admin", "id", "*", "e_id = '$e_id' AND password = '$password'");
        $user = (is_array($user) && count($user) > 0) ? $user[0] : [];
        if (count($user) > 0) {

            $phone = read("phone", "p_id", "phone", "p_id = '" . $user['p_id'] . "'");
            $phone = (is_array($phone) && count($phone) > 0) ? $phone[0]['phone'] : "N/A";

            $id = $user['id'];
            $name = $user['a_name'];
            $email_store = $email;
            $nid = $user['NID'];
            $purl = $user['purl'];
            $notFound = false;
        } else {
            session_unset();
            session_destroy();
            header("Location: ../login.php?errors=notlogin");
            exit();
        }
    }

    if ($notFound) {
        session_unset();
        session_destroy();
        header("Location: ../login.php?errors=notlogin");
        exit();
    }

    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email_store;
    $_SESSION['nid'] = $nid;
    $_SESSION['location'] = $location;
    $_SESSION['phone'] = $phone;
    $_SESSION['type'] = $type;
    $_SESSION['purl'] = $purl;
    $_SESSION['login'] = true;

    header("Location: ../dashboard.php");
    exit();
} else {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}
