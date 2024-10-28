<?php
// Start output buffering
ob_start();

// Check if a session is already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// End output buffering and flush the output
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

    <title>Your Page Title</title>
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
    position: fixed;
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



.cart {
    max-width: 800px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
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
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f8f8;
}

tr:hover {
    background-color: #f1f1f1;
}

.checkout-btn-container {
    display: flex;
    justify-content: space-between;
}

.checkout-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.checkout-btn:hover {
    background-color: #218838;
}

.remove-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.remove-btn:hover {
    background-color: #c82333;
}

input[type="number"] {
    width: 80px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

footer {
   
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #f5f5dc;

    text-align: center;
    padding: 10px 0;
    z-index: 1000;
}

footer .social{
    display: flex;
    justify-content: center;
}

footer .social a{
   font-size: 40px;
   padding: 10px;
}
table {
    width: 100%; /* Ensure the table takes up the full width of its container */
    border-collapse: collapse; /* Optional: for cleaner borders */
}

.total-price-row {
    background-color: #f8f9fa;
    border-top: 2px solid #343a40;
    font-weight: bold;
    font-size: 1.2rem;
    padding: 15px 10px;
}

.total-price-row td {
    padding: 15px;
}

.total-price-value {
    color: #28a745;
    font-size: 1.5rem;
    text-align: right; /* Aligns the total price value to the right */
}



     
    </style>
</head>
<body>

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
                <li><a href="about-us.php">About Us</a></li>
            </ul>


        </header>

<div class="cart">
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Weight (Kg)</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
 

        <?php
include 'config.php';


$totalPrice = 0;
$userId = $_SESSION['userId'];

// Handle form submission for updating cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if quantity is less than 1 kg
    if ($quantity < 1) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: 'You must input a value more than 100 grams.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . htmlspecialchars($_SERVER['PHP_SELF']) . "';
                    }
                });
              </script>";
        exit();
    }

    // Fetch product price from database
    $result = mysqli_query($conn, "SELECT price FROM tbl_product WHERE id='$productId'");
    $product = mysqli_fetch_assoc($result);
    $totalPrice = $product['price'] * $quantity;

    // Update cart table
    $query = "UPDATE tbl_cart SET quantity='$quantity', totalPrice='$totalPrice' WHERE userId='$userId' AND productId='$productId'";
    mysqli_query($conn, $query);

    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Cart Updated',
                text: 'Your cart has been updated.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . htmlspecialchars($_SERVER['PHP_SELF']) . "';
                }
            });
          </script>";
    exit();
}

// Fetch cart items for the user
$result = mysqli_query($conn, "SELECT c.*, p.name, p.price FROM tbl_cart c JOIN tbl_product p ON c.productId = p.id WHERE c.userId='$userId'");
while ($row = mysqli_fetch_assoc($result)) {
    $pricePerKg = $row['price']; // Assuming price is already per kg
    $quantityInKg = $row['quantity']; // Quantity is already in kilograms
    
    // Calculate total price based on actual quantity in kilograms
    $productTotal = $pricePerKg * $quantityInKg;
    
    $totalPrice += $productTotal;

    // Display product information and a form to update quantity
    echo "<tr>
            <td>{$row['name']}</td>
            <td>
               <form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                   <input type='number' name='quantity' value='" . number_format($quantityInKg, 2) . "' step='0.001' min='0.001'>
                   <input type='hidden' name='product_id' value='{$row['productId']}'>
                   <input type='submit' value='Update' class='checkout-btn'>
               </form>
            </td>
            <td>" . number_format($pricePerKg, 2) . "</td>
            <td>" . number_format($productTotal, 2) . "</td>
            <td>
               <form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                    <input type='hidden' name='product_id' value='{$row['productId']}'>
                    <input type='submit' value='Remove' class='remove-btn'>
                </form>
            </td>
          </tr>";
}

// Display total price
echo "<tr class='total-price-row'>
        <td colspan='4'>Total Price</td>
        <td class='total-price-value'>LKR " . number_format($totalPrice, 2) . "</td>
      </tr>";
?>

<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['userId'];

    // Remove from cart table
    $query = "DELETE FROM tbl_cart WHERE userId='$userId' AND productId='$productId'";
    mysqli_query($conn, $query);

    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Removed from Cart',
                text: 'The item has been removed from your cart.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'cart.php';
                }
            });
          </script>";
    exit();
}
?>


        </tbody>
    </table>
    <!-- <h2>Total Price: <?php echo $totalPrice; ?></h2> -->

    <div class="checkout-btn-container">
    <form method="post" action="report-cart.php">
            <button type="submit" class="checkout-btn" name="generate_cart_invoice">Download Invoice</button>
        </form>

        <form action="order.php" method="get">
            <button type="submit" class="checkout-btn"> Next</button>
        </form>

     
    </div>
</div>

  
</head>
<body>

<main>
    <!-- Your page content goes here -->
</main>

<footer style="background-color: #f5f5dc; color: #017143; padding: 20px 0; text-align: center; font-family: Arial, sans-serif;">
    <div style="margin-bottom: 10px;">
        <h3 style="margin-bottom: 15px;">Connect with Us</h3>
    </div>
    <div style="font-size: 24px;">
        <a href="https://wa.me/94716195982" style="margin: 0 15px; color: #25D366; text-decoration: none;">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/norwoodteasinternational/" style="margin: 0 15px; color: #4267B2; text-decoration: none;">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="mailto:norwoodlankateasinternational@gmail.com">
  <i class="fa-solid fa-envelope" style="margin: 0 15px; color: #DA3902;"></i>
</a>

    </div>
    <div style="margin-top: 15px; font-size: 14px;">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </div>
    <style>
        footer a:hover {
            color: #ffffff;
        }

        footer i {
            transition: transform 0.3s ease;
        }

        footer a:hover i {
            transform: scale(1.2);
        }
  
     
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #f5f5dc;
             color: #017143;
      
            padding: 20px 0;
            text-align: center;
        }

      
    </style>
</footer>

</body>
</html>

<script>
document.querySelectorAll('form[action="remove_from_cart.php"]').forEach(form => {
    form.addEventListener('submit', function(event) {
        if (!confirm('Are you sure you want to remove this item from the cart?')) {
            event.preventDefault();
        }
    });
});
</script>
</body>
</html>
