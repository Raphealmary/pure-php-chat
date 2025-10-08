<?php
session_start();


if ($_SESSION["activeLogin"] == "activehere") {
    include "../config/dbconnect.php";
    $currentId = $_SESSION["activeId"];
    ?>





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Amebor Settings</title>
        <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="../favicon.svg" />
<link rel="shortcut icon" href="../favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
<link rel="manifest" href="../site.webmanifest" />

        
        
        <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap_icons/bootstrap-icons.css">
        <link rel="shortcut icon" href="amebor_logo.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../login.css">
    </head>

    <body class="light-mode">
        <section class="section">
            <img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
            Mobile devices with portrait viewport to access Amebor Chat
        </section>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 setting_wrapper">
                        <header
                            class="header-setting  p-2 d-flex justify-content-start align-items-center border-bottom position-fixed">
                            <div>
                                <i style="cursor:pointer;" id="arrowLeftSettings"
                                    class="bi bi-arrow-left fs-1"></i>
                            </div>
                            <div class="ms-3 user-select-none">
                                <p style="line-height: normal;" class="h1 mt-1">
                                    Settings
                                </p>
                            </div>
                            <!-- <div><i class="bi bi-search fs-2 "></i></div> -->
                        </header>
                        <?php

                        $sql = "SELECT * FROM chat_users WHERE id='$currentId'";

                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        }









                        ?>

                        <nav class="nav-setting p-2 mb-3 d-flex justify-content-around align-items-center border-bottom w-100">
                            <div class="me-2">

                                <?php
                                if ($row["profile_img"] == "profile.png") {

                                    ?>
                                    <img src="../chat_img/profile.png" width="70" height="70">






                                    <?php
                                } else {
                                    // code...

                                    ?>

                                    <img src="../users_img/<?php echo $row["profile_img"]; ?>" width="70" height="70">




                                    <?php
                                }



                                ?>




                            </div>
                            <div class="me-2 d-flex flex-column w-50">
                                <div class="h3 text-uppercase">
                                    <?php echo $row["fullname"]; ?>
                                </div>
                                <div class="text-muted">
                                    <?php echo $row["phone"]; ?>
                                </div>
                                <div class="overflow-about text-muted">

                                    <?php echo $row["about"]; ?>

                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <i class="bi bi-fingerprint fs-1 me-2 text-muted"></i>
                                </div>
                                <div>
                                    <i class="bi bi-check-circle fs-1 ms-2 text-muted"></i>
                                </div>
                            </div>
                        </nav>
                        <main class="setting_main">
                            <ul class="ps-0">
                                <li class="mb-3"><a class="d-flex" href="updateme.php"><i
                                    class="bi bi-key fs-1 me-5 text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Account</b><small class="text-muted">Security
                                        notifications,
                                        change number</small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-lock fs-1 me-5  text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Privacy</b><small class="text-muted">Block
                                        contacts,disappearing
                                        messages</small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="profileimg.php"><i
                                    class="bi bi-person-badge fs-1 me-5  text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Avatar</b><small class="text-muted">Create,
                                        Edit,
                                        Profile
                                        photo</small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-balloon-heart fs-1 me-5 text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Favorites</b><small class="text-muted">Add,
                                        reorder, remove
                                    </small></span></a></li>
                                <li class="mb-3"><a class="d-flex changeTheme" href="#"><i
                                    class="bi bi-chat-left-text fs-1 me-5 text-muted "></i>
                                    <span class="d-flex flex-column"> <b>Chats</b><small class="text-muted">Theme,
                                        wallpapers, chat history
                                    </small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-bell fs-1 me-5  text-muted"></i>
                                    <span class="d-flex flex-column">
                                        <b>Notifications</b><small class="text-muted">Message, group & call tones
                                        </small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-floppy fs-1 me-5 text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Storage and
                                        data</b><small class="text-muted">Network usage, auto-download
                                    </small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-globe2 fs-1 me-5 text-muted"></i>
                                    <span class="d-flex flex-column"> <b>App
                                        language</b><small class="text-muted">English(device's langauage)
                                    </small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-question-circle fs-1 me-5 text-muted"></i>
                                    <span class="d-flex flex-column"> <b>Help</b><small class="text-muted">Help center,
                                        contact us, privacy policy
                                    </small></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-people fs-1 me-5 text-muted"></i>
                                    <span class="d-flex align-items-center"> <b>Invite a
                                        friend</b></span></a></li>
                                <li class="mb-3"><a class="d-flex" href="#"><i
                                    class="bi bi-facebook fs-1 me-5 text-muted"></i>
                                    <span class="d-flex align-items-center"> <b>Open
                                        Facebook</b></span></a></li>
                            </ul>
                        </main>

                    </div>

                </div>
            </div>

        </main>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript" src="../script.js"></script>
        <script>
          






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