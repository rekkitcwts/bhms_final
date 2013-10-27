<?php

include_once ('database_connection.php');

// INSERT TO OFFICIAL values
$lodger_ssn = $_POST['lodger_ssn'];
$room_bedspace = $_POST['rb_id'];
$appliancerate = $_POST['appliancerate'];

$query = "INSERT INTO occupy_room (ssn, rb_id, applianceRate) VALUES ('$lodger_ssn', '$room_bedspace', '$appliancerate')";

mysqli_query($dbc, $query)
			or die('Error querying database.');
			
echo 'Official lodger added. Redirecting to system homepage...';
		
header('Refresh: 3; index.php');
?>