<?php
session_start();


if ($_SESSION["activeLogin"] == "activehere") {
    include "../config/dbconnect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mySubmit"])) {

        $myFullname = $_POST["myFullname"];
        $myabout = $_POST["myabout"];
        $myId = $_POST["myId"];


        $sql = "UPDATE chat_users SET fullname=?, about=?  WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssi", $myFullname, $myabout, $myId);
        $result = $stmt->execute();

        if ($result) {
            $_SESSION["Updateusererror"] = "Updated Success";
            header("location:settings.php");
        } else {
            $_SESSION["Updateusererror"] = "Updated Failed";
        }
    }
    // else{
    //     header("location:settings.php");
    // //exit();
    // }


    $currentId = $_SESSION["activeId"];

    $sql = "SELECT fullname,email,phone,id,about,username FROM chat_users WHERE id='$currentId'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();





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


            <link rel="stylesheet" type="text/css" href="../aos/aos.css">
            <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
            <link rel="stylesheet" href="../bootstrap_icons/bootstrap-icons.css">
            <link rel="shortcut icon" href="amebor_logo.png" type="image/x-icon">
            <link rel="stylesheet" type="text/css" href="../login.css">
        </head>

        <body class="light-mode updateme">
            <section class="section">
                <img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
                Mobile devices with portrait viewport to access Amebor Chat
            </section>
            <main>

                <div class="container">
                    <div class="row">
                        <h1 data-aos="flip-up" class="text-center">Updata Data</h1>


                        <form action="" method="post">
                            <input type="hidden" name="myId" id="id" value="<?php echo $row["id"];   ?>">

                            <div class="form-group mt-3">
                                <label for="yourfullname">Fullname</label>
                                <input type="text" placeholder="fullname" name="myFullname" id="yourfullname" value="<?php echo $row["fullname"];   ?>" class="form-control mt-2">


                            </div>
                            <div class="form-group mt-3">
                                <label for="username">Username</label>
                                <input readonly type="text" name="myUsername" value="<?php echo $row["username"];   ?>" id="username" class="form-control mt-2">
                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input readonly type="email" name="myEmail" value="<?php echo $row["email"];   ?>" id="email" class="form-control mt-2">
                            </div>
                            <div class="form-group mt-3">
                                <label for="phone">Phone</label>
                                <input readonly type="tel" name="myPhone" value="<?php echo $row["phone"];   ?>" id="phone" class="form-control mt-2">
                            </div>


                            <div class="form-group mt-3">
                                <label for="about">My About</label>
                                <textarea style="resize: none;" placeholder="About" name="myabout" id="about" class="form-control mt-2"><?php echo $row["about"];   ?></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="mySubmit" value="Update" id="fullname" class="p-3 form-control text-white bg-primary">
                            </div>

                        </form>
                    </div>
                </div>
            </main>









            <script type="text/javascript" src="../jquery.js"></script>
            <script type="text/javascript" src="../script.js"></script>
            <script type="text/javascript" src="../aos/aos.js"></script>
            <script>







            </script>
        </body>

        </html>







<?php
    }
    $con->close();
} else {

    header("location:login.php");
    exit();
}



?>