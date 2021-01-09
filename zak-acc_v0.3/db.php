<?php
$hostname="localhost";
$dbname="weight_calc";
$user="root";
$pass="";
$conn=mysqli_connect("$hostname","$user","$pass","$dbname");
if (mysqli_connect_error()){
    echo "connection failed".mysqli_connect_error();
}
$conn->set_charset('UTF8');

?>