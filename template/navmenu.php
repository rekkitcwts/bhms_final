<body>
<div id="container">
<div id="header">
<div class="nav-top">
<div class="left">
<ul class="nav-top-menu">
<li><span id="logo"><a title="System Homepage" href="./index.php">Index</a></span></li>
<li class="lodger"><a href="#" class="brown">Lodger Management</a>
<ul class="lodger-menu"><!-- Format: <a href="[base url]bhms_home/methodname">-->
<li><a href="./addlodger.php" title="Add a new lodger">Add Lodger</a></li>
<li><a href="./officiallodgers.php" title="Search and view the list of lodgers, whether official or unofficial.">Lodgers List</a></li>
</ul>
</li>
<li><a href="#" class="brown">Room Management</a>
<ul><!-- Format same as above.-->
<li><a href="./addroom.php" title="Add a new room">Add Room</a></li>
<li><a href="./viewrooms.php" title="View all rooms regardless of vacancy status">View All Rooms</a></li>
</ul>
</li>
<li><a href="#" class="brown">Reservation</a>
<ul><!-- Format same as above.-->
<!--  <li><a href="./index.php/bhms_home/addres" title="Add a new room reservation">Add Room Reservation</a></li> -->
<!--    <li><a href="./index.php/bhms_home/viewrescust" title="View all roomless customer reservations">View Roomless Customer Reservations</a></li> -->
<li><a href="./reslist.php" title="View all customer reservations, with rooms reserved.">View All Customer Reservations</a></li>
</ul>
</li>
<li><a href="#" class="brown">Payments and Balances</a>
<ul><!-- Format same as above.-->
<li><a href="./olpayment.php" title="Record official lodger's payment">Add Payment</a></li>
<li><a href="./viewrecords.php" title="Lists down payment records.">View Payment Records</a></li>
<li><a href="./unpaidlodgers.php">View Unpaid Lodgers</a></li>
<li><a href="./generatereports.php">Generate Reports</a></li>
</ul>
</li>
</ul>
</div>
<div class="right"><span>
		<?php
		  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['id'])) {
    echo 'Not logged in.';
  }
  else {
    echo('Logged in: ' . $_SESSION['username'] . '. <a href="logout.php" title="Log-out from the system.">Log out</a>');
  }
  ?>
		</span></div>
</div>
<div class="clear"></div>
  

