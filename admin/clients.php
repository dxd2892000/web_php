<?php
    ob_start();
	session_start();

	$pageTitle = 'Customers';

	if(isset($_SESSION['username']) && isset($_SESSION['password']))
	{
		include '../common/connect.php';
  		include '../common/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php';

        ?>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('clients_link')[0].className += " active_link";

            </script>

        <?php

            
            $do = 'Manage';

            if($do == "Manage")
            {
                $query = $conn->query("SELECT * FROM customers");
                $clients = $query->fetch_all(MYSQLI_ASSOC);

            ?>
                <div class="card">
                    <div class="card-header">
                        <?php echo $pageTitle; ?>
                    </div>
                    <div class="card-body">

                        <!-- CLIENTS TABLE -->

                        <table class="table table-bordered clients-table">
                            <thead>
                                <tr>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($clients as $client)
                                    {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $client['cus_name'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $client['cus_phone'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $client['cus_email'];
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            <?php
            }


        /* FOOTER BOTTOM */

        include 'Includes/templates/footer.php';

    }
    else
    {
        header('Location: index.php');
        exit();
    }
?>