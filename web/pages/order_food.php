<!-- PHP INCLUDES -->

<?php
    //Set page title
    $pageTitle = 'Order Food';

    include("../../common/connect.php");
    include("../../common/functions.php");
    include("../ingredients/header.php");
    include("../ingredients/navbar.php");


?>

    <!-- START ORDER FOOD SECTION -->

	<section class="order_food_section">

        <?php

            if(isset($_POST['submit_order_food_form']) && $_SERVER['REQUEST_METHOD'] === 'POST')
            {
                // Selected Menus

                $selected_menus = $_POST['selected_menus'];

                //Client Details

                $client_full_name = test_input($_POST['client_full_name']);
                $delivery_address = test_input($_POST['client_delivery_address']);
                $client_phone_number = test_input($_POST['client_phone_number']);
                $client_email = test_input($_POST['client_email']);

                $conn->begin_transaction();
                try
                {
                    $stmtgetCurrentClientID = $conn->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant_hus' AND TABLE_NAME = 'customers'");
            
                    $stmtgetCurrentClientID->execute();
                    $result = $stmtgetCurrentClientID->get_result();
                    $client_id = $result->fetch_all(MYSQLI_ASSOC);

                    $stmtClient = $conn->prepare("insert into customers(cus_name,cus_phone,cus_email) 
                                values(?,?,?)");
                    $stmtClient->execute(array($client_full_name,$client_phone_number,$client_email));

                    $stmtgetCurrentOrderID = $conn->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant_website' AND TABLE_NAME = 'placed_orders'");
            
                    $stmtgetCurrentOrderID->execute();
                    $result = $stmtgetCurrentOrderID->get_result();
                    $order_id = $result->fetch_all(MYSQLI_ASSOC);
                    
                    $stmt_order = $conn->prepare("insert into placed_orders(order_time, cus_id, delivery_address) values(?, ?, ?)");
                    $stmt_order->execute(array(Date("Y-m-d H:i"),$client_id[0],$delivery_address));

                    foreach($selected_menus as $menu)
                    {
                        $stmt = $conn->prepare("insert into in_order(order_id, menu_id) values(?, ?)");
                        $stmt->execute(array($order_id[0],$menu));
                    }
                    
                    echo "<div class = 'alert alert-success'>";
                        echo "Great! Your order has been created successfully.";
                    echo "</div>";

                    $conn->commit();
                }
                catch(Exception $e)
                {
                    $conn->rollBack();
                    echo "<div class = 'alert alert-danger'>"; 
                        echo $e->getMessage();
                    echo "</div>";
                }
            }

        ?>

        <!-- ORDER FOOD FORM -->

		<form method="post" id="order_food_form" action="order_food.php">
		
			<!-- SELECT MENUS -->

			<div class="select_menus_tab order_food_tab" id="menus_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Please, select at least one item!
				</div>

                <div class="text_header">
                    <span>
                        1. Choice of Items
                    </span>
                </div>

				<div>
					<?php
						$stmt = $conn->query("Select * from menu_categories");
                    	$menu_categories = $stmt->fetch_all(MYSQLI_ASSOC);


                    	foreach($menu_categories as $category)
                    	{
                    		?>
                    			<div class="text_header">
									<span>
										<?php echo $category['category_name']; ?>
									</span>
								</div>
								<div class="items_tab">
				        			<?php
                                        $cate_id = $category['category_id'];
				        				$stmt = $conn->query("SELECT * FROM menus WHERE category_id = $cate_id");
				                    	$rows = $stmt->fetch_all(MYSQLI_ASSOC);

				                    	foreach($rows as $row)
				                    	{
				                        	echo "<div class='itemListElement'>";
				                            	echo "<div class = 'item_details'>";
				                                	echo "<div>";
				                                    	echo $row['menu_name'];
				                                	echo "</div>";
				                                	echo "<div class = 'item_select_part'>";
				                                    	echo "<div class = 'menu_price_field'>";
				    										echo "<span style = 'font-weight: bold;'>";
				                                    			echo $row['menu_price']."$";
				                                    		echo "</span>";
				                                    	echo "</div>";
				                                    ?>
				                                    	<div class="select_item_bttn">
				                                    		<div class="btn-group-toggle" data-toggle="buttons">
																<label class="menu_label item_label btn btn-secondary">
																	<input type="checkbox"  name="selected_menus[]" value="<?php echo $row['menu_id'] ?>" autocomplete="off">Select
																</label>
															</div>
				                                    	</div>
				                                    <?php
				                                	echo "</div>";
				                            	echo "</div>";
				                        	echo "</div>";
				                    	}
				            		?>
				    			</div>
                    		<?php
                    	}
					?>
				</div>				
			</div>


            <!-- CLIENT DETAILS -->


            <div class="client_details_tab order_food_tab" id="clients_tab">

                <div class="text_header">
                    <span>
                        2. Client Details
                    </span>
                </div>

                <div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_full_name" id="client_full_name" oninput="document.getElementById('required_fname').style.display = 'none'" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Full name">
                            <div class="invalid-feedback" id="required_fname">
                                Invalid Name!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="email" name="client_email" id="client_email" oninput="document.getElementById('required_email').style.display = 'none'" class="form-control" placeholder="E-mail">
                            <div class="invalid-feedback" id="required_email">
                                Invalid E-mail!
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="text"  name="client_phone_number" id="client_phone_number" oninput="document.getElementById('required_phone').style.display = 'none'" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Phone number">
                            <div class="invalid-feedback" id="required_phone">
                                Invalid Phone number!
                            </div>
                        </div>
                    </div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_delivery_address" id="client_delivery_address" oninput="document.getElementById('required_delivery_address').style.display = 'none'" class="form-control" placeholder="Delivery Address">
                            <div class="invalid-feedback" id="required_delivery_address">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEXT AND PREVIOUS BUTTONS -->

            <div style="overflow:auto;padding: 30px;">
                <div style="float:right;">
                    <input type="hidden" name="submit_order_food_form">
                    <button type="button" class="next_prev_buttons" style="background-color: #bbbbbb;"  id="prevBtn"  onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->

            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
            </div>

		</form>
	</section>





	<!-- WIDGET SECTION / FOOTER -->
    <?php include "../ingredients/widget.php" ?>
   
    <!-- FOOTER BOTTOM  -->

    <?php include "../ingredients/footer.php" ?>


    <!-- JS SCRIPTS -->

    <script type="text/javascript">

        /* TOGGLE MENU SELECT BUTTON */

        $('.menu_label').click(function() 
        {
            $(this).button('toggle');
            
        });

    </script>

    <!-- JS SCRIPT FOR NEXT AND BACK TABS -->

    <script type="text/javascript">
        
        var currentTab = 0;
        showTab(currentTab);

        //Show Tab Function

        function showTab(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            x[n].style.display = "block";
            
            if (n == 0) 
            {
                document.getElementById("prevBtn").style.display = "none";
            } 
            else 
            {
                document.getElementById("prevBtn").style.display = "inline";
            }
            
            if (n == (x.length - 1)) 
            {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } 
            else 
            {
                document.getElementById("nextBtn").innerHTML = "Next";
            }

            fixStepIndicator(n)
        }

        // Next Prev Function

        function nextPrev(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) 
            {
                // ... the form gets submitted:
                document.getElementById("order_food_form").submit();
                return false;
            }

            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        // Validate Form Function

        function validateForm()
        {
            var x, id_tab, valid = true;
            x = document.getElementsByClassName("order_food_tab");
            id_tab = x[currentTab].id;

            if(id_tab == "menus_tab")
            {
                if(x[currentTab].querySelectorAll('input[type="checkbox"]:checked').length == 0)
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "block";
                    valid = false;
                }
                else
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "none";
                }
            }
            if(id_tab == "clients_tab")
            {
                y = x[currentTab].getElementsByTagName("input");
                z = x[currentTab].getElementsByClassName("invalid-feedback");

                for (var i = 0; i < y.length; i++) 
                {
                    if(y[i].value == "")
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                    if(y[i].type == "email" && !ValidateEmail(y[i].value))
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                }
            }

            if (valid) 
            {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }

            return valid;
        }



        function fixStepIndicator(n) 
        {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            
            for (i = 0; i < x.length; i++) 
            {
                x[i].className = x[i].className.replace(" active", "");
            }
            
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }

    
    </script>
<style type="text/css">
        body
        {
            background: #f7f7f7;
        }

		.text_header
		{
			margin-bottom: 5px;
    		font-size: 18px;
    		font-weight: bold;
    		line-height: 1.5;
    		margin-top: 22px;
    		text-transform: capitalize;
		}

        .items_tab
        {
            border-radius: 4px;
            background-color: white;
            overflow: hidden;
            box-shadow: 0 0 5px 0 rgba(60, 66, 87, 0.04), 0 0 10px 0 rgba(0, 0, 0, 0.04);
        }

        .itemListElement
        {
            font-size: 14px;
            line-height: 1.29;
            border-bottom: solid 1px #e5e5e5;
            cursor: pointer;
            padding: 16px 12px 18px 12px;
        }

        .item_details
        {
            width: auto;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -webkit-box-align: center;
            -webkit-align-items: center;
        }

        .item_label
        {
        	color: #9e8a78;
            border-color: #9e8a78;
            background: white;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active 
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_select_part
        {
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            flex-shrink: 0;
        }

        .select_item_bttn
        {
            width: 55px;
            display: flex;
            margin-left: 30px;
            -webkit-box-pack: end;
            justify-content: flex-end;
        }

        .menu_price_field
        {
        	width: auto;
            display: flex;
            margin-left: 30px;
            -webkit-box-align: baseline;
            align-items: baseline;
        }

        .order_food_section
        {
            max-width: 720px;
            margin: 50px auto;
            padding: 0px 15px;
        }

        .item_label.focus,
        .item_label:focus
        {
            outline: none;
            background:initial;
            box-shadow: none;
            color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_label:hover
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        /* Make circles that indicate the steps of the form: */
        .step 
        {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;  
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active 
        {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish 
        {
            background-color: #4CAF50;
        }


        .order_food_tab
        {
            display: none;
        }

        .next_prev_buttons
        {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            cursor: pointer;
        }

        .client_details_tab  .form-control
        {
            background-color: #fff;
            border-radius: 0;
            padding: 25px 10px;
            box-shadow: none;
            border: 2px solid #eee;
        }

        .client_details_tab  .form-control:focus 
        {
            border-color: #ffc851;
            box-shadow: none;
            outline: none;
        }

	</style>