<?php
include_once ('database_connection.php');

$type = $_GET['type'];
$ssn = $_GET['ssn'];
$bedspace_id = $_GET['bedspace_id'];
$ar_id = $_GET['ar_id'];
$amountPaid = $_GET['amountPaid'];

$insertPayment = "INSERT INTO payment(paymenttype, amountPaid, paymentDate) VALUES ('$type','$amountPaid',NOW())";
mysqli_query($dbc, $insertPayment)
	or die('Error querying database. Check the insert into payment query.');
	
$payment_id = mysqli_insert_id($dbc);

$insertPayment = "INSERT INTO lodger_payment(ssn, payment_id, bedspace_id, ar_id) VALUES ('$ssn','$payment_id','$bedspace_id','$ar_id')";
mysqli_query($dbc, $insertPayment)
	or die('Error querying database. SOOOOOOOOREEEEEEEEEEEE POOOOOOOOOOOOOOO.');
			
	echo 'Payment recorded.<br>';
	echo 'Redirecting to records list. Please wait.';
		
	header('Refresh: 1.5; viewrecords.php');

	mysqli_close($dbc);
?>