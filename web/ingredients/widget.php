<?php
include_once "../../common/functions.php";
$array = website_settings();
?>
<div class="widget_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <img src="../../common/hus.jpg" alt="Logo" style="width: 250px;height: 200px;margin-bottom: 10px;">
                    <p>
                        Hus Foodies là sự lựa chọn hàng đầu cho bữa ăn sinh viên giá rẻ.
                    </p>
                    <ul class="widget_social">
                        <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>THÔNG TIN</h3>
                    <p>
                        <?php echo $array[3]; ?>
                    </p>
                    <p>
                        <?php echo $array[1]; ?>
                        <br>
                        <?php echo $array[2]; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>
                        Giờ mở cửa
                    </h3>
                    <ul class="opening_time">
                        <li>Monday - Friday 6:30am - 6:00pm</li>
                        <li>Monday - Friday 6:30am - 6:00pm</li>
                        <li>Monday - Friday 6:30am - 6:00pm</li>
                        <li>Monday - Friday 6:30am - 6:00pm</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>Subscribe to our contents</h3>
                    <div class="subscribe_form">
                        <form action="#" class="subscribe_form" novalidate="true">
                            <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                            <button type="submit" class="submit">SUBSCRIBE</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .widget_section {
        background-color: #f5fcf4;
        padding: 20px 0;
        color: black !important;
    }

    .widget_social {
        display: block;
        text-align: left;
    }

    .widget_social li {
        display: inline-block;
    }

    .widget_social li a {
        font-size: 12px;
        margin-right: 20px;
    }


    .subscribe_form {
        display: block;
        text-align: center;
        padding: 5px 0;
    }

    .subscribe_form .form_input {
        display: block;
        background-color: rgba(9, 1, 1, 0.33);
        border: none;
        font-size: 14px;
        line-height: 50px;
        padding: 0 10px;
        float: left;
        width: 100%;
        margin-bottom: 10px;
        transition: all 0.5s ease-in-out;
    }

    .opening_time li {
        line-height: 35px;
    }

    .subscribe_form .submit {
        background-color: #ffc851;
        font-family: "Work Sans", sans-serif;
        font-size: 12px;
        font-weight: 600;
        line-height: 50px;
        display: inline-block;
        padding: 0 10px;
        width: 100%;
        cursor: pointer;
        border: none;
        transition: all 0.5s ease-in-out;
    }

    .subscribe_form .submit:hover {
        background-color: #897666;
        transition: all 0.5s ease-in-out;
    }
</style>