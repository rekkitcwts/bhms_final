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
		$rb_id = $_GET['rb_id'];
		// add lodger to official listing
		$confirmLodgerQuery = "INSERT INTO occupy_room (ssn, rb_id) VALUES ('$ssn', '$rb_id')";
		// and delete the info for the reservation
		mysqli_query($dbc, $confirmLodgerQuery)
			or die('Error querying database.');	
		$delquery = "DELETE FROM reservation WHERE ssn = '$ssn' LIMIT 1";
		mysqli_query($dbc, $delquery) or die('Error querying database.');
			
		echo 'Reservation confirmed. Redirecting to system homepage...';
		mysqli_close($dbc);
		header('Refresh: 1.5; index.php');
		
		

  }
?>