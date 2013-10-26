<?php
$page_title = "Add a new lodger";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/forms/religiondropdown.js"></script>
<script type="text/javascript" src="./scripts/forms/formvalidation.js">
</script>
<link href="./styles/forms/formvalidation.css" rel="stylesheet" type="text/css" />


<form enctype="multipart/form-data" name="lodgerdata" action="createlodger.php" method="post">
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">Enter details here.</th>
</tr>
<tr><td>Last Name (Required)</td><td>
<div class="field">
<input type="text" name="lname" value="">
</div>
</td></tr>
<tr><td>First Name (Required)</td><td>
<div class="field">
<input type="text" name="fname" value="">
</div>
</td></tr>
<tr><td>Middle Name</td><td><input type="text" name="mname" value=""></td></tr>
<tr><td>Gender</td><td>
<select name="gender">
      <option value="F">Female</option>
	  <option value="M">Male</option>
</select></td></tr>
<input type="hidden" name="balance" value="0.00" >
<tr><td>Birthdate</td>
<td>
<!--<input type="text" name="birthdate" id="datepicker" value="">-->
<select name="birthdayYear" >
    <option value="0000">Year</option>
<?php
for($i=date('Y'); $i>1973; $i--) {
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="birthdayMonth">
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

<select name="birthdayDay" >
    <option value="00">Day</option>
<?php
for($i=1; $i<32; $i++) 
{
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>
</select>

</td></tr>
<tr>
<td>Start of Stay</td>
<td>
<!--<input type="text" name="startlodge" id="datepicker2" value="">-->
<select name="startLodgeYear" >
    <option value="0000">Year</option>
<?php
for($i=date('Y'); $i>2000; $i--) {
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="startLodgeMonth">
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

<select name="startLodgeDay" >
    <option value="00">Day</option>
<?php
for($i=1; $i<32; $i++) 
{
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>
</select>
</td>
</tr>
<tr><td>Province</td><td><input type="text" name="province" value=""></td></tr>
<tr><td>City/Municipality</td><td><input type="text" name="city" value=""></td></tr>
<tr><td>Barangay</td><td><input type="text" name="barangay" value=""></td></tr>
<tr><td>Purok</td><td><input type="text" name="purok" value=""></td></tr>
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
<tr><td>Contact Number</td><td><input type="text" name="contactnum" value=""></td></tr>
<tr><td>Profile Picture (Optional)</td><td><input type="file" id="picture" name="picture"></td></tr>
</tbody>
</table>
<div class='actions'>
<input type="submit" class="send" disabled="disabled" name="" value="Add Lodger">
</div>
</form>


<?php

// footer
require_once('template/footer.php');
?>
