<?php
session_start();
date_default_timezone_set('Africa/Lagos');

include_once "../config/dbconnect.php";
if ($_SESSION["activeLogin"] == "activehere") {
    $currentId = $_SESSION["activeId"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $recepient_id = $_POST["updateChatData"];

        $sql = "SELECT chat_users.id,
        chat_users.profile_img,
        chat_messages.message,
        chat_messages.image_name,
chat_messages.uploadWord,
chat_messages.uploadPdf,
chat_messages.uploadCamera,
chat_messages.uploadRecorder,

        chat_messages.sender_id,
        DATE_FORMAT(chat_messages.message_time,'%Y-%m-%d %h:%i:%s %p') As formate_time FROM chat_messages JOIN chat_users ON chat_messages.sender_id=chat_users.id
        WHERE chat_messages.sender_id='$currentId' AND chat_messages.recepient_id = '$recepient_id' OR chat_messages.sender_id='$recepient_id' AND chat_messages.recepient_id = '$currentId'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["sender_id"] == $currentId) {
?>

                    <div class="position-relative message1 mt-3 ps-3 pe-3 pt-3 pb-3" style="cursor: pointer;">


                        <div>
                            <?php
                            if ($row["profile_img"] == "profile.png") {

                            ?>


                                <img class="rounded-pill me-2" src="../chat_img/profile.png" width="40" height="40">



                            <?php
                            } else {
                            ?>

                                <img class="rounded-pill me-2" src="../users_img/<?php echo $row["profile_img"]; ?>" width="40" height="40">



                            <?php
                            }
                            ?>



                        </div>



                        <div class="d-flex flex-column justify-content-between align-items-center" style="width: 200px;">
                            <div class="pb-3" style="word-wrap: break-word; font-family: arial;width:200px;max-width:200px; font-size:14px;">
                                <?php echo $row["message"]; ?>
                            </div>

                            <!-- Display image if exists -->
                            <?php
                            if (!empty($row["image_name"])) {
                                echo '<a href="../users_img/' . $row["image_name"] . '"><img src="../users_img/' . $row["image_name"] . '" alt="Image" class="message-image" style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 5px;"></a>';
                            }
                            ?>


                            <!-- Display word if exists -->
                            <?php
                            if (!empty($row["uploadWord"])) {
                                echo '<a href="../users_img/' . $row["uploadWord"] . '" class="wordgraphics text-white" style="max-width:200px;"><img  src="../chat_img/wordimg.png" alt="Image"   style="width: 30px;height:30px; margin-right:5px;">' . $row["uploadWord"] . '</a>';
                            }
                            ?>
                            <!-- Display pdf if exists -->
                            <?php
                            if (!empty($row["uploadPdf"])) {
                                echo '<a href="../users_img/' . $row["uploadPdf"] . '" class="wordgraphics text-white" style="max-width:200px;"><img  src="../chat_img/pdfimg.png" alt="Image"   style="width: 30px;height:30px; margin-right:5px;">' . $row["uploadPdf"] . '</a>';
                            }
                            ?>
                            <!-- Display recorder if exists -->
                            <?php
                            if (!empty($row["uploadRecorder"])) {
                                echo '<a href="../users_img/' . $row["uploadRecorder"] . '" class="wordgraphics text-white" style="max-width:200px;"><img  src="../chat_img/recorder.png" alt="Image"   style="width: 30px; height:30px; margin-right:5px;">' . $row["uploadRecorder"] . '</a>';
                            }
                            ?>

                            <?php
                            // if (!empty($row["uploadRecorder"])) {
                            //     echo '<audio controls class="wordgraphics text-white"><source  src="../users_img/' . $row["uploadRecorder"] . '"    style="width: 30px; margin-right:5px;"></audio>';
                            // }
                            ?>


                            <!-- Display camera if exists -->
                            <?php
                            if (!empty($row["uploadCamera"])) {
                                echo '<a href="../users_img/' . $row["uploadCamera"] . '"><img src="../users_img/' . $row["uploadCamera"] . '" alt="Image" class="message-image" style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 5px;"></a>';
                            }
                            ?>





                        </div>
                        <div class="position-absolute translate-middle mt-3"
                            style="font-size: 12px; bottom: -15px; right: -15px;">
                            <span> <?php

                                    echo date('h:i A', strtotime($row["formate_time"])); ?></span><i
                                class="bi bi-check2-all fs-4"></i>
                        </div>

                        <!-- <script>
                            $(document).ready(function() {
                                $(".message1").click(function() {

                                    confirm("select");
                                });


                            });
                        </script> -->

                    </div>
                <?php
                } else {
                ?>
                    <div class="message2 position-relative shadow-lg mt-3  ps-3 pe-3 pt-3 pb-3">



                        <div class="">

                            <?php
                            if ($row["profile_img"] == "profile.png") {

                            ?>


                                <img class="rounded-pill me-2" src="../chat_img/profile.png" width="40" height="40">



                            <?php
                            } else {
                            ?>

                                <img class="rounded-pill me-2" src="../users_img/<?php echo $row["profile_img"]; ?>" width="40" height="40">



                            <?php
                            }
                            ?>







                        </div>


                        <div class="d-flex flex-column justify-content-between align-items-center" style="width: 200px;">
                            <div class="pb-3" style="word-wrap: break-word; font-family: arial;width:200px;max-width:200px; font-size:14px;">
                                <?php echo $row["message"]; ?>
                            </div>

                            <!-- Display image if exists -->
                            <?php
                            if (!empty($row["image_name"])) {
                                echo '<a href="../users_img/' . $row["image_name"] . '"><img src="../users_img/' . $row["image_name"] . '" alt="Image" class="message-image" style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 5px;"></a>';
                            }
                            ?>


                            <!-- Display word if exists -->
                            <?php
                            if (!empty($row["uploadWord"])) {
                                echo '<a href="../users_img/' . $row["uploadWord"] . '" class="wordgraphics text-dark" style="max-width:200px;"><img  src="../chat_img/wordimg.png" alt="Image"   style="width: 30px;height:30px; margin-right:5px;">' . $row["uploadWord"] . '</a>';
                            }
                            ?>
                            <!-- Display pdf if exists -->
                            <?php
                            if (!empty($row["uploadPdf"])) {
                                echo '<a href="../users_img/' . $row["uploadPdf"] . '" class="wordgraphics text-dark" style="max-width:200px;"><img  src="../chat_img/pdfimg.png" alt="Image"   style="width: 30px;height:30px; margin-right:5px;">' . $row["uploadPdf"] . '</a>';
                            }
                            ?>
                            <!-- Display recorder if exists -->
                            <?php
                            if (!empty($row["uploadRecorder"])) {
                                echo '<a href="../users_img/' . $row["uploadRecorder"] . '" class="wordgraphics text-dark" style="max-width:200px;"><img  src="../chat_img/recorder.png" alt="Image"   style="width: 30px; height:30px; margin-right:5px;">' . $row["uploadRecorder"] . '</a>';
                            }
                            ?>

                            <?php
                            // if (!empty($row["uploadRecorder"])) {
                            //     echo '<audio controls class="wordgraphics text-white"><source  src="../users_img/' . $row["uploadRecorder"] . '"    style="width: 30px; margin-right:5px;"></audio>';
                            // }
                            ?>


                            <!-- Display camera if exists -->
                            <?php
                            if (!empty($row["uploadCamera"])) {
                                echo '<a href="../users_img/' . $row["uploadCamera"] . '"><img src="../users_img/' . $row["uploadCamera"] . '" alt="Image" class="message-image" style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 5px;"></a>';
                            }
                            ?>





                        </div>






                        <div class="position-absolute translate-middle"
                            style="font-size: 12px; bottom: -15px; right: -15px;">
                            <span> <?php echo date('h:i A', strtotime($row["formate_time"])); ?></span><i
                                class="bi bi-check2 fs-4"></i>
                        </div>


                    </div>






            <?php
                }
            }
        } else {

            ?>

            <div style="font-family:tahoma,arial" class="text-center rounded-2 p-5 w-75 fs-4 bg bg-info position-absolute translate-middle start-50 top-50">
                <img class="me-2" src="../chat_img/chat.svg" width="80" height="80"> <br>
                No chats with this fellow Amebor yet
            </div>


<?php
        }
    } else {
        echo "failed to sync chat";
    }
} else {

    header("location:login.php");
    exit();
}
$con->close();

?>