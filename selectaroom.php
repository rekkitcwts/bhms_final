<?php
$functionality = $_GET['ref'];

if(($functionality != "addlodger") && ($functionality != "makeofficial") && ($functionality != "editrooms"))
{
$page_title = "Access Denied";
}
else
{
	$page_title = "Select a room";
}
	require_once("template/header.php");
	require_once("template/navigation.php");
	include_once("backend/database_connection.php");
	//include_once("backend/jtable.php");
	$roomQuery = "SELECT * from room";
// this determines what functionalities should the last column echo

if(($functionality != "addlodger") && ($functionality != "makeofficial") && ($functionality != "editrooms"))
{
	echo 'You don\'t have permission to access this page.';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
}
else
{
  ?>

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
					listAction: 'selroombackend.php?action=list',
				//	createAction: 'roombackend.php?action=create',
				//	updateAction: 'roombackend.php?action=update',
				//	deleteAction: 'roombackend.php?action=delete'
				},
				fields: {
					roomcode: {
						key: true,
						title: 'Room Number',
						width: '20%',
						create: false,
						edit: false,
						list: true
					}
				}
			});

			//Load person list from server
			$('#RLtable').jtable('load');

			
		});

	</script>
<br>
<?php
}
	require_once("template/footer.php");
?>