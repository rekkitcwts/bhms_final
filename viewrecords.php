<?php
$page_title = "View Payment Records";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>

<div id="PeopleTableContainer" style="width: 800px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Payment Records',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'lodger_payment.paymentDate ASC',
				actions: {
					listAction: 'offlodger-list-payment.php?action=list',
				//	createAction: 'offlodger-list-payment.php?action=create',
					updateAction: 'offlodger-list-payment.php?action=update',
					deleteAction: 'offlodger-list-payment.php?action=delete'
				},
				fields: {
					lp_id: {
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
					paymentDate: {
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
					amountPaid: {
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
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
    <br />
    <br />
    <br />
<?php
// footer
require_once('template/footer.php');
?>
