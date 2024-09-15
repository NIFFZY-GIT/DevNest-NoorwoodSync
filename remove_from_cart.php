<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['userId'];

    // Remove from cart table
    $query = "DELETE FROM tbl_cart WHERE userId='$userId' AND productId='$productId'";
    mysqli_query($conn, $query);

    header("Location: cart.php");
    exit();
}
?>
