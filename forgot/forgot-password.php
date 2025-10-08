<?php
session_start();
require "../config/dbconnect.php";


$demoBaseUrl = 'https://api.sendinblue.com/v3/smtp/email';


$publishableKey = "YOUR OWN API KEY PUBLIC KEY";





if (isset($_POST["email"])) {
    $myRestEmail = $_POST["email"];
    function encrypt($data)
    {
        $key = "amebor_chat";
        $cipher = "AES-128-CBC";
        $iven = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($iven);
        $cipherText = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($iv . $cipherText);
    }

    if (empty($myRestEmail)) {
        $_SESSION["invalid_email"] = "Email cannot be empty";
        header("location:index.php");
    } else if (!filter_var($myRestEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["invalid_email"] = "Invalid email format e.g jesus@mail.com";
        header("location:index.php");
    } else {
        $sql = "SELECT username,email,forgot_status,forgot_token FROM chat_users WHERE email=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $myRestEmail);
        $stmt->execute();
        $showResult = $stmt->get_result();

        if ($showResult->num_rows > 0) {
            $fetchRow = $showResult->fetch_assoc();

            $emailVerify = $fetchRow["email"];
            $forgotStatus = $fetchRow["forgot_status"];
            $useName = $fetchRow["username"];

            if ($forgotStatus == 1) {
                $_SESSION["correct_email"] = "Check Email/Spambox Link Already sent";
                header("location:index.php");
                exit();
            } else {
                $token = bin2hex(random_bytes(10 * 2));
                $timeExpires = time() + 300;

                $allData = [
                    "token" => $token,
                    "email" => $emailVerify,
                    "timeExpires" => $timeExpires
                ];
                $jsonDisplay = json_encode($allData);
                $encryptedUrl = urlencode(encrypt($jsonDisplay));



                $numOne = 1;




                $data = array(
                    "sender" => [
                        "name" => "Regital technologies",
                        "email" => "testapplication772@gmail.com"
                    ],
                    "to" => [
                        [
                            "email" => $emailVerify,
                            "name" => $useName
                        ]
                    ],
                    "subject" => "Password reset",
                    //"htmlContent" => "<html><head></head><body><p>Hello,</p>http://localhost/dashboard/chatapp/forgot/reset_password.php?tl=$encryptedUrl</p></body></html>"
                    "htmlContent" => "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Email Signature</title>
  
   
</head>
<body>
    <table class='signature' style='font-family: 'Arial',sans-serif;font-size: 12px; line-height: 1.4;
            color: #333333;
            max-width: 600px;
            border-left: 3px solid #2A5DB0;
            padding-left: 15px;'>
        <tr>
            <td>
                <div style='font-size: 16px;
            font-weight: bold;
            color: #2A5DB0;
            margin-bottom: 5px;' class='name'>Regital technologies</div>
                <div  style='font-size: 14px;
            color: #666666;
            margin-bottom: 10px;' class='title'>Automated Mailing Services</div>
                
                <div class='contact-info'>
                    <a style='color: #2A5DB0;
            text-decoration: none;' href='tel:+2349019426074'>09019426074</a>
                    <span class='divider'>|</span>
                    <a style='color: #2A5DB0;
            text-decoration: none;' href='mailto:info@regitaltechnologies.com.ng'>info@regitaltechnologies.com.ng</a>
                    <span style ='color: #CCCCCC;
            padding: 0 5px;color: #2A5DB0;
            text-decoration: none;' class='divider'>|</span>
                    <a style='color: #2A5DB0;
            text-decoration: none;' href='https://www.regitaltechnologies.com.ng'>www.regitaltechnologies.com.ng</a>
                </div>
                
                <div>
                    <a style='display: inline-block;color: #2A5DB0;
            text-decoration: none;
            padding: 8px 15px;
            background-color: #2A5DB0;
            color: white !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 5px;
            font-size: 12px;' href='http://localhost/dashboard/chatapp/forgot/reset_password.php?tl=$encryptedUrl' class='button'>Click to Reset Password</a>
                </div>
                
                <div style='margin-top: 10px;'>
                    <img src='../favicon-96x96.png' alt='regitaltechnologies_logo' class='logo' style='margin-top: 15px;
            max-height: 50px;'>
                </div>
                
                <div style='font-size: 11px; color: #999999; margin-top: 10px;'>
                    CONFIDENTIALITY NOTICE: This email and any attachments may contain confidential information.
                </div>
                
      <span style='font-size: 12px; color: #888;'>Mandate Technologies © 2025</span>
            </td>
        </tr>
    </table>
</body>
</html>"
                    // -----------------end of signature------------

                );

                $transaction = curl_init($demoBaseUrl);

                curl_setopt($transaction, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($transaction, CURLOPT_SSL_VERIFYPEER, 0);



                curl_setopt($transaction, CURLOPT_POST, true);
                curl_setopt($transaction, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($transaction, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($transaction, CURLOPT_HTTPHEADER, [
                    "api-key: " . $publishableKey,
                    "Content-Type: application/json"
                ]);

                $response = curl_exec($transaction);
                curl_close($transaction);
                $status = json_decode($response);



                if ($status->messageId) {

                    $sqlUpdate = "UPDATE chat_users SET forgot_status=$numOne,forgot_token='$token',time_expires='$timeExpires' WHERE email='$emailVerify'";
                    $stmtUpdate = $con->prepare($sqlUpdate);
                    $stmtUpdate->execute();
                    $_SESSION["correct_email"] = $fetchRow["email"];
                    header("location:index.php");
                    exit();
                } else {

                    $_SESSION["invalid_email"] = "Couldnt Sent to email";

                    header("location:index.php");
                    exit();
                }
            }
        } else {

            $_SESSION["invalid_email"] = $myRestEmail;
            header("location:index.php");
        }
    }
} else {
    header("location:../php/login.php");
}
