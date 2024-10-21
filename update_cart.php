<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['userId'];

    // Check if quantity is less than 100
    if ($quantity < 1) {
        echo "<script>alert('You must input a value more than 100 grams'); window.location.href='cart.php';</script>";
        exit();
    }

    // Fetch product price from database
    $result = mysqli_query($conn, "SELECT price FROM tbl_product WHERE id='$productId'");
    $product = mysqli_fetch_assoc($result);
    $totalPrice = $product['price'] * $quantity;

    // Update cart table
    $query = "UPDATE tbl_cart SET quantity='$quantity', totalPrice='$totalPrice' WHERE userId='$userId' AND productId='$productId'";
    mysqli_query($conn, $query);

    header("Location: cart.php");
    exit();
}
?>
