<?php
$page_title = "Edit room details";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
include_once ('database_connection.php');
$roomcode = $_GET['roomcode'];

$query = "SELECT * FROM room WHERE roomcode = '$roomcode'";
$result = mysqli_query($dbc,$query);
if($result)
{
	if(mysqli_affected_rows($dbc)!=0)
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$roomtype = $row['roomtype'];
			$roomrate = $row['roomrate'];
			$remain_bedspace = $row['remain_bedspace'];
			$isroomwithCR = $row['isroomwithCR'];
		}
	}
	else
	{
		echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"./img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'No data!';
			echo '</span>';
	}
}
else
{
}
?>
<form action="updateroom.php" method="post" accept-charset="utf-8">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<tr><td>Room Code</td><td><input type="text" name="roomcode" value="<?php echo $_GET['roomcode']; ?>"></td></tr>
<tr><td>Room Type</td><td>
<select name="roomtype">
      <option <?php if($roomtype == "Female"){echo " selected=\"Female\"";} ?> value="Female">Female</option>
	  <option <?php if($roomtype == "Male"){echo " selected=\"Male\"";} ?> value="Male">Male</option>
</select></td></tr>
<tr><td>Rate per head</td><td><input type="text" name="roomrate" value="<?php echo $roomrate; ?>"></td></tr>
<tr><td>Total Bedspaces</td><td>
<select name="remain_bedspace">
      <option <?php if($remain_bedspace == "1"){echo " selected=\"1\"";} ?> value="1">1</option>
	  <option <?php if($remain_bedspace == "2"){echo " selected=\"2\"";} ?> value="2">2</option>
	  <option <?php if($remain_bedspace == "3"){echo " selected=\"3\"";} ?> value="3">3</option>
	  <option <?php if($remain_bedspace == "4"){echo " selected=\"4\"";} ?> value="4">4</option>
	  <option <?php if($remain_bedspace == "5"){echo " selected=\"5\"";} ?> value="5">5</option>
	  <option <?php if($remain_bedspace == "6"){echo " selected=\"6\"";} ?> value="6">6</option>
	  <option <?php if($remain_bedspace == "7"){echo " selected=\"7\"";} ?> value="7">7</option>
	  <option <?php if($remain_bedspace == "8"){echo " selected=\"8\"";} ?> value="8">8</option>
</select>
</td></tr>
<tr><td>Room has CR?</td><td>
<select name="isroomwithCR">
      <option <?php if($isroomwithCR == "1"){echo " selected=\"1\"";} ?> value="1">Yes</option>
	  <option <?php if($isroomwithCR == "0"){echo " selected=\"0\"";} ?> value="0">No</option>
</select></td></tr>
</tbody>
</table>

<input type="submit" name="" value="Update Room">
</center>
</form>
<?php
// footer
require_once('template/footer.php');
?>
