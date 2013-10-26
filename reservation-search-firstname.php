<?php


include_once ('database_connection.php');

if(isset($_GET['keyword'])){
    $keyword = 	trim($_GET['keyword']) ;
$keyword = mysqli_real_escape_string($dbc, $keyword);


$query = "SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname, reservation.roomcode, reservation.resdate, reservation.resdeadline FROM lodger, reservation WHERE lodger.ssn = reservation.lodger_ssn AND lodger.fname LIKE '%$keyword%' ORDER BY lodger.lname ASC";

//echo $query;
$result = mysqli_query($dbc,$query);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="900">';
	echo '<tr bgcolor="#66cc44"><th>Name</th><th>Room</th><th>Reservation Date</th><th>Deadline</th><th>Options</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			echo '<tr><td>'.$row['lname'].', '.$row['fname']. ' '.$row['mname'].'</td><td>' . $row['roomcode'] .'</td><td>' . $row['resdate'] .'</td><td>' . $row['resdeadline'] .'</td>' . '</td><td>';
			echo '<a href="confirmres.php?ssn=' . $row['ssn'] . '&roomcode=' . $row['roomcode'] . '"\>' . 'Confirm' . '</a>';
			echo ' <br> ';
			echo '<a href="deleteres.php?ssn=' . $row['ssn'] . '" onclick="return confirm(\'Delete this reservation? This cannot be undone.\')"\>' . 'Delete' . '</a></td></tr>';
		 }
	echo '</table>';
    }else {
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"../../img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  
}
}else {
    echo 'Parameter Missing';
}




?>