<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'user_sql');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'test');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
