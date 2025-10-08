<?php
session_start();
require "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userlogin"])) {
  function validate($data)
  {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
  }
  $loginusername = validate($_POST["phone"]);
  $loginpassword = validate($_POST["password"]);

  if (empty($loginusername)) {
    $failed = "Email/phone number cannot be empty";
  } else if (empty($loginpassword)) {
    $failed = "password cannot be empty";
  } else if (!preg_match("/.{8,}/", $loginpassword)) {
    $failed = "Password must not be less than 8 character";
  } else {
    $passwordencrypt = md5($loginpassword);
    $stmt = $con->prepare("SELECT id,username,email,phone,password,status FROM chat_users WHERE phone=? LIMIT 1");
    $stmt->bind_param("s", $loginusername);
    $stmt->execute();

    // AND password=? 
    // , $passwordencrypt

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      $phonenum = $row["phone"];
      $passcode = $row["password"];
      $activeName = $row["username"];
      $activeId = $row["id"];
      if ($passcode == $passwordencrypt) {
        $stmt = $con->prepare("UPDATE chat_users SET status='online' WHERE phone=? AND password=?");
        $stmt->bind_param("ss", $phonenum, $passcode);
        $stmt->execute();

        $_SESSION["activeLogin"] = "activehere";
        $_SESSION["activePhone"] = $phonenum;
        $_SESSION["activeUsername"] = $activeName;
        $_SESSION["activeId"] = $activeId;

        header("location:seefriends.php");
        exit();
      } else {
        $failed = "Password mismatch";
      }
    } else {
      $failed = "User not found in our system";
    }



    $stmt->close();
  }
}
$con->close();
?>



<!DOCTYPE html>
<html lang="en">

<scr>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Amebor Chat | Login</title>
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
  <!-- <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="../bootstrap_icons/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js"
    crossorigin="anonymous" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css"
    rel="stylesheet" crossorigin="anonymous">

  <style type="text/css">
    body {
      background-color: white;
    }

    #preloader {
      display: none;
      position: absolute;
      z-index: 999999999 !important;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .preloaderbg {
      display: none;
      position: absolute;
      z-index: 9999999 !important;
      top: 0;
      left: 0;
      right: 0;
      height: 100vh;
      background-color: rgba(255, 255, 255, 0.8);

    }
  </style>
  <script>
    function preventBack() {
      window.history.forward();
    }
    preventBack();
    // setTimeout(preventBack(), 0);
    // window.onunload = function () { null }
  </script>

  <body>
    <section class="section"><img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
      Mobile devices with portrait viewport to access Amebor Chat</section>
    <div class="preloaderbg"></div>
    <div id="preloader"><img width="150" src="../chat_svg/preloader.svg"> </div>
    <main>

      <div class="container">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


          <div style="width:100vw;"
            class="swiffy-slider slider-nav-autoplay slider-nav-autopause slider-indicators-round slider-indicators-dark  slider-indicators-highlight slider-indicators-sm slider-nav-animation slider-nav-animation-fadein slider-nav-animation-slow">

            <ul class="slider-container">
              <li class="slide-visible">
                <div id="slide1"><img src="../chat_svg/contactUs.svg" width="250"> </div>
              </li>
              <li class="">
                <div id="slide2"><img src="../chat_svg/HotelSoftware.svg" width="250"></div>
              </li>
              <li class="">
                <div id="slide3"><img src="../chat_svg/lifeChat.svg" width="250"></div>
              </li>
              <li class="">
                <div id="slide4"><img src="../chat_svg/publicAdvert.svg" width="250"></div>
              </li>
              <li class="">
                <div id="slide5"><img src="../chat_svg/teamGoal.svg" width="250"></div>
              </li>
              <li class="">
                <div id="slide6"><img src="../chat_svg/worldPlay.svg" width="250"></div>
              </li>

            </ul>

            <ul class="slider-indicators">
              <li class=""></li>
              <li class=""></li>
              <li class=""></li>
              <li class=""></li>
              <li class="active"></li>
              <li class=""></li>
            </ul>
          </div>
          <div class="flex-container">

            <?php
            if (isset($failed)) { ?>
              <div style="text-align: center;padding: 6px; color: white; background-color: red;">
                <?php echo $failed; ?>
              </div>
            <?php
            }
            ?>


            <div class="input-wrapper">
              <input maxlength="11" required type="text" name="phone" class="inputuser"
                id="yourUsername" value="<?php if (isset($_POST['phone'])) {
                                            echo ($_POST['phone']);
                                          } ?>">

              <label for="yourUsername" class="form-label">Phone No</label>
            </div>

            <div class="input-wrapper">
              <input required type="password" name="password" class="inputuser" id="yourpassword"
                value="<?php if (isset($_POST['password'])) {
                          echo ($_POST['password']);
                        } ?>">

              <label for="yourpassword" class="form-label">Password</label>
              <i id="eye-show" class="bi bi-eye"></i>
            </div>

            <div class="forgot-pass">
              <p><input type="checkbox" id="check">Remember me</p>
              <p><a href="../forgot/index.php">Forgot Password</a></p>
            </div>

            <div>
              <button style="padding: 15px 10px;" class="submit-btn" type="submit"
                name="userlogin">Login</button>
            </div>

            <div class="social-media-login">
              <div><i class="bi bi-facebook"></i></div>
              <div><i class="bi bi-twitter"></i></div>
              <div><i class="bi bi-instagram"></i></div>
            </div>


            <div class="login-btn-create">
              <a href="create.php">
                <span class="loginnotify">Don't have Account?</span> Signup!
              </a>
            </div>
          </div>
        </form>
      </div>
    </main>

    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <script>

    </script>
  </body>

</html>