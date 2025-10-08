<?php
session_start();
sleep(5);

if ($_SESSION["activeLogin"] == "activehere") {
    include "../config/dbconnect.php";
    date_default_timezone_set('Africa/Lagos');
    $currentId = $_SESSION["activeId"];
    $currentPhone = $_SESSION["activePhone"];
    $currentUsername = $_SESSION["activeUsername"];

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Amebor Chat | Search Friends</title>
        <meta
            content="What strategies do you use to get past awkward silences or uncomfortable moments is in conversation"
            name="description">
        <meta content="" name="keywords">
        <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
        <link rel="shortcut icon" href="../favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
        <link rel="manifest" href="../site.webmanifest" />


        <link rel="stylesheet" type="text/css" href="../aos/aos.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap5/css/bootstrap.min.css">
        <link href="../bootstrap_icons/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../login.css">

        <script>
            function preventBack() {
                window.history.forward();
            }
            preventBack();
            //setTimeout(preventBack(), 0);
            // window.onunload = function () { null }
        </script>
    </head>

    <body class="light-mode">
        <section class="section">
            <img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
            Mobile devices with portrait viewport to access Amebor Chat
        </section>
        <main class="see-friends-page pb-3 w-100" style="overflow:scroll;">
            <!-- \\\-------------------------float start chat--------------------------\\\ -->
            <div class="user-select-none float-chart-btn">
                <i
                    class="bi bi-chat-left-text fs-5 me-2 pt-2"></i><span>Start Chart</span>
            </div>
            <!-- \\\-------------------------float start chat--------------------------\\\ -->
            <section class="container-fluid">
                <!-- <div class="row">
                                                                                                                                                                                                                                                                			<div class="col-md-12 uu"> -->
                <section>

                    <!-- \\\-------------------------search header--------------------------\\\ -->
                    <?php
                    $stmt = $con->prepare("SELECT username,email,phone,password,profile_img, status FROM chat_users WHERE phone=? AND username=? LIMIT 1");
                    $stmt->bind_param("ss", $currentPhone, $currentUsername);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $activeUserImg = $row["profile_img"];
                        $activeUser = $row["username"];

                        $stmt->close();
                    } else {
                        echo "error";
                    }

                    ?>

                    <div class="position-fixed start-0 top-0 end-0 pe-3 ps-3 ameborseeTitle"
                        style="z-index: 999">
                        <div class="ameborTitle mt-2 ms-3 user-select-none">
                            amebor..
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2 search-flex">
                            <div>
                                <i class="bi bi-search search-icon"></i>
                            </div>
                            <div>
                                <input class="w-100" id="search_chat" type="text" name="search-friends"
                                    placeholder="Search for friends...">
                            </div>
                            <div class="profile_mini user-select-none">




                                <?php
                                if ($activeUserImg == "profile.png") {

                                ?>





                                    <img
                                        class="rounded-pill search-border-img"
                                        src="../chat_img/profile.png" height="30" width="30">






                                <?php
                                } else {
                                    // code...

                                ?>
                                    <img
                                        class="rounded-pill search-border-img"
                                        src="../users_img/<?php echo $activeUserImg; ?>" height="30" width="30">




                                <?php
                                }



                                ?>











                                <ul class="shadow p-2">
                                    <li><a href="#">New group</a></li>
                                    <li><a href="#">New broadcast</a></li>
                                    <li><a href="#">Linked devices</a></li>
                                    <li><a href="#">Starred messages</a></li>
                                    <li><a href="settings.php">Settings</a></li>
                                    <li><a
                                            href="logout.php?logMeOut=<?php echo $activeUser; ?>">Logout</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- \\\-------------------------search header end--------------------------\\\ -->
                    <div style="flex-direction: column; z-index: 99;position: absolute;top: 100px; left: 0px;right: 0px; "
                        class="searchPreview d-flex justify-content-between align-items-center">
                    </div>
                    <!-- \\\<------------------your friends start--------------------------\\ -->
                    <div data-aos="flip-up"
                        class="developers-rows d-flex justify-content-between align-items-center user-select-none"
                        style="margin-top: 120px;">
                        <div class="position-relative">




                            <img class="rounded-pill border-dark border border-2" src="../chat_img/develope_raphealmary.jpg"
                                width="60">










                            <span
                                class="bi bi-patch-check-fill  p-1 position-absolute translate-middle top"
                                style="top: 58px;font-size: 20px;  left: 50px;color: rgb(51,204,102);"></span>
                        </div>

                        <div style="overflow: hidden;text-overflow:ellipsis; white-space: nowrap;"
                            class="ms-2 me-2 w-75 d-flex justify-content-between name-content">
                            <span>Onyeke Raphealmary</span>
                            <p>
                                Developer of Amebor chat Platform <br>for Nigerians way sabi Aproko
                            </p>
                        </div>

                        <div>
                            <span class="badge rounded-pill bg-primary">Verified</span>
                        </div>
                    </div>
                    <?php

                    $sql5 = "SELECT DISTINCT
                    chat_users.id,
                    chat_users.fullname,
                    chat_users.profile_img,
                    chat_users.status,
	MAX(chat_messages.message_time) AS updated_time_date,chat_messages.message
	 FROM chat_messages JOIN chat_users ON
chat_messages.sender_id = chat_users.id OR
chat_messages.recepient_id=chat_users.id
WHERE (chat_messages.sender_id='$currentId' OR chat_messages.recepient_id='$currentId')
AND chat_users.id !='$currentId'
GROUP BY chat_users.id
ORDER BY updated_time_date DESC";






                    $result5 = $con->query($sql5);
                    if ($result5->num_rows > 0) {

                        while ($row5 = $result5->fetch_assoc()) {
                            /*$you = $row5["profile_img"];
                            $eng = $row5["message"];
                            $fr = $row5["fullname"];*/
                            //echo $row5["id"]."__".$row5["fullname"]."__".$row5["message"]."__".$row5["updated_time_date"]."<br>";

                    ?>

                            <input type="hidden" name="" value="<?php echo $row5["id"]; ?>">




                            <div class="friends-rows d-flex justify-content-between align-items-center mt-3">
                                <div class="position-relative">
                                    <?php
                                    if ($row5["profile_img"] == "profile.png") {
                                    ?>
                                        <img class="rounded-pill border-dark border border-2 displayFullImage" src="../chat_img/profile.png" width="60" height="60">

                                    <?php
                                    } else {
                                    ?>

                                        <img  class="rounded-pill border border-dark border-2 displayFullImage" src="../users_img/<?php echo $row5["profile_img"]; ?>" width="60" height="60">





























                                    <?php
                                    }


                                    if ($row5["status"] == "online") {
                                    ?>





                                        <span class="badge rounded-circle p-2  position-absolute translate-middle top-100 border border-white border-3" style="left: 50px;background-color: rgb(51,204,102);"><span class="visually-hidden">online/offline</span></span>

                                    <?php

                                    } else {
                                    ?>

                                        <span class="badge rounded-circle p-2 position-absolute translate-middle top-100 border border-white border-3" style="left: 50px;background-color: red;"><span class="visually-hidden">online/offline</span></span>


                                    <?php
                                    }

                                    ?>
                                </div>

                                <div style="overflow: hidden;text-overflow:ellipsis; white-space: nowrap;" class="ms-2 w-75 me-2 d-flex justify-content-between name-content">
                                    <span><?php echo $row5["fullname"]; ?></span>
                                    <p>



                                        <?php
                                        $counterUser = $row5["id"];
                                        $sql12 = "SELECT message FROM chat_messages WHERE sender_id='$currentId' AND recepient_id='$counterUser' OR sender_id='$counterUser' AND recepient_id='$currentId' ORDER BY id DESC LIMIT 1";



                                        $result12 = $con->query($sql12);
                                        if ($result12->num_rows > 0) {
                                            $row12 = $result12->fetch_assoc();
                                            echo $row12["message"];
                                        } else {
                                            echo "No conversation with this user";
                                        }










                                        ?>





                                    </p>
                                </div>
                                <div style="width:120px" class="d-flex time-notify">
                                    <span class="time d-block text-center w-100"><?php echo date('D, h:i a', strtotime($row5["updated_time_date"])); ?></span>
                                    <p>
                                        <?php

                                        $sql20 = "SELECT status,Count(status) FROM chat_messages WHERE status=0 AND (sender_id='$counterUser')";



                                        $result20 = $con->query($sql20);
                                        // if ($result20->num_rows > 0) {
                                        $row20 = $result20->fetch_array();

                                        if ($row20["Count(status)"] == 0) {
                                        ?>
                                            <span class="visually-hidden"></span>

                                        <?php

                                        } else {
                                        ?>


                                            <span class="badge rounded-pill bg-primary"><?php echo $row20["Count(status)"]; ?></span>



                                        <?php
                                            ///  }



                                        } ?>


                                    </p>
                                </div>
                            </div>

                    <?php

                        }
                    }

                    ?>
                    <!--

                                                                                                                                                                                                            <div class="friends-rows d-flex justify-content-between align-items-center mt-3">
                                                                                                                                                                                                                <div class="position-relative">
                                                                                                                                                                                                                    <img class="rounded-pill border border-2" src="../users_img/18.jpg" width="60">
                                                                                                                                                                                                                    <span class="badge rounded-circle p-2 position-absolute translate-middle top-100 border border-white border-3" style="left: 50px;background-color: red;"><span class="visually-hidden">online/offline</span></span>


                                                                                                                                                                                                                </div>

                                                                                                                                                                                                                <div class="ms-2 w-75 me-2 d-flex justify-content-between name-content">
                                                                                                                                                                                                                    <span>Samuel Ali</span><p>
                                                                                                                                                                                                                        i am invicible
                                                                                                                                                                                                                    </p>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                <div class="d-flex time-notify">
                                                                                                                                                                                                                    <span class="time">11:43am</span><p>
                                                                                                                                                                                                                        <span class="badge rounded-pill bg-primary">3</span>
                                                                                                                                                                                                                    </p>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </div>


                                                                                                                                                                                                                                                                                                                                    <div class="friends-rows d-flex justify-content-between align-items-center mt-3">
                                                                                                                                                                                                                                                                                                                                    	<div class="position-relative">
                                                                                                                                                                                                                                                                                                                                    		<img class="rounded-pill border border-2" src="../users_img/21.jpg" width="60">
                                                                                                                                                                                                                                                                                                                                    		<span class="badge rounded-circle p-2 position-absolute translate-middle top-100 border border-white border-3" style="left: 50px;background-color: red;"><span class="visually-hidden">online/offline</span></span>
                                                                                                                                                                                                                                                                                                                                    	</div>

                                                                                                                                                                                                                                                                                                                                    	<div class="ms-2 w-75 me-2 d-flex justify-content-between name-content"><span>Mike Samuel tong</span><p>Microsoft create a scotland water resistant server</p></div>
                                                                                                                                                                                                                                                                                                                                    	<div class="d-flex time-notify"><span class="time">11:43am</span><p><span class="badge rounded-pill bg-primary"></span></p></div>
                                                                                                                                                                                                                                                                                                                                    </div> -->

                    <!-- \\------------------your friends end--------------------------\\\ -->













                </section>


                <!--
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                    	</div>
                                                                                                                                                                                                                                                                     -->


            </section>
        </main>
        <script type="text/javascript" src="../jquery.js"></script>
<script src="../bootstrap5/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="../aos/aos.js"></script>
        <script type="text/javascript" src="../script.js"></script>




        <script type="text/javascript">
            $(document).ready(function() {
                $(".friends-rows").click(function() {

                    var inputHiddenVal = $(this).prev().val();

                    window.location.href = "chatroom.php?user_id=" + inputHiddenVal;

                });
                

               

            });
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