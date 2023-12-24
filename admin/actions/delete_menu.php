<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<?php
include '../../common/connect.php';
include '../../common/functions.php';
?>

<?php
if (isset($_GET['menu_id'])) {
  $menu_id = $_GET['menu_id'];
  $query = $conn->query("SELECT *FROM menus WHERE menu_id = '$menu_id'");
  if ($query->num_rows > 0) {
    $query_menu = $conn->query("DELETE from menus where menu_id = '$menu_id'");
    if ($query_menu === TRUE) {
?>
      <script>
        $(document).ready(function() {
          alert("Xóa thành công");
          window.location.href = "../menus.php";
        });
      </script>
<?php
    }
  } else {
    header("Location:../menus.php");
  }
}
?>