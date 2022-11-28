<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "crud";
$port = "3306";

$con = mysqli_connect($server, $user, $pass, $db, $port);
if ($con) {
    // echo "Connected Successfully ^_^";
} else {
    die("Failed to connect!!!");
}
