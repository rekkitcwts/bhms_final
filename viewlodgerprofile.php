<?php
$page_title = "Viewing Lodger Profile";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
require_once('imguploadConstraints.php');
include_once ('database_connection.php');

$ssn = $_GET['ssn'];
$type = $_GET['type'];

//$balquery = "SELECT SUM(totalrate - paymentamt) as totalbalance FROM payment WHERE lodger_ssn = '$ssn'";
$balquery = "SELECT lodger_payment.lp_id, lodger.lname, lodger.fname, lodger.mname, payment.paymenttype, payment.amountPaid, payment.paymentDate, bedspace.monthlyrate, appliancerate.appliancerate, bedspace.monthlyrate + appliancerate.appliancerate AS totalrate, SUM(bedspace.monthlyrate + appliancerate.appliancerate - payment.amountPaid) AS balance FROM lodger INNER JOIN lodger_payment USING (ssn) INNER JOIN payment USING (payment_id) INNER JOIN bedspace USING (bedspace_id) INNER JOIN appliancerate USING (ar_id) WHERE lodger.ssn = '$ssn'";
$balresult = mysqli_query($dbc,$balquery);
$balrow = mysqli_fetch_array($balresult,MYSQLI_ASSOC);
$numbal = $balrow['balance'];

$query = "SELECT * from lodger WHERE ssn = '$ssn'";


// Edit profile button here
$result = mysqli_query($dbc,$query);
if($result)
{
	
    if(mysqli_affected_rows($dbc)!=0)
	{
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			 if ($row['gender'] == "M")
				 echo '<tr bgcolor="#1569C7"><th colspan="3">Lodger Details</th></tr>';
			 else
			 	 echo '<tr bgcolor="#FF69B4"><th colspan="3">Lodger Details</th></tr>';
			 
			echo '<tr><td>Name</td><td>' . $row['lname'].', '.$row['fname']. ' '.$row['mname'] .'</td>';
			echo '<td rowspan="3">';
				if (is_file(BHMS_UPLOADPATH . $row['picture']) && filesize(BHMS_UPLOADPATH . $row['picture']) > 0) 
				{
					echo '<img class="boxshadow" width="160" height="160" src="' . BHMS_UPLOADPATH . $row['picture'] . '" alt="Profile Photo" />';
				}
				else 
				{
					if ($row['gender'] == "M")
					echo '<img class="boxshadow" width="160" height="160" src="' . BHMS_UPLOADPATH . 'nophoto-male.png' . '" alt="No profile photo available." />';
					else
					echo '<img class="boxshadow" width="160" height="160" src="' . BHMS_UPLOADPATH . 'nophoto-female.png' . '" alt="No profile photo available." />';
				}
			echo '</td></tr>';
			echo '<tr><td>Status</td><td>' . $type .'</td></tr>';
			echo '<tr><td>Gender</td><td>' . $row['gender'].'</td></tr>';
			echo '<tr><td>Date of Birth</td><td>' . $row['birthdate'] .'</td></tr>';
			echo '<tr><td>Start of Stay</td><td>' . $row['startStay'] .'</td></tr>';
			echo '<tr><td>Home Address</td><td>' . $row['purok'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province'] . '</td></tr>';
			echo '<tr><td>Religious Affiliation</td><td>' . $row['affiliation']; 
			if ($row['denomination'])
				echo ' (' . $row['denomination'] . ')'; 
				
			echo '</td></tr>';
			echo '<tr><td>Contact Number</td><td>' . $row['contactnum'] .'</td></tr>';
			echo '<tr><td>Balance</td><td>' . 'P';
			if (!$numbal)
				echo '0.00';
			else
				echo $numbal;
			echo '</td></tr>';
			echo '<tr><td colspan=3><a href="./editlodgerprofile.php?ssn='.$ssn.'" title="Edit a lodger\'s profile">Edit Lodger Profile</a></td></tr>';
		 }
	echo '</table>';
	}
	else 
	{
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  
}
else 
{
    echo 'Parameter Missing';
}



// footer
require_once('template/footer.php');
?>
