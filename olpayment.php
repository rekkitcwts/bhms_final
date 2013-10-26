<?php
$page_title = "Official Lodgers Listing";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/livesearch/payment.js"></script>
<!--Criteria: <select name="searchtype" id="searchtype">
	<option value="Last">Last Name</option>
	<option value="First">First Name</option>
	</select> 
	<br>
	Search:<INPUT type ="Text" placeholder="Search" value ="" name ="nametosearch" id="faq_search_input" autocomplete="off">
	<br>
	<br>
	<br>
	<div id="searchresultdata" class="faq-articles"> </div>-->
	<div id="OLtable" style="width: 750px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {
			
		    //Prepare jTable
			$('#OLtable').jtable({
				
				title: 'Official Lodgers Listing',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'lodger.lname ASC',
				actions: {
					listAction: 'ol.php?action=list',
				//	updateAction: 'ol.php?action=update',
				//	deleteAction: 'ol.php?action=delete',
				//	viewAction: 'viewlodgerprofile.php'
				},
				fields: {
					ssn: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					lname: {
						title: 'Last Name',
						width: '20%',
						create: false,
						edit: false
					},
					fname: {
						title: 'First Name',
						width: '20%',
						create: false,
						edit: false
					
					},
					mname: {
						title: 'Middle Name',
						width: '20%',
						create: false,
						edit: false
					},
					room_code: {
						title: 'Room',
						width: '20%'
					},
					appliancerate: {
						title: 'Appliance Rate',
						width: '25%'
					},
					monthlybal: {
						title: 'Room Rate',
						width: '25%'
					},
					total: {
						title: 'Total',
						width: '50%'
					},
					fullpayment: {
					
						title: '',
						width: '23%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="Full Payment" href="recordpayment.php?type=full&ssn=' + data.record.ssn + '" ><img src="./img/icons/bhms_full_payment.png" alt="Full Payment"></img></a>'
						}
						
						
					},
					partpayment: {
					
						title: '',
						width: '23%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="Partial Payment" href="addpayment.php?ssn=' + data.record.ssn + '" ><img src="./img/icons/bhms_partial_payment.png" alt="Partial Payment"></img></a>'
						}
						
						
					}
				}
			});

			//Load person list from server
			$('#OLtable').jtable('load');

			
		});

	</script>
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
	<br>
	<br>
	<br>

<?php
// footer
require_once('template/footer.php');
?>

