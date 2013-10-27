<?php
$page_title = "View room details";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
include_once ('database_connection.php');
$rb_id = $_GET['rb_id'];

$roomQuery = "SELECT room . * , bedspace.*
FROM room, bedspace, room_bedspace
WHERE bedspace.bedspace_id = room_bedspace.bedspace_id
AND room.roomcode = room_bedspace.roomcode AND room_bedspace.rb_id = '$rb_id'";

$occupantsQuery = "SELECT occupy_room.official_rec_id , lodger.lname, lodger.fname, lodger.mname FROM occupy_room INNER JOIN lodger ON lodger.ssn = occupy_room.ssn WHERE occupy_room.rb_id = '$rb_id' ORDER BY lodger.lname";

$reslodgersQuery = "SELECT reservation.res_id , lodger.lname, lodger.fname, lodger.mname, reservation.resDate, reservation.resDeadline FROM reservation INNER JOIN lodger ON lodger.ssn = reservation.ssn AND reservation.rb_id = '$rb_id' ORDER BY lodger.lname";

$countOLquery = "SELECT count(official_rec_id) AS occnum FROM occupy_room WHERE rb_id = '$rb_id'";
$OLresult = mysqli_query($dbc,$countOLquery);
$OLrow = mysqli_fetch_array($OLresult,MYSQLI_ASSOC);
$numOL = $OLrow['occnum'];
				
$countRLquery = "SELECT count(res_id) AS resnum FROM reservation WHERE rb_id = '$rb_id'";
$RLresult = mysqli_query($dbc,$countRLquery);
$RLrow = mysqli_fetch_array($RLresult,MYSQLI_ASSOC);
$numRL = $RLrow['resnum'];

$roomResult = mysqli_query($dbc,$roomQuery);
$occResult = mysqli_query($dbc,$occupantsQuery);
$resResult = mysqli_query($dbc, $reslodgersQuery);

if($roomResult){
	
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
	echo '<tr bgcolor="#66cc44"><th>Details</th><th></th></tr>';
         while($room = mysqli_fetch_array($roomResult,MYSQLI_ASSOC))
		 {
			echo '<tr><td>Room Code</td><td>' . $room['roomcode'] .'</td></tr>';
			echo '<tr><td>Description</td><td>' . $room['roomdesc'] .'</td></tr>';
			echo '<tr><td>Room Type</td><td>' . $room['roomtype'] .'</td></tr>';
			echo '<tr><td>Rate per Bedspacer</td><td>P' . $room['monthlyrate'] .'</td></tr>';
			echo '<tr><td>Total Bedspaces</td><td>' . $room['maxspace'] .'</td></tr>';
			$freespace = ($room['maxspace']  - $numOL) - $numRL;
			echo '<tr><td>Free Bedspaces</td><td>' . $freespace .'</td></tr>';
			echo '<tr><td>Has CR?</td>';
			if ($room['hasCR'] == 0)
				echo '<td>No</td>';
			else
				echo '<td>Yes</td>';
			echo '</tr>';	
			echo '<tr><td>Room Status</td>';
			if ($freespace == 0)
				echo '<td>Full</td>';
			else
				echo '<td>Vacant</td>';
			echo '</tr>';
		 }
	echo '</table>'; 
}
else 
{
    echo 'Parameter Missing';
}
echo '<br>';
echo '<br>';
if($occResult)
{
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
	echo '<tr bgcolor="#66cc44"><th>Occupants</th></tr>';
	$occMSAR = mysqli_num_rows($occResult);
	if($occMSAR != 0){
		while($occs = mysqli_fetch_array($occResult,MYSQLI_ASSOC))
		{
			echo '<tr><td>' . $occs['lname'].', '.$occs['fname']. ' '.$occs['mname'].'</td></tr>';
		}
	}
	else
	{
		echo '<tr><td>This room has no occupants.</td></tr>';
	}
	echo '</table>';
}
else
{
	echo 'No occupants.';
}
echo '<br>';
echo '<br>';

if($resResult)
{
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
	echo '<tr bgcolor="#66cc44"><th>Reserved Lodgers</th><th>Date of Deadline</th></tr>';
	$resMSAR = mysqli_affected_rows($dbc);
	if($resMSAR!=0){
		while($res = mysqli_fetch_array($resResult,MYSQLI_ASSOC))
		{
			echo '<tr><td>' . $res['lname'].', '.$res['fname']. ' '.$res['mname'].'</td><td>'.$res['resDeadline'].'</td></tr>';
		}
	}
	else
	{
		echo '<tr><td>This room has no occupants.</td></tr>';
	}
	echo '</table>';
}
else
{
	echo 'Parameter is missing!';
}

?>
<br>
<?php
// footer
require_once('template/footer.php');
?>
