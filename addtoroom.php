<?php

include_once ('database_connection.php');

// INSERT TO OFFICIAL values
$lodger_ssn = $_POST['lodger_ssn'];
$room_bedspace = $_POST['rb_id'];
$appliancerate = $_POST['appliancerate'];
$ar_id = "";

$result = mysqli_query($dbc,"SELECT ar_id FROM appliancerate WHERE appliancerate = '$appliancerate' LIMIT 1") OR die('Error querying database. SOOOOOOOOOREEEEEEE POOOOOOOOOOOOOH');
if(mysqli_num_rows($result))
{
	// If the appliance rate is on the table
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$ar_id = $row['ar_id'];
}
else
{
	mysqli_query($dbc,"INSERT INTO appliancerate (appliancerate) VALUES ('$appliancerate')") OR die('Error querying database. SOOOOOOOOOREEEEEEE POOOOOOOOOOOOOH');
	
	$newARresult = mysqli_query($dbc,"SELECT ar_id FROM appliancerate WHERE appliancerate = '$appliancerate' LIMIT 1") OR die('Error querying database. SOOOOOOOOOREEEEEEE POOOOOOOOOOOOOH');
	$newARrow = mysqli_fetch_array($newARresult,MYSQLI_ASSOC);
	$ar_id = $newARrow['ar_id'];
}
		

$query = "INSERT INTO occupy_room (ssn, rb_id, ar_id) VALUES ('$lodger_ssn', '$room_bedspace', '$ar_id')";

mysqli_query($dbc, $query)
			or die('Error querying database.');
			
echo 'Official lodger added. Redirecting to system homepage...';
		
header('Refresh: 1.5; index.php');
?>