<?php
include '../../comon/connect.php';
include '../../common/functions.php';

if (isset($_POST['do']) && $_POST['do'] == "Add") {
    $category_name = test_input($_POST['category_name']);

    $checkItem = checkItem("category_name", "menu_categories", $category_name);

    if ($checkItem != 0) {
        $data['alert'] = "Warning";
        $data['message'] = "This category name already exists!";
        echo json_encode($data);
        exit();
    } elseif ($checkItem == 0) {
        //Insert into the database
        $stmt = $con->prepare("insert into menu_categories(category_name) values(?) ");
        $stmt->execute(array($category_name));

        $data['alert'] = "Success";
        $data['message'] = "The new category has been inserted successfully !";
        echo json_encode($data);
        exit();
    }
}

if (isset($_POST['do']) && $_POST['do'] == "Delete") {
    $category_id = $_POST['category_id'];

    $query = $conn->query("DELETE FROM menu_categories WHERE category_id = '$category_id'");
}
