<?php

$servername = 'localhost';
$username = 'assign';
$password = trim(file_get_contents("/home/kit214/password.txt")); 
$db_name = 'assign';
//connect to mysql
$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die('Connection failed' . $conn->connect_error);
}
echo '';
?>