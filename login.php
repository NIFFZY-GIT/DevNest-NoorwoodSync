<?php
session_start();
require 'config.php';

if (isset($_POST["loginBtn"])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Invalid Email Format!',
                text: 'Please enter a valid email address.',
                icon: 'error',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: You can redirect or perform any other action if needed
                    // window.location.href = 'login.php'; // Uncomment if you want to redirect
                }
            });
        });
      </script>";
    } else {
        // Use prepared statement to fetch user
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            // Verify password
            if (password_verify($password, $row['password'])) {
                $_SESSION["login"] = true;  // Set login status
                $_SESSION["userId"] = $row["userId"];
                $_SESSION["userType"] = $row["userType"];

                // Redirect based on user type
                if ($row['userType'] == 'admin') {
                    echo '<script>window.location.href="admin-dashboard.php";</script>';
                } else {
                    echo '<script>window.location.href="index.php";</script>';
                }
                exit(); // Stop script after redirection
            } else {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Incorrect Password!',
                        text: 'Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Optional: You can redirect to the login page or perform another action if needed
                            // window.location.href = 'login.php'; // Uncomment if you want to redirect
                        }
                    });
                });
            </script>";
    
            }
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'User is not Rejistered!',
                    text: 'Please register first!',
                    icon: 'error',
                    confirmButtonText: 'Register'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'register.php';
                    }
                });
            });
        </script>";
        }
        $stmt->close(); // Close the statement
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
      <!-- Include SweetAlert CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <form action="login.php" method="post">
                <h1>Login</h1>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <i class="fa-solid fa-user" style="color: #ffff;"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="fa-solid fa-lock" style="color: #ffff;"></i>
                </div>
                <button class="btn" name="loginBtn">Login</button>
                <div class="signup">
                    <p>Don't have an account?
                    <a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
</body>
</html>