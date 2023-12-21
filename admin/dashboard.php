<?php

//Start session
session_start();

$pageTitle = 'Dashboard';

//PHP INCLUDES
include_once '../common/connect.php';
include_once '../common/functions.php';
include 'Includes/templates/header.php';

//TEST IF THE SESSION HAS BEEN CREATED BEFORE

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    include 'Includes/templates/navbar.php';
?>

    <!-- TOP 4 CARDS -->

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-green ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("cus_id", "customers") ?></span></div>
                            <div>Total Clients</div>
                        </div>
                    </div>
                </div>
                <a href="clients.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fas fa-utensils fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("menu_id", "menus") ?></span></div>
                            <div>Total Menus</div>
                        </div>
                    </div>
                </div>
                <a href="menus.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class=" col-sm-6 col-lg-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="far fa-calendar-alt fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span>32</span></div>
                            <div>Total Appointments</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class=" col-sm-6 col-lg-3">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fas fa-pizza-slice fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("order_id", "placed_orders") ?></span></div>
                            <div>Total Orders</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- START ORDERS TABS -->

    <div class="card" style="margin: 20px 10px">

        <!-- TABS BUTTONS -->

        <div class="card-header tab" style="padding:0px;">
            <button class="tablinks_orders active" onclick="openTab(event, 'recent_orders','tabcontent_orders','tablinks_orders')">Recent Orders</button>
            <button class="tablinks_orders" onclick="openTab(event, 'completed_orders','tabcontent_orders','tablinks_orders')">Completed Orders</button>
            <button class="tablinks_orders" onclick="openTab(event, 'canceled_orders','tabcontent_orders','tablinks_orders')">Canceled Orders</button>
        </div>

        <!-- TABS CONTENT -->

        <div class="card-body">
            <div class='responsive-table'>

                <!-- RECENT ORDERS -->

                <table class="table X-table tabcontent_orders" id="recent_orders" style="display:table">
                    <thead>
                        <tr>
                            <th>
                                Order Time Created
                            </th>
                            <th>
                                Selected Menus
                            </th>
                            <th>
                                Total Price
                            </th>
                            <th>
                                Customers
                            </th>
                            <th>
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = $conn->query("SELECT * 
                                                    FROM placed_orders po , customers c
                                                    WHERE 
                                                        po.cus_id = c.cus_id
                                                    AND canceled = 0
                                                    AND delivered = 0
                                                    ORDER BY order_time;
                                                    ");
                        $placed_orders = $query->fetch_all(MYSQLI_ASSOC);
                        $count = $query->num_rows;


                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your recent orders will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($placed_orders as $order) {
                                echo "<tr>";
                                echo "<td>";
                                echo $order['order_time'];
                                echo "</td>";
                                echo "<td>";
                                $order_id = $order['order_id'];
                                $queryMenus = $conn->query("SELECT menu_name, quantity, menu_price FROM menus m, in_order in_o WHERE m.menu_id = in_o.menu_id AND order_id = '$order_id'");
                                $menus = $queryMenus->fetch_all(MYSQLI_ASSOC);

                                $total_price = 0;

                                foreach ($menus as $menu) {
                                    echo "<span style = 'display:block'>" . $menu['menu_name'] . "</span>";

                                    $total_price += ($menu['menu_price'] * $menu['quantity']);
                                }

                                echo "</td>";
                                echo "<td>";
                                echo $total_price . " nghìn đồng";
                                echo "</td>";
                                echo "<td>";
                        ?>
                                <a href="actions/dashboard.php?do=ShowCustomer&cus_id=<?php echo $order['cus_id']; ?>" style="color: white;">
                                    <button class="btn btn-info btn-sm rounded-0">
                                        <?php echo $order['cus_id']; ?>
                                    </button>
                                </a>
                                <?php
                                echo "</td>";

                                echo "<td>";

                                $cancel_data = $order["order_id"];
                                $deliver_data = $order["order_id"];
                                ?>
                                <ul class="list-inline m-0">

                                    <!-- Deliver Order BUTTON -->

                                    <li class="list-inline-item" data-toggle="tooltip" title="Deliver Order">
                                        <button class="btn btn-info btn-sm rounded-0" type="button">
                                            <a href="actions/dashboard.php?do=Deliver&order_id=<?php echo $deliver_data; ?>" style="color: white;">
                                                <i class="fas fa-truck"></i>
                                            </a>
                                        </button>
                                    </li>

                                    <!-- CANCEL BUTTON -->

                                    <li class="list-inline-item" data-toggle="tooltip" title="Cancel Order">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $cancel_data; ?>" data-placement="top">
                                            <a href="actions/dashboard.php?do=Cancel&order_id=<?php echo $cancel_data; ?>" style="color: white;">
                                                <i class="fas fa-calendar-times"></i>
                                            </a>
                                        </button>
                                    </li>
                                </ul>
                        <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <!-- COMPLETED ORDERS -->

                <table class="table X-table tabcontent_orders" id="completed_orders">
                    <thead>
                        <tr>
                            <th>
                                Order Time Created
                            </th>
                            <th>
                                Menus
                            </th>
                            <th>
                                Customer
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $stmt = $conn->query("SELECT * 
                                                    FROM placed_orders po , customers c
                                                    where 
                                                        po.cus_id = c.cus_id
                                                        and
                                                        delivered = 1
                                                        and
                                                        canceled = 0
                                                    order by order_time;
                                                    ");
                        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                        $count = $stmt->num_rows;



                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your completed orders will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['order_time'];
                                echo "</td>";
                                echo "<td>";
                                $order_id = $row['order_id'];
                                $stmtMenus = $conn->query("SELECT menu_name, quantity
                                                            from menus m, in_order in_o
                                                            where m.menu_id = in_o.menu_id
                                                            and order_id = '$order_id'");
                                $menus = $stmtMenus->fetch_all(MYSQLI_ASSOC);
                                foreach ($menus as $menu) {
                                    echo "<span style = 'display:block'>" . $menu['menu_name'] . "</span>";
                                }

                                echo "</td>";
                                echo "<td>";
                                echo $row['cus_name'];
                                echo "</td>";

                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <!-- CANCELED ORDERS -->

                <table class="table X-table tabcontent_orders" id="canceled_orders">
                    <thead>
                        <tr>
                            <th>
                                Order Time Created
                            </th>
                            <th>
                                Customer
                            </th>
                            <th>
                                Cancellation Reason
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $stmt = $conn->query("SELECT * 
                                                    FROM placed_orders po , customers c
                                                    WHERE 
                                                        po.cus_id = c.cus_id
                                                    AND 
                                                        canceled = 1
                                                    ORDER BY order_time;
                                                    ");
                        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                        $count = $stmt->num_rows;

                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your canceled orders will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['order_time'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['cus_name'];
                                echo "</td>";
                                echo "<td>";

                                echo $row['cancellation_reason'];

                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- END ORDERS TABS -->

    <!-- START RESERVATIONS TABS -->

    <div class="card" style="margin: 20px 10px">

        <!-- TABS BUTTONS -->

        <div class="card-header tab" style="padding:0px;">
            <button class="tablinks_reservations active" onclick="openTab(event, 'recent_reservations','tabcontent_reservations','tablinks_reservations')">Recent Reservations</button>
            <button class="tablinks_reservations" onclick="openTab(event, 'completed_reservations','tabcontent_reservations','tablinks_reservations')">Completed Reservations</button>
            <button class="tablinks_reservations" onclick="openTab(event, 'canceled_reservations','tabcontent_reservations','tablinks_reservations')">Canceled Reservations</button>
        </div>

        <!-- TABS CONTENT -->

        <div class="card-body">
            <div class='responsive-table'>

                <!-- RECENT RESERVATIONS -->

                <table class="table X-table tabcontent_reservations" id="recent_reservations" style="display:table">
                    <thead>
                        <tr>
                            <th>
                                Reservation Time Created
                            </th>
                            <th>
                                Reservation Date and Time
                            </th>
                            <th>
                                Number of Guests
                            </th>
                            <th>
                                Table ID
                            </th>
                            <th>
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $timestamp = time();
                        $formatted_time = date('y-m-d h:i:s', $timestamp);
                        $query = $conn->query("SELECT *FROM reservations WHERE (selected_time > '$formatted_time') AND (canceled = 0)");
                        $reservations = $query->fetch_all(MYSQLI_ASSOC);
                        $count = $query->num_rows;


                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your upcoming reservations will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($reservations as $reservation) {
                                echo "<tr>";
                                echo "<td>";
                                echo $reservation['date_created'];
                                echo "</td>";
                                echo "<td>";
                                echo $reservation['selected_time'];
                                echo "</td>";
                                echo "<td>";
                                echo $reservation['amounts'];
                                echo "</td>";
                                echo "<td>";
                                echo $reservation['table_id'];
                                echo "</td>";
                                echo "<td>";

                                $cancel_data_reservation = $reservation["reservation_id"];
                                $liberate_data = $reservation["reservation_id"];
                        ?>
                                <ul class="list-inline m-0">

                                    <!-- Liberate Table BUTTON -->

                                    <li class="list-inline-item" data-toggle="tooltip" title="Liberate Table">
                                        <button class="btn btn-info btn-sm rounded-0">
                                            <a href="actions/dashboard.php?do=Liberate&data=<?php echo $liberate_data; ?>" style="color: white;">
                                                <i class="far fa-check-circle"></i>
                                            </a>
                                        </button>
                                    </li>

                                    <!-- CANCEL BUTTON -->

                                    <li class="list-inline-item" data-toggle="tooltip" title="Cancel Reservation">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button">
                                            <a href="actions/dashboard.php?do=Cancel&data=<?php echo $cancel_data_reservation; ?>" style="color: white;">
                                                <i class="fas fa-calendar-times"></i>
                                            </a>
                                        </button>
                                    </li>
                                </ul>
                        <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <!-- COMPLETED RESERVATIONS -->

                <table class="table X-table tabcontent_reservations" id="completed_reservations">
                    <thead>
                        <tr>
                            <th>
                                Reservation Date Created
                            </th>
                            <th>
                                Reservation Date
                            </th>
                            <th>
                                Table ID
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $timestamp = time();
                        $formatted_time = date('y-m-d h:i:s', $timestamp);
                        $query = $conn->query("SELECT * FROM reservations WHERE (selected_time < '$formatted_time') AND (canceled = 0) ORDER BY selected_time");
                        $rows = $query->fetch_all(MYSQLI_ASSOC);
                        $count = $query->num_rows;



                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your completed reservations will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['date_created'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['selected_time'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['table_id'];
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <!-- CANCELED RESERVATIONS -->

                <table class="table X-table tabcontent_reservations" id="canceled_reservations">
                    <thead>
                        <tr>
                            <th>
                                Reservation Date Created
                            </th>
                            <th>
                                Cancellation Reason
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $stmt = $conn->query("SELECT * 
                                                    FROM reservations
                                                    where 
                                                        canceled = 1
                                                    order by date_created;
                                                    ");
                        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                        $count = $stmt->num_rows;

                        if ($count == 0) {

                            echo "<tr>";
                            echo "<td colspan='5' style='text-align:center;'>";
                            echo "List of your canceled reservations will be presented here";
                            echo "</td>";
                            echo "</tr>";
                        } else {

                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['date_created'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['cancellation_reason'];
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- END RESERVATIONS TABS -->

<?php

    include 'Includes/templates/footer.php';
} else {
    header("Location: index.php");
    exit();
}

?>