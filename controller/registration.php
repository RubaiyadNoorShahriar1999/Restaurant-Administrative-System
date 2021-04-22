<?php

if (isset($_POST)) {
    require_once("../model/database.php");

    $errors = [];
    $name = (isset($_POST['name'])) ? htmlentities(htmlspecialchars($_POST['name'])) : '';
    $email = (isset($_POST['email'])) ? htmlentities(htmlspecialchars($_POST['email'])) : '';
    $adminid = (isset($_POST['adminid'])) ? htmlentities(htmlspecialchars($_POST['adminid'])) : '';
    $rid = (isset($_POST['rid'])) ? htmlentities(htmlspecialchars($_POST['rid'])) : '';
    $wtype = (isset($_POST['wtype'])) ? htmlentities(htmlspecialchars($_POST['wtype'])) : '';
    $phone = (isset($_POST['phone'])) ? htmlentities(htmlspecialchars($_POST['phone'])) : '';
    $location = (isset($_POST['location'])) ? htmlentities(htmlspecialchars($_POST['location'])) : '';
    $nid = (isset($_POST['nid'])) ? htmlentities(htmlspecialchars($_POST['nid'])) : '';
    $password = (isset($_POST['password'])) ? htmlentities(htmlspecialchars($_POST['password'])) : '';
    $cpassword = (isset($_POST['cpassword'])) ? htmlentities(htmlspecialchars($_POST['cpassword'])) : '';
    $type = (isset($_POST['type'])) ? htmlentities(htmlspecialchars($_POST['type'])) : '';

    if (empty($name) && ($type === "user" || $type === "restaurantadmin")) {
        array_push($errors, "emptyname");
    }

    if (empty($email)) {
        array_push($errors, "emptyemail");
    }

    if (empty($adminid) && ($type === "user" || $type === "restaurantadmin")) {
        array_push($errors, "emptyadminid");
    }

    if (empty($rid) && $type === "management") {
        array_push($errors, "emptyrid");
    }

    if (empty($wtype) && $type === "management") {
        array_push($errors, "emptywtype");
    }

    if (empty($phone) && ($type === "user" || $type === "management")) {
        array_push($errors, "emptyphone");
    }

    if (empty($location) && ($type === "user" || $type === "restaurantadmin")) {
        array_push($errors, "emptylocation");
    }

    if (empty($nid)) {
        array_push($errors, "emptynid");
    }

    if (empty($password)) {
        array_push($errors, "emptypassword");
    }

    if (empty($cpassword)) {
        array_push($errors, "emptycpassword");
    }

    if (empty($type)) {
        array_push($errors, "emptytype");
    }

    if (isset($_POST['name']) && !empty($name)) {
        if (strlen($name) < 2 || preg_match("/[a-zA-z0-9]/", $name) != 1) {
            array_push($errors, "name");
        }
    }
    if (isset($_POST['password']) && !empty($password)) {
        if (strlen($password) < 8 || preg_match("/[\@|\#|\$|\%]/", $password) != 1) {
            array_push($errors, "password");
        }
    }

    if (isset($_POST['cpassword']) && !empty($cpassword)) {
        if ($cpassword !== $password) {
            array_push($errors, "cpassword");
        }
    }

    if (isset($_POST["email"]) && !empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "email");
        }
    }

    if (isset($_POST['type']) && !empty($type)) {
        if (empty($type) || preg_match("/restaurantadmin|management|user|addmanagement.php/", $type) != 1) {
            array_push($errors, "type");
        }
    }

    if (isset($_POST['email']) && !empty($email)) {
        if (isExist("email", "email", $email)) {
            array_push($errors, "duplicate");
        }
    }

    if (isset($_POST['rid']) && !empty($rid)) {
        if (!isExist("restaurant_admin", "r_id", $rid)) {
            array_push($errors, "ridnotfound");
        }
    }

    if (count($errors)) {
        $url = "?errors=";
        for ($i = 0; $i < count($errors); ++$i) {
            $url = $url . $errors[$i] . ',';
        }

        if ($type === "restaurantadmin") {
            header("Location: ../registration_ra.php$url");
            exit();
        } else if ($type === "management") {
            header("Location: ../registration_m.php$url");
            exit();
        } else if ($type === "addmanagement") {
            header("Location: ../addmanagement.php$url");
            exit();
        } else if ($type === "user") {
            header("Location: ../registration_u.php$url");
            exit();
        }
    }

    if ($type === "restaurantadmin") {
        $e_id = "";
        $L_id = "";

        create("email", "'$email'");
        create("location", "'$location'");

        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]["e_id"];
        $L_id = read("location", "L_id", "L_id", "Location = '$location'")[0]["L_id"];

        create(
            "restaurant_admin",
            "'$name', '$password', '$nid', '', '$e_id', '$L_id', '$adminid'"
        );

        header("Location: ../registration_ra.php?successfull=true");
        exit();
    } else if ($type === "management" || $type === "addmanagement") {
        $e_id = "";
        $p_id = "";
        // $w_id = "";

        create("email", "'$email'");
        create("phone", "'$phone'");

        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]["e_id"];
        $p_id = read("phone", "p_id", "p_id", "phone = '$phone'")[0]["p_id"];

        create(
            "management",
            "'$wtype', '$password', '$nid', '', '$e_id', '$p_id', '$rid'"
        );

        if ($type === "management") {
            header("Location: ../registration_m.php?successfull=true");
            exit();
        } else if ($type === "addmanagement") {
            header("Location: ../addmanagement.php?successfull=true");
            exit();
        }
    } else if ($type === "user") {
        $e_id = "";
        $L_id = "";
        $p_id = "";

        create("email", "'$email'");
        create("phone", "'$phone'");
        create("location", "'$location'");

        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]["e_id"];
        $p_id = read("phone", "p_id", "p_id", "phone = '$phone'")[0]["p_id"];
        $L_id = read("location", "L_id", "L_id", "Location = '$location'")[0]["L_id"];

        create(
            "user",
            "'$name', '$password', $nid, '', '$e_id', '$p_id', '$L_id', '$adminid'"
        );
        
        header("Location: ../registration_u.php?successfull=true");
        exit();
    }
} else {
    header("Location: ../registration.php");
    exit();
}
