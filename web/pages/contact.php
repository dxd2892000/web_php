<?php
include "../../common/connect.php";
require_once "../../common/functions.php";
$array = website_settings();
include "../ingredients/header.php";

?>

<body>
    <?php include "../ingredients/navbar.php"; ?>
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Kết nối với chúng tôi
                            <br>cho chúng tôi biết cảm xúc của bạn!
                        </h2>
                        <p>
                            Chào mừng bạn đến với chúng tôi.
                        </p>
                        <h3>
                            <?php echo $array[3]; ?>
                        </h3>
                        <h4>
                            <span>Email:</span>
                            <?php echo $array[1]; ?>
                            <br>
                            <span>Phone:</span>
                            <?php echo $array[2]; ?>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Subject">
                                    <div class="invalid-feedback" id="invalid-subject" style="display: block">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="bttn_style_2">Send Message</button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Sending...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "../ingredients/widget.php";
    include "../ingredients/footer.php" ?>
    ?>
</body>


<style>
    .contact-section {
        padding: 100px;
        background-color: #f5fcf4;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .contact-section {
        padding: 100px 0px;
    }

    .contact-info h2 {
        font-size: 36px;
        color: #303133;
        margin: 0 0 8px;
        font-weight: 400;
        line-height: 48px;
        letter-spacing: -0.04em;
        font-family: 'Prata', sans-serif;
    }

    .contact-info h3 {
        line-height: 28px;
        margin-bottom: 20px;
    }

    .contact-info h4 {
        font-size: 15px;
        line-height: 28px;
    }

    .contact-form {
        background-color: #fff;
        padding: 50px 40px;
        -webkit-box-shadow: 0px 50px 100px 0px rgba(64, 1, 4, 0.1), 0px -6px 0px 0px rgba(248, 99, 107, 0.004);
        box-shadow: 0px 50px 100px 0px rgba(64, 1, 4, 0.1), 0px -6px 0px 0px rgba(248, 99, 107, 0.004);
        border-radius: 3px;
    }

    .contact-form .form-control {
        background-color: #fff;
        border-radius: 0;
        padding: 25px 10px;
        box-shadow: none;
        border: 2px solid #eee;
    }

    .contact-form .form-control:focus {
        border-color: #ffc851;
        box-shadow: none;
        outline: none;
    }
</style>