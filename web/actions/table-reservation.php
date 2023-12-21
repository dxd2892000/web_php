<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include_once "../../common/connect.php";
include_once "../../common/functions.php";
if (isset($_POST['submit_table_reservation_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_date = $_POST['selected_date'];
    $selected_time = $_POST['selected_time'];

    $desired_date = $selected_date . " " . $selected_time;

    $number_of_guests = $_POST['number_of_guests'];

    $table_id = $_POST['table_id'];

    $cus_full_name = test_input($_POST['cus_full_name']);
    $cus_phone_number = test_input($_POST['cus_phone_number']);
    $cus_email = test_input($_POST['cus_email']);
    $date = date('Y-m-d H:i');
    $cus_id = NULL;
    $getCustomers = $conn->query("SELECT *FROM customers");
    $customers = $getCustomers->fetch_all(MYSQLI_ASSOC);
    $check = 0;
    foreach ($customers as $cus) {
        if ($cus_full_name === $cus['cus_name'] && ($cus_phone_number === $cus['cus_phone'] || $cus_email === ['cus_email'])) {
            $check += 1;
            $cus_id = $cus['cus_id'];
            break;
        }
    }
    echo $check;
    $conn->begin_transaction();
    try {
        if ($check == 0) {
            $resultCurrentCusID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'customers'");
            $cus_id = $resultCurrentCusID->fetch_row();
            echo "<br>" . $cus_id[0];
            $query_cus = $conn->query("INSERT INTO `customers`(`cus_name`,`cus_phone`,`cus_email`) 
                                    values('$cus_full_name','$cus_phone_number','$cus_email')");
            if ($query_cus === TRUE) {
                echo "hello";
            }

            $query = $conn->query("INSERT INTO reservations(date_created, cus_id, selected_time, amounts, table_id) VALUES('$date', '$cus_id[0]', '$desired_date', '$number_of_guests', '$table_id')");
        } else {
            $query = $conn->query("INSERT INTO reservations(date_created, cus_id, selected_time, amounts, table_id) VALUES('$date', '$cus_id[0]', '$desired_date', '$number_of_guests', '$table_id')");
            if ($query === TRUE) {
                echo "hello Đặt bàn";
            }
        }
        $conn->commit();
        if ($query === TRUE) {
            echo "ĐÚNG";
?>
            <script>
                $(document).ready(function() {
                    alert("Đặt bàn thành công");
                    window.location.href = "../pages/home.php";
                });
            </script>
<?php

        }
    } catch (Exception $e) {
        $con->rollBack();
        echo "<div class = 'alert alert-danger'>";
        echo $e->getMessage();
        echo "</div>";
    }
}
?>