<?php


include_once ('database_connection.php');

if(isset($_GET['keyword'])){
    $keyword = 	trim($_GET['keyword']) ;
$keyword = mysqli_real_escape_string($dbc, $keyword);

$query = "SELECT lodger.ssn, lodger.lname, lodger.fname, lodger.mname, lodger.gender from lodger where lodger.ssn not in (SELECT lodger.ssn FROM lodger, official WHERE lodger.ssn = official.lodger_ssn UNION (SELECT lodger.ssn FROM lodger, reservation WHERE lodger.ssn = reservation.lodger_ssn)) ORDER BY lodger.lname ASC";

//echo $query;
$result = mysqli_query($dbc,$query);
if($result){
	
    if(mysqli_affected_rows($dbc)!=0){
	echo '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">';
	echo '<tr bgcolor="#66cc44"><th>Name</th><th>Gender</th><th>Options</th></tr>';
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			echo '<tr><td>'.$row['lname'].', '.$row['fname'].'</td><td>'.$row['gender'].'</td><td>' . '<nobr>';
			echo '<a href="' . 'selectaroom.php?ref=makeofficial&ssn=' . $row['ssn'] . '"\>' . 'Make Official' . '</a>';
			echo ' | ';
			echo '<a href="' . 'viewlodgerprofile.php?ssn=' . $row['ssn'] . '&type=unofficial"\>' . 'View Personal Info' . '</a></nobr></td></tr>';
		 }
	echo '</table>';
    }else {
       // echo 'No Results for :"'.$_GET['keyword'].'"';
	   echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src=' . '"img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Unofficial lodger with last name ' . $_GET['keyword'] . ' was not found.';
			echo '</span>';
    }
  
}
}else {
    echo 'Parameter Missing';
}




?>