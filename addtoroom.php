<?php

include_once ('database_connection.php');

// INSERT TO OFFICIAL values
$lodger_ssn = $_POST['lodger_ssn'];
$room_code = $_POST['room_code'];
$appliancerate = $_POST['appliancerate'];
$monthlybal = $_POST['monthlybal'];

	if ($monthlybal > 0)
	{
		$query = "INSERT INTO official (lodger_ssn, room_code, appliancerate, monthlybal) VALUES ('$lodger_ssn', '$room_code', '$appliancerate', '$monthlybal')";
		mysqli_query($dbc, $query)
			or die('Error querying database.');
			
		echo 'Official lodger added. Redirecting to system homepage...';
		
		header('Refresh: 3; index.php');
	}
	else
	{
		echo 'Monthly room rate cannot be zero.';
	}
?>