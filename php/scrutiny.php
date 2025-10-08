<?php
session_start();

if ($_SESSION["activeLogin"] == "activehere") {
    include_once "../config/dbconnect.php";
    $currentId = $_SESSION["activeId"];

    if (isset($_POST["displaySearch"])) {
        $displaySearch = $_POST["displaySearch"];
        //$food='%$displaySearch%';
        $sql = "SELECT * FROM chat_users WHERE NOT id='$currentId' AND fullname LIKE '%$displaySearch%' OR username='$displaySearch'";
        // 	$stmt= $con->prepare($sql);

        // $stmt->bind_param("s", $displaySearch);
        // $stmt->execute();



        //$result=$stmt->get_result();
        $result = $con->query($sql);

        //echo $sql;
        // $sql2 = "SELECT * from chat_messages where sender_id='$uniqueid' OR recepient_id='$uniqueid' AND recepient_id='$currentId' OR sender_id='$currentId' ORDER BY id DESC LIMIT 1";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $uniqueid = $row["id"];


                ?>

                <!-- <input class="activeUser" type="hidden" name=""
                					value="<?php //echo $currentId = $_SESSION["activeId"]; ?>"> -->
                <input type="hidden" name="" value="<?php echo $uniqueid = $row["id"]; ?>">


                <!-- <a href="chatroom.php" class="directoroom"> -->
                <div class="directoroom  w-100 mb-2  p-3 d-flex justify-content-between align-items-center"
                    style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                    <div class="searchImg">

                        <?php
                        if ($row["profile_img"] == "profile.png") {
                            ?>
                            <img width="50" height="50" class="rounded-pill" src="../chat_img/profile.png">


                            <?php
                        } else {
                            ?>


                            <img width="50" height="50" class="rounded-pill" src="../users_img/<?php echo $row["profile_img"]; ?>">





                            <?php
                        }

                        ?>

                    </div>

                    <div style="overflow: hidden;text-overflow:ellipsis; white-space: nowrap;"
                        class="me-3 ms-3 w-100">
                        <div class="fs-4  fw-bolder">
                            <?php echo $row["fullname"]; ?>
                        </div>
                        <div class="text-muted">
                            <?php
                            $sql2 = "SELECT * FROM chat_messages WHERE sender_id='$currentId' AND recepient_id='$uniqueid' OR sender_id='$uniqueid' AND recepient_id='$currentId' ORDER BY id DESC LIMIT 1";



                            $result2 = $con->query($sql2);
                            if ($result2->num_rows > 0) {
                                $row2 = $result2->fetch_assoc();
                                echo $row2["message"];

                            } else {
                                echo "No conversation with this user";
                            }








                            ?>
                            <!-- Lorem, ipsum dolor sit amet consectetur adipisimollitia debitis optio ad! -->
                        </div>
                    </div>


                    <div class="">
                        <?php
                        if ($row["status"] == "online") {
                            ?>
                            <!-- //echo "online"; -->
                            <span class="badge rounded-circle p-2" style="background-color: rgb(51,204,102);"><span
                                class="visually-hidden">online/offline</span></span>
                            <?php
                        } else {
                            ?>
                            <!-- //echo "offline"; -->
                            <span class="badge rounded-circle p-2" style="background-color: red;"><span
                                class="visually-hidden">online/offline</span></span>


                            <?php
                        }

                        ?>
                    </div>
                </div>
                <!-- </a> -->

                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".directoroom").click(function () {

                            var inputHiddenVal = $(this).prev().val();

                            window.location.href = "chatroom.php?user_id=" + inputHiddenVal;

                        });







                    });

                </script>



                <?php
            }





        } else {
            echo "<div class='p-4 text-center vh-100 w-100 text-primary noFriendFound'>" . "No friends found" . "</div>";
        }



    } else {

        header("location:login.php");
        exit();
    }

} else {

    header("location:login.php");
    exit();
}
$con->close();
?>