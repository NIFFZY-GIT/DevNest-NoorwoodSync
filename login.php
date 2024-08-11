<?php
require 'config.php';
if(isset($_POST["loginBtn"]))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $result=mysqli_query($conn,"SELECT * FROM tbl_user WHERE email='$email'");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)> 0)
    {
        if($password == $row['password'])
        {
            $_SESSION["login"]=true;
            $_SESSION["userId"]=$row["userId"];
            header("Location: customerindex.html");
            echo '<script> alert("Successfully logged in") </script>';
        }
        else
        {
            echo '<script> alert("Check the password again") </script>';
        }
    }
    else
    {
        echo '<script> alert("User not registered") </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
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