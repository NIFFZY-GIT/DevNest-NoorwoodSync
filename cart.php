<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #F5F5DC;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center; /* Center the content horizontally */
}

h1, h2 {
    text-align: center;
    color: #343a40;
    margin-top: 20px;
}


.cart-container {
    max-width: 90%;
    width: 1200px; 
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 15px; 
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px; 
    overflow: hidden; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    border: 1px solid #e2e2e2;
    text-align: center;
    font-size: 16px;
}

th {
    background-color: #343a40;
    color: white;
}

td {
    background-color: #f9f9f9;
    border-bottom: 1px solid #ddd;
}

.product-item {
    border: 1px solid #ddd;
    padding: 15px;
    margin: 10px;
    text-align: center;
    background-color: #ffffff;
    border-radius: 10px; 
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.cart-controls {
    display: flex;
    justify-content: center;
    align-items: center;
}

.add-to-cart {
    margin-left: 15px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.add-to-cart:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.checkout-btn-container {
    text-align: center;
    margin-top: 30px;
}

.checkout-btn {
    background-color: #28a745;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s, transform 0.3s;
}

.checkout-btn:hover {
    background-color: #218838;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .cart-container {
        width: 95%;
        padding: 15px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
        font-size: 14px;
    }

    .add-to-cart, .checkout-btn {
        font-size: 14px;
        padding: 10px 18px;
    }
}
form input[type='submit'] {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form input[type='submit'][value='Update'] {
    background-color: #28a745; 
    color: white;
}

form input[type='submit'][value='Remove'] {
    background-color: #dc3545;
    color: white;
}

form input[type='submit'][value='Update']:hover {
    background-color: #218838; 
}

form input[type='submit'][value='Remove']:hover {
    background-color: #c82333;
}
    </style>
    
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include 'config.php';
            $totalPrice = 0;
            $userId = $_SESSION['userId'];

            $result = mysqli_query($conn, "SELECT c.*, p.name, p.price FROM tbl_cart c JOIN tbl_product p ON c.productId = p.id WHERE c.userId='$userId'");
            while ($row = mysqli_fetch_assoc($result)) {
                $productTotal = $row['price'] * $row['quantity'];
                $totalPrice += $productTotal;
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>
                            <form method='post' action='update_cart.php'>
                                <input type='number' name='quantity' value='{$row['quantity']}' min='1'>
                                <input type='hidden' name='product_id' value='{$row['productId']}'>
                                <input type='submit' value='Update'>
                            </form>
                        </td>
                        <td>{$row['price']}</td>
                        <td>{$productTotal}</td>
                        <td>
                            <form method='post' action='remove_from_cart.php'>
                                <input type='hidden' name='product_id' value='{$row['productId']}'>
                                <input type='submit' value='Remove'>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <h2>Total Price: <?php echo $totalPrice; ?></h2>

    <!-- Next button for checkout -->
    <div class="checkout-btn-container">
        <form action="order.php" method="get">
            <button type="submit" class="checkout-btn">Next: Checkout</button>
        </form>
    </div>
</body>
<script>
document.querySelectorAll('form[action="remove_from_cart.php"]').forEach(form => {
    form.addEventListener('submit', function(event) {
        if (!confirm('Are you sure you want to remove this item from the cart?')) {
            event.preventDefault();
        }
    });
});
</script>
</html>
