<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['userId']; // Assuming user ID is stored in session after login

    // Fetch product price from database
    $result = mysqli_query($conn, "SELECT price FROM tbl_product WHERE id='$productId'");
    $product = mysqli_fetch_assoc($result);
    $totalPrice = $product['price'] * $quantity;

    // Insert into cart table
    $query = "INSERT INTO tbl_cart (userId, productId, quantity, totalPrice) VALUES ('$userId', '$productId', '$quantity', '$totalPrice')";
    mysqli_query($conn, $query);

    header("Location: products.html");
    exit();
}
?>
