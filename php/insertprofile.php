<?php

session_start();

include_once "../config/dbconnect.php";
if ($_SESSION["activeLogin"] == "activehere") {
    $currentId = $_SESSION["activeId"];

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["profile"])) {
        $uploadpix = $_FILES["profile"]["name"];
        $myName = $currentId . "_" . time() . "_" . time() . $uploadpix;
        $destination = "../users_img/" . $myName;
        $tmp = $_FILES["profile"]["tmp_name"];
        $type = strtolower(pathinfo($uploadpix, PATHINFO_EXTENSION));
        if ($type != "jpg" && $type != "jpeg" && $type != "png") {
            echo "invalid file type eg.'jpg','jpeg','png'";
        } else {
            if (move_uploaded_file($tmp, $destination)) {

                $sql2 = "SELECT profile_img FROM chat_users WHERE id='$currentId' LIMIT 1";
                $result2 = $con->query($sql2);


                $rows = $result2->fetch_assoc();
                $pathimage = $rows['profile_img'];

                $old_img = "../users_img/" . $pathimage;
                if (file_exists($old_img)) {
                    unlink("../users_img/" . $pathimage);
                }


                $sql = "UPDATE chat_users SET profile_img='$myName' WHERE id='$currentId' LIMIT 1";
                $result = $con->query($sql);
                if ($result) {

                    echo "Profile Image Updated successfully";
                } else {
                    echo "failed to update";
                }
            }
        }

        //end of else






    } else {

        header("location:login.php");
        exit();
    }
} else {

    header("location:login.php");
    exit();
}
$con->close();
