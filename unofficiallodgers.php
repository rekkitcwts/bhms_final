<?php
$page_title = "Unofficial Lodgers Listing";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/active-ul.php');
require_once('template/content-top.php');

?>
<script type="text/javascript" src="./scripts/livesearch/unofficial.js"></script>
<br>
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
				
				title: 'Unofficial Lodgers Listing',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'lodger.lname ASC',
				actions: {
					listAction: 'ul.php?action=list',
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
					gender: {
						title: 'Gender',
						width: '20%',
						create: false,
						edit: false
					},
					makeofficial: {
					
						title: 'Make Official',
						width: '10%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="Make this lodger an official lodger." href="selectaroom.php?ref=makeofficial&ssn=' + data.record.ssn + '" ><img src="./img/icons/bhms_make_official.png" width="16" height="16" alt="Make official"></img></a>'
						}
					},
					viewprofile: {
					
						title: 'View Profile',
						width: '10%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="View Personal Profile" href="viewlodgerprofile.php?type=unofficial&ssn=' + data.record.ssn + '" ><img src="./img/forms/Search-icon.png" alt="View Profile"></img></a>'
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
<?php
// footer
require_once('template/footer.php');
?>

