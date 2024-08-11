<?php
require 'config.php';
if(isset($_POST["regBtn"]))
{
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];
    $duplicate="SELECT * FROM tbl_user WHERE email='$email'";
    $result=$conn->query($duplicate);

    if($result->num_rows>0)
    {
        echo '<script> alert("Email has been already registered") </script>';
    }
    else
    {
        if($password == $confirmpassword)
        {
            $query="INSERT INTO tbl_user  VALUES('','$fname','$lname','$email','$password')";
            mysqli_query($conn,$query);
            echo '<script> alert("Registration Successful") </script>';
            header("Location: login.html");
        }
        else
        {
            echo '<script> alert("Password does not match") </script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>

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