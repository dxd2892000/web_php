<?php
/*
		Title Function That Echo The Page Title In Case The Page Has The Variable $pageTitle And Echo Default Title For Other Pages
	*/
function getTitle()
{
	global $pageTitle;
	if (isset($pageTitle))
		echo $pageTitle . " | Vincent Restaurant - Your Restaurant";
	else
		echo "Vincent Restaurant | Your Restaurant";
}

/*
		This function returns the number of items in a given table
	*/

function countItems($item, $table)
{
	global $conn;
	$stat_ = $conn->query("SELECT COUNT($item) FROM $table");

	return $stat_->fetch_column();
}

/*
	
	** Check Items Function
	** Function to Check Item In Database [Function with Parameters]
	** $select = the item to select [Example : user, item, category]
	** $from = the table to select from [Example : users, items, categories]
	** $value = The value of select [Example: Ossama, Box, Electronics]

	*/
function checkItem($select, $from, $value)
{
	global $con;
	$statment = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
	$statment->execute(array($value));
	$count = $statment->rowCount();

	return $count;
}


/*
    	==============================================
    	TEST INPUT FUNCTION, IS USED FOR SANITIZING USER INPUTS
    	AND REMOVE SUSPICIOUS CHARS and Remove Extra Spaces
    	==============================================
	
	*/

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function website_settings()
{
	global $conn;
	$sql = "SELECT * FROM `website_settings`";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row_web = $result->fetch_all(MYSQLI_ASSOC);
	}

	foreach ($row_web as $row) {
		switch ($row['option_name']) {
			case 'restaurant_name':
				$restaurant_name = $row['option_value'];
				break;
			case 'restaurant_email':
				$restaurant_email = $row['option_value'];
				break;
			case 'restaurant_address':
				$restaurant_address = $row['option_value'];
				break;
			case 'restaurant_phonenumber':
				$restaurant_phonenumber = $row['option_value'];
				break;
		}
	}
	return array($restaurant_name,$restaurant_email,$restaurant_phonenumber,$restaurant_address);
}
