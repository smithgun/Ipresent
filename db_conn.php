<?php

$sname= "localhost";//used to store the server name or IP address of the MySQL server you want to connect to.
$unmae= "root"; // used to store the MySQL username you want to use to connect to the MySQL server.
$password = "";//used to store the password for the MySQL user you want to use to connect to the MySQL server.

$db_name = "db_usim";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

/* The function takes four parameters: 
$sname (the server name or IP address),
$unmae (the username),
$password (the password), 
$db_name (the name of the database).
The function returns a connection object that can be used to interact with the database.*/

if (!$conn) {
	echo "Connection failed!";
}