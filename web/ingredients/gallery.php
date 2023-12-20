<?php
$query = $conn->query("SELECT menu_image FROM menus LIMIT 20");
$rows = $query->fetch_all(MYSQLI_ASSOC);
?>
<div class="image-gallery">
    <h2 style="text-align: center;margin-bottom: 30px">IMAGE GALLERY</h2>
    <div class="slider-container">
        <?php
        foreach ($rows as $row) {
            $source = "../../images/foods/" . $row['menu_image'];
            // echo $source;
        ?>
            <div class="slide fade">
                <img src="<?php echo $source; ?>" alt="Slide 2">
            </div>
        <?php
        }
        ?>

        <!-- <div class="slide fade">
            <img src="image2.jpg" alt="Slide 2">
        </div>
        <div class="slide fade">
            <img src="image3.jpg" alt="Slide 3">
        </div> -->
        <!-- Thêm các slide khác nếu cần -->
    </div>
</div>


<style>
    .slider-container {
        position: relative;
        width: 100%;
        max-width: 600px;
        margin: auto;
    }

    .slide {
        display: none;
    }

    img {
        width: 80%;
    }

    .fade {
        animation: fade 2s ease-in-out infinite;
    }

    @keyframes fade {

        0%,
        100% {
            opacity: 0;
        }

        25%,
        75% {
            opacity: 1;
        }
    }
</style>

<script>
    let slideIndex = 0;

    function showSlides() {
        let i;
        const slides = document.getElementsByClassName("slide");

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slideIndex++;

        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        slides[slideIndex - 1].style.display = "block";

        setTimeout(showSlides, 2000); // Thay đổi 2000 thành thời gian hiển thị mỗi slide (milliseconds)
    }

    document.addEventListener("DOMContentLoaded", showSlides);
</script>