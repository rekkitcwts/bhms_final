<?php

	include_once('database_connection.php');
	$rb_id = $_POST['roombedspace'];
	$off_rec_id = $_POST['official_rec_id'];
	
	$query = "UPDATE occupy_room SET rb_id = '$rb_id' WHERE official_rec_id = '$off_rec_id'";
	mysqli_query($dbc, $query) or die('"Error querying database. Thanks to you." -GLaDOS, Portal');
	
	echo 'Room changed.';
	echo 'Redirecting to official lodger list. Please wait.';
		
	header('Refresh: 2; officiallodgers.php');

?>