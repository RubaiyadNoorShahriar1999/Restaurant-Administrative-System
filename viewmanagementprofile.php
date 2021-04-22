<?php require_once("./controller/deps.php"); ?>
<?php header_section("Add Management"); ?>
<?php
if ($_SESSION['login'] == false) {
    header("Location: login.php");
    exit();
}
?>

<main class="clearfix">

    <?php

    // $json_data = file_get_contents("db/managementdata.json");
    // $json_data = json_decode($json_data);

    $email = "";
    $phone = "";
    $error_message = [];
    $success_message = "";
    $management_users = read("management", "w_id");

    if (isset($_GET['successfull'])) {
        if ($_GET['successfull'] == "true") {
            // var_dump($_GET);
            $success_message = "Successfully Deleted";
        }
    }

    if (isset($_GET['errors'])) {
        $errors_code = explode(",", $_GET['errors']);
    
        foreach ($errors_code as $error) {
            if ($error == "emptyid") {
                array_push($error_message, "Empty Delete ID");
            }
            if ($error == "notvalid") {
                array_push($error_message, "Delete ID is not valid");
            }
            if ($error == "notintid") {
                array_push($error_message, "Delete ID is not numaric value");
            }
            if ($error == "deleteunsuccessfull") {
                array_push($error_message, "Delete ID not found");
            }
        }
    }

    // echo '<pre>';
    // var_dump($management_users);
    // echo '</pre>';
    // return;

    // foreach ($management_users as $management_user) {
    //     echo $management_user['r_name'];
    // }
    // return;


    ?>

    <h1 class="main-title">Management List</h1>
    <?php if (count($error_message)) : ?>

    <div class="errors-list">
        <table>
            <tbody>

                <?php foreach ($error_message as $err_msg) : ?>

                    <tr>
                        <td>!! <?php echo $err_msg; ?></td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <?php endif; ?>
    <?php if (!empty($success_message)) : ?>

        <div class="success">
            <table>
                <tbody>
                    <tr>
                        <td><?php echo $success_message; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

    <form id ="view-management">
        <table>
            <tbody>
                 <tr>
                    <td><label for="searchinput">Search by Worker ID</label></td>
                    <td><input class="inp" id="searchinput" type="number" name="searchinput" onkeyup="getManagementData()"></td>
                    <td><label for="sortby">Sort By</label></td>
                    <td>
                        <select class="inp" name="sortby" id="sortby" onchange="getManagementData()">
                            <option value="w_id">Worker ID</option>
                            <option value="w_type">Worker Type</option>
                        </select>
                    </td>
                    <!-- <td><button class="btn" id="search" type="submit" name="search">Search</button></td> -->
                </tr>
            </tbody>
        </table>
    </form>

    <!-- <div id="search-bar">
        <label> Search : </label>
        <input type="text" id="search" autocomplete="off">
    </div> -->

    <?php if (is_array($management_users) && count($management_users) > 0 && empty($error_message)) : ?>
        <form action="./controller/deletemanagement.php">
            <table id="view-mngmnt" class="view-mngmnt">
            </table>
        </form>
    <?php else: ?>
        <div class="errors-list">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align:center;">!! No data found</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php footer_section(); ?>