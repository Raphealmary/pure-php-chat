<?php 
session_start();

if ($_SESSION["activeLogin"]=="activehere") {
    include_once("../config/dbconnect.php");
	 if (isset($_GET["logMeOut"])) {
        $logMeOut = $_GET["logMeOut"];
        // $logoutPhone=$_SESSION["activePhone"];
        // $logoutUsername=$_SESSION["activeUsername"];
        $sqlUpdate="UPDATE chat_users SET status='offline' WHERE email=? ";
        $stmt = $con->prepare($sqlUpdate);
        $stmt->bind_param("s",$logMeOut);
        $result=$stmt->execute();
        if ($result) {
            session_unset();
            session_destroy();
            header("location:login.php");
            exit();
        }
     }
     else{
        header("location:login.php");
        exit();
     }
    
   


    
   
$con->close();
} else {
	
	header("location:login.php");
	exit();
}	
?>






?>