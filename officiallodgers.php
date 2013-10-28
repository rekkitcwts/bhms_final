<?php
$page_title = "Official Lodgers Listing";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/active-ol.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/livesearch/official.js"></script>

<!--Criteria: <select name="searchtype" id="searchtype">
	<option value="Last">Last Name</option>
	<option value="First">First Name</option>
	</select> 
	<br>
	Search:<INPUT type ="Text" placeholder="Search" value ="" name ="nametosearch" id="faq_search_input" autocomplete="off">
	<br>
	<br>
	<br>
	<div id="searchresultdata" class="faq-articles"> </div> -->
	<form>
        Name: <input type="text" name="name" id="name" />
        Search Criteria: 
        <select id="criteria" name="criteria">
            <option selected="selected" value="lname">Last Name</option>
            <option value="fname">First Name</option>
            <option value="room_code">Room</option>
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
					updateAction: 'ol.php?action=update',
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
					methodsadd: {
					
						title: '',
						width: '23%',
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							return '<a title="View Personal Profile" href="viewlodgerprofile.php?type=official&ssn=' + data.record.ssn + '" ><img src="./img/forms/Search-icon.png" alt="View Profile"></img></a>'
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
                lname: $('#name').val(),
                criteria: $('#criteria').val()
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

