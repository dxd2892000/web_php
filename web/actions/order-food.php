<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include_once "../../common/connect.php";
include_once "../../common/functions.php";

if (isset($_POST['submit_order_food_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Selected Menus

    $selected_menus = $_POST['selected_menus'];

    //cus Details

    $cus_full_name = test_input($_POST['cus_full_name']);
    $delivery_address = test_input($_POST['cus_delivery_address']);
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

    $conn->begin_transaction();
    try {
        if ($check == 0) {
            $resultCurrentCusID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'customers'");
            $cus_id = $resultCurrentCusID->fetch_row();
            $query_cus = $conn->query("INSERT INTO `customers`(`cus_name`,`cus_phone`,`cus_email`) 
                                    values('$cus_full_name','$cus_phone_number','$cus_email')");
            $resultCurrentOrderID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'placed_orders'");
            $ord_id = $resultCurrentOrderID->fetch_row();
            $query_order = $conn->query("INSERT INTO placed_orders(order_time, cus_id, delivery_address) VALUES('$date', '$cus_id[0]', '$delivery_address')");
            foreach ($selected_menus as $menu) {
                $query = $conn->query("INSERT INTO in_order(order_id, menu_id) VALUES('$ord_id[0]', '$menu')");
            }
        } else {
            $resultCurrentOrderID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'placed_orders'");
            $ord_id = $resultCurrentOrderID->fetch_row();
            $query_order = $conn->query("INSERT INTO placed_orders(order_time, cus_id, delivery_address) VALUES('$date', '$cus_id', '$delivery_address')");
            foreach ($selected_menus as $menu) {
                $query = $conn->query("INSERT INTO in_order(order_id, menu_id) VALUES('$ord_id[0]', '$menu')");
            }

        }
        $conn->commit();
        if ($query === TRUE) {
?>
            <script>
                $(document).ready(function() {
                    alert("Đặt đồ thành công");
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