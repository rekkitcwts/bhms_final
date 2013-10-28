<?php
$page_title = "Edit Lodger Personal Profile";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
include_once ('database_connection.php');

$birthdayYear = "";
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
			$birthdatetime=strtotime($birthdate);
				$birthdayDay = date("d",$birthdatetime);
				$birthdayMonth = date("m",$birthdatetime);
				$birthdayYear = date("Y",$birthdatetime);
			$startlodge = strtotime($row['startStay']);
				$startStayYear = date("Y",$startlodge);
				$startStayMonth = date("m",$startlodge);
				$startStayDay = date("d",$startlodge);
			$purok = $row['purok'];
			$barangay = $row['barangay'];
			$city = $row['city'];
			$province = $row['province'];
			$religion = $row['affiliation'];
			$denomination = $row['denomination'];
			$contactnum = $row['contactnum'];
			$picture = $row['picture'];
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
<script type="text/javascript" src="./scripts/forms/formvalidation.js">
</script>
<link href="./styles/forms/formvalidation.css" rel="stylesheet" type="text/css" />


<form enctype="multipart/form-data" name="lodgerdata" action="updatelodgerprofile.php" method="post">
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">Enter details here.</th>
</tr>
<input type="hidden" name="ssn" value="<?php echo $ssn; ?>" >
<tr><td>Last Name (Required)</td><td>
<div class="field">
<input type="text" name="lname" value="<?php echo $lname; ?>">
</div>
</td></tr>
<tr><td>First Name (Required)</td><td>
<div class="field">
<input type="text" name="fname" value="<?php echo $fname; ?>">
</div>
</td></tr>
<tr><td>Middle Name</td><td><input type="text" name="mname" value="<?php echo $mname; ?>"></td></tr>
<tr><td>Gender</td><td>
<select name="gender">
      <option <?php if($gender == "F"){echo " selected=\"F\"";} ?> value="F">Female</option>
	  <option <?php if($gender == "M"){echo " selected=\"M\"";} ?> value="M">Male</option>
</select></td></tr>
<tr><td>Birthdate</td>
<td>
<!--<input type="text" name="birthdate" id="datepicker" value="">-->
<select name="birthdayYear" >
<?php
for($i=date('Y'); $i>1973; $i--) {
    echo '<option'; 
      if($birthdayYear == $i)
      {
          echo ' selected="'.$i.'"';
      }
      echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="birthdayMonth">
<option <?php if($birthdayMonth == "1"){echo " selected=\"1\"";} ?> value="1">January</option>
<option <?php if($birthdayMonth == "2"){echo " selected=\"2\"";} ?> value="2">February</option>
<option <?php if($birthdayMonth == "3"){echo " selected=\"3\"";} ?> value="3">March</option>
<option <?php if($birthdayMonth == "4"){echo " selected=\"4\"";} ?> value="4">April</option>
<option <?php if($birthdayMonth == "5"){echo " selected=\"5\"";} ?> value="5">May</option>
<option <?php if($birthdayMonth == "6"){echo " selected=\"6\"";} ?> value="6">June</option>
<option <?php if($birthdayMonth == "7"){echo " selected=\"7\"";} ?> value="7">July</option>
<option <?php if($birthdayMonth == "8"){echo " selected=\"8\"";} ?> value="8">August</option>
<option <?php if($birthdayMonth == "9"){echo " selected=\"9\"";} ?> value="9">September</option>
<option <?php if($birthdayMonth == "10"){echo " selected=\"10\"";} ?> value="10">October</option>
<option <?php if($birthdayMonth == "11"){echo " selected=\"11\"";} ?> value="11">November</option>
<option <?php if($birthdayMonth == "12"){echo " selected=\"12\"";} ?> value="12">December</option>
</select>

<select name="birthdayDay" >
<?php
for($i=1; $i<32; $i++) 
{
    echo '<option'; 
    if($birthdayDay == $i)
    {
         echo ' selected="'.$i.'"';
    }
    echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>
</select>

</td></tr>
<tr>
<td>Start of Stay</td>
<td>
<!--<input type="text" name="startlodge" id="datepicker2" value="">-->
<select name="startLodgeYear" >
<?php
for($i=date('Y'); $i>2000; $i--) {
   echo '<option'; 
      if($startStayYear == $i)
      {
          echo ' selected="'.$i.'"';
      }
      echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="startLodgeMonth">
<option <?php if($startStayMonth == "1"){echo " selected=\"1\"";} ?> value="1">January</option>
<option <?php if($startStayMonth == "2"){echo " selected=\"2\"";} ?> value="2">February</option>
<option <?php if($startStayMonth == "3"){echo " selected=\"3\"";} ?> value="3">March</option>
<option <?php if($startStayMonth == "4"){echo " selected=\"4\"";} ?> value="4">April</option>
<option <?php if($startStayMonth == "5"){echo " selected=\"5\"";} ?> value="5">May</option>
<option <?php if($startStayMonth == "6"){echo " selected=\"6\"";} ?> value="6">June</option>
<option <?php if($startStayMonth == "7"){echo " selected=\"7\"";} ?> value="7">July</option>
<option <?php if($startStayMonth == "8"){echo " selected=\"8\"";} ?> value="8">August</option>
<option <?php if($startStayMonth == "9"){echo " selected=\"9\"";} ?> value="9">September</option>
<option <?php if($startStayMonth == "10"){echo " selected=\"10\"";} ?> value="10">October</option>
<option <?php if($startStayMonth == "11"){echo " selected=\"11\"";} ?> value="11">November</option>
<option <?php if($startStayMonth == "12"){echo " selected=\"12\"";} ?> value="12">December</option>
</select>

<select name="startLodgeDay" >
<?php
for($i=1; $i<32; $i++) 
{
    echo '<option'; 
    if($startStayDay == $i)
    {
         echo ' selected="'.$i.'"';
    }
    echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>
</select>
</td>
</tr>
<tr><td>Province</td><td><input type="text" name="province" value="<?php echo $province; ?>"></td></tr>
<tr><td>City/Municipality</td><td><input type="text" name="city" value="<?php echo $city; ?>"></td></tr>
<tr><td>Barangay</td><td><input type="text" name="barangay" value="<?php echo $barangay; ?>"></td></tr>
<tr><td>Purok</td><td><input type="text" name="purok" value="<?php echo $purok; ?>"></td></tr>
<tr><td>Religion: Major Affiliation</td><td>
<select name="religion" id="relaff" onchange="changeList(this)">
      <option value="Paganism">Paganism</option>
	  <option value="Wicca">Wicca</option>
	  <option value="Witchcraft">Witchcraft</option>
	  <option value="Islam">Islam</option>
	  <option value="Buddhism">Buddhism</option>
	  <option value="No religion">No religion</option>
	  <option value="Christianity">Christianity</option>
	  <option value="Other">Other</option>
</select>
</td></tr>
<tr><td>Religion: Denomination</td><td>
<select name="denomination" id="reldet">
	<option value="NONE">This will update after selecting a religion</option>
</select>
</td></tr>
<tr><td>Contact Number</td><td><input type="text" name="contactnum" value="<?php echo $contactnum; ?>"></td></tr>
<tr><td>Profile Picture (Optional)</td><td><input type="file" id="picture" name="picture"></td></tr>
</tbody>
</table>
<div class='actions'>
<input type="submit" class="send" name="" value="Update Lodger Profile">
</div>
</form>

<?php
// footer
require_once('template/footer.php');
?>
