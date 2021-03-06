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
		$roomcode = $_GET['roomcode'];
		$query = "DELETE FROM room WHERE roomcode = '$roomcode'";
		mysqli_query($dbc, $query) or die('Error querying database.');
		
		echo 'Room with number ' . $roomcode . ' removed.<br>';
		echo 'Redirecting to rooms list...';
		
		mysqli_close($dbc);
		header('Refresh: 1.5; viewrooms.php');

		
  }
?>