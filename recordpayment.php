<?php
$type = $_GET['type'];
$ssn = $_GET['ssn'];
if(($type == "full") || ($type == "partial"))
$page_title = "Billing Statement";
else
$page_title = "Access denied";

include_once ('database_connection.php');
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');

// There should be a confirmation (may or may not be a pop up).
// Ex. Record this payment? (Y/N)
if(($type == "full"))
{
$dataQuery = "SELECT lodger.lname, lodger.fname, lodger.mname, official.appliancerate, official.monthlybal FROM lodger, official WHERE lodger.ssn = official.lodger_ssn AND ssn = '$ssn'";
$dataResult = mysqli_query($dbc,$dataQuery);
	if($dataResult)
	{
		//$officialQuery = "SELECT lodger.lname, lodger.fname, lodger.mname, payment.totalrate, payment.paymentamt, payment.paymenttype, payment.paymentdate FROM payment, lodger WHERE lodger.ssn = payment.lodger_ssn AND lodger.ssn = '$ssn'";
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
		echo '<tr bgcolor="#66cc44"><th colspan="2">Payment Details</th></tr>';
		$totalrate = "";
			while($data = mysqli_fetch_array($dataResult,MYSQLI_ASSOC))
			{
				echo '<tr><td>Lodger Name</td><td>' . $data['lname'] . ', ' . $data['fname'] . ' ' . $data['mname'] .'</td></tr>';
				$totalrate = $data['appliancerate'] + $data['monthlybal'];
				echo '<tr><td>Amount</td><td>P' . $totalrate .'</td></tr>';
				echo '<tr><td>Payment</td><td>P' . $totalrate . '</td></tr>';
				echo '<tr><td>Payment Type</td><td>Full</td></tr>';
			}
		echo '</table>'; 
		echo '<br><br>';
		echo '<a href="createpayment.php?type=full&ssn=' . $_GET['ssn'] . '&totalrate=' . $totalrate . '&paymentamt=' . $totalrate .'" onclick="return confirm(\'Confirm payment?\\n\')">Confirm this payment</a>';
	}
}
if(($type == "partial"))
{
	$dataQuery = "SELECT lodger.lname, lodger.fname, lodger.mname, official.appliancerate, official.monthlybal FROM lodger, official WHERE lodger.ssn = official.lodger_ssn AND ssn = '$ssn'";
	$dataResult = mysqli_query($dbc,$dataQuery);
	if($dataResult)
	{
		//$officialQuery = "SELECT lodger.lname, lodger.fname, lodger.mname, payment.totalrate, payment.paymentamt, payment.paymenttype, payment.paymentdate FROM payment, lodger WHERE lodger.ssn = payment.lodger_ssn AND lodger.ssn = '$ssn'";
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
		echo '<tr bgcolor="#66cc44"><th colspan="2">Payment Details</th></tr>';
		$totalrate = "";
			while($data = mysqli_fetch_array($dataResult,MYSQLI_ASSOC))
			{
				echo '<tr><td>Lodger Name</td><td>' . $data['lname'] . ', ' . $data['fname'] . ' ' . $data['mname'] .'</td></tr>';
				$totalrate = $data['appliancerate'] + $data['monthlybal'];
				echo '<tr><td>Amount</td><td>P' . $totalrate .'</td></tr>';
				echo '<tr><td>Payment</td><td>P' . $_POST['paymentamt'] . '</td></tr>';
				echo '<tr><td>Payment Type</td><td>Partial</td></tr>';
				$bal = $totalrate - $_POST['paymentamt'];
				echo '<tr><td>Balance</td><td>'. $bal . '</td></tr>';
			}
		echo '</table>'; 
		echo '<br><br>';
		echo '<a href="createpayment.php?type=partial&ssn=' . $_GET['ssn'] . '&totalrate=' . $totalrate . '&paymentamt=' . $_POST['paymentamt'] .'" onclick="return confirm(\'Confirm payment?\\n\')">Confirm this payment</a>';
	}
}
// footer
require_once('template/footer.php');
?>
