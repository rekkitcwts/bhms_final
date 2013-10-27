<?php
$page_title = "List of rooms";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');

include_once ('database_connection.php');
$roomQuery = "SELECT * from room";
?>
<center>
		<div id="RLtable" style="width: 850px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {
			
		    //Prepare jTable
			$('#RLtable').jtable({
				
				title: 'Rooms Listing',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'roomcode ASC',
				actions: {
					listAction: 'roombackend.php?action=list',
				//	createAction: 'roombackend.php?action=create',
				//	updateAction: 'roombackend.php?action=update',
				//	deleteAction: 'roombackend.php?action=delete'
				},
				fields: {
					rb_id: {
						key: true,
						width: '20%',
						list: false
					},
					roomcode: {
						title: 'Room Number',
						width: '20%',
						create: true,
						edit: false,
						list: true
					},
					roomdesc: {
						title: 'Description',
						width: '20%',
						create: false,
						edit: true
					},
					roomtype: {
						title: 'Type',
						width: '20%',
						options: { 'M': 'Male', 'F': 'Female'},
						create: true,
						edit: true
					
					},
					roomrate: {
						title: 'Monthly Rate',
						width: '20%',
						create: true,
						edit: true
					},
					freespace: {
						title: 'Free Bedspaces',
						width: '20%',
						options: { '0': '0', '1': '1', '2':'2', '3':'3', '4':'4'},
						create: false,
						edit: false
					},
					remain_bedspace: {
						title: 'Max Bedspaces',
						width: '20%',
						create: true,
						edit: true
					},
					isroomwithCR: {
						title: 'Room has CR?',
						width: '30%',
						options: { '0': 'No', '1': 'Yes'},
						create: true,
						edit: true
					},
					
					viewroom: {
					
						title: '',
						width: '10%',
						create: false,
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="View Room Info" href="viewroom.php?rb_id=' + data.record.rb_id + '" ><img src="./img/forms/Search-icon.png" alt="View Room Info" /></a>'
						}
						
						
					}
				}
			});

			//Load person list from server
			$('#RLtable').jtable('load');

			
		});

	</script>
<br>
</center>
<?php
// footer
require_once('template/footer.php');
?>
