<?php
include_once ('database_connection.php');
$deadlinedate=date_create();
date_date_set($deadlinedate,$_POST['deadlineYear'],$_POST['deadlineMonth'],$_POST['deadlineDay']);
$deadlinedateString = date_format($deadlinedate,"Y-m-d");
$ssn = $_POST['ssn'];
$rb_id = $_POST['rb_id'];
$currentDate = date("Y-m-d");


$insertPayment = "INSERT INTO reservation (ssn, rb_id, resDate, resDeadline) VALUES ('$ssn','$rb_id','$currentDate','$deadlinedateString')";
mysqli_query($dbc, $insertPayment)
	or die('Error querying database.');
			
	echo 'Reservation recorded.<br>';
	echo 'Redirecting to reservations list. Please wait.';
		
	header('Refresh: 1.5; reslist.php');

	mysqli_close($dbc);
?>