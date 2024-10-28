<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tea.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="/image/png" href="images/icon.png">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
</head>
<style>
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
</style>
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
                <li><a href="about-us.php">About Us</a></li>
            </ul>
        </header>

        <div class="products">
            <h1>Tea Products</h1>
            <?php
            include 'config.php';

            $result = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category='tea'");

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-item">';
                echo '<img src="uploaded/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' .$row['name'] . '</h3>';
                echo '<p>Price: LKR ' . $row['price'] . ' - 1 Kg</p>';

                echo '<form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">';
                echo '<div class="cart-controls">';
                echo '<label for="quantity' . $row['id'] . '">In KG: </label>';
                echo '<input type="phone" placeholder="1Kg" id="quantity' . $row['id'] . '" name="quantity" min="1" step="1" oninput="validateQuantity(this)">';
                echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="add-to-cart">Add to Cart</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            }
     



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    if (!isset($_SESSION['userId'])) {
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'You need to log in to add items to the cart.',
                    confirmButtonText: 'Login'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
              </script>";
        exit();
    }

    $productId = $_POST['product_id'];
    $quantity = floatval($_POST['quantity']); // Convert quantity to integer

    if ($quantity <= 0.9) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: 'You must include a quantity greater than 1Kg.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'tea.php';
                    }
                });
              </script>";
        exit();
    }

    $userId = $_SESSION['userId']; // Assuming user ID is stored in session after login

    // Check if the product is already in the cart
    $checkCart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE userId='$userId' AND productId='$productId'");
    if (mysqli_num_rows($checkCart) > 0) {
        echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Already in Cart',
                    text: 'This product is already in your cart. You can change the quantity from the cart.',
                    confirmButtonText: 'Go to Cart'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'cart.php';
                    }
                });
              </script>";
        exit();
    }

    // Fetch product price from database
    $result = mysqli_query($conn, "SELECT price FROM tbl_product WHERE id='$productId'");
    $product = mysqli_fetch_assoc($result);
    $totalPrice = floatval($product['price']) * $quantity; // Convert price to float

    // Insert into cart table
    $query = "INSERT INTO tbl_cart (userId, productId, quantity, totalPrice) VALUES ('$userId', '$productId', '$quantity', '$totalPrice')";
    mysqli_query($conn, $query);
    
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                text: 'Item added to cart. Quantity: $quantity',
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
        </div>
        <!-- <script>
function validateQuantity(input) {
    let value = parseFloat(input.value); // Convert the input value to a number
    if (isNaN(value)) {
        alert('Please enter a valid number.');
        input.value = ''; // Clear the input if it's not a valid number
    } else if (value % 1 !== 0) {
        alert('You cannot enter decimal numbers for the quantity.');
        input.value = Math.floor(value); // Remove the decimal part
    }
}
</script> -->

    </section>

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
    </style>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
