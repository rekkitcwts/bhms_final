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
$dataQuery = "SELECT occupy_room.official_rec_id, lodger.lname, lodger.fname, lodger.mname, lodger.ssn, appliancerate.ar_id, appliancerate.appliancerate, room_bedspace.rb_id, room_bedspace.roomcode, bedspace.bedspace_id, bedspace.monthlyrate, appliancerate.appliancerate + bedspace.monthlyrate AS total 
FROM lodger 
INNER JOIN occupy_room USING (ssn) 
INNER JOIN room_bedspace USING (rb_id) 
INNER JOIN bedspace USING (bedspace_id) 
INNER JOIN appliancerate USING (ar_id) WHERE lodger.ssn = '$ssn'";
$dataResult = mysqli_query($dbc,$dataQuery);
	if($dataResult)
	{
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
		echo '<tr bgcolor="#66cc44"><th colspan="2">Payment Details</th></tr>';
		$totalrate = "";
		$bedspace_id = "";
	$ar_id = "";
		$amountPaid = "";
			while($data = mysqli_fetch_array($dataResult,MYSQLI_ASSOC))
			{
				echo '<tr><td>Lodger Name</td><td>' . $data['lname'] . ', ' . $data['fname'] . ' ' . $data['mname'] .'</td></tr>';
				$totalrate = $data['appliancerate'] + $data['monthlyrate'];
				$bedspace_id = $data['bedspace_id'];
				$ar_id = $data['ar_id'];
				echo '<tr><td>Amount</td><td>P' . $totalrate .'</td></tr>';
				echo '<tr><td>Payment</td><td>P' . $totalrate . '</td></tr>';
				echo '<tr><td>Payment Type</td><td>Full</td></tr>';
			}
		echo '</table>'; 
		echo '<br><br>';
		echo '<a href="createpayment.php?type=full&ssn=' . $_GET['ssn'] . '&bedspace_id=' . $bedspace_id . '&ar_id=' . $ar_id . '&amountPaid='.$totalrate.'" onclick="return confirm(\'Confirm payment?\\n\')">Confirm this payment</a>';
	}
}
if(($type == "partial"))
{
	$dataQuery = "SELECT occupy_room.official_rec_id, lodger.lname, lodger.fname, lodger.mname, lodger.ssn, appliancerate.*, room_bedspace.rb_id, room_bedspace.roomcode, bedspace.*, appliancerate.appliancerate + bedspace.monthlyrate AS total 
FROM lodger 
INNER JOIN occupy_room USING (ssn) 
INNER JOIN room_bedspace USING (rb_id) 
INNER JOIN bedspace USING (bedspace_id) 
INNER JOIN appliancerate USING (ar_id) WHERE lodger.ssn = '$ssn'";
	$dataResult = mysqli_query($dbc,$dataQuery);
	if($dataResult)
	{
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
		echo '<tr bgcolor="#66cc44"><th colspan="2">Payment Details</th></tr>';
		$totalrate = "";
		$bedspace_id = "";
	$ar_id = "";
		$amountPaid = "";
			while($data = mysqli_fetch_array($dataResult,MYSQLI_ASSOC))
			{
				echo '<tr><td>Lodger Name</td><td>' . $data['lname'] . ', ' . $data['fname'] . ' ' . $data['mname'] .'</td></tr>';
				$totalrate = $data['appliancerate'] + $data['monthlyrate'];
				$bedspace_id = $data['bedspace_id'];
				$ar_id = $data['ar_id'];
				echo '<tr><td>Amount</td><td>P' . $totalrate .'</td></tr>';
				echo '<tr><td>Payment</td><td>P' . $_POST['amountPaid'] . '</td></tr>';
				echo '<tr><td>Payment Type</td><td>Partial</td></tr>';
				$bal = $totalrate - $_POST['amountPaid'];
				echo '<tr><td>Balance</td><td>'. $bal . '</td></tr>';
			}
		echo '</table>'; 
		echo '<br><br>';
		echo '<a href="createpayment.php?type=partial&ssn=' . $_GET['ssn'] . '&bedspace_id=' . $bedspace_id . '&ar_id=' . $ar_id .'&amountPaid='.$_POST['amountPaid'].'" onclick="return confirm(\'Confirm payment?\\n\')">Confirm this payment</a>';
	}
}
// footer
require_once('template/footer.php');
?>
