<?php
session_start();


if ($_SESSION["activeLogin"] == "activehere") {
    include "../config/dbconnect.php";
    //if (isset($_POST["inputHiddenVal"])) {
    // $activeuser = $_POST["activeUserVal"];

    $user_id = $_GET["user_id"];
    //exit();
    $activeIdUser = $_SESSION["activeId"];
    //$currentPhone= $_SESSION["activePhone"];
    // $currentUsername= $_SESSION["activeUsername"];
    $sql22 = "UPDATE chat_messages SET status=1 WHERE recepient_id='$activeIdUser'";



    $result22 = $con->query($sql22);

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Amebor Chat | Chat room</title>
        <meta
            content="What strategies do you use to get past awkward silences or uncomfortable moments is in conversation"
            name="description">
        <meta content="" name="keywords">
        <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
        <link rel="shortcut icon" href="../favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
        <link rel="manifest" href="../site.webmanifest" />

        <link rel="stylesheet" type="text/css" href="../login.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap5/css/bootstrap.min.css">
        <link href="../bootstrap_icons/bootstrap-icons.min.css" rel="stylesheet">
    </head>

    <body class="chatroom_body light-mode">
        <section class="section">
            <img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
            Mobile devices with portrait viewport to access Amebor Chat
        </section>
        <main id="main_chat" class="main_chat">
            <section class="main"></section>
            <header>
                <?php

                $sql = "SELECT * FROM chat_users WHERE id='$user_id'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }

                ?>









                <div id="chatroom_profile" class="pt-2 pb-2">
                    <div>
                        <i class="bi bi-arrow-left-short chatRoomLeft"></i>
                    </div>
                    <div>

                        <?php
                        if ($row["profile_img"] == "profile.png") {

                        ?>




                            <img class="rounded-pill clicK" src="../chat_img/profile.png"
                                width="60" height="60">


                        <?php
                        } else {
                            // code...

                        ?>



                            <img class="rounded-pill clicK" src="../users_img/<?php echo $row["profile_img"]; ?>"
                                width="60" height="60">








                        <?php
                        }



                        ?>













                    </div>
                    <div class="d-flex" style="width:160px;">
                        <span
                            style="overflow: hidden;text-overflow:ellipsis; white-space: nowrap;"
                            class="user_name"><?php echo $row["fullname"]; ?></span>
                        <?php if ($row["status"] == "online") {
                        ?>
                            <span class="text-success fw-bolder" style="font-family: arial">Online</span>
                    </div>

                <?php
                        } else {
                ?>
                    <span class="text-danger fw-bolder" style="font-family: arial">offline</span>
                </div>
            <?php
                        }

            ?>


            <div>
                <i class="bi bi-camera-video me-2"></i>
            </div>
            <div>
                <a href="tel:<?php echo $row["phone"]; ?>"><i class="bi bi-telephone"></i></a>
            </div>
            </div>




            </header>
            <section id="chat_section" class="">

            </section>






            <footer>
                <div id="message_type">
                    <form id="sendMyMessage" method="POST" enctype="multipart/form-data">
                        <p id="error-receiver" class="text-center text-danger" style="display:none;"></p>
                        <input type="hidden" id="ChatUserHidden" name="ChatUserHidden"
                            value="<?php echo $row["id"]; ?>">
                        <div class="input_type_message position-relative">

                            <!-- -----------------hoverwrapper-------------------- -->
                            <div class="hoverWrapper2">
                                <div class="position-absolute shadow-lg p-3 pe-5 other-wrapper rounded">
                                    <div class="mb-2"><label class="upload" for="upload"><i class="bi bi-images fs-2 me-3"></i>Image</label></div>
                                    <div class="mb-2"><label class="upload" for="wordupload"><i class="bi bi-file-earmark-word fs-2 me-3"></i>Word</label></div>
                                    <div class="mb-2"><label class="upload" for="pdfupload"><i class="bi bi-file-earmark-pdf fs-2 me-3"></i>Pdf</label></div>
                                    <div class="mb-2"><label class="upload" for="snapupload"><i class="bi bi-camera fs-2 me-3"></i>Camera</label></div>
                                    <div class="mb-2"><label class="upload" for="othersupload"><i class="bi bi-plus-circle fs-2 me-3"></i>Others</label></div>
                                    <div class="mb-2"><label class="upload" for="recordupload"><i class="bi bi-mic fs-2 me-3"></i>Recorder</label></div>



                                </div>
                                <div class="uploadHover"><i class="bi bi-paperclip fs-2"></i></div>

                                <!-- ----------------------------imageupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="upload" id="upload" accept="image/*">
                                </div>
                                <!-- ----------------------------imageupload--------------- -->

                                <!-- ----------------------------pdfupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="pdfupload" id="pdfupload" accept=".pdf">
                                </div>
                                <!-- ----------------------------pdfupload--------------- -->

                                <!-- ----------------------------wordupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="wordupload" id="wordupload" accept=".doc,.docx">
                                </div>
                                <!-- ----------------------------wordupload--------------- -->
                                <!-- ----------------------------snapupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="snapupload" id="snapupload" capture="user" accept="image/*">
                                </div>
                                <!-- ----------------------------snapupload--------------- -->

                                <!-- ----------------------------othersupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="othersupload" id="othersupload">
                                </div>
                                <!-- ----------------------------othersupload--------------- -->
                                <!-- ----------------------------recorderupload--------------- -->
                                <div class="d-none">
                                    <input type="file" name="recordupload" id="recordupload" capture="user" accept="audio/*">
                                </div>
                                <!-- ----------------------------recorderupload--------------- -->


                            </div>

                            <!-- -----------------hoverwrapper-------------------- -->
                            <div>
                                <textarea rows="1" style="resize: none;" name="sample-textarea"
                                    id="myMessage" placeholder="Type message..."></textarea>
                            </div>


                            <div style="width:50px;border-radius:100%; height:50px; padding-left:15px;padding-top:12px;"
                                class="record-icon bg-primary position-absolute end-0">
                                <button type="button"><i
                                        class="bi bi-mic fs-4 text-white text-center"></i></button>
                            </div>
                            <div style="display:none;width:50px;border-radius:100%; height:50px; padding-left:15px;padding-top:13px;"
                                class="send-icon  bg-primary rounded-circle position-absolute end-0">
                                <button type="submit"><i
                                        class="bi bi-send-fill fs-4   text-white text-center"></i></button>
                            </div>
                        </div>

                        <audio></audio>
                    </form>
                </div>


            </footer>
        </main>

        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript" src="../script.js"></script>
        <script src="../emoji/lc_emoji_picker.min.js" type="text/javascript">
        </script>
        <script>
            $(document).ready(function() {
             



                $(".upload").click(function() {
                    var imageUpload = $('#upload').val();
                    var pdfUpload = $('#pdfupload').val();
                    var wordUpload = $('#wordupload').val();
                    var snapUpload = $('#snapupload').val();
                    var recordUpload = $('#recordupload').val();



                    var sendIcon = $(".send-icon");
                    var recordIcon = $(".record-icon");
                    sendIcon.show();
                    recordIcon.hide();
                    if (imageUpload.length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    }
                    if (wordUpload.length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    }
                    if (pdfUpload.length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    }
                    if (snapUpload.length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    }
                    if (recordUpload.length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    }



                });











                var mySenderSound = new Audio("../sound/ameborSent.mp3");

                function sendSound() {

                    mySenderSound.play();
                }
                var myReceiverSound = new Audio("../sound/ameborReceive.mp3");


                function receiveSound() {
                    myReceiverSound.play();
                }


                var lastMessageCount = 0;


                // Function to scroll to the bottom of the main chat container
                function scrollToBottom() {
                    $("#chat_section").scrollTop($("#chat_section")[0].scrollHeight);
                }

                let userScroll = false; // Track if the user has scrolled up

                // Send message when form is submitted
                $("#sendMyMessage").on("submit", function(e) {
                    e.preventDefault();





                    //ar restrictInputt = $("#myMessage").val();
                   // if (restrictInputt.length < 1) {
                        $("#myMessage").css("height", "30px");
                   // }



                    sendSound();
                    //var chatformData = $(this).serialize();
                    var chatformData = new FormData(this);
                    $.ajax({
                        url: "insertmessage.php", // PHP file that handles inserting messages
                        type: "POST",
                        data: chatformData,
                        contentType: false, // Required for file uploads
                        processData: false, // Prevents jQuery from processing data (important for file uploads)
                        success: function(response) {



                            $("#error-receiver").html(response);
                            $("#upload").val('');
                            $("#pdfupload").val('');
                            $("#wordupload").val('');
                            $("#snapupload").val('');
                            $("#recordupload").val('');
                            $("#error-receiver").html(response);
                            $("#error-receiver").css("display", "block");



                            $("#myMessage").val(''); // Clear the input field
                            scrollToBottom(); // Scroll to bottom after sending message
                        }
                    });
                });

                // Check for new messages every second
                setInterval(function() {
                    var updateChatData = $("#ChatUserHidden").val();
                    $.ajax({
                        url: "autoload.php",
                        type: "POST",
                        data: {
                            updateChatData: updateChatData
                        },
                        success: function(response) {
                            $("#chat_section").html(response);

                            var currentMessageCount = $("#chat_section").children().length;
                            //Check if the message count has increased (new message)
                            if (currentMessageCount > lastMessageCount) {
                                // New message detected, play the sound
                                receiveSound();
                                lastMessageCount = currentMessageCount; // Update last message count
                            }










                            if (!userScroll) {
                                // Only scroll if user hasn't scrolled up
                                scrollToBottom();
                            }
                        }
                    });
                }, 1000); // Increase interval if necessary to reduce server load

                // Detect if user scrolls up to stop auto-scrolling
                $("#chat_section").on("scroll", function() {
                    userScroll = $(this).scrollTop() + $(this).innerHeight() < $(this)[0].scrollHeight;
                });

                // Dynamically show send icon and adjust textarea height
                $("#myMessage").on("input", function() {
                    var restrictInput = $(this).val();
                    var sendIcon = $(".send-icon");
                    var recordIcon = $(".record-icon");




                    if (restrictInput.trim().length > 0) {
                        sendIcon.show();
                        recordIcon.hide();
                    } else {
                        sendIcon.hide();
                        recordIcon.show();
                    }

                    // Adjust height based on content length
                    if (restrictInput.length >= 20 && restrictInput.length <= 40) {
                        $(this).css("height", "60px");
                    } else if (restrictInput.length >= 40) {
                        $(this).css("height", "90px");
                    } else {
                        $(this).css("height", "30px");
                    }
                });

                // Initial scroll to bottom on load
                scrollToBottom();
            });












            new lc_emoji_picker('textarea, input', {
                    trigger_size: {
                        height: '30px',
                        width: '30px',
                    },


                    trigger_position: {
                        top: '0',
                        left: '-38px',
                    },

                    use_noto_emojis: true,
                    selection_callback: function(emoji, target_field) {
                        console.log(emoji,
                            target_field);
                    },

                }

            );
        </script>
    </body>

    </html>


<?php
    $con->close();
} else {

    header("location:login.php");
    exit();
}



?>