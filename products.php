<?php
session_start();
require 'config.php';

$result = mysqli_query($conn, "SELECT * FROM products");

if (isset($_POST['addToCart'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['userId'];

    $query = "INSERT INTO cart (userId, productId, quantity) VALUES ('$userId', '$productId', '$quantity')";
    mysqli_query($conn, $query);
    header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 15px;
            background: #017143;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background: #014f2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product">
                <p><strong>Name:</strong> <?php echo $row['productName']; ?></p>
                <p><strong>Price:</strong> $<?php echo $row['productPrice']; ?></p>
                <form action="products.php" method="post">
                    <input type="hidden" name="productId" value="<?php echo $row['productId']; ?>">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="addToCart">Add to Cart</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>
