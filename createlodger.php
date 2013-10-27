<?php
//  $dbc = mysqli_connect('localhost', 'kureido', 'tnx4standinstillwanker', 'kureido')
//    or die('Error connecting to MySQL server.');
include_once ('database_connection.php');
require_once('imguploadConstraints.php');
	$bdate=date_create();
	date_date_set($bdate,$_POST['birthdayYear'],$_POST['birthdayMonth'],$_POST['birthdayDay']);
	$birthdateString = date_format($bdate,"Y-m-d");
	$dateSL=date_create();
	date_date_set($dateSL,$_POST['startLodgeYear'],$_POST['startLodgeMonth'],$_POST['startLodgeDay']);
	$startLodgeString = date_format($dateSL,"Y-m-d");
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$mname = mysqli_real_escape_string($dbc, trim($_POST['mname']));
	$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
	$balance = mysqli_real_escape_string($dbc, trim($_POST['balance']));
	$birthdate = mysqli_real_escape_string($dbc, trim($birthdateString));
	$startlodge = mysqli_real_escape_string($dbc, trim($startLodgeString));
	$province = mysqli_real_escape_string($dbc, trim($_POST['province']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$barangay = mysqli_real_escape_string($dbc, trim($_POST['barangay']));
	$purok = mysqli_real_escape_string($dbc, trim($_POST['purok']));
	$religion = mysqli_real_escape_string($dbc, trim($_POST['religion']));
	$denomination = mysqli_real_escape_string($dbc, trim($_POST['denomination']));
	$contactnum = mysqli_real_escape_string($dbc, trim($_POST['contactnum']));
	$picture = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size']; 
	
	if((!empty($lname)) && (empty($fname)))
	{
		echo 'You forgot the given name of the lodger.';
	}
	if((empty($lname)) && (!empty($fname)))
	{
		echo 'You forgot the surname of the lodger.';
	}
	if((empty($lname)) && (empty($fname)))
	{
		echo 'You forgot the surname and given name of the lodger.';
	}
	if((!empty($lname)) && (!empty($fname)))
	{
		if (!empty($picture)) 
		{
			if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture == 'image/pjpeg') || ($picture_type == 'image/png')) /* && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE) */ ) 	
			{
				if ($_FILES['picture']['error'] == 0) 
				{
				// Move the file to the target upload folder
				$target = BHMS_UPLOADPATH . $picture;
				if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) 
				{
					$query = "INSERT INTO lodger (lname, fname, mname, gender, birthdate, startStay, province, city, barangay, purok, affiliation, denomination, contactnum, picture) VALUES ('$lname', '$fname', '$mname', '$gender', '$birthdate', '$startlodge', '$province', '$city', '$barangay', '$purok', '$religion', '$denomination', '$contactnum', '$picture')";
					mysqli_query($dbc, $query)
						or die('Error querying database.');
					$ssnquery = "Select lodger.ssn from lodger where lodger.lname = '$lname' AND lodger.fname = '$fname' and lodger.mname = '$mname'";
					$result = mysqli_query($dbc,$ssnquery);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$ssn = $row['ssn'];
			
					echo 'Lodger info added.<br>';
					echo 'Name: ' . $lname . ', ' . $fname . ' ' . $mname.'<br>';
					echo 'Redirecting to room list within a few moments. Please wait.';
		
					header('Refresh: 2; selectaroom.php?ref=addlodger&ssn=' . $ssn);

					mysqli_close($dbc);
		
				}
					else 
					{
					echo '<p class="error">Sorry, there was a problem uploading the profile photo.</p>';
					}
				}
			}
			else 
			{
			echo '<p class="error">The lodger\'s profile photo must be a GIF, JPEG, or PNG image file.</p>';
			}

			// Try to delete the temporary screen shot image file
			@unlink($_FILES['picture']['tmp_name']);
		}
		else
		{
			// NO PROFILEPIC
			$query = "INSERT INTO lodger (lname, fname, mname, gender, birthdate, startStay, province, city, barangay, purok, affiliation, denomination, contactnum) VALUES ('$lname', '$fname', '$mname', '$gender', '$birthdate', '$startlodge', '$province', '$city', '$barangay', '$purok', '$religion', '$denomination', '$contactnum')";
					mysqli_query($dbc, $query)
						or die('Error querying database.');
					$ssnquery = "Select lodger.ssn from lodger where lodger.lname = '$lname' AND lodger.fname = '$fname' and lodger.mname = '$mname'";
					$result = mysqli_query($dbc,$ssnquery);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$ssn = $row['ssn'];
			
					echo 'Lodger info added.<br>';
					echo 'Name: ' . $lname . ', ' . $fname . ' ' . $mname.'<br>';
					echo 'Redirecting to room list within a few moments. Please wait.';
		
					header('Refresh: 2; selectaroom.php?ref=addlodger&ssn=' . $ssn);

					mysqli_close($dbc);
		}
	}
?>