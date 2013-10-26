<?php
$page_title = "Set reservation deadline";
include_once ('database_connection.php');
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
$ssn = $_GET['ssn'];
$roomcode = $_GET['roomcode'];
?>
<form action="createres.php" method="post" accept-charset="utf-8">
	<table border="0" class="mytable" cellpadding="0" cellspacing="0">
		<tbody>
			<tr><th colspan="3">Set the deadline.</th></tr>
			<input type="hidden" name="ssn" value="<?php echo $ssn; ?>" >
			<input type="hidden" name="roomcode" value="<?php echo $roomcode; ?>" >
			<tr><td>Deadline date</td>
<td>
<select name="deadlineYear" >
    <option value="0000">Year</option>
<?php
for($i=date('Y'); $i>1973; $i--) {
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="deadlineMonth">
<option value="0">Month</option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>

<select name="deadlineDay" >
    <option value="00">Day</option>
<?php
for($i=1; $i<32; $i++) 
{
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>
</select>

</td></tr>
		</tbody>
	</table>
	<input type="submit" name="" value="Store Reservation">
</form>
<?php
// footer
require_once('template/footer.php');
?>
