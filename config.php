<?php
define('DBSERVER', 'localhost'); //DB server
define('DBUSERNAME', 'root'); //DB username
define('DBPASSWORD', ''); //DB password
define('DBNAME', 'ipproject'); //DB name

/* connect to MySQL DB */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME); 

//check db connection
if ($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>