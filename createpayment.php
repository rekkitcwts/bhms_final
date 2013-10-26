<?php
include_once ('database_connection.php');

$type = $_GET['type'];
$ssn = $_GET['ssn'];
$totalrate = $_GET['totalrate'];
$paymentamt = $_GET['paymentamt'];

$insertPayment = "INSERT INTO payment(lodger_ssn, paymenttype, paymentdate, totalrate, paymentamt) VALUES ('$ssn','$type',NOW(),'$totalrate','$paymentamt')";
mysqli_query($dbc, $insertPayment)
	or die('Error querying database.');
			
	echo 'Payment recorded.<br>';
	echo 'Redirecting to records list. Please wait.';
		
	header('Refresh: 1.5; viewrecords.php');

	mysqli_close($dbc);
?>