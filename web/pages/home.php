<?php
include "../../common/connect.php";
include "../ingredients/header.php";
?>

<body>
    <?php
    include("../ingredients/navbar.php");
    ?>
    <section class="home-section">
        <div class="container">
            <div class="row" style="flex-wrap: nowrap;">
                <div class="col-md-6 home-left-section">
                    <div style="padding: 100px 0px">
                        <h1>
                            HUS FOODIES
                        </h1>
                        <h2>
                            MAKING PEOPLE HAPPY
                        </h2>
                        <hr>
                        <p>
                            Chuyên phục vụ các món ăn bình dân
                        </p>
                        <div style="display: flex;">
                            <a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
                                GỌI MÓN
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
                                MENU
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 home-right-section">
                    <img src="../../common/heroimg.png" alt="HOME IMAGE">
                </div>

            </div>
        </div>
    </section>
    <?php
    //OUR QUALITIES SECTION

    include("../ingredients/qualyties.php");

    //  IMAGE GALLERY


    include "../ingredients/gallery.php";

    //  WIDGET SECTION / FOOTER 

    include "../ingredients/widget.php";
    include "../ingredients/footer.php" ?>
</body>
<style>
    .home-section {
        background-color: #f5fcf4;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 650px;
        background-attachment: fixed;
        color: black;
    }

    .bttn_style_1 {
        font-family: "Work Sans", sans-serif;
        letter-spacing: 3px;
        background-color: transparent;
        color: black !important;
        line-height: 45px;
        display: inline-block;
        padding: 0 25px;
        border-radius: 0;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        position: relative;
        border: 2px solid black;
        opacity: 1;
    }

    .bttn_style_1:hover {
        opacity: 0.6;
    }

    .bttn_style_2 {
        font-family: "Work Sans", sans-serif;
        letter-spacing: 3px;
        background-color: #ffc851;
        color: rgb(18, 22, 24);
        line-height: 45px;
        display: inline-block;
        padding: 0 25px;
        border-radius: 0;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        position: relative;
        border: 2px solid #ffc851;
        overflow: hidden;
        z-index: 1;
        -webkit-transition: color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -moz-transition: color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -ms-transition: color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -o-transition: color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transition: color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .bttn_style_2:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: #222227;
        -webkit-transform-origin: right center;
        -moz-transform-origin: right center;
        -ms-transform-origin: right center;
        transform-origin: right center;
        -webkit-transform: scale(0, 1);
        -moz-transform: scale(0, 1);
        -ms-transform: scale(0, 1);
        -o-transform: scale(0, 1);
        transform: scale(0, 1);
        -webkit-transition: -webkit-transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -moz-transition: -moz-transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -ms-transition: -ms-transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        -o-transition: -o-transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: -1;
    }

    .bttn_style_2:hover:before {
        -webkit-transform-origin: left center;
        -moz-transform-origin: left center;
        -ms-transform-origin: left center;
        transform-origin: left center;
        -webkit-transform: scale(1, 1);
        -moz-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .bttn_style_2:hover {
        color: #0fa131;
        border-color: #222227;
    }

    .home-section h1 {
        color: rgb(1, 0, 0);
        white-space: nowrap;
        letter-spacing: 12px;
        font-weight: 400;
        font-size: 50px;
    }

    .home-section h2 {
        color: rgb(3, 1, 1);
        white-space: nowrap;
        letter-spacing: 12px;
        font-weight: 400;
        font-size: 30px;
    }

    .home-section p {
        color: rgb(12, 2, 2);
        white-space: nowrap;
        letter-spacing: 2px;
        font-weight: 300;
        font-size: 17px;
    }

    a {
        color: black;
    }
</style>