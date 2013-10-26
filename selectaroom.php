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

$query = "SELECT * FROM room";

//echo $query;
$result = mysqli_query($dbc,$query);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="920">';
	echo '<tr bgcolor="#0000FF"><th>Room</th><th>Description</th><th>Room Type</th><th>Room has CR?</th><th>Maximum Bedspaces</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			 $hasCR = "";
			 if ($row['hasCR'] == 0) $hasCR = "No";
			 else $hasCR = "Yes";
			echo '<tr><td>'.$row['roomcode'].'</td><td>'.$row['roomdesc'].'</td><td>'.$row['roomtype'].'</td><td>'.$hasCR.'</td><td>'.$row['maxspace'].'</td></tr>';
		 }
	echo '</table>';
    }else {
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'No data.';
			echo '</span>';
    }
  
}
}
	require_once("template/footer.php");
