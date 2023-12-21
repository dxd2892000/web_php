<?php
include '../../comon/connect.php';
include '../../common/functions.php';

if (isset($_POST['do_']) && $_POST['do_'] == "Delete") {
	$menu_id = $_POST['menu_id'];

	$query = $conn->query("DELETE from menus where menu_id = '$menu_id'");
}
