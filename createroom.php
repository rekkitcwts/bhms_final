<?php
include_once ('database_connection.php');

$roomcode = $_POST['roomcode'];
$roomtype = $_POST['roomtype'];
// Get number of beds of this room...
$hasCR = $_POST['hasCR'];
$bedspace_id = $_POST['bedspace_id'];

if(empty($roomcode))
{
	echo 'ERROR: Need to input a room code.';
}
else
{
	$bedspaceResult = mysqli_query($dbc, "SELECT * FROM bedspace WHERE bedspace_id = '$bedspace_id'")
			or die('Error querying database.');
	$bsRow = mysqli_fetch_array($bedspaceResult,MYSQLI_ASSOC);
	$numberbeds = $bsRow['maxspace'];
	
	$roomdesc = "";
		
		// ... then generate the description for it.
		if ($numberbeds == 1)
		{
			$roomdesc = "Room for 1 person";
		}
		else
		{
			$roomdesc = 'Room for ' . $numberbeds . ' persons';
		}
		
		$roomquery = "INSERT INTO room (roomcode, roomdesc, roomtype, hasCR) VALUES ('$roomcode', '$roomdesc', '$roomtype', '$hasCR')";
		mysqli_query($dbc, $roomquery)
			or die('Error querying database.');
			
		$occroom = "INSERT INTO room_bedspace (roomcode, bedspace_id) VALUES ('$roomcode','$bedspace_id')";
		mysqli_query($dbc, $occroom)
			or die('Error querying database.');
			
		echo 'Room info added.<br>';
		echo 'Room number: ' . $roomcode . '<br>';
		echo 'Details: ' . $roomdesc . '<br>';
		echo 'Type: ' . $roomtype . '<br>';
		if ($hasCR == 1)
		echo 'Has CR: Yes<br>';
		else
		echo 'Has CR: No<br>';
		echo 'Redirecting to room list within a few moments. Please wait.';
		
		header('Refresh: 1.5; viewrooms.php');

		mysqli_close($dbc);
}
?>