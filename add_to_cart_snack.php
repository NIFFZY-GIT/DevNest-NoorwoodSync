<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    if (!isset($_SESSION['userId'])) {
        echo "<script>alert('You need to log in to add items to the cart.'); window.location.href = 'login.php';</script>";
        exit();
    }

    $productId = $_POST['product_id'];
    $quantity = intval($_POST['quantity']); // Convert quantity to integer

    if ($quantity <= 1) {
        echo "<script>alert('You must include a quantity greater than 100g.'); window.location.href = 'bites.php';</script>";
        exit();
    }

    $userId = $_SESSION['userId']; // Assuming user ID is stored in session after login

    // Check if the product is already in the cart
    $checkCart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE userId='$userId' AND productId='$productId'");
    if (mysqli_num_rows($checkCart) > 0) {
        echo "<script>alert('This product is already in your cart. You can change the quantity from the cart.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    // Fetch product price from database
    $result = mysqli_query($conn, "SELECT price FROM tbl_product WHERE id='$productId'");
    $product = mysqli_fetch_assoc($result);
    $totalPrice = floatval($product['price']) * $quantity; // Convert price to float

    // Insert into cart table
    $query = "INSERT INTO tbl_cart (userId, productId, quantity, totalPrice) VALUES ('$userId', '$productId', '$quantity', '$totalPrice')";
    mysqli_query($conn, $query);
    
    echo "<script>window.location.href = 'cart.php';</script>";
    // echo "<script>alert('Item added to cart. Quantity: $quantity'); window.location.href = 'bites.php';</script>";
    exit();
}
?>
