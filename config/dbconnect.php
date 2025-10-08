<?php
$servername="localhost";
$username="root";
$password="";
$database="amebor";
$con=new mysqli("$servername","$username","$password","$database");
$con->set_charset("utf8mb4");
if ($con->connect_error) {
    die("connection to database failed".$con->connect_error);
}

?>