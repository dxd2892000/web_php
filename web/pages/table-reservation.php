<?php
//Set page title
$pageTitle = 'Table Reservation';

include("../../common/connect.php");
include("../../common/functions.php");
include "../ingredients/header.php";
?>

<body>
    <?php include("../ingredients/navbar.php") ?>
    <!-- START ORDER FOOD SECTION -->

    <section style="
    background-position: center bottom;
    background-repeat: no-repeat;
    background-size: cover;">
        <div class="layer">
            <div style="text-align: center;padding: 15px;">
                <h1 style="font-size: 120px; color: white;font-family: 'Roboto'; font-weight: 100;
">Book a Table</h1>
            </div>
        </div>

    </section>

    <section class="table_reservation_section">

        <div class="container">
            <?php

            if (isset($_POST['submit_table_reservation_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Selected Date and Time
                $selected_date = $_POST['selected_date'];
                $selected_time = $_POST['selected_time'];

                $desired_date = $selected_date . " " . $selected_time;

                //Nbr of Guests

                $number_of_guests = $_POST['number_of_guests'];

                //Table ID

                $table_id = $_POST['table_id'];

                //Customer Details

                $cus_full_name = test_input($_POST['cus_full_name']);
                $cus_phone_number = test_input($_POST['cus_phone_number']);
                $cus_email = test_input($_POST['cus_email']);
                $cus_id = NULL;
                $getCustomers = $conn->query("SELECT *FROM customers");
                $customers = $getCustomers->fetch_all(MYSQLI_ASSOC);
                $check = 0;
                foreach ($customers as $cus) {
                    if ($cus_full_name === $cus['cus_name'] && ($cus_phone_number === $cus['cus_phone'] || $cus_email === ['cus_email'])) {
                        $check += 1;
                        $cus_id = $cus['cus_id'];
                        break;
                    }
                }


                $conn->begin_transaction();

                try {
                    if ($check == 0) {
                        $resultCurrentCusID = $conn->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant' AND TABLE_NAME = 'customers'");
                        $cus_id = $resultCurrentCusID->fetch_row();
                        $stmtcus = $conn->query("INSERT INTO customers(cus_name,cus_phone,cus_email) 
                                values($cus_full_name,$cus_phone_number,$cus_email)");
                        $query_reservation = $conn->query("INSERT INTO reservations(date_created, cus_id, selected_time, nbr_guests, table_id) values(Date('Y-m-d H:i'), $cus_id[0], $desired_date, $number_of_guests, $table_id)");
                    }else{
                        $query_reservation = $conn->query("INSERT INTO reservations(date_created, cus_id, selected_time, nbr_guests, table_id) values(Date('Y-m-d H:i'), $cus_id, $desired_date, $number_of_guests, $table_id)");
                    }

                    echo "<div class = 'alert alert-success'>";
                    echo "Great! Your Reservation has been created successfully.";
                    echo "</div>";

                    $conn->commit();
                } catch (Exception $e) {
                    $conn->rollBack();
                    echo "<div class = 'alert alert-danger'>";
                    echo $e->getMessage();
                    echo "</div>";
                }
            }

            ?>
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

                $stmt = $conn->query("select table_id
                        from tables
                        where table_id not in (select t.table_id
                        from tables t, reservations r
                        where 
                        t.table_id = r.table_id
                        and 
                        date(r.selected_time) = $selected_date
                        and liberated = 0
                        and canceled = 0)
                    ");

                $rows = $stmt->fetch_all(MYSQLI_ASSOC);

                if ($stmt->num_rows == 0) {
            ?>
                    <div class="error_div">
                        <span class="error_message" style="font-size: 16px">ALL TABLES ARE RESERVED</span>
                    </div>
                <?php
                } else {
                    foreach ($rows as $row) {
                        $table_id = $row['table_id'];
                    }

                ?>
                    <div class="text_header">
                        <span>
                            2. Customers details
                        </span>
                    </div>
                    <form method="POST" action="table-reservation.php">
                        <input type="hidden" name="selected_date" value="<?php echo $selected_date ?>">
                        <input type="hidden" name="selected_time" value="<?php echo $selected_time ?>">
                        <input type="hidden" name="number_of_guests" value="<?php echo $number_of_guests ?>">
                        <input type="hidden" name="table_id" value="<?php echo $table_id ?>">
                        <div class="cus_details_tab">
                            <div class="form-group colum-row row">
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
    </section>
</body>




<style type="text/css">
    .details_card {
        display: flex;
        align-items: center;
        margin: 150px 0px;
    }

    .details_card>span {
        float: left;
        font-size: 60px;
    }

    .details_card>div {
        float: left;
        font-size: 20px;
        margin-left: 20px;
        letter-spacing: 2px
    }
</style>

<section class="restaurant_details" style="background: url(Design/images/food_pic_2.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: 50% 0%;
    background-size: cover;
    color:white !important;
    min-height: 300px;">
    <div class="layer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 details_card">
                    <span>30</span>
                    <div>
                        Total
                        <br>
                        Reservations
                    </div>
                </div>
                <div class="col-md-3 details_card">
                    <span>30</span>
                    <div>
                        Total
                        <br>
                        Menus
                    </div>
                </div>
                <div class="col-md-3 details_card">
                    <span>30</span>
                    <div>
                        Years of
                        <br>
                        Experience
                    </div>
                </div>
                <div class="col-md-3 details_card">
                    <span>30</span>
                    <div>
                        Profesionnal
                        <br>
                        Cook
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER BOTTOM  -->

<?php include "ingredients/footer.php" ?>
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