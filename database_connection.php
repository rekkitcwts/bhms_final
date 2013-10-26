<?php

/*Define constant to connect to database */
DEFINE('DATABASE_USER', 'bhms');
DEFINE('DATABASE_PASSWORD', 'regularshow');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_NAME', 'bhms');



// Make the connection:
$dbc = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD,
    DATABASE_NAME);

if (!$dbc) {
    trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

?>