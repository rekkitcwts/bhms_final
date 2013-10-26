<?php


include_once ('database_connection.php');

if(isset($_GET['keyword'])){
    $keyword = 	trim($_GET['keyword']) ;
$keyword = mysqli_real_escape_string($dbc, $keyword);


$query = "SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname,official.room_code, official.appliancerate, official.monthlybal, official.appliancerate + official.monthlybal AS total FROM lodger, official WHERE lodger.ssn = official.lodger_ssn AND lodger.lname LIKE '%$keyword%' ORDER BY lodger.lname ASC ";

//echo $query;
$result = mysqli_query($dbc,$query);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow" width="900">';
	echo '<tr bgcolor="#66cc44"><th>Name</th><th>Room</th><th>Appliance Rate</th><th>Monthly Room Rate</th><th>Total Monthly Rate</th><th>Options</th></tr>';
         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			echo '<tr><td>'.$row['lname'].', '.$row['fname']. ' '.$row['mname'].'</td><td>' . $row['room_code'] .'</td><td>' . $row['appliancerate'] .'</td><td>' . $row['monthlybal'] .'</td><td>' . $row['total'] .'</td><td>';
			echo '<a href="' . './' . 'recordpayment.php?type=full&ssn=' . $row['ssn'] . '"\>' . 'Full Payment' . '</a>';
			echo '<br>';
			echo '<a href="' . './' . 'addpayment.php?ssn=' . $row['ssn'] . '"\>' . 'Partial Payment' . '</a></td></tr>';
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