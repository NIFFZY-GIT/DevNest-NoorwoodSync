<?php
session_start();
include 'config.php'; // Include your database connection file

// Check if the verification form was submitted
if (isset($_POST['verifyBtn'])) {
    // Get the verification code entered by the user
    $user_input_code = $_POST['verification_pin'];

    // Check if the input code matches the stored code
    if ($user_input_code == $_SESSION['verification_code']) {
        // Insert user details into the database
        $user_email = $_SESSION['user_email'];
        $user_fname = $_SESSION['user_details']['fname'];
        $user_lname = $_SESSION['user_details']['lname'];
        $user_password = $_SESSION['user_details']['password'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO tbl_user (fname, lname, email, password) VALUES (?, ?, ?, ?)");

        
        
        // Check if preparation was successful
        if (!$stmt) {
            die("Prepare failed: " . $conn->error); // Output error if preparation fails
        }

        // Bind parameters and execute
        $stmt->bind_param("ssss", $user_fname, $user_lname, $user_email, $user_password);

        if ($stmt->execute()) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Employee deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            });
        </script>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Verification Successfull!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        });
    </script>";
            // Optionally, redirect to a login page or a welcome page
            // header("Location: login.php");
            // exit();
        } else {
            echo "Error: " . $stmt->error; // Output execution error
        }

        // Close the statement
        $stmt->close();

        // Clear session variables
        unset($_SESSION['user_email']);
        unset($_SESSION['verification_code']);
        unset($_SESSION['user_details']);
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Invalid verification code!',
                    text: 'Please enter a valid verification code sent through email!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'verify.php';
                    }
                });
            });
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Pin</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #017143;
        }

        /* .verify-container {
            width: 400px;
            padding: 40px 30px;
            background: #017143;
            border-radius: 12px;
            box-shadow: 0 8px 32px #021f00;
            text-align: center;
        } */

        .verify-container h1 {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 200;
            color:white;
            justify-content: center;
            align-items: center;
            
        }

        .verify-container input {
            width: 100%;
            margin-top: 10px;
            padding: 15px;
            border: 5px solid rgba(255, 255, 255, 0.5);
            border-radius: 50px;
            background: transparent;
            outline: none;
            color: #333;
            font-size: 18px;
            color:white;
        }
  

        ::placeholder{
            color:white;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #f0f0f0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <form action="verify.php" method="post">
            <div class="hh">
            <h1>Please Check Your email for the verification pin</h1>
            </div>
            <input type="text" name="verification_pin" placeholder="Enter the pin" required>
            <button class="btn" name="verifyBtn">Verify</button>
        </form>
    </div>
</body>
</html>
