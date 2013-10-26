<?php

include_once ('database_connection.php');

// INSERT TO OFFICIAL values
$lodger_ssn = $_POST['lodger_ssn'];
$room_code = $_POST['room_code'];
$appliancerate = $_POST['appliancerate'];
$monthlybal = $_POST['monthlybal'];

	if ($monthlybal > 0)
	{
		$query = "UPDATE official SET room_code = '$room_code' ,appliancerate = '$appliancerate', monthlybal = '$monthlybal' WHERE lodger_ssn = '$lodger_ssn'";
		mysqli_query($dbc, $query)
			or die('Error querying database.');
			
		echo 'Official records updated. Redirecting to system homepage...';
		
		header('Refresh: 1.5; index.php');
	}
	else
	{
		echo 'Monthly room rate cannot be zero.';
	}
?>