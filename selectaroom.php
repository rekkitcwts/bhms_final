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
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');

include_once ('database_connection.php');
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
/*
	$result = mysqli_query($dbc,$roomQuery);
	if($result)
	{
		if(mysqli_affected_rows($dbc)!=0){
		echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="900">';
		echo '<tr bgcolor="#66cc44"><th>Room Number</th><th>Room Description</th><th>Room Type</th><th>Rate/head</th><th>Maximum Bedspaces</th><th>Free Bedspaces</th><th>Status</th><th>Has CR</th><th>Options</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			// These are for the reserved customers and official lodgers.
			$room = $row['roomcode'];
			$countOLquery = "SELECT count(lodger_ssn) AS occnum FROM official WHERE room_code = '$room'";
			$OLresult = mysqli_query($dbc,$countOLquery);
			$OLrow = mysqli_fetch_array($OLresult,MYSQLI_ASSOC);
			$numOL = $OLrow['occnum'];
			$countRLquery = "SELECT count(lodger_ssn) AS resnum FROM reservation WHERE roomcode = '$room'";
			$RLresult = mysqli_query($dbc,$countRLquery);
			$RLrow = mysqli_fetch_array($RLresult,MYSQLI_ASSOC);
			$numRL = $RLrow['resnum'];
			$freespace = ($row['remain_bedspace'] - $numOL) - $numRL;
			
			echo '<tr><td>'.$row['roomcode'].'</td><td>' . $row['roomdesc'] .'</td><td>' . $row['roomtype'] .'</td><td>' . $row['roomrate'] .'</td><td>' . $row['remain_bedspace'] .'</td><td>' . $freespace .  '</td>';
			if ($freespace == 0)
				echo '<td>Full</td>';
			else
				echo '<td>Vacant</td>';
				
			if ($row['isroomwithCR'] == 0)
				echo '<td>No</td>';
			else
				echo '<td>Yes</td>';
			
			if ($functionality == "addlodger")
			{
				if ($freespace > 0) 
				{
					echo '<td><a href="recordlodger.php?ssn='. $_GET['ssn'] . '&roomcode=' . $row['roomcode'] . '&roomrate=' . $row['roomrate'] . '"\>' . 'Add</a>';
					echo ' | ';
					echo ' <a href="reservelodger.php?ssn='. $_GET['ssn']  . '&roomcode=' . $row['roomcode'] . '"\>' . 'Reserve' . '</a></td></tr>';
				}
				else
				echo '<td>No free space</td></tr>';
			}
			
			if ($functionality == "makeofficial")
			{
				if ($freespace > 0) 
				{
					echo '<td><a href="recordlodger.php?ssn='. $_GET['ssn'] . '&roomcode=' . $row['roomcode'] . '&roomrate=' . $row['roomrate'] . '"\>' . 'Add</a>';
					echo '</td></tr>';
				}
				else
				echo '<td>No free space</td></tr>';
			}

		 }
		echo '</table>';
		
    }
	else 
	{
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  */
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
					listAction: 'roombackend.php?action=list',
				//	createAction: 'roombackend.php?action=create',
				//	updateAction: 'roombackend.php?action=update',
				//	deleteAction: 'roombackend.php?action=delete'
				},
				fields: {
					roomcode: {
						key: true,
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
						options: { 'M': 'M', 'F': 'F'},
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
					<?php
					if ($functionality != "makeofficial")
					{
					?>
					reserve: {
					
						title: 'Reserve',
						width: '10%',
						create: false,
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							if (data.record.freespace == 0)
							{
								return '<img src="./img/icons/bhms_full.png" width="16" height="16" alt="No available space"></img>'
							}
							else
							{
							//<a href="reservelodger.php?ssn='. $_GET['ssn']  . '&roomcode=' . $row['roomcode'] . '"\>' . 'Reserve' . '</a>
							return '<a href="reservelodger.php?ssn=' + <?php echo $_GET['ssn'] ?> + '&roomcode=' + data.record.roomcode + '"\><img src="./img/icons/bhms_reserve_icon.png" width="16" height="16" alt="Reserve Lodger"></img></a>'
							}
						}
						
						
					},
					<?php
					}
					?>
					addtoroom: {
					
						title: 'Add',
						width: '10%',
						create: false,
						edit: false,
						sorting: false, //This column is not sortable!
						display: function(data)
						{
							//return '<a title="View Room Info" href="viewroom.php?roomcode=' + data.record.roomcode + '" ><img src="./img/forms/Search-icon.png" alt="View Room Info"></img></a>'
							if (data.record.freespace == 0)
							{
								return '<img src="./img/icons/bhms_full.png" width="16" height="16" alt="No available space"></img>'
							}
							else
							{
								return '<a href="recordlodger.php?ssn=' + <?php echo $_GET['ssn'] ?> + '&roomcode=' + data.record.roomcode + '&roomrate=' + data.record.roomrate + '"\><img src="./img/icons/bhms_add_lodger.png" width="16" height="16" alt="Add Lodgers"></img></a>'
							}
						}
						
						
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




// footer
require_once('template/footer.php');
?>
