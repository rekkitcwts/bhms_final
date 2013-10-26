<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
    if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Boarding House Management System</title>

<script src="./scripts/jquery-1.9.1.js"></script>
<script src="./scripts/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="./styles/flexigrid.css" />
<link rel="stylesheet" type="text/css" href="./styles/jqpurr.css" />
<script type="text/javascript" src="./scripts/jquery.min.js"></script>
<script type="text/javascript" src="./scripts/flexigrid.pack.js"></script>
<link rel="stylesheet" href="./styles/styletest.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="./styles/toastmsg/jquery.toast.css" type="text/css">
<link rel="stylesheet" href="./styles/toastmsg/jquery.toast.min.css" type="text/css">
<script src="./scripts/toastmsg/jquery.toast.js"></script>
<script src="./scripts/toastmsg/jquery.toast.min.js"></script>
<script src="./scripts/toastmsg/customtoast.js"></script>
<link rel="stylesheet" href="./styles/tf2fonts.css" type="text/css">
</head>
<body>
<div id="container">
  
<div id="header">
  <div class="nav-top">
    <div class="left">
      <ul class="nav-top-menu">
        <li><span id="logo"><a title="System Homepage" href="./index.php">Index</a></span></li>
        <li class="lodger"><a href="#" class="brown">Lodger Management</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="./addlodger.php" title="Add a new lodger">Add Lodger</a></li>
			<li><a href="./officiallodgers.php" title="Search and view the list of lodgers, whether official or unofficial.">Lodgers List</a></li>
			
          </ul>
        </li>
        <li><a href="#" class="brown">Room Management</a>
          <ul>
		  <!-- Format same as above.-->
            <li><a href="./addroom.php" title="Add a new room">Add Room</a></li>
			<li><a href="./viewrooms.php" title="View all rooms regardless of vacancy status">View All Rooms</a></li>
          </ul>
        </li>
		<li><a href="#" class="brown">Reservation</a>
          <ul>
		  <!-- Format same as above.-->
          <!--  <li><a href="./index.php/bhms_home/addres" title="Add a new room reservation">Add Room Reservation</a></li> -->
		<!--	<li><a href="./index.php/bhms_home/viewrescust" title="View all roomless customer reservations">View Roomless Customer Reservations</a></li> -->
			<li><a href="./reslist.php" title="View all customer reservations, with rooms reserved.">View All Customer Reservations</a></li>
          </ul>
        </li>
		<li><a href="#" class="brown">Payments and Balances</a>
          <ul>
		  <!-- Format same as above.-->
            <li><a href="./olpayment.php" title="Record official lodger's payment">Add Payment</a></li>
			<li><a href="./viewrecords.php" title="Lists down payment records.">View Payment Records</a></li>
			<li><a title="Coming Soon">View Unpaid Lodgers</a></li>
			<li><a title="Coming soon">View lodgers with balances</a></li>
          </ul>
        </li>
		
      </ul>
    </div>
	<div class="right">
		<span>
		<?php
		  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['id'])) {
    echo '<p class="login">Not logged in.</p>';
    exit();
  }
  else {
    echo('You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php" title="Log-out from the system.">Log out</a>');
  }
  ?>
		</span>
	</div>
    
  </div>
  <div class="clear"></div>
  <div id="main-menu">
    <ul>
	  <li><a href="./officiallodgers.php" class="active"><span>Official</span></a></li>
      <li><a href="./unofficiallodgers.php"><span>Unofficial</span></a></li>
    </ul>
  </div>

</div>
<div class="content">
<div class="content-body">
<center><h1>
<span class="boxshadow"style="background:#fff">
<?php echo $page_title; ?>
</span>
</h1>
<?php
  }
  else {
    header( 'Location: login.php' ) ;
  }

?>