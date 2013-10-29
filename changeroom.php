<?php
	$page_title = "Change lodger's room";
	require_once('template/header.php');
	require_once('template/navmenu.php');
	require_once('template/content-top.php');
	include_once('database_connection.php');
	$record_id = $_GET['orid'];
	$query = "SELECT rb_id FROM occupy_room WHERE official_rec_id = '$record_id'";
	$result = mysqli_query($dbc,$query);
	$resarr = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$roombed = $resarr['rb_id'];

	echo '<form action="updateOLroom.php" method="post" accept-charset="utf-8">';
	echo '<table border="0" class="mytable" cellpadding="0" cellspacing="0">';
	echo '<tbody>';
	echo '<tr>';
    echo '<th colspan="3">Select a new room.</th>';
	echo '</tr>';
	echo '<input type="hidden" name="official_rec_id" value="'.$record_id.'" />';
	echo '<tr><td>Room</td>';
	echo '<td>';
	echo '<select name="roombedspace" >';

	$sql = "SELECT * FROM room_bedspace";
	$result = mysqli_query($dbc,$sql);
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		echo '<option'; 
    	if($roombed == $row['rb_id'])
    	{
        	 echo ' selected="'.$row['rb_id'].'"';
    	}
    echo ' value="'.$row['rb_id'].'"'.'>'.$row['roomcode'].'</option>'."\n";
	}

?>
</select>
</tbody>
</table>
<input type="submit" class="send" name="" value="Change this lodger's room">
</form>
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

