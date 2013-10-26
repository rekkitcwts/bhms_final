<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  if (isset($_SESSION['username'])) {
?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Boarding House Management System: <?php echo $page_title; ?></title>

<script type="text/javascript" src="./scripts/jquery-1.9.1.js"></script>
<script type="text/javascript" src="./scripts/jquery-ui.js"></script>
<link rel="stylesheet" href="./styles/styletest.css" type="text/css" media="screen" />
<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" />
<!-- Include one of jTable styles. -->
<link href="./scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
 
<!-- Include jTable script file. -->
<script src="./scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
<!-- Filipino localization script file. -->
<!--<script src="./scripts/jtable/localization/jquery.jtable.tl.js" type="text/javascript"></script>-->

<link rel="stylesheet" href="./styles/tf2fonts.css" type="text/css" />
</head>
<?php
  }
  else {
    header( 'Location: login.php' ) ;
  }

?>