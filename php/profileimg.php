<?php

session_start();



if ($_SESSION["activeLogin"] == "activehere") {
    include "../config/dbconnect.php";
    $currentId = $_SESSION["activeId"];

    $sql = "SELECT fullname,profile_img,phone,about FROM chat_users WHERE id='$currentId' LIMIT 1";
    $result = $con->query($sql);


    $row = $result->fetch_assoc();


    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyProfile</title>
<link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="../favicon.svg" />
<link rel="shortcut icon" href="../favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
<link rel="manifest" href="../site.webmanifest" />

        <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap_icons/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../login.css">

    </head>

    <body class="light-mode">
        <section class="section">
            <img width="400px" src="../chat_svg/largescreen-error.svg"> Please use Mobile devices with portrait viewport to access Amebor Chat
        </section>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 setting_wrapper">
                        <header
                            class="header-setting p-2 d-flex justify-content-start align-items-center border-bottom position-fixed">
                            <!-- <div><i class="bi bi-arrow-left fs-1"></i></div> -->
                            <div class="ms-5 user-select-none">
                                <p style="line-height: normal;" class="h1 mt-2">
                                    Profile
                                </p>
                            </div>

                        </header>
                        <main class="profileimg">
                            <form action="insertprofile.php" method="post" id="profileSubmit" enctype="multipart/form-data">



                                <div class="position-relative profileimgwrapper">
                                    <div class="imgcover position-relative">
                                        <?php
                                        if ($row["profile_img"] == "profile.png") {

                                            ?>
                                            <img class="position-absolute top-50 start-50 translate-middle" width="150"  id="profilepixDisplay"  src="../chat_img/profile.png">

                                            <?php
                                        } else {
                                            // code...

                                            ?>
                                            <img class="position-absolute top-50 start-50 translate-middle" width="150"  id="profilepixDisplay"  src="../users_img/<?php echo $row["profile_img"]; ?>">
                                            <?php
                                        }



                                        ?>
                                        
                                    </div>
                                    <input accept="image/*" class="d-none" type="file" name="profile" id="camera">
                                    <div class="position-absolute camerabtn">
                                        <label style="cursor: pointer;" class="p-4 camera-color"
                                            for="camera"><i class="bi bi-camera text-white"></i></label>
                                    </div>

                                </div>
                                <button style="z-index: 999999;" class="bg-transparent top-0 start-0 ms-2 mt-2 position-fixed border-0" type="submit"><i id="profileArrowLeft" class="bi bi-arrow-left fs-1"></i></button>
                            </form>
                        </main>
                        <section class="mt-5 profileimgSection">
                            <ul class="p-0">
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-people fs-1 me-4 text-muted"></i>
                                    <span class="d-flex flex-column pb-2  d-block w-100">
                                        <h6 class="text-muted">Name</h6>
                                        <b><?php echo $row["fullname"]; ?></b><small class="text-muted">To save your profile img click the top left arrow
                                        </small>
                                    </span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-info-circle fs-1 me-4  text-muted"></i>
                                    <span class="d-flex flex-column pb-2  d-block w-100">
                                        <h6 class=" text-muted">About</h6>
                                        <small><?php echo $row["about"]; ?></small>
                                    </span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-telephone fs-1 me-4 text-muted"></i>
                                    <span class="d-flex flex-column pb-2 d-block w-100">
                                        <h6 class="text-muted">
                                            Phone
                                        </h6>
                                        <small>Security
                                            <?php echo $row["phone"]; ?></small>
                                    </span></a></li>
                            </ul>
                        </section>
                    </div>

                </div>
            </div>
        </main>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript" src="../script.js"></script>
        <script>
            $(document).ready(function () {


                $("#profileSubmit").on("submit", function (e) {
                    e.preventDefault();

                    var chatprofileData = new FormData($(this)[0]);
                    //
                    $.ajax({
                        url: "insertprofile.php",
                        type: "POST",
                        data: chatprofileData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            //alert(response);
                            window.location.href = "settings.php";
                        },
                        error: function () {
                            alert("error uploadpix");
                        }
                    });

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