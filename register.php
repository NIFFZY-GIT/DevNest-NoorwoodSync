<?php
require 'config.php';

if (isset($_POST["regBtn"])) {
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format");</script>';
    } else {
        // Check if email already exists
        $duplicate = "SELECT * FROM tbl_user WHERE email = ?";
        $stmt = $conn->prepare($duplicate);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<script>alert("Email has already been registered")</script>';
        } else {
            if ($password === $confirmpassword) {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                // Insert user into the database
                $query = "INSERT INTO tbl_user (fname, lname, email, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);
                
                if ($stmt->execute()) {
                    echo '<script>alert("Registration Successful"); window.location.href="login.php";</script>';
                    exit();  // Ensure redirection
                } else {
                    echo '<script>alert("Registration failed")</script>';
                }
            } else {
                echo '<script>alert("Passwords do not match")</script>';
            }
        }
        $stmt->close();  // Close the statement
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins",sans-serif;
}

        body{
            display: flex;
            justify-content: center;
            background: #017143;
            align-items: center;
            min-height: 100vh;
        }

        .login-container{
            width: 420px;
            background: transparent;
            color: #ffff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .login-container h1{
            font-size: 36px;
            text-align: center;
        }

        .login-container form .form-group{
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .login-container input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255,255,255,.2);
            border-radius: 40px;
            font-size: 16px;
            color: #ffff;
            padding: 20px 45px 20px;
        }

        .login-container form .form-group input::placeholder{
            color: #ffff;
        }

        .login-container form i{
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #ffff;
        }

        .login-container .btn{
            width: 100%;
            height: 45px;
            background: #ffff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .login-container form .signup{
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px;
        }

        .login-container p a{
            color: #ffff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-container p a:hover{
            text-decoration: underline;
            
        }
    </style>
</head>
<body>
        <header>
            <div class="hi">
         
                <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
            </div>
            
        </header>

        <div class="login-container">
            <form action="register.php" method="post">
                <h1>Register</h1>
                <div class="form-group">
                    <input type="text" name="fname" class="form-control" placeholder="First name" required>
                    <i class="fa-solid fa-user" style="color: #ffff;"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                    <i class="fa-solid fa-user" style="color: #ffff;"></i>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <i class="fa-solid fa-envelope" style="color: #ffff;"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="fa-solid fa-lock" style="color: #ffff;"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                    <i class="fa-solid fa-lock" style="color: #ffff;"></i>
                </div>
                <button class="btn" name="regBtn">Register</button>
                <div class="signup">
                    <p>Already have an account?
                    <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
</body>
</html>