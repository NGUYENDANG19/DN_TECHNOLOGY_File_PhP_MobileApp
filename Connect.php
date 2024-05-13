<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "dataonline";

$conn = mysqli_connect($host, $user, $pass, $database); // Fix: Change 'usser' to $user
mysqli_set_charset($conn, "utf8");

if($conn) {
    //code..

}
?>
