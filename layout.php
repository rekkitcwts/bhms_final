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
			<li><a href="./index.php/bhms_home/offedit" title="Edit a lodger's personal info">Edit Lodger Personal Info</a></li>
			<li><a href="./lodgers.php" title="Search and view the list of lodgers, whether official or unofficial.">Search and View Lodgers List</a></li>
			<li><a title="Coming soon">View lodgers with balances</a></li>
			
          </ul>
        </li>
        <li><a href="#" class="brown">Room Management</a>
          <ul>
		  <!-- Format same as above.-->
            <li><a href="./index.php/bhms_home/addroom" title="Add a new room">Add Room</a></li>
			<li><a href="./index.php/bhms_home/viewvacantroom" title="View all rooms regardless of vacancy status">View All Rooms</a></li>
          </ul>
        </li>
		<li><a href="#" class="brown">Reservation</a>
          <ul>
		  <!-- Format same as above.-->
          <!--  <li><a href="./index.php/bhms_home/addres" title="Add a new room reservation">Add Room Reservation</a></li> -->
		<!--	<li><a href="./index.php/bhms_home/viewrescust" title="View all roomless customer reservations">View Roomless Customer Reservations</a></li> -->
			<li><a href="./index.php/bhms_home/viewresroom" title="View all customer reservations, with rooms reserved.">View All Customer Reservations</a></li>
          </ul>
        </li>
		<li><a href="#" class="brown">Payments and Balances</a>
          <ul>
		  <!-- Format same as above.-->
            <li><a <a href="./index.php/bhms_home/paymentofflist" title="Record official lodger's payment">Add Payment</a></li>
			<li><a <a href="./index.php/bhms_home/viewpaymentrecords" title="Lists down payment records for each month.">View Payment Records</a></li>
			<li><a title="Coming Soon">View Unpaid Lodgers</a></li>
			
          </ul>
        </li>
		
      </ul>
    </div>
	<div class="right">
		<span>Security System Not Implemented.  </span>
		<a title="Log-out of the system." href="./index.php/bhms_home/logout" class="brown" >Logout</a>
	</div>
    
  </div>
  <div class="clear"></div>
  

</div>
<div class="content">
<div class="content-body">
<center><h1>
<span class="boxshadow"style="background:#fff">
Welcome to the System
</span>
</h1>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</center>

</div>
</div>
<div id="footer">
  <div style="float:left; width:400px"> 
  
  <!--[if IE]>
Place content here to target all Internet Explorer users.
	<span>You are using Internet Explorer.<br>
	This system runs better on Chrome or Firefox</span>
<![endif]-->
<![if !IE]>
Good. You are using the correct browser.
<![endif]>
  
  </div>
  <div style="width:300px;float:right; text-align:right">
  Boarding House Management System <br>
  Version 0.3 (Alicia) alpha<br>
  Last Release: 8-OCT-2013
  </div>
</div>
</body>
</html>