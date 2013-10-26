<?php
	$page_title = "Official Lodgers List";
	require_once("template/header.php");
	require_once("template/navigation.php");
	include_once("backend/database_connection.php");
?>
<br />
<br />
<br />
<br />
<div id="RLtable" style="width: 850px;"></div>
<script type="text/javascript">

		$(document).ready(function () {
			
		    //Prepare jTable
			$('#RLtable').jtable({
				
				title: 'Rooms Listing',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'lname ASC',
				actions: {
					listAction: './backend/olbackend.php?action=list'
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
						edit: true
					},
					fname: {
						title: 'First Name',
						width: '20%',
						create: false,
						edit: true
					},
					mname: {
						title: 'Middle Name',
						width: '20%',
						create: false,
						edit: true
					},
					gender: {
						title: 'Gender',
						width: '20%',
						options: { 'M': 'Male', 'F': 'Female'},
						create: false,
						edit: true
					
					}
				}
			});

			//Load person list from server
			$('#RLtable').jtable('load');

			
		});

	</script>
<br>
<?php
	require_once("template/footer.php");
?>