<?php
session_start();
include 'config.php';
?>
<style>
   @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins';

}
body{
    background: beige
}

section {
    position: relative;
    width: 100%;
    min-height: 100vh;
    padding: 100px;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    background: beige;
}


header{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
 
}

header .hi{
    display: flex;
    position: relative;
/* background-color: #d4af37; */
border-radius: 100%;

    align-content: center;
  
}

header .hi h1{


    font-size: 30px;
    align-content: center;
}
.hi{
color: black;
font-family: "Kanit", sans-serif;
font-weight: 100;
font-style: normal;
}


header ul{
    position: relative;
    display: flex;
}

header ul li{
    list-style: none;
}

header ul li a{
    display: inline-block;
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    font-size: 18PX;
    text-decoration: none;
    transition: 0.1s;
}
header ul li a:hover{
    color: #017143;
    font-weight: bold;
}

img .logo{
    width: 80px;  /* Set the width to 200 pixels */
    height: 100px; /* Set the height to 100 pixels */
}


.topic
{
    color: #0b422b;
    margin: 180px 50px 10px 80px;
    justify-content: space-between;
}

.info
{
    margin: 10px 50px 0px 80px;
    color: #017143;
}

.container {
    width: 90%;
    margin: 20px auto;
    margin-bottom: 20px;
    padding: 20px 20px 20px 20px;

    border-radius: 8px;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
}
/* h1 {
    text-align: center;
    color: #0b422b;
    padding-bottom: 20px;
} */

table {
    border-collapse: collapse;
    margin: 0px 0 20px 0;
    font-size: 0.9em;
    /* min-width: 600px; */
    width: 100%;
    align-items: center;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0);
    
}
table thead
{
    background-color: #017143;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

tbody tr{
    border-bottom: 1px solid #dddddd;
}

tbody tr:nth-of-type(even)
{
    background-color: #50ba5d;
    color: #100f0f;
}

tbody tr:last-of-type
{
    border-bottom: 2px solid #017143;
}

.delete
{
    font-size: 15px;
    background-color: rgba(232, 74, 74, 0.747);
    padding: 10px 24px;
    border-radius: 8px;
    border-color: rgba(232, 74, 74, 0.747);
    box-shadow: none;
    
    
}
.delete:hover
{
    background-color: #e78686;
    font-weight: bold;
}
.button3
{
    font-size: 15px;
    background-color: rgb(232, 222, 27);
    padding: 10px 24px;
    border-radius: 8px;
    border-color: rgb(232, 222, 27);
    box-shadow: none;   
}
.button3:hover
{
    background-color: #ece48d;
    font-weight: bold;
}

input[type="text"], select {
    padding: 8px;
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #017143;
    border-radius: 5px;
}

footer{
    background-color: #f5f5dc;
    margin-top: 10px;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Management</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adr.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
</head>
<body>

<?php
// Fetch all orders
$orderResult = mysqli_query($conn, "SELECT o.*, u.fname, u.lname FROM tbl_order o JOIN tbl_user u ON o.userId = u.userId");

// Handle order status update
if (isset($_POST['update_order'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    $deliveryLocation = $_POST['delivery_location'];
    if (mysqli_query($conn, "UPDATE tbl_order SET status='$status', deliveryLocation='$deliveryLocation' WHERE orderId='$orderId'")) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Order updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating order: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle order deletion
if (isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete from tbl_order_details first
        mysqli_query($conn, "DELETE FROM tbl_order_details WHERE orderId='$orderId'");

        // Delete from tbl_order
        mysqli_query($conn, "DELETE FROM tbl_order WHERE orderId='$orderId'");

        // Commit transaction
        mysqli_commit($conn);

        // Redirect after successful deletion
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Order deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                    }
                });
            });
        </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction if any query fails
        mysqli_rollback($conn);
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to delete order: " . $e->getMessage() . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                    }
                });
            });
        </script>";
    }
}
?>

<header>
            <div class="hi">
                <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
                <h1>Norwood International</h1>
            </div>


            <ul>
                <li><a href="admin-index.php">Home</a></li>
                <li><a href="admin-product.php">Products</a></li>
                <li><a href="supplier.php">Suppliers</a></li>
                <li><a href="employee.php">Employees</a></li>
                <li><a href="admin_order.php">Orders</a></li>
                <li><a href="admin-feedback.php">Feedback</a></li>
                <li><a href="admin-dashboard.php">Dashboard</a></li>
            </ul>
        </header>

        
        <h2 class="topic">Order Details</h2>
        <!-- <p class="info">In the delivery details section, you can review and manage all orders with their details. You can view and edit many information 
        such as IDs of all orders, ordered products, order date, price and order status.Access to this area is limited. Only administrater and team leaders can reach. 
        The changes you make will be approved after they are checked. </p> -->

    <div class="container">
        <h1></h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Delivery Location</th>
                    <th>Total Amount</th>
                    <th>Products</th>
                    <th>Quantity (In Grams)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($orderResult)): ?>
                    <tr>
                        <td><?php echo $order['orderId']; ?></td>
                        <td><?php echo $order['fname'] . ' ' . $order['lname']; ?></td>
                        <td><?php echo $order['orderDate']; ?></td>
                        <td>
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="order_id" value="<?php echo $order['orderId']; ?>">
                                <input type="text" name="delivery_location" value="<?php echo $order['deliveryLocation']; ?>">
                        </td>
                        <td><?php echo $order['totalAmount']; ?></td>
                        <td>
                            <?php
                            $orderId = $order['orderId'];
                            $productResult = mysqli_query($conn, "SELECT p.name, od.quantity FROM tbl_order_details od JOIN tbl_product p ON od.productId = p.id WHERE od.orderId='$orderId'");
                            while ($product = mysqli_fetch_assoc($productResult)) {
                                echo $product['name'] . '<br>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            mysqli_data_seek($productResult, 0);
                            while ($product = mysqli_fetch_assoc($productResult)) {
                                echo $product['quantity'] . 'g<br>';
                            }
                            ?>
                        </td>
                        <td>
                            <select name="status">
                                <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Confirmed" <?php if ($order['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                        </td>
                        <td>
                                <button type="submit" name="update_order" class="button3">Update</button>
                            </form>
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="order_id" value="<?php echo $order['orderId']; ?>">
                                <button type="submit" name="delete_order" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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