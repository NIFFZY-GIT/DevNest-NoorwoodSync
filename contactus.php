<?php
require 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index-customer.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Contact Us - Norwood</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: beige;
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        section {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 70px;
        }

        .header h1 {
            font-size: 3em;
            color: #017143;
        }

        
        form {
            width: 100%;
            max-width: 600px;
            background: #C2B280;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.1em;
            color: #333;
            font-weight: bold;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #f9f9f9;
        }

        form input:focus,
        form textarea:focus {
            border-color: #017143;
            outline: none;
            background-color: #fff;
        }

        form button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #017143;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #01834d;
        }
    </style>
</head>
<body>
    <section>
        <header>
            <div class="hi">
                <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
                <h1>Norwood International</h1>
            </div>

       
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Products</a>
                    <ul class="dropdown-content">
                        <li><a href="tea.php">Tea</a></li>
                        <li><a href="bites.php">Snacks</a></li>
                    </ul>
                </li>
             
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
            </ul>


        </header>
        <div class="header">
            <h1>Contact Us</h1>
            <p>If you have any questions, feel free to reach out!</p>
        </div>
        <form method="POST" action="https://api.web3forms.com/submit">
            <input type="hidden" name="access_key" value="d0af20aa-a9d3-4bc7-93b8-aef98b60a43d">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
