<?php
	include_once ('database_connection.php');
	session_start();

  // If the session vars aren't set, try to set them with a cookie
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
		$query = "DELETE FROM reservation WHERE lodger_ssn = '$ssn'";
		mysqli_query($dbc, $query) or die('Error querying database.');
		
		echo 'Reservation cancelled.<br>';
		echo 'Redirecting to reservations list...';
		
		mysqli_close($dbc);
		header('Refresh: 1.5; reslist.php');

		
  }
?>