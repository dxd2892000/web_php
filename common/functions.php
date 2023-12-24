<?php

function getTitle()
{
	global $pageTitle;
	if(isset($pageTitle))
		echo $pageTitle." | HUS Restaurant - HUS FOODIES";
	else
		echo "HUS Restaurant";
}

function countItems($item, $table)
{	
	global $conn;
	$query = $conn->query("SELECT COUNT(`$item`) FROM `$table`");
	$result = $query->fetch_row();
	return $result[0];
}


function checkItem($select, $from, $value)
{
	global $conn;
	$query = $conn->query("SELECT `$select` FROM `$from` WHERE `$select` = `$value` ");
	$count = $query->num_rows;

	return $count;
}




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
