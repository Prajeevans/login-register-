<?php

$hostname = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "medical-shop";
$conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $database);

if (!$conn){
    die("Something went wrong");
}
?>
