<?php
ob_start();
session_start();
include '../common/connect.php';
include '../common/functions.php';
include 'Includes/templates/header.php';
include 'Includes/templates/navbar.php';
$pageTitle = 'Menu Categories';

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $do = '';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
        echo $do;
    } else {
        $do = "Manage";
    }

?>
    <?php

    $query = $conn->query("SELECT * FROM menu_categories");
    $menu_categories = $query->fetch_all(MYSQLI_ASSOC);
    if ($do == "Manage") {

    ?>
        <div class="card">
            <div class="card-header">
                <?php echo $pageTitle; ?>
            </div>
            <div class="card-body">

                <!-- ADD NEW CATEGORY BUTTON -->

                <button class="btn btn-success btn-sm" style="margin-bottom: 10px;">
                    <a href="menu_categories.php?do=Add">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </a>
                </button>
                <!-- MENU CATEGORIES TABLE -->
                <table class="table table-bordered categories-table">
                    <thead>
                        <tr>
                            <th scope="col">Category ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($menu_categories as $category) {
                            echo "<tr>";
                            echo "<td>";
                            echo $category['category_id'];
                            echo "</td>";
                            echo "<td style = 'text-transform:capitalize'>";
                            echo $category['category_name'];
                            echo "</td>";
                            echo "<td>";
                            /****/
                            $delete_data = $category["category_id"];
                        ?>
                            <ul class="list-inline m-0">

                                <!-- DELETE BUTTON -->

                                <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                    <button class="btn btn-danger btn-sm rounded-0">
                                    <a href="actions/delete_categories.php?category_id=<?php echo $delete_data;?>" style="color: white;">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    </button>
                                </li>
                            </ul>
                        <?php
                            /****/
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } elseif ($do == "Add") { ?>
        <div class="card">
            <div class="card-header">
                Add New Category
            </div>
            <div class="card-body">
                <form method="POST" class="menu_form" action="menu_categories.php?do=Add" enctype="multipart/form-data">
                    <div class="panel-X">
                        <div class="panel-header-X">
                            <div class="main-title">
                                Add New Category
                            </div>
                        </div>
                        <div class="save-header-X">
                            <div style="display:flex">
                                <div class="icon">
                                    <i class="fa fa-sliders-h"></i>
                                </div>
                                <div class="title-container">Category details</div>
                            </div>
                            <div class="button-controls">
                                <button type="submit" name="add_new_category" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <div class="panel-body-X">

                            <!-- MENU NAME INPUT -->

                            <div class="form-group">
                                <label for="menu_name">Category Name</label>
                                <input type="text" class="form-control" placeholder="Category Name" name="category_name">
                                <?php
                                $flag_add_menu_form = 0;

                                if (isset($_POST['add_new_category'])) {
                                    if (empty(test_input($_POST['category_name']))) {
                                ?>
                                        <div class="invalid-feedback" style="display: block;">
                                            Menu name is required.
                                        </div>
                                <?php

                                        $flag_add_menu_form = 1;
                                    }
                                }
                                ?>
                            </div>


                        </div>
                    </div>
            </div>
            </form>
        </div>
        <?php

        /*** ADD NEW CATEGORY ***/

        if (isset($_POST['add_new_category']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_add_menu_form == 0) {
            $category_name = test_input($_POST['category_name']);
            try {
                $query = $conn->query("INSERT INTO menu_categories(category_name) VALUES('$category_name') ");
        ?>
                <!-- SUCCESS MESSAGE -->

                <script type="text/javascript">
                    swal("New category", "The new category has been inserted successfully", "success").then((value) => {
                        window.location.replace("menu_categories.php");
                    });
                </script>

            <?php

            } catch (Exception $e) {
                echo 'Error occurred: ' . $e->getMessage();
            }
        }
    }
        ?>
<?php

    /*** FOOTER BOTTON ***/

    include 'Includes/templates/footer.php';
} else {
    header('Location: index.php');
    exit();
}

?>

<style type="text/css">
    .categories-table {
        -webkit-box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15) !important;
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15) !important;
        text-align: center;
        vertical-align: middle;
    }
</style>