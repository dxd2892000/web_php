<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include '../../common/connect.php';
include '../../common/functions.php';
if (isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];
	$query = $conn->query("SELECT *FROM menu_categories WHERE category_id = '$category_id'");
	if($query->num_rows >0){
?>
<script>
$(document).ready(function() {
    // Hiển thị hộp thoại xác nhận
    swal({
      title: "Bạn có chắc?",
      text: "Bạn sẽ xóa mục này!",
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
		$conn->query("DELETE from menu_categories where category_id = '$category_id'"); 
		header("Location:../menu_categories.php");
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
	header("Location:../menu_categories.php");
}
} 
?>