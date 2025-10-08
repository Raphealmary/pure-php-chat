<?php
session_start();
require "../config/dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
$new=$_POST["newPassword"];
$confirm=$_POST["confirmPassword"];

if(empty($new) || empty($confirm)){
    echo "values cant be empty";
}
elseif($new != $confirm){
    echo "password not same";
}
else{
if(isset($_SESSION["emailV"])){

$myEmail=$_SESSION["emailV"];
$passwordenc=md5($confirm);
$sqlUpdate="UPDATE chat_users SET forgot_status=0,forgot_token='',time_expires='',password='$passwordenc' WHERE email='$myEmail'";
      $stmtUpdate=$con->prepare($sqlUpdate);
$stmtUpdate->execute();
echo "success";
}
else{
    header("location:index.php");
}

   
}





}
else{
    header("location:../php/login.php");
}
