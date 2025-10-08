<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Expired | Regital Technologies</title>
    <link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../favicon.svg" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png" />
    <link rel="manifest" href="../site.webmanifest" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        
        h1 {
            color: #d32f2f;
            margin-top: 0;
        }
        
        p {
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .icon {
            font-size: 60px;
            color: #d32f2f;
            margin-bottom: 20px;
        }
        
        .btn {
            display: inline-block;
            background-color: #4285f4;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⌛</div>
        <h1>This Link Has Expired</h1>
        <p>The password reset link you've clicked has expired for security reasons. Password reset links are only valid for 10 minutes.</p>
        <p>Please request a new password reset link if you still need to change your password.</p>
        <a href="index.php" class="btn">Request New Reset Link</a>
    </div>
</body>
</html>