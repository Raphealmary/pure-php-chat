<?php
session_start();

require "../config/dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="GET"){



function decrypt($data) {
    $data=base64_decode($data);
    $key="amebor_chat";
$cipher="AES-128-CBC";
$iven=openssl_cipher_iv_length($cipher);
$iv=substr($data,0,$iven);
$cipherText=substr($data,$iven);
return openssl_decrypt($cipherText,$cipher,$key,0,$iv);

}

$decryptedGET=decrypt($_GET["tl"]);

$jsonDeco=json_decode($decryptedGET);



$tokenGET=$jsonDeco->token;
$emailGET=$jsonDeco->email;
$timeGET=$jsonDeco->timeExpires;
$_SESSION["emailV"]=$emailGET;
if(time()>$timeGET){

$sqlUpdate="UPDATE chat_users SET forgot_status=0,forgot_token='',time_expires='' WHERE email='$emailGET'";
$stmtUpdate=$con->prepare($sqlUpdate);
$stmtUpdate->execute();

header("location:expireLink.php");
die();
}
else{

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Password reset page">
    <title>Reset Password | Your Application</title>
    <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
    <link rel="manifest" href="../site.webmanifest" />
    <style>
        :root {
            --primary-color: #4a90e2;
            --primary-hover: #3a7bc8;
            --success-color: #2ecc71;
            --error-color: #e74c3c;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #ecf0f1;
            --bg-color: #f9f9f9;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--bg-color);
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .reset-card {
            background: var(--white);
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }



        h1 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        .instructions {
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        form {
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .password-wrapper {
            position: relative;
        }

        input {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            padding: 0.25rem;
        }

        .password-strength {
            margin-top: 0.75rem;
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .strength-indicator {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        .login-link {
            margin-top: 1.5rem;
            text-align: center;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .reset-card {
                padding: 1.75rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }


        /*------------------mediaqueries start--------------*/

        @media only screen and (min-width: 576px) {
            main {
                display: none !important;
            }

            .section {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                height: 100vh;
                width: 100vw;

                flex-direction: column;
            }
        }


        @media only screen and (max-width: 576px) {

            .section {

                display: none !important;
            }
        }
    </style>
</head>

<body>
    <section class="section"><img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
        Mobile devices with portrait viewport to access Amebor Chat</section>
    <main>

        <section class="reset-card" aria-labelledby="reset-password-heading">


            <h1 id="reset-password-heading">Create New Password</h1>

            <form id="resetPasswordForm" method="POST" action="">
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="new-password"
                            name="newPassword"
                            placeholder="Enter new password"
                            required
                            minlength="8"
                            aria-describedby="password-strength password-error"
                            autocomplete="new-password">


                    </div>
                    <div class="password-strength">
                        <div class="strength-indicator"></div>
                    </div>
                    <div id="password-error" class="error-message" role="alert"></div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="confirm-password"
                            name="confirmPassword"
                            placeholder="Confirm your password"
                            required
                            aria-describedby="confirm-error"
                            autocomplete="new-password">

                    </div>
                    <div id="confirm-error" class="error-message" role="alert"></div>
                </div>

                <button type="submit">Reset Password</button>
            </form>

            <nav class="login-link" aria-label="Login navigation">
                <a href="../php/login.php">
                    <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to Login
                </a>
            </nav>
        </section>
    </main>
    <script src="../jquery.js"></script>
    <script>
        $(document).ready(function() {

            //document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resetPasswordForm');
            const newPassword = document.getElementById('new-password');
            const confirmPassword = document.getElementById('confirm-password');
            const toggleButtons = document.querySelectorAll('.toggle-password');
            const strengthIndicator = document.querySelector('.strength-indicator');
            const passwordError = document.getElementById('password-error');
            const confirmError = document.getElementById('confirm-error');


            // Password strength calculation
            newPassword.addEventListener('input', function() {
                const strength = calculatePasswordStrength(this.value);
                strengthIndicator.style.width = `${strength}%`;
                strengthIndicator.style.backgroundColor = getStrengthColor(strength);
            });

            // Form validation
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;

                // Reset errors
                passwordError.style.display = 'none';
                confirmError.style.display = 'none';

                // New password validation
                if (!newPassword.value) {
                    showError(passwordError, 'Password is required');
                    isValid = false;
                } else if (newPassword.value.length < 8) {
                    showError(passwordError, 'Password must be at least 8 characters');
                    isValid = false;
                }

                // Confirm password validation
                if (newPassword.value !== confirmPassword.value) {
                    showError(confirmError, 'Passwords do not match');
                    isValid = false;
                }

                if (isValid) {
                 

                    $.ajax({
                        url: "reset.php",
                        type: "POST",
                        data: $(form).serialize(),
                        success: function(response) {
                            
                           if(response=="success"){
                            alert("password reset successfully");
                            window.location.href="../php/login.php";
                          }else{
                            alert("link has expired");
                            window.location.href="expireLink.php";
                          }

                        },



                    });
                }
            });

            function calculatePasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength += 30;
                if (/[A-Z]/g.test(password)) strength += 20;
                if (/[0-9]/g.test(password)) strength += 20;
                if (/[^A-Za-z0-9]/g.test(password)) strength += 30;
                return Math.min(strength, 100);
            }

            function getStrengthColor(strength) {
                if (strength < 40) return '#e74c3c';
                if (strength < 70) return '#f1c40f';
                return '#2ecc71';
            }

            function showError(element, message) {
                element.textContent = message;
                element.style.display = 'block';
                element.setAttribute('aria-live', 'polite');
            }
        });







        //});
    </script>
</body>

</html>




<?php
}





}
else{
    header("location:../php/login.php");
}