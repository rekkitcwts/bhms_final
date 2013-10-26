<?php
	$page_title = "Add A New Lodger";
	require_once("template/header.php");
	require_once("template/navigation.php");
	include_once("backend/database_connection.php");
?>
<link rel="stylesheet" type="text/css" href="./styles/forms/validation.css" />
<?php
  if (isset($_POST['submit'])) 
  {
	// Required Fields
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$mname = mysqli_real_escape_string($dbc, trim($_POST['mname']));
	$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
	$birthdayYear = $_POST['birthdayYear'];
	$birthdayMonth = $_POST['birthdayMonth'];
	$birthdayDay = $_POST['birthdayDay'];
    $bdate=date_create();
	date_date_set($bdate,$birthdayYear,$birthdayMonth,$birthdayDay);
	$birthdateString = date_format($bdate,"Y-m-d");
	$startStayYear = $_POST['startStayYear'];
	$startStayMonth = $_POST['startStayMonth'];
	$startStayDay = $_POST['startStayDay'];
	$dateSL=date_create();
	date_date_set($dateSL,$startStayYear,$startStayMonth,$startStayDay);
	$startLodgeString = date_format($dateSL,"Y-m-d");
	$birthdate = mysqli_real_escape_string($dbc, trim($birthdateString));
	$startStay = mysqli_real_escape_string($dbc, trim($startLodgeString));
	
	// Optional Fields.
	$province = mysqli_real_escape_string($dbc, trim($_POST['province']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$barangay = mysqli_real_escape_string($dbc, trim($_POST['barangay']));
	$purok = mysqli_real_escape_string($dbc, trim($_POST['purok']));
	$religion = mysqli_real_escape_string($dbc, trim($_POST['affiliation']));
	$denomination = mysqli_real_escape_string($dbc, trim($_POST['denomination']));
	$contactnum = mysqli_real_escape_string($dbc, trim($_POST['contactnum']));
	
	// Form Validation
    $output_form = false;

    if (empty($lname) && empty($fname)) {
      // All required fields are empty. 
      echo 'Required fields missing!<br />';
      $output_form = true;
    }
	if (empty($lname) && (!empty($fname))) {
      echo 'Lodger\'s last name is missing!<br />';
      $output_form = true;
    }

    if ((!empty($lname)) && empty($fname)) {
      echo 'Lodger\'s first name is missing!<br />';
      $output_form = true;
    }
  }
  else {
    $output_form = true;
  }

  if ((!empty($lname)) && (!empty($fname))) {
		// All required fields not empty.
		// echo 'Form validated!<br />';
		$output_form = false;
		
		$query = "INSERT INTO lodger (lname, fname, mname, gender, birthdate, startStay, province, city, barangay, purok, affiliation, denomination, contactnum) VALUES ('$lname', '$fname', '$mname', '$gender', '$birthdate', '$startStay', '$province', '$city', '$barangay', '$purok', '$religion', '$denomination', '$contactnum')";
		
		mysqli_query($dbc, $query)
			or die('Error querying database.');
					
		$ssnquery = "Select lodger.ssn from lodger where lodger.lname = '$lname' AND lodger.fname = '$fname' and lodger.mname = '$mname'";
		$result = mysqli_query($dbc,$ssnquery);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$ssn = $row['ssn'];
			
		echo 'Lodger info added.<br />';
		echo 'Name: ' . $lname . ', ' . $fname . ' ' . $mname.'<br />';
		echo 'Redirecting to room list within a few moments. Please wait.<br />';
		
		header('Refresh: 2; selectaroom.php?ref=addlodger&ssn=' . $ssn);

		mysqli_close($dbc);

    
  }

  if ($output_form) {
?>
	<br />
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label for="lname">Last Name (Required)</label>
		<div class="field">
			<input type="text" name="lname" value="<?php if (isset($_POST['submit'])) echo $lname; ?>">
		</div><br />
    <label for="fname">First Name (Required)</label>
		<div class="field">
			<input type="text" name="fname" value="<?php if (isset($_POST['submit'])) echo $fname; ?>">
		</div><br />
	<label for="mname">Middle Name (Leave blank if lodger is illegitimate)</label>
		<div class="field">
			<input type="text" name="mname" value="<?php if (isset($_POST['submit'])) echo $mname; ?>">
		</div><br />
	<label for="mname">Gender</label>
		<div class="field">
			<select name="gender">
				<option <?php if(isset($_POST['submit']) && $gender == "F"){echo " selected=\"F\"";} ?> value="F">Female</option>
				<option <?php if(isset($_POST['submit']) && $gender == "M"){echo " selected=\"M\"";} ?> value="M">Male</option>
			</select>
		</div><br />
	<label for="birthday">Birthdate</label>
		<div class="field">
			<select name="birthdayYear" >
				<?php
					for($i=date('Y'); $i>1973; $i--) 
					{
						echo '<option'; 
						if(isset($_POST['submit']) && $birthdayYear == $i)
						{
							echo ' selected="'.$i.'"';
						}
						echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
					} 
				?>
			</select>
			<select name="birthdayMonth">
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "1"){echo " selected=\"1\"";} ?> value="1">January</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "2"){echo " selected=\"2\"";} ?> value="2">February</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "3"){echo " selected=\"3\"";} ?> value="3">March</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "4"){echo " selected=\"4\"";} ?> value="4">April</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "5"){echo " selected=\"5\"";} ?> value="5">May</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "6"){echo " selected=\"6\"";} ?> value="6">June</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "7"){echo " selected=\"7\"";} ?> value="7">July</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "8"){echo " selected=\"8\"";} ?> value="8">August</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "9"){echo " selected=\"9\"";} ?> value="9">September</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "10"){echo " selected=\"10\"";} ?> value="10">October</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "11"){echo " selected=\"11\"";} ?> value="11">November</option>
				<option <?php if(isset($_POST['submit']) && $birthdayMonth == "12"){echo " selected=\"12\"";} ?> value="12">December</option>
			</select>
			<select name="birthdayDay" >
				<?php
					for($i=1; $i<32; $i++) 
					{
						echo '<option'; 
						if(isset($_POST['submit']) && $birthdayDay == $i)
						{
							echo ' selected="'.$i.'"';
						}
						echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
					} 
				?>
			</select>
		</div><br />
	<label for="startStay">Start of Stay</label>
		<div class="field">
			<select name="startStayYear" >
				<?php
					for($i=date('Y'); $i>1973; $i--) 
					{
						echo '<option'; 
						if(isset($_POST['submit']) && $startStayYear == $i)
						{
							echo ' selected="'.$i.'"';
						}
						echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
					} 
				?>
			</select>
			<select name="startStayMonth">
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "1"){echo " selected=\"1\"";} ?> value="1">January</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "2"){echo " selected=\"2\"";} ?> value="2">February</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "3"){echo " selected=\"3\"";} ?> value="3">March</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "4"){echo " selected=\"4\"";} ?> value="4">April</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "5"){echo " selected=\"5\"";} ?> value="5">May</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "6"){echo " selected=\"6\"";} ?> value="6">June</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "7"){echo " selected=\"7\"";} ?> value="7">July</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "8"){echo " selected=\"8\"";} ?> value="8">August</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "9"){echo " selected=\"9\"";} ?> value="9">September</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "10"){echo " selected=\"10\"";} ?> value="10">October</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "11"){echo " selected=\"11\"";} ?> value="11">November</option>
				<option <?php if(isset($_POST['submit']) && $startStayMonth == "12"){echo " selected=\"12\"";} ?> value="12">December</option>
			</select>
			<select name="startStayDay" >
				<?php
					for($i=1; $i<32; $i++) 
					{
						echo '<option'; 
						if(isset($_POST['submit']) && $startStayDay == $i)
						{
							echo ' selected="'.$i.'"';
						}
						echo ' value="'.$i.'"'.'>'.$i.'</option>'."\n";
					} 
				?>
			</select>
		</div><br />
	<label for="province">Province</label>
		<div class="field">
			<input type="text" name="province" value="<?php if (isset($_POST['submit'])) echo $province; ?>">
		</div><br />
	<label for="city">City</label>
		<div class="field">
			<input type="text" name="city" value="<?php if (isset($_POST['submit'])) echo $city; ?>">
		</div><br />
	<label for="barangay">Barangay</label>
		<div class="field">
			<input type="text" name="barangay" value="<?php if (isset($_POST['submit'])) echo $barangay; ?>">
		</div><br />
	<label for="purok">Purok</label>
		<div class="field">
			<input type="text" name="purok" value="<?php if (isset($_POST['submit'])) echo $purok; ?>">
		</div><br />
	<label for="affiliation">Religion - Major Affiliation</label>
		<div class="field">
			<input type="text" name="affiliation" value="<?php if (isset($_POST['submit'])) echo $religion; ?>">
		</div><br />
	<label for="denomination">Denomination</label>
		<div class="field">
			<input type="text" name="denomination" value="<?php if (isset($_POST['submit'])) echo $denomination; ?>">
		</div><br />
	<label for="contactnum">Contact Number</label>
		<div class="field">
			<input type="text" name="contactnum" value="<?php if (isset($_POST['submit'])) echo $contactnum; ?>">
		</div><br />
    <input type="submit" class="send" name="submit" value="Add Lodger" />
  </form>

<?php
  }
?>
<?php
	require_once("template/footer.php");
?>