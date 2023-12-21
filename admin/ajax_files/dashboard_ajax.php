<?php
include '../../comon/connect.php';
include '../../common/functions.php';

if (isset($_POST['do_']) && $_POST['do_'] == "Deliver_Order") {
	$order_id = $_POST['order_id'];

	$query = $conn->query("update placed_orders set delivered = 1 where order_id = '$order_id'");
} elseif (isset($_POST['do_']) && $_POST['do_'] == "Cancel_Order") {
	$order_id = $_POST['order_id'];
	$cancellation_reason_order = test_input($_POST['cancellation_reason_order']);

	$query = $conn->query("UPDATE placed_orders SET canceled = 1, cancellation_reason = '$cancellation_reason_order' WHERE order_id = '$order_id'");
}
