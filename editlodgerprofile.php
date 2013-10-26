<?php
$page_title = "Welcome to the system";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
include_once ('database_connection.php');

$ssn = mysqli_real_escape_string($dbc, trim($_GET['ssn']));

$query = "SELECT * FROM lodger WHERE ssn = '$ssn'";
$result = mysqli_query($dbc,$query);
if($result)
{
	if(mysqli_affected_rows($dbc)!=0)
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$lname = $row['lname'];
			$fname = $row['fname'];
			$mname = $row['mname'];
			$gender = $row['gender'];
			$birthdate = $row['birthdate'];
			$startlodge = $row['startlodge'];
			$purok = $row['purok'];
			$barangay = $row['barangay'];
			$city = $row['city'];
			$province = $row['province'];
			$religion = $row['religion'];
			$denomination = $row['denomination'];
			$contactnum = $row['contactnum'];
			$balance = $row['balance'];
		}
	}
	else
	{
		echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'No data!';
			echo '</span>';
	}
}
else
{
}
?>
<script src="./scripts/forms/religiondropdown.js"></script>
<form name="lodgerdata" action="updatelodger.php" method="post" accept-charset="utf-8">
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">Enter details here.</th>
</tr>
<input type="hidden" name="ssn" value="<?php echo $ssn; ?>" >
<tr><td>Last Name</td><td><input type="text" name="lname" value="<?php echo $lname; ?>"></td></tr>
<tr><td>First Name</td><td><input type="text" name="fname" value="<?php echo $fname; ?>"></td></tr>
<tr><td>Middle Name</td><td><input type="text" name="mname" value="<?php echo $mname; ?>"></td></tr>
<tr><td>Gender</td><td>
<select name="gender">
      <option <?php if($gender == "F"){echo " selected=\"F\"";} ?> value="F">Female</option>
	  <option <?php if($gender == "M"){echo " selected=\"M\"";} ?> value="M">Male</option>
</select></td></tr>
<input type="hidden" name="balance" value="<?php echo $balance; ?>" >
<tr><td>Birthdate</td><td><input type="text" name="birthdate" id="datepicker" value="<?php echo $birthdate; ?>"></td></tr>
<tr><td>Start of Stay</td><td><input type="text" name="startlodge" id="datepicker2" value="<?php echo $startlodge; ?>"></td></tr>
<tr><td>Province</td><td><input type="text" name="province" value="<?php echo $province; ?>"></td></tr>
<tr><td>City/Municipality</td><td><input type="text" name="city" value="<?php echo $city; ?>"></td></tr>
<tr><td>Barangay</td><td><input type="text" name="barangay" value="<?php echo $barangay; ?>"></td></tr>
<tr><td>Purok</td><td><input type="text" name="purok" value="<?php echo $purok; ?>"></td></tr>
<tr><td>Religion: Major Affiliation</td><td>
<select name="religion" id="relaff" onchange="changeList(this)">
      <option <?php if($religion == "Paganism"){echo " selected=\"Paganism\"";} ?> value="Paganism">Paganism</option>
	  <option <?php if($religion == "Wicca"){echo " selected=\"Wicca\"";} ?> value="Wicca">Wicca</option>
	  <option <?php if($religion == "Witchcraft"){echo " selected=\"Witchcraft\"";} ?> value="Witchcraft">Witchcraft</option>
	  <option <?php if($religion == "Islam"){echo " selected=\"Islam\"";} ?> value="Islam">Islam</option>
	  <option <?php if($religion == "Buddhism"){echo " selected=\"Buddhism\"";} ?> value="Buddhism">Buddhism</option>
	  <option <?php if($religion == "No religion"){echo " selected=\"No religion\"";} ?> value="No religion">No religion</option>
	  <option <?php if($religion == "Christianity"){echo " selected=\"Christianity\"";} ?> value="Christianity">Christianity</option>
	  <option <?php if($religion == "Other"){echo " selected=\"Other\"";} ?> value="Other">Other</option>
</select>
</td></tr>
<tr><td>Religion: Denomination</td><td>
<select name="denomination" id="reldet">
	<option value="NONE">This will update after selecting a religion</option>
</select>
</td></tr>
<tr><td>Contact Number</td><td><input type="text" name="contactnum" value="<?php echo $contactnum; ?>"></td></tr>
</tbody>
</table>

<input type="submit" name="" value="Add Lodger">
</form>

<?php
// footer
require_once('template/footer.php');
?>
