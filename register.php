<?php
session_start();
include 'config.php'; // Include your database connection file

// Check if the registration form was submitted
if (isset($_POST['regBtn'])) {
    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
    if (!$stmt) {
        die("Database query failed: " . $conn->error); // Display error if the query fails
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "
            <script>
document.addEventListener('DOMContentLoaded', function() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-lg', // Blue, large login button
            cancelButton: 'btn btn-warning btn-lg text-white' // Yellow button with white text
        },
        buttonsStyling: false // Disable default styling to use custom Bootstrap styles
    });

    swalWithBootstrapButtons.fire({
        title: 'This email is already registered!',
        text: 'Please try logging in or use a different email.',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: '🔑Log In', // Adding emoji for a friendlier look
        cancelButtonText: '✉️ Use Another Email',
        reverseButtons: true // Swap positions of buttons
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to login.php
            window.location.href = 'login.php';
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Redirect to register.php
            window.location.href = 'register.php';
        }
    });
});
</script>

";
    } else {
        // Generate a random verification code
        $verification_code = rand(100000, 999999);

        // Store user details in the session
        $_SESSION['user_email'] = $email;
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['user_details'] = [
            'fname' => $fname,
            'lname' => $lname,
            'password' => password_hash($password, PASSWORD_DEFAULT) // Store hashed password
        ];

        // Send verification code via email
        $to = $email;
        $subject = "Your Verification Code - Norwood Lanka Teas International";
        $message = "Dear Valued Customer,\n\nThank you for choosing Norwood Lanka Teas International! We're thrilled to welcome you to our community of tea enthusiasts.\n\nTo ensure the security of your account, please use the following verification code to complete your registration process:\n\n Verification Code: $verification_code  \n\nThis code is valid for the next 30 minutes. If you did not initiate this request, please disregard this email.\n\nWe look forward to providing you with the finest teas and snacks. If you have any questions or need assistance, feel free to contact us at norwoodteas@gmail.com.\n\nWarm Regards,\nNorwood Lanka Teas International Team";
        $headers = "From: noreply@norwoodteas.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Verification code sent! Please check your email.";
            // Redirect to the verification page
            header("Location: verify.php");
            exit();
        } else {
            echo "Failed to send verification code.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <!-- Include SweetAlert2 and Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
    <style>



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            background: #017143;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            width: 420px;
            background: transparent;
            color: #ffff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .login-container h1 {
            font-size: 36px;
            text-align: center;
        }

        .login-container form .form-group {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .login-container input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #ffff;
            padding: 20px 45px 20px;
        }

        .login-container form .form-group input::placeholder {
            color: #ffff;
        }

        .login-container form i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #ffff;
        }

        .login-container .btn {
            width: 100%;
            height: 45px;
            background: #ffff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .login-container form .signup {
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px;
        }

        .login-container p a {
            color: #ffff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-container p a:hover {
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
    <input type="password" name="password" id="password" class="form-control" 
           placeholder="Password" minlength="8" required
           pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
           title="Password must contain at least 8 characters, one uppercase letter, one number, and one special character.">
    <i class="fa-solid fa-lock" style="color: #fff;"></i>
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
