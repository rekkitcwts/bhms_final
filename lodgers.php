<?php
$page_title = "Official Lodgers Listing";
require_once('template/headerOL.php');

?>
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
List of Lodgers
</span>
</h1>
<script>
  $(function() {
    $( "input[type=submit], a, button" )
      .button()
      .click(function( event ) {
        event.preventDefault();
		alert("You rang?");
      });
  });
  </script>
<div class="container">
	<button>A button element</button>
 
<input type="submit" value="A submit button" />
 
<a href="#">An anchor</a>
</div>

</center>

</div>
</div>
<?php
// footer
require_once('template/footer.php');
?>
