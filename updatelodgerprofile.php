<?php
include_once('database_connection.php');
require_once('imguploadConstraints.php');

$ssn = $_POST['ssn'];
$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
$mname = mysqli_real_escape_string($dbc, trim($_POST['mname']));
$gender = $_POST['gender'];
$bdate=date_create();
	date_date_set($bdate,$_POST['birthdayYear'],$_POST['birthdayMonth'],$_POST['birthdayDay']);
	$birthdateString = date_format($bdate,"Y-m-d");
	$dateSL=date_create();
	date_date_set($dateSL,$_POST['startLodgeYear'],$_POST['startLodgeMonth'],$_POST['startLodgeDay']);
	$startLodgeString = date_format($dateSL,"Y-m-d");
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
					$query = "UPDATE lodger SET lname = '$lname', fname = '$fname', mname = '$mname', gender = '$gender', birthdate = '$birthdateString', startStay = '$startLodgeString', province = '$province', city = '$city', barangay = '$barangay', purok = '$purok', affiliation = '$religion', denomination = '$denomination', contactnum = '$contactnum', picture = '$picture' WHERE ssn = '$ssn'";
					mysqli_query($dbc, $query)
						or die('Error querying database.');
					
			
					echo 'Profile updated.';
					echo 'Redirecting to lodger list. Please wait.';
		
					header('Refresh: 2; officiallodgers.php');

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
			$query = "UPDATE lodger SET lname = '$lname', fname = '$fname', mname = '$mname', gender = '$gender', birthdate = '$birthdateString', startStay = '$startLodgeString', province = '$province', city = '$city', barangay = '$barangay', purok = '$purok', affiliation = '$religion', denomination = '$denomination', contactnum = '$contactnum' WHERE ssn = '$ssn'";
					mysqli_query($dbc, $query)
						or die('Error querying database.');
					
			
					echo 'Profile updated.';
					echo 'Redirecting to lodger list. Please wait.';
		
					header('Refresh: 2; officiallodgers.php');

					mysqli_close($dbc);
		}
	}

?>