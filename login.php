<?php
  require_once('database_connection.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['id'])) {
    if (isset($_POST['submit'])) {
      

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT id, username FROM staff WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Boarding House Management System - Log In</title>
 <!--<link rel="stylesheet" type="text/css" href="style.css" />-->
 <link rel="stylesheet" href="./styles/login_form/css/styles.css" />
</head>
<body>
  <center><h3>Boarding House Management System - Log In</h3></center>
<?php
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>
<div id="formContainer">
  <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<!--    <fieldset>
      <legend>Log In</legend>
      <label for="username">Username:</label>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" autocomplete="off" /><br />
      <label for="password">Password:</label>
      <input type="password" name="password" />
    </fieldset>-->
    <input type="text" autocomplete="off" placeholder="Username" name="username" id="loginEmail" value="<?php if (!empty($user_username)) echo $user_username; ?>" />
				<input type="password" placeholder="Password" name="password" id="loginPass" value="" />
			<!--	<input type="submit" name="submit" value="Login" /> -->
    <input type="submit" value="Log In" name="submit" />
  </form>
 </div>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }
?>

</body>
</html>
