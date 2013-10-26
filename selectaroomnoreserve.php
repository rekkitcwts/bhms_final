<?php
$page_title = "Select a room";
require_once('template/header.php');


include_once ('database_connection.php');
$roomQuery = "SELECT * from room";

//echo $_GET['ssn'];

$result = mysqli_query($dbc,$roomQuery);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="900">';
	echo '<tr bgcolor="#66cc44"><th>Room Number</th><th>Room Description</th><th>Room Type</th><th>Rate/head</th><th>Maximum Bedspaces</th><th>Free Bedspaces</th><th>Status</th><th>Has CR</th><th>Options</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			// These are for the reserved customers and official lodgers.
			$room = $row['roomcode'];
			$countOLquery = "SELECT count(lodger_ssn) AS occnum FROM official WHERE room_code = '$room'";
			$OLresult = mysqli_query($dbc,$countOLquery);
			$OLrow = mysqli_fetch_array($OLresult,MYSQLI_ASSOC);
			$numOL = $OLrow['occnum'];
			$countRLquery = "SELECT count(lodger_ssn) AS resnum FROM reservation WHERE roomcode = '$room'";
			$RLresult = mysqli_query($dbc,$countRLquery);
			$RLrow = mysqli_fetch_array($RLresult,MYSQLI_ASSOC);
			$numRL = $RLrow['resnum'];
			$freespace = ($row['remain_bedspace'] - $numOL) - $numRL;
			
			echo '<tr><td>'.$row['roomcode'].'</td><td>' . $row['roomdesc'] .'</td><td>' . $row['roomtype'] .'</td><td>' . $row['roomrate'] .'</td><td>' . $row['remain_bedspace'] .'</td><td>' . $freespace .  '</td>';
			if ($freespace == 0)
				echo '<td>Full</td>';
			else
				echo '<td>Vacant</td>';
				
			if ($row['isroomwithCR'] == 0)
				echo '<td>No</td>';
			else
				echo '<td>Yes</td>';
			
			if ($freespace > 0)
			echo '<td><a href="recordlodger.php?ssn='. $_GET['ssn'] . '&roomcode=' . $row['roomcode'] . '&roomrate=' . $row['roomrate'] . '"\>' . 'Add official lodger' . '</a></td></tr>';
			else
			echo '<td>No free space</td></tr>';
		/*	echo '<a href=' . '../' . 'bhms_home/editpaymentrecords/' . $row['ssn'] . '/' . $row['room_code'] . '\>' . 'Edit Payment Records' . '</a>';
			echo ' <br> ';
			echo '<a href=' . '../' . 'bhms_home/viewofflodgerinfo/' . $row['ssn'] . '\>' . 'View Personal Info' . '</a></td></tr>'; */
		 }
	echo '</table>';
    }else {
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  
}
else {
    echo 'Parameter Missing';
}



// footer
require_once('template/footer.php');
?>
