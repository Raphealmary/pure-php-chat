<?php
session_start();
include_once "../config/dbconnect.php";
if ($_SESSION["activeLogin"] == "activehere") {
    $currentId = $_SESSION["activeId"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function validate($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }
        $myChatUserId = validate($_POST["ChatUserHidden"]);
        $myMessage = validate($_POST["sample-textarea"]);
        //$worduploads="";
        // if (isset($_FILES["upload"])){
        //     $fileName = $_FILES["upload"]["name"];
        // }

        // Handle file image upload (if file is present)
        if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0) {
            $fileTmpPath = $_FILES["upload"]["tmp_name"];
            $fileName = $_FILES["upload"]["name"];
            $fileSize = $_FILES["upload"]["size"];
            $fileType = $_FILES["upload"]["type"];

            // Validate file type (only image files allowed)
            $allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
            if (in_array($fileType, $allowedTypes)) {
                // Generate a unique file name to avoid overwriting
                $newFileName = "amebor chat".uniqid("img_") . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $uploadPath = "../users_img/" . $newFileName;
                // Move the file to the uploads directory
                if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                    $imageName = $newFileName; // Save the image file name to insert into the database
                } else {
                    echo "Error uploading the image.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
                exit();
            }
        }


        // 
        // Handle file word upload (if file is present)
        if (isset($_FILES["wordupload"]) && $_FILES["wordupload"]["error"] == 0) {
            $uploadpix = $_FILES["wordupload"]["name"];
            $myName = "amebor chat".$currentId . "_" . time() . "_" . time() . $uploadpix;
            $destination = "../users_img/" . $myName;
            $tmp = $_FILES["wordupload"]["tmp_name"];
            $type = strtolower(pathinfo($uploadpix, PATHINFO_EXTENSION));
            if ($type != "docx" && $type != "doc") {
                echo "invalid file type eg.'doc','docx'";
            }
            // else if (empty($imageName) && empty($myMessage)) {
            //     var_dump("cannot be empty");
            // } 
            else {
                if (move_uploaded_file($tmp, $destination)) {
                    $wordupload = $myName;
                    //echo "success";
                } else {
                    echo "Error uploading the word.";
                }
            }

            //end of else

        }

        // ---------------upload pdf files--------------
        if (isset($_FILES["pdfupload"]) && $_FILES["pdfupload"]["error"] == 0) {
            $uploadpixpdf = $_FILES["pdfupload"]["name"];
            $myNamepdf = "amebor chat".$currentId . "_" . time() . "_" . time() . $uploadpixpdf;
            $destinationpdf = "../users_img/" . $myNamepdf;
            $tmppdf = $_FILES["pdfupload"]["tmp_name"];
            $typepdf = strtolower(pathinfo($uploadpixpdf, PATHINFO_EXTENSION));
            if ($typepdf != "pdf") {
                echo "invalid file type eg.'pdf'";
            }
            // else if (empty($imageName) && empty($myMessage)) {
            //     var_dump("cannot be empty");
            // } 
            else {
                if (move_uploaded_file($tmppdf, $destinationpdf)) {
                    $pdfupload = $myNamepdf;
                    //echo "success";
                } else {
                    echo "Error uploading the pdf.";
                }
            }

            //end of else

        }
        // ----------------------snapphoto files----------------
        if (isset($_FILES["snapupload"]) && $_FILES["snapupload"]["error"] == 0) {
            $uploadpixsnap = $_FILES["snapupload"]["name"];
            $myNamesnap = "amebor chat".$currentId . "_" . time() . "_" . time() . $uploadpixsnap;
            $destinationsnap = "../users_img/" . $myNamesnap;
            $tmpsnap = $_FILES["snapupload"]["tmp_name"];
            $typesnap = strtolower(pathinfo($uploadpixsnap, PATHINFO_EXTENSION));
            if ($typesnap != "jpg" && $typesnap != "jpeg" && $typesnap != "png") {
                echo "invalid file type eg.'image file'";
            }
            // else if (empty($imageName) && empty($myMessage)) {
            //     var_dump("cannot be empty");
            // } 
            else {
                if (move_uploaded_file($tmpsnap, $destinationsnap)) {
                    $snapupload = $myNamesnap;
                   // echo "success";
                } else {
                    echo "Error uploading the image.";
                }
            }

            //end of else

        }
        // ----------------------recorder files----------------


        if (isset($_FILES["recordupload"]) && $_FILES["recordupload"]["error"] == 0) {
            $uploadpixrecord = $_FILES["recordupload"]["name"];
            $myNamerecord = "amebor chat".$currentId . "_" . time() . "_" . time() . $uploadpixrecord;
            $destinationrecord = "../users_img/" . $myNamerecord;
            $tmprecord = $_FILES["recordupload"]["tmp_name"];
            $typerecord = strtolower(pathinfo($uploadpixrecord, PATHINFO_EXTENSION));
            if ($typerecord != "mp3" && $typerecord != "wav" && $typerecord != "aac" && $typerecord != "aax" && $typerecord != "flac" && $typerecord != "ogg" && $typerecord != "wma") {
                echo "invalid file type eg.'mp3, wav,aac,....'";
            }
            // else if ($_FILES["recordupload"]["size"] > 6000) {
            //     echo ("file size too large max 6MB");
            // } 
            else {
                if (move_uploaded_file($tmprecord, $destinationrecord)) {
                    $recordupload = $myNamerecord;
                    //echo "success";
                } else {
                    echo "Error uploading the sound.";
                }
            }

            //end of else

        }



















        if (empty($imageName) && empty($myMessage) && empty($wordupload) && empty($pdfupload) && empty($snapupload) && empty($recordupload)) {
            echo("cannot be empty");
        } else {


            $sql = "INSERT INTO chat_messages (sender_id, recepient_id, message,image_name,uploadWord,uploadPdf,uploadCamera,uploadRecorder) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iissssss", $currentId, $myChatUserId, $myMessage, $imageName, $wordupload, $pdfupload, $snapupload, $recordupload);
            $stmt->execute();
            // if ($stmt->execute()) {
            //     echo "Message sent successfully!";
            // } else {
            //     echo "Error: " . $stmt->error;
            // }

            // Close the statement
            $stmt->close();
        }
    } else {
        echo "error occured";
    }
} else {

    header("location:login.php");
    exit();
}
$con->close();
