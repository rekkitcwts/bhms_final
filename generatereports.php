<?php
$page_title = "Generate Reports";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>
<div class="filtering">
    <form>
<select name="year" >
    <option value="0000">Year</option>
<?php
for($i=date('Y'); $i>2012; $i--) {
    echo '<option value="'.$i.'"'.'>'.$i.'</option>'."\n";
} 
?>

</select>
<select name="month">
<option value="0">Month</option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<button type="submit" id="LoadRecordsButton">Load records</button>
</form>
<div id="PeopleTableContainer" style="width: 850px;"></div>
<script type="text/javascript">
 	$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Payment Records',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'payment.paymentdate ASC',
				actions: {
					listAction: 'payment.php?action=list'
				//	createAction: 'offlodger-list-payment.php?action=create',
				//	updateAction: 'offlodger-list-payment.php?action=update',
				//	deleteAction: 'offlodger-list-payment.php?action=delete'
				},
				
				fields: {
					paymentid: {
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
					paymenttype: {
						title: 'Type',
						width: '20%',
						create: false,
						edit: false
					},
					paymentdate: {
						title: 'Date',
						width: '20%',
						create: false,
						edit: false
					},
					totalrate: {
						title: 'Total Rate',
						width: '20%',
						create: false,
						edit: false
					},
					paymentamt: {
						title: 'Amount',
						width: '20%',
						create: false	
					},
					balance: {
						title: 'Balance',
						width: '20%',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			//$('#PeopleTableContainer').jtable('load');
			
			//Re-load records when user click 'load records' button.
			// Backup
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#PeopleTableContainer').jtable('load', {
				year: $('#year selected').val(),
                month: $('#month selected').val()
            });
        }); 
		
	/*	$('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $.post("payment.php",
			{
				year: $('#year').val(),
                month: $('#reportMonth').val()
			},
			function(){
				// do nothing
			});
        }); */
 
        //Load all records when page is first shown
       // $('#LoadRecordsButton').click();

		});

</script>
<br>
<br>
<?php
// footer
require_once('template/footer.php');
?>
