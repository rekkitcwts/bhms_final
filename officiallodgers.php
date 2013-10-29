<?php
$page_title = "Official Lodgers Listing";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/active-ol.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/livesearch/official.js"></script>
	<form>
        Name: <input type="text" name="name" id="name" />
        Search Criteria: 
        <select id="criteria" name="criteria">
            <option selected="selected" value="lodger.lname">Last Name</option>
            <option value="lodger.fname">First Name</option>
            <option value="lodger.room_code">Room</option>
        </select>
        <button type="submit" id="LoadRecordsButton">Load records</button>
    </form>
	<br>
	<center>
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
					deleteAction: 'ol.php?action=delete'
				},
				fields: {
					official_rec_id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					ssn: {
						list: false,
						create: false,
						edit: false
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
					appliancerate: {
						title: 'Appliance Rate',
						width: '25%'
					},
					roomcode: {
						title: 'Room',
						width: '20%'
					},
					monthlyrate: {
						title: 'Room Rate',
						width: '25%'
					},
					total: {
						title: 'Total',
						width: '50%'
					},
					viewprofile: {
						title: 'View Profile',
						width: '23%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="View Personal Profile" href="viewlodgerprofile.php?type=official&ssn=' + data.record.ssn + '" ><img src="./img/forms/Search-icon.png" alt="View Profile"></img></a>'
						}
						
						
					},
					changeroom: {
						title: 'Change Room',
						width: '20%',
						edit: false,
						sorting: false,
						display: function(data)
						{
							return '<a title="Change this lodger\'s room" href="changeroom.php?orid=' + data.record.official_rec_id + '"><img src="./img/icons/bhms_transfer_room.png" alt="Change this lodger\'s room" width="16" height="16" /></a>'
						}
					},
					changeappliancerate: {
						title: 'Adjust app. rate',
						width: '15%',
						edit: false,
						sorting: false,
						display: function(data)
						{
							return '<a title="Change this lodger\'s appliance rate" href="changeapprate.php?orid=' + data.record.official_rec_id + '"><img src="./img/icons/bhms_update_appliances.png" alt="Change this lodger\'s room" width="16" height="16" /></a>'
						}
					}
				}
			});

			//Load person list from server
			//$('#OLtable').jtable('load');
			 //Re-load records when user click 'load records' button.
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#OLtable').jtable('load', {
                name: $('#name').val(),
                criteria: $('#criteria option:selected').val()
            });
        });
 
        //Load all records when page is first shown
        $('#LoadRecordsButton').click();

			
		});

	</script>
	</center>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
<?php
// footer
require_once('template/footer.php');
?>

