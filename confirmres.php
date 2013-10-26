<?php
include_once ('database_connection.php');
	session_start();
	
	if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
	
  if (!isset($_SESSION['username'])) 
  {
	// No session set, access denied.
	header( 'Location: login.php' ) ;
  }
  else
  {
  
		$ssn = $_GET['ssn'];
		$roomcode = $_GET['roomcode'];
		$roomquery = "SELECT * from room where roomcode = '$roomcode'";
		$roomdata = mysqli_query($dbc, $roomquery);
		$rowdata = mysqli_fetch_array($roomdata,MYSQLI_ASSOC);
		$monthlybal = $rowdata['roomrate'];
		// add lodger to official listing
		$confirmLodgerQuery = "INSERT INTO official (lodger_ssn, room_code, appliancerate, monthlybal) VALUES ('$ssn', '$roomcode', '0.00', '$monthlybal')";
		// and delete the info for the reservation
		mysqli_query($dbc, $confirmLodgerQuery)
			or die('Error querying database.');	
		$delquery = "DELETE FROM reservation WHERE lodger_ssn = '$ssn'";
		mysqli_query($dbc, $delquery) or die('Error querying database.');
			
		echo 'Reservation confirmed. Redirecting to system homepage...';
		mysqli_close($dbc);
		header('Refresh: 1.5; index.php');
		
		

  }
?>