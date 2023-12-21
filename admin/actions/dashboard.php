<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include '../../common/connect.php';
include '../../common/functions.php';
if (isset($_GET['do'])) {
	$do = $_GET['do'];
	if ($do == "ShowCustomer") {
		if (isset($_GET['cus_id'])) {
			$cus_id = $_GET['cus_id'];
			$query = $conn->query("SELECT *FROM customers WHERE cus_id = '$cus_id'");
			$row = $query->fetch_assoc();
?>
			<script>
				$(document).ready(function() {
					alert("<?php echo $row['cus_name'] ?>---<?php echo $row['cus_email'] ?>---<?php echo $row['cus_phone'] ?>");
					window.location.href = "../dashboard.php";
				});
			</script>
			<?php
		} else {
			header("Location: ../dashboard.php");
		}
	} elseif ($do == "Deliver") {
		if (isset($_GET['order_id'])) {
			$order_id = $_GET['order_id'];
			$query = $conn->query("UPDATE placed_orders set delivered = 1 where order_id = '$order_id'");
			if ($query === TRUE) {
			?>
				<script>
					$(document).ready(function() {
						alert("Cập nhật thành công");
						window.location.href = "../dashboard.php";
					});
				</script>
<?php

			}
		}else{
			header("Location: ../dashboard.php");
		}
	}elseif($do == "Cancel"){
		if (isset($_GET['order_id'])) {
			$order_id = $_GET['order_id'];
			$query = $conn->query("UPDATE placed_orders SET canceled = 1 WHERE order_id = '$order_id'");
			if ($query === TRUE) {
			?>
				<script>
					$(document).ready(function() {
						alert("Hủy thành công");
						window.location.href = "../dashboard.php";
					});
				</script>
<?php

			}
		}else{
			header("Location: ../dashboard.php");
		}
	}elseif($do == "Liberate"){
		if (isset($_GET['data'])) {
			$reservation_id = $_GET['data'];
			$query = $conn->query("UPDATE reservations SET liberated = 1 WHERE reservation_id = '$reservation_id'");
			if ($query === TRUE) {
			?>
				<script>
					$(document).ready(function() {
						alert("Cập nhật thành công");
						window.location.href = "../dashboard.php";
					});
				</script>
<?php

			}
		}else{
			header("Location: ../dashboard.php");
		}
	}elseif($do == "Cancel"){
		if (isset($_GET['data'])) {
			$reservation_id = $_GET['data'];
			$query = $conn->query("UPDATE reservations SET canceled = 1 WHERE reservation_id = '$reservation_id'");
			if ($query === TRUE) {
			?>
				<script>
					$(document).ready(function() {
						alert("Hủy thành công");
						window.location.href = "../dashboard.php";
					});
				</script>
<?php

			}
		}else{
			header("Location: ../dashboard.php");
		}
	}
}
?>
