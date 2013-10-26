<?php
$page_title = "Add Partial Payment";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
include_once ('database_connection.php');
$totalrate = "";
$ssn = $_GET['ssn'];
$dataQuery = "SELECT lodger.lname, lodger.fname, lodger.mname, official.appliancerate, official.monthlybal FROM lodger, official WHERE lodger.ssn = official.lodger_ssn AND lodger.ssn = '$ssn' LIMIT 1";
$dataResult = mysqli_query($dbc,$dataQuery);
	if($dataResult)
	{
			while($data = mysqli_fetch_array($dataResult,MYSQLI_ASSOC))
			{
				$totalrate = $data['appliancerate'] + $data['monthlybal'];
			}
	}
?>
<form action="recordpayment.php?type=partial&ssn=<?php echo $ssn; ?>" method="POST">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">Fill out necessary details</th>
</tr>
<input type="hidden" name="ssn" value="<?php echo $ssn; ?>" >
<input type="hidden" name="type" value="partial" >
<tr><td>Monthly Rate</td><td>P<?php echo $totalrate; ?></td></tr>
<tr><td>Amount</td><td><input type="text" name="paymentamt" value=""></td></tr>
</tbody>
</table>

<input type="submit" name="" value="Add Partial Payment">
</center>
</form>
<?php
// footer
require_once('template/footer.php');
?>
