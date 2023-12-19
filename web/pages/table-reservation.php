<?php
include("../../common/connect.php");
include("../../common/functions.php");
include "../ingredients/header.php";
?>

<body>
    <?php include("../ingredients/navbar.php") ?>
    <!-- START ORDER FOOD SECTION -->

    <div style="background-position: center bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="layer">
            <div style="text-align: center;padding: 15px;">
                <h1 style="font-size: 120px; color: white;font-family: 'Roboto'; font-weight: 100;">ĐẶT BÀN</h1>
            </div>
        </div>

    </div>

    <div class="table_reservation_section">

        <div class="container">

            <div class="text_header">
                <span>
                    1. Select Date & Time
                </span>
            </div>
            <form method="POST" action="table-reservation.php">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_date">Date</label>
                            <input type="date" min="<?php echo (isset($_POST['reservation_date'])) ? $_POST['reservation_date'] : date('Y-m-d', strtotime("+1day"));  ?>" value="<?php echo (isset($_POST['reservation_date'])) ? $_POST['reservation_date'] : date('Y-m-d', strtotime("+1day"));  ?>" class="form-control" name="reservation_date">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_time">Time</label>
                            <input type="time" value="<?php echo (isset($_POST['reservation_time'])) ? $_POST['reservation_time'] : date('H:i');  ?>" class="form-control" name="reservation_time">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="number_of_guests">How many people?</label>
                            <select class="form-control" name="number_of_guests">
                                <option value="1" <?php echo (isset($_POST['number_of_guests'])) ? "selected" : "";  ?>>
                                    One person
                                </option>
                                <option value="2" <?php echo (isset($_POST['number_of_guests'])) ? "selected" : "";  ?>>Two people</option>
                                <option value="3" <?php echo (isset($_POST['number_of_guests'])) ? "selected" : "";  ?>>Three people</option>
                                <option value="4" <?php echo (isset($_POST['number_of_guests'])) ? "selected" : "";  ?>>Four people</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="check_availability" style="visibility: hidden;">Check Availability</label>
                            <input type="submit" class="form-control check_availability_submit" name="check_availability_submit">
                        </div>
                    </div>
                </div>
            </form>

            <!-- CHECKING AVAILABILITY OF TABLES -->

            <?php

            if (isset($_POST['check_availability_submit'])) {
                $selected_date = $_POST['reservation_date'];
                $selected_time = $_POST['reservation_time'];
                $number_of_guests = $_POST['number_of_guests'];
                echo "<br>" . $selected_date;
                $query = $conn->query("SELECT table_id FROM tables WHERE table_id NOT IN (SELECT t.table_id FROM tables t, reservations r WHERE t.table_id = r.table_id AND Date(r.selected_time) = $selected_date AND liberated = 0 AND canceled = 0)");

                $rows = $query->fetch_all(MYSQLI_ASSOC);
                var_dump($rows);

                if ($query->num_rows == 0) {
            ?>
                    <div class="error_div">
                        <span class="error_message" style="font-size: 16px">ALL TABLES ARE RESERVED</span>
                    </div>
                <?php
                } else {

                ?>
                    <div class="text_header">
                        <span>
                            2. Customers details
                        </span>
                    </div>
                    <form method="POST" action="../actions/table-reservation.php">
                        <input type="hidden" name="selected_date" value="<?php echo $selected_date ?>">
                        <input type="hidden" name="selected_time" value="<?php echo $selected_time ?>">
                        <input type="hidden" name="number_of_guests" value="<?php echo $number_of_guests ?>">
                        <input type="hidden" name="table_id" value="<?php echo $table_id ?>">
                        <div class="cus_details_tab">

                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="book_tables">Đặt bàn?</label>
                                        <select class="form-control" name="table_id">
                                            <?php
                                            foreach ($rows as $row) {
                                                $table_id = $row['table_id'];
                                            ?>
                                            <option value="<?php echo $table_id;?>" <?php echo (isset($_POST['table_id'])) ? "selected" : "";  ?>>
                                                Bàn số <?php echo $table_id; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" name="cus_full_name" id="cus_full_name" oninput="document.getElementById('required_fname').style.display = 'none'" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Full name">
                                    <div class="invalid-feedback" id="required_fname">
                                        Invalid Name!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="email" name="cus_email" id="cus_email" oninput="document.getElementById('required_email').style.display = 'none'" class="form-control" placeholder="E-mail">
                                    <div class="invalid-feedback" id="required_email">
                                        Invalid E-mail!
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="cus_phone_number" id="cus_phone_number" oninput="document.getElementById('required_phone').style.display = 'none'" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Phone number">
                                    <div class="invalid-feedback" id="required_phone">
                                        Invalid Phone number!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit_table_reservation_form" class="btn btn-info" value="Make a Reservation">
                        </div>
                    </form>
            <?php
                }
            }

            ?>
        </div>
    </div>
    </div>
    <?php 
    include "../ingredients/widget.php";
    include "../ingredients/footer.php";
    ?>
</body>

<style type="text/css">
    .table_reservation_section {
        max-width: 850px;
        margin: 50px auto;
        min-height: 500px;
    }

    .check_availability_submit {
        background: #ffc851;
        color: white;
        border-color: #ffc851;
        font-family: work sans, sans-serif;
    }

    .cus_details_tab .form-control {
        background-color: #fff;
        border-radius: 0;
        padding: 25px 10px;
        box-shadow: none;
        border: 2px solid #eee;
    }

    .cus_details_tab .form-control:focus {
        border-color: #ffc851;
        box-shadow: none;
        outline: none;
    }

    .text_header {
        margin-bottom: 5px;
        font-size: 18px;
        font-weight: bold;
        line-height: 1.5;
        margin-top: 22px;
        text-transform: capitalize;
    }

    .layer {
        height: 100%;
        background: -moz-linear-gradient(top, rgba(45, 45, 45, 0.4) 0%, rgba(45, 45, 45, 0.9) 100%);
        background: -webkit-linear-gradient(top, rgba(45, 45, 45, 0.4) 0%, rgba(45, 45, 45, 0.9) 100%);
        background: linear-gradient(to bottom, rgba(45, 45, 45, 0.4) 0%, rgba(45, 45, 45, 0.9) 100%);
    }
</style>