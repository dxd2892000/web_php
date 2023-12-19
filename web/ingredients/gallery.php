<section class="image-gallery" id="gallery">
    <div class="container">
        <h2 style="text-align: center;margin-bottom: 30px">IMAGE GALLERY</h2>
        <?php
        $sql_image = "SELECT * FROM `image_gallery`";
        $result_image = $conn->query($sql_image);
        if ($result_image->num_rows > 0) {
            $row_image = $result_image->fetch_all(MYSQLI_ASSOC);
        }

        echo "<div class = 'row'>";

        foreach ($row_image as $row_image_gallery) {
            echo "<div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>";
            $source = "../images/" . $row_image_gallery['image'];
        ?>

            <div style="background-image: url('<?php echo $source; ?>') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
            </div>

        <?php
            echo "</div>";
        }

        echo "</div>";
        ?>
    </div>
</section>