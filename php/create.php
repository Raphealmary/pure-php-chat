<?php
session_start();


require "../config/dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usercreate"]) ) {



    function validate($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
$fullname=validate($_POST["fullname"]);
$username=validate($_POST["username"]);
$email=validate(strtolower($_POST["email"]));

$tel=validate($_POST["tel"]);
$password=validate($_POST["password"]);


if (empty($username)) {
  $_SESSION["usererror"] = "username cannot be empty";
}
else if (empty($email)) {
  $_SESSION["usererror"] = "Email cannot be empty";
}

else if (empty($tel)) {
  $_SESSION["usererror"] = "Phone number cannot empty";
}
else if (empty($password)) {
  $_SESSION["usererror"] = "Your Password cannot be empty";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION["usererror"] = "Invalid email format e.g jesus@mail.com";
}

else if (!preg_match("/[0]{1}[7-9]{1}[0-1]{1}[0-9]{8}/", $tel)) {
  $_SESSION["usererror"] = "Invalid Tel eg. 090,070,081,091 or 080**";
}
else if (!preg_match("/.{8,}/", $password)) {
  $_SESSION["usererror"] = "Password must not be less than 8 character";
}
else if (!preg_match("/[A-Z]{1}[a-z]{3,}/", $username)) {
  $_SESSION["usererror"] = "Username must be more than 3 letters e.g. Rapheal, Samuel, Rukky, etc..";
}






 else {
$stmt=$con->prepare("SELECT username,email,phone FROM chat_users WHERE username=? OR email=? OR phone=? LIMIT 1");
$stmt->bind_param("sss",$username,$email,$tel);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows>0) {
  $_SESSION["usererror"] = "User with this details already registered";
  } else {
 $passwordencrypt=md5($password);
  $stmt=$con->prepare("INSERT INTO chat_users (fullname, username,email,phone,password) VALUES(?,?,?,?,?)");
  $stmt->bind_param("sssss",$fullname,$username,$email,$tel,$passwordencrypt);
  if ($stmt->execute()) {
      $_SESSION["usersuccess"] = "Account created successfully Login";
   } else {
  $_SESSION["usererror"] = "Error creating account.";
} 
  }
  $stmt->close();

}
} 


$con->close();





?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Amebor Chat | Signup</title>
    <meta content="What strategies do you use to get past awkward silences or uncomfortable moments is in conversation" name="description">
    <meta content="" name="keywords">
<link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="../favicon.svg" />
<link rel="shortcut icon" href="../favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
<link rel="manifest" href="../site.webmanifest" />

<link rel="stylesheet" type="text/css" href="../login.css">
<link rel="stylesheet" type="text/css" href="../aos/aos.css">
   <link href="../bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap_icons/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
  <section class="section"><img width="400px" src="../chat_svg/largescreen-error.svg"> Please use Mobile devices with portrait viewport to access Amebor Chat</section>
<main>
 
	<div class="create-container">
  <div class="create-welcome" data-aos="flip-up">
 <h1>Sign Up!</h1><p>Hello! Create your account</p>
 </div>
 <?php if (isset($_SESSION["usersuccess"])) {?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i width="24" height="24" fill="currentColor" class="bi bi-exclamation-circle me-2"
                                    role="img" aria-label="Warning:"></i>
                                <div>
                                    <?php echo $_SESSION["usersuccess"]; ?>
                                </div>
                            </div>
                            <?php
                        }
                            unset($_SESSION["usersuccess"]);
                        ?>

 <?php if (isset($_SESSION["usererror"])) {?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-1"
                                    role="img" aria-label="Warning:"></i>
                                <div>
                                    <?php echo $_SESSION["usererror"]; ?>
                                </div>
                            </div>
                            <?php
                        }
                            unset($_SESSION["usererror"]);
                        ?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                        <div class="flex-container-create">
<!-- oninput="inputUsername()" -->
                             <div class="input-wrapper">
                                  <input  required type="text" name="fullname" class="inputuser" id="yourfullname" value="<?php if(isset($_POST['fullname'])){
                                    echo($_POST['fullname']);
                                  } ?>">

                                  <label for="yourfullname" class="form-label">Full Name</label>
                            </div>   






                               <div class="input-wrapper">
                                  <input  required type="text" name="username" class="inputuser" id="yourUsername" value="<?php if(isset($_POST['username'])){
                                    echo($_POST['username']);
                                  } ?>">

                                  <label for="yourUsername" class="form-label">Username</label>
                            </div>









                             
                              <div class="input-wrapper">
                                  <input required  type="text" name="email" class="inputuser" id="email" value="<?php if(isset($_POST['email'])){
                                    echo($_POST['email']);
                                  } ?>">

                                  <label for="email" class="form-label">Your Email</label>
                            </div>
                          
<div class="input-wrapper">
                                <input maxlength="11" required  type="tel" name="tel" class="inputuser" id="tel" value="<?php if(isset($_POST['tel'])){
                                    echo($_POST['tel']);
                                  } ?>">

                                  <label for="tel" class="form-label">Phone/Tel</label>
                            </div>
                           
                       <div class="input-wrapper">
                        <input required type="password" name="password" class="inputuser" id="yourpassword" value="<?php if(isset($_POST['password'])){
                                    echo($_POST['password']);
                                  } ?>">

                                   <label for="yourpassword" class="form-label">Password</label>
                                   <i id="eye-show" class="bi bi-eye"></i>
                            </div>
                           
                       

                         <div>
                            <button style="padding: 15px 10px;" class="submit-btn" type="submit" name="usercreate">Sign up</button>
                        </div>
                        

                     



                     </div>
            <div class="btn-create"><a style="text-decoration: none;" href="login.php"><span class="loginnotify">Already have an Account?</span> Login!</a></div>  
             </form>
	
</div>
</main>

<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript" src="../aos/aos.js"></script>
<script type="text/javascript" src="../script.js"></script>

 </body>

</html>



