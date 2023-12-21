<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include '../../common/connect.php';
include '../../common/functions.php';
?>

<?php
if (isset($_GET['menu_id'])) {
	$menu_id = $_GET['menu_id'];
	$query = $conn->query("SELECT *FROM menus WHERE menu_id = '$menu_id'");
	if($query->num_rows >0){
?>
<script>
$(document).ready(function() {
    // Hiển thị hộp thoại xác nhận
    swal({
      title: "Bạn có chắc?",
      text: "Bạn sẽ xóa đồ ăn này!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Item has been deleted!", {
          icon: "success",
        });
		<?php 
		$conn->query("DELETE from menus where menu_id = '$menu_id'"); 
		header("Location:../menus.php");
		?>
      } else {
        swal("Item is safe!", {
          icon: "info",
        });
      }
    });
});
</script>
<?php 
}else {
	header("Location:../menus.php");
}
} 


?>


