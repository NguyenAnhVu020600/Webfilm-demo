<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="film";
$conn = new mysqli($hostname,$username, $password,$dbname);  
if($conn->connect_error) {
    die("Database connection failed"). $conn->connect_error;
}
?>