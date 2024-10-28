<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Delivery Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
window.embeddedChatbotConfig = {
chatbotId: "xYab3amLnm91LwMETAtb3",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="xYab3amLnm91LwMETAtb3"
domain="www.chatbase.co"
defer>
</script>
    <style>
@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins';
    
}

body {
    padding-top: 100px; /* Adjust this value based on your header's height */
    background-color: #f5f5dc;
}

header {

    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f5f5dc;
    color: white;
    z-index: 1000;
}

header .hi {
    display: flex;
    position: relative;
    border-radius: 100%;
    align-content: center;
}

header .hi h1 {
    font-size: 30px;
    align-content: center;
}

.hi {
    color: black;
    font-family: "Kanit", sans-serif;
    font-weight: 100;
    font-style: normal;
}

header ul {
    position: relative;
    display: flex;
}

header ul li {
    list-style: none;
}

header ul li a {
    display: inline-block;
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    font-size: 18px;
    text-decoration: none;
    transition: 0.1s;
}

header ul li a:hover {
    color: #017143;
    font-weight: bold;
}

img .logo {
    width: 80px;
    height: 100px;
}

.dropdown {
    position: relative;
}

.dropdown .dropbtn {
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    border-radius: 20px;
    width: 100%;
    background-color: beige;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

.dropdown-content li {
    list-style: none;
}

.dropdown-content li a {
    color: #333;
    display: block;
    text-align: left;
    font-size: 16px;
    transition: background-color 0.3s;
}

.dropdown-content li a:hover {
    background-color: #017143;
    color: #fff;
}


.dropdown:hover .dropdown-content {
    display: block;
}


header ul {
    display: flex;
    list-style: none;
}

header ul li {
    position: relative;
}

header ul li a {
    text-decoration: none;
    font-size: 18px;
    color: #333;
    margin-left: 40px;
    padding: 10px;
    transition: color 0.3s;
}
.imgBox img {
    width: 100%; /* Adjusted width */
    height: auto;

}
.dropdown ul li a{
    margin: 0px;
    border-radius: 20px;
}

header ul li a:hover {
    color: #017143;
}

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: auto;
            flex: 1;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[type="text"]:disabled,
        .form-group input[type="date"]:disabled {
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f4f4f9;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
     
        footer{
    background-color: #f5f5dc;
}

footer .social{
    display: flex;
    justify-content: center;
}

footer .social a{
   font-size: 40px;
   padding: 10px;

}

    </style>
</head>
<body>
<?php
// Fetch user details
$userId = $_SESSION['userId'];
$userResult = mysqli_query($conn, "SELECT * FROM tbl_user WHERE userId='$userId'");
$user = mysqli_fetch_assoc($userResult);

// Fetch cart details
$cartResult = mysqli_query($conn, "SELECT c.*, p.name, p.price FROM tbl_cart c JOIN tbl_product p ON c.productId = p.id WHERE c.userId='$userId'");
$totalAmount = 0;

while ($cart = mysqli_fetch_assoc($cartResult)) {
    $totalAmount += $cart['totalPrice'];
}
$formattedTotalAmount = number_format($totalAmount, 2, '.', ''); // Ensure it's a float with 2 decimal points

// Handle checkout
if (isset($_POST['checkout'])) {
    $deliveryLocation = $_POST['delivery_location'];
    $mobileNumber = $_POST['mobile_number'];
    $orderDate = date('Y-m-d');
    
    // Insert order
    mysqli_query($conn, "INSERT INTO tbl_order (userId, orderDate, deliveryLocation, mobileNumber, totalAmount) VALUES ('$userId', '$orderDate', '$deliveryLocation', '$mobileNumber', '$formattedTotalAmount')");
    $orderId = mysqli_insert_id($conn);
    
    // Insert order details
    mysqli_data_seek($cartResult, 0);
    while ($cart = mysqli_fetch_assoc($cartResult)) {
        $productId = $cart['productId'];
        $quantity = $cart['quantity'];
        $price = $cart['price'];
        mysqli_query($conn, "INSERT INTO tbl_order_details (orderId, productId, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$price')");
    }
    
    // Clear cart
    mysqli_query($conn, "DELETE FROM tbl_cart WHERE userId='$userId'");
    
    // Redirect to home.php after successful order placement
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Order placed successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        });
    </script>";
    exit();
}
?>

<header>
            <div class="hi">
                <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
                <h1>Norwood International</h1>
            </div>

       
            <ul class="nav-links">
                <li><a href="customer-index.html">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Products</a>
                    <ul class="dropdown-content">
                        <li><a href="tea.php">Tea</a></li>
                        <li><a href="bites.php">Snacks</a></li>
                    </ul>
                </li>
             
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>


        </header>
    <div class="container">
        <h1>Customer Delivery Page</h1>
        <form method="post">
            <div class="form-group">
                <label>Order Number:</label>
                <input type="text" value="<?php echo uniqid(); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Customer Name:</label>
                <input type="text" value="<?php echo $user['fname'] . ' ' . $user['lname']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Products:</label>
                <table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity (In Grams)</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        mysqli_data_seek($cartResult, 0);
        while ($cart = mysqli_fetch_assoc($cartResult)): 
            $pricePerGram = $cart['price']; // Calculate price per gram
            $productTotal = $pricePerGram * $cart['quantity']; // Calculate total price based on actual quantity
        ?>
        <tr>
            <td><?php echo $cart['name']; ?></td>
            <td><?php echo $cart['quantity']; ?>g</td>
            <td><?php echo number_format($cart['price'], 2); ?></td>
            <td><?php echo number_format($productTotal, 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

            </div>
            <div class="form-group">
                <label>Delivery Location:</label>
                <input type="text" name="delivery_location" required>
            </div>
            <div class="form-group">
                <label>Mobile Number:</label>
                <input type="text" name="mobile_number" pattern="\d{10}" maxlength="10" placeholder="+94 xxx-xxx-xxxx" required>

            </div>
            <div class="form-group">
                <label>Order Date:</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Total Amount:</label>
                <input type="text" value="<?php echo $totalAmount; ?>" disabled>
            </div>
            <div class="form-group">
                <button type="submit" name="checkout">Checkout</button>
            </div>
        </form>
    </div>
    <footer class="footer">
            <div class="social">
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-brands fa-facebook" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-solid fa-envelope" style="color: #000000;"></i></a>                    
            </div>
            <p align="center"> © Copyright Norwood.lk 2023. All rights reserved</p>
            <p align="center"> Established in 2022</p>
            <p align="center"> Privacy Policy | Terms of Service | Contact Us</p>
            <br>
        </footer>
</body>
</html>
