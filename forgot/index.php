<?php
session_start();
//include "forgot-password.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Password recovery page">
    <title>Forgot Password | Your Application</title>
    <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
  <link rel="shortcut icon" href="../favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
  <link rel="manifest" href="../site.webmanifest" />
  <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
    <style>
        /* Reset and base styles */
        :root {
            --primary-color: #4a90e2;
            --primary-hover: #3a7bc8;
            --text-color: #333;
            --text-light: #666;
            --error-color: #e74c3c;
            --border-color: #ddd;
            --bg-color: #f5f5f5;
            --white: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--bg-color);
        }
        
        /* Main container */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }
        
        /* Card component */
        .forgot_head {
            background: var(--white);
            border-radius: 0.5rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 28rem;
            text-align: center;
        }
        
       
        
        /* Headings */
        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.9375rem;
            color: var(--text-color);
        }
        
        /* Text content */
        p {
            color: var(--text-light);
            margin-bottom: 1.875rem;
        }
        
        /* Form elements */
        form {
            margin-top: 1.875rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }
        
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
            font-size: 1rem;
            transition: border 0.3s ease;
        }
        
        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.3125rem;
            min-height: 1.25rem;
        }
        
        /* Buttons */
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        button:hover {
            background-color: var(--primary-hover);
        }
        
        /* Navigation links */
        nav {
            margin-top: 1.25rem;
        }
        
        a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .forgot_head {
                padding: 1.5rem;
            }
            
            h1 {
                font-size: 1.25rem;
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

/*------------------mediaqueries end--------------*/
    </style>
</head>
<body>
<section class="section"><img width="400px" src="../chat_svg/largescreen-error.svg"> Please use
Mobile devices with portrait viewport to access Amebor Chat</section>
    <main>
        <section class="forgot_head" aria-labelledby="forgot-password-heading">
            <header class="logo">
                <img src="../favicon.svg" alt="Company Logo" width="150" height="40">
            </header>
            
            <h1 id="forgot-password-heading">Forgot Password?</h1>
            <p class="instructions">Enter your email address and we'll send you a link to reset your password.</p>
           <?php


if(isset($_SESSION["correct_email"])){?>

    <b  class="alert p-2 alert-success"> Link sent to 
  <?php  echo  $_SESSION["correct_email"];
unset($_SESSION["correct_email"]);
  ?>
    </b>
<?php
}
else if(isset($_SESSION["invalid_email"])){?>
  
    <b  class="alert p-2 alert-danger"> Your Email:
   <?php echo  $_SESSION["invalid_email"];
    unset($_SESSION["invalid_email"]);
    ?>
     is Invalid</b>

   
 <?php   
}

?>
          
            
            
            <form id="forgotPasswordForm" method="POST" action="forgot-password.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your registered email"
                        required
                        aria-required="true"
                        aria-describedby="email-error"
                    >
                    <div id="email-error" class="error-message" role="alert"></div>
                </div>

                <button type="submit">Send Reset Link</button>
            </form>
            
            <nav aria-label="Secondary navigation">
                <a href="../php/login.php">Back to Login</a>
            </nav>
        </section>
    </main>

    <script src="../bootstrap5/js/bootstrap.bundle.min.js">
       
    </script>
</body>
</html>