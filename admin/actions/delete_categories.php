<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include '../../common/connect.php';
include '../../common/functions.php';
if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];
  $query = $conn->query("SELECT *FROM menu_categories WHERE category_id = '$category_id'");
  if ($query->num_rows > 0) {
    $query_delete = $conn->query("DELETE from menu_categories where category_id = '$category_id'");
    if ($query_delete === TRUE) {
?>
      <script>
        $(document).ready(function() {
          alert("Xóa thành công");
          window.location.href = "../menu_categories.php";
        });
      </script>
<?php
    }
  } else {
    header("Location:../menu_categories.php");
  }
}
?>