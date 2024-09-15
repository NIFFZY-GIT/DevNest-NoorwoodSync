<?php
session_start();
include 'config.php';

// Fetch user details
$userId = $_SESSION['userId'];
$userResult = mysqli_query($conn, "SELECT * FROM tbl_user WHERE userId='$userId'");
$user = mysqli_fetch_assoc($userResult);

// Fetch cart details
$cartResult = mysqli_query($conn, "SELECT c.*, p.name, p.price FROM tbl_cart c JOIN tbl_product p ON c.productId = p.id WHERE c.userId='$userId'");
$totalAmount = 0;
while ($cart = mysqli_fetch_assoc($cartResult)) {
    $totalAmount += $cart['price'] * $cart['quantity'];
}

// Handle checkout
if (isset($_POST['checkout'])) {
    $deliveryLocation = $_POST['delivery_location'];
    $mobileNumber = $_POST['mobile_number'];
    $orderDate = date('Y-m-d');
    
    // Insert order
    mysqli_query($conn, "INSERT INTO tbl_order (userId, orderDate, deliveryLocation, mobileNumber, totalAmount) VALUES ('$userId', '$orderDate', '$deliveryLocation', '$mobileNumber', '$totalAmount')");
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
    echo "<script>alert('Order placed successfully!'); window.location.href='tea.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Delivery Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f8f8f8;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group input[type="number"], .form-group input[type="date"] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
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
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($cartResult, 0);
                        while ($cart = mysqli_fetch_assoc($cartResult)): ?>
                            <tr>
                                <td><?php echo $cart['name']; ?></td>
                                <td><?php echo $cart['quantity']; ?></td>
                                <td><?php echo $cart['price']; ?></td>
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
                <input type="text" name="mobile_number" required>
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
</body>
</html>
