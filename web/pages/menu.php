<?php
include("../../common/connect.php");
include "../ingredients/header.php";
?>

<body>
    <?php include("../ingredients/navbar.php") ?>
    <div class="our_menus">
        <div class="container">
            <h2 style="text-align: center;margin-bottom: 30px">DANH SÁCH CÁC MÓN</h2>
            <div class="menus_tabs">
                <div class="menus_tabs_picker">
                    <ul style="text-align: center;margin-bottom: 70px">
                        <?php
                        // CATEGORIES
                        $result = $conn->query("SELECT * FROM `menu_categories`");
                        if ($result->num_rows > 0) {
                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                        }
                        foreach ($rows as $row) {
                            echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'" . str_replace(' ', '', $row['category_name']) . "')>";
                            echo $row['category_name'];
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="menus_tab">
                    <?php
                    $i = 0;
                    foreach ($rows as $row) {
                        if ($i == 0) {

                            echo '<div class="menu_item  tab_category_content" id="' . str_replace(' ', '', $row['category_name']) . '" style=display:block>';
                            $cate_id = $row['category_id'];
                            $query_menus = $conn->query("SELECT * FROM menus WHERE category_id = $cate_id");

                            if ($query_menus->num_rows == 0) {
                                echo "<div style='margin:auto'>No Available Menus for this category!</div>";
                            } else {
                                $rows_menus = $query_menus->fetch_all(MYSQLI_ASSOC);
                            }

                            echo "<div class='row'>";
                            foreach ($rows_menus as $menu) {
                    ?>

                                <div class="col-md-4 col-lg-3 menu-column">
                                    <div class="thumbnail" style="cursor:pointer">
                                        <?php $source = "../../images/foods/" . $menu['menu_image']; ?>

                                        <div class="menu-image">
                                            <div class="image-preview">
                                                <div style="background-image: url('<?php echo $source; ?>');"></div>
                                            </div>
                                        </div>

                                        <div class="caption">
                                            <h5>
                                                <?php echo $menu['menu_name']; ?>
                                            </h5>
                                            <p>
                                                <?php echo $menu['menu_description']; ?>
                                            </p>
                                            <span class="menu_price">
                                                <?php echo $menu['menu_price']." nghìn đồng"; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            echo "</div>";

                            echo '</div>';
                        } else {

                            echo '<div class="menus_categories  tab_category_content" id="' . str_replace(' ', '', $row['category_name']) . '">';
                            $cate_id = $row['category_id'];
                            $request_menus = $conn->query("SELECT * FROM menus WHERE category_id = $cate_id");

                            if ($request_menus->num_rows == 0) {
                                echo "<div class = 'no_menus_div'>No Available Menus for this category!</div>";
                            } else {
                                $rows_menus = $request_menus->fetch_all(MYSQLI_ASSOC);
                            }

                            echo "<div class='row'>";
                            foreach ($rows_menus as $menu) {
                            ?>

                                <div class="col-md-4 col-lg-3 menu-column">
                                    <div class="thumbnail" style="cursor:pointer">
                                        <?php $source = "../../images/foods/" . $menu['menu_image']; ?>
                                        <div class="menu-image">
                                            <div class="image-preview">
                                                <div style="background-image: url('<?php echo $source; ?>');"></div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <h5>
                                                <?php echo $menu['menu_name']; ?>
                                            </h5>
                                            <p>
                                                <?php echo $menu['menu_description']; ?>
                                            </p>
                                            <span class="menu_price">
                                                <?php echo $menu['menu_price']." nghìn đồng"; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                    <?php
                            }
                            echo "</div>";

                            echo '</div>';
                        }

                        $i++;
                    }

                    echo "</div>";

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "../ingredients/widget.php";
    include "../ingredients/footer.php";
    ?>
</body>
<style>
    .thumbnail {
        display: block;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        -webkit-transition: border .2s ease-in-out;
        -o-transition: border .2s ease-in-out;
        transition: border .2s ease-in-out;
        text-align: center;
        background: inherit;
    }

    .our_menus,
    .image-gallery {
        color: #dce4e8;
        padding: 100px 0px;
        background: #158eca;
    }

    .our_menus {
        background-color: #f5fcf4;
        color: black;
    }

    .menu_category_name {
        display: inline-block;
        cursor: pointer;
        vertical-align: top;
        font-size: 18px;
        line-height: 26px;
        letter-spacing: 4px;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0 22px;
        -webkit-transition: all .3s;
        transition: all .3s;
    }

    .tab_category_content {
        display: none;
    }


    .no_menus_div {
        margin: auto;
        font-size: 26px;
        font-weight: bold;
        width: fit-content;
        /* color: #705c32; */
    }

    /* .active_category {
        color: #907333;
    } */


    .menu-image {
        position: relative;
        max-width: 200px;
        margin: 50px auto;
    }

    .menu-image .image-preview {
        width: 200px;
        height: 200px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #222227;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .menu-image .image-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }


    .thumbnail>.caption>p {
        font-size: 14px;
        line-height: 28px;
        margin-top: 14px;
    }

    .menu_price {
        font-size: 24px;
        line-height: 26px;
        letter-spacing: 3px;
        display: block;
    }
</style>