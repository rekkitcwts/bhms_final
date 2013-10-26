<?php
$page_title = "Add a new room";
require_once('template/header.php');
require_once('template/navmenu.php');
require_once('template/content-top.php');
?>
<script type="text/javascript" src="./scripts/forms/formvalidation.js">
</script>
<link href="./styles/forms/formvalidation.css" rel="stylesheet" type="text/css" />
<form action="createroom.php" method="post" accept-charset="utf-8">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<tr><td>Room Code</td><td>
<div class="field">
<input type="text" class="required" name="roomcode" value="">
</div>
</td></tr>
<tr><td>Room Type</td><td>
<select name="roomtype">
      <option value="Female">Female</option>
	  <option value="Male">Male</option>
</select></td></tr>
<tr><td>Rate per head</td><td>
<div class="field">
<input type="text" class="required" name="roomrate" value="">
</div></td></tr>
<tr><td>Total Bedspaces</td><td>
<select name="remain_bedspace">
      <option value="1">1</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="4">4</option>
	  <option value="5">5</option>
	  <option value="6">6</option>
	  <option value="7">7</option>
	  <option value="8">8</option>
</select>
</td></tr>
<tr><td>Room has CR?</td><td>
<select name="isroomwithCR">
      <option value="1">Yes</option>
	  <option value="0">No</option>
</select></td></tr>
</tbody>
</table>
<div class='actions'>
<input type="submit" class="send" disabled="disabled" value="Add Room">
</div>
</center>
</form>
<?php
// footer
require_once('template/footer.php');
?>
