<?php
$page_title = "Reservation List";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/livesearch/reservation.js"></script>
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
		<div id="RLtable" style="width: 800px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {
			
		    //Prepare jTable
			$('#RLtable').jtable({
				
				title: 'Reserved Lodgers Listing',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'lodger.lname ASC',
				actions: {
					listAction: 'rl.php?action=list',
					updateAction: 'rl.php?action=update',
					deleteAction: 'rl.php?action=delete'
				},
				fields: {
					res_id: {
						key: true,
						edit: false,
						create: false,
						list: false
					},
					ssn: {
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
					gender: {
						title: 'Gender',
						width: '20%',
						create: false,
						edit: false
					},
					roomcode: {
						title: 'Reserved Room',
						width: '20%',
						create: false,
						edit: false
					},
					resDate: {
						title: 'Date of Reservation',
						width: '20%',
						create: false,
						edit: false
					},
					resDeadline: {
						title: 'Reservation Deadline',
						width: '20%',
						edit: true,
						create: false
					},
					makeofficial: {
					
						title: '',
						width: '10%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="Confirm Reservation." href="confirmres.php?ssn=' + data.record.ssn + '&rb_id=' + data.record.rb_id + '" ><img src="./img/icons/bhms_confirm_res.png" width="16" height="16"  alt="Confirm Reservation"></img></a>'
						}
					},
					viewprofile: {
					
						title: '',
						width: '10%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="View Personal Profile" href="viewlodgerprofile.php?type=reserved&ssn=' + data.record.ssn + '" ><img src="./img/forms/Search-icon.png" alt="View Profile"></img></a>'
						}
						
						
					}
				}
			});

			//Load person list from server
			$('#RLtable').jtable('load');

			
		});

	</script>
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
