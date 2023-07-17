<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "Sequirei11";
$database = "Votos";
$con =mysqli_connect ($hostname, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    }

?>