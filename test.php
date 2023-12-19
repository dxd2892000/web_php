<?php
include "common/connect.php";
// $stmt_menus = $conn->prepare("Select * from menus where category_id = ?");
// $stmt_menus->execute(array($row['category_id']));
// $stmt_menus->execute([1]);
// $result_menus = $stmt_menus->get_result();

// if ($result_menus->num_rows == 0) {
//     echo "<div style='margin:auto'>No Available Menus for this category!</div>";
// }else{
//     $rows_menus = $result_menus->fetch_all(MYSQLI_ASSOC);
// }
// var_dump($rows_menus);
// echo "<br>";
// echo $rows_menus[0]['menu_id'];

// $stat_ = $conn->query("SELECT COUNT(cus_id) FROM customers");

// $stmt = $conn->prepare("SELECT * FROM menus m, menu_categories mc where mc.category_id = m.category_id");
// $stmt->execute();
// $result = $stmt->get_result();
// $menus = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($menus);
// echo "<br>";
// echo $menus['menu_id'][1];

// $stmt = $conn->query("SELECT * FROM menu_categories");
// $menu_categories = $stmt->fetch_all(MYSQLI_ASSOC);
// var_dump($menu_categories);
// $request = $conn->query("SELECT menu_name,menu_image FROM menus");
// $result = $request->fetch_all(MYSQLI_ASSOC);
// foreach($result as $row){
//     $conn->query("INSERT INTO `image_gallery` (`image_name`, `image`) VALUES ()")
// }
// $resultCurrentCusID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'customers'");
// $cus_id = $resultCurrentCusID->fetch_row();
// var_dump($cus_id);
// echo $cus_id[0];
$query = $conn->query("SELECT `user_id`, `username`, `password` FROM `users` WHERE `username` = 'ducdx' AND `password` = 'duc12345'");
$rows = $query->fetch_assoc();
$count = $query->num_rows;
var_dump($rows);
echo "<br>".$count;
echo "<br>".$rows['user_id'];