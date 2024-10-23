<?php
// Include your database connection file
include 'config.php';

// Function to fetch count from a table
function fetchCount($conn, $tableName) {
    $query = "SELECT COUNT(*) AS count FROM $tableName";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $data = mysqli_fetch_assoc($result);
    return $data['count'];
}

// Fetch counts
$supplierCount = fetchCount($conn, 'tbl_supplier');
$productCount = fetchCount($conn, 'tbl_product');
$employeeCount = fetchCount($conn, 'tbl_employee');
$feedbackCount = fetchCount($conn, 'tbl_feedback');
$orderCount = fetchCount($conn, 'tbl_order');
$userCount = fetchCount($conn, 'tbl_user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* background-color: #f0f2f5; */
            /* background: #017143; */
            margin: 0;
            padding: 0;
            color: #333;
            background: beige
        }
        .header {
            background: #017143;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
        }
        .home-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .home-button:hover {
            background-color: #388E3C;
        }
        .main-content {
            padding: 20px;
            text-align: center;
        }
        .main-content h2 {
            margin-bottom: 30px;
            color: #333;
        }
        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: calc(33% - 40px);
            text-align: center;
            color: #333;
        }
        .card h3 {
            margin-bottom: 20px;
        }
        .card p {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .card a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .card a:hover {
            color: #388E3C;
        }
        .user-count {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 50%;
            text-align: center;
            color: #333;
        }
        .user-count h3 {
            margin-bottom: 20px;
        }
        .user-count p {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .card .btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 5px;
    font-size: 1em;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.card .btn:hover {
    background-color: #0056b3;
    color: #fff;
}

.card .report-btn {
    background-color: #28a745;
    display: block;
    margin: 10px auto;
}

.card .report-btn:hover {
    background-color: #218838;
}

footer{
    background-color: #f5f5dc;
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
</head>
<body>
    <header class="header">
        <h1>Admin Dashboard</h1>
        <a href="admin-index.php" class="home-button">Go Home</a>
    </header>
    <div class="main-content">
       
        <h2>Norwood Tea International</h2>
       
        <div class="card-container">
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $userCount; ?> Users</p>
        </div>
            <div class="card">
                <h3>Manage Products</h3>
                <p><?php echo $productCount; ?> Products</p>
                <form action="report-product.php" method="post">
        <button type="submit" name="generate_product_pdf" class="btn report-btn">Generate PDF Report</button>
    </form>
                <a href="admin-product.php" class="btn">Go to Products</a>
            </div>
            <div class="card">
                <h3>Manage Suppliers</h3>
                <p><?php echo $supplierCount; ?> Suppliers</p>
                <form action="report-supplier.php" method="post">
        <button type="submit" name="generate_supplier_pdf" class="btn report-btn">Generate PDF Report</button>
    </form>
                <a href="supplier.php" class="btn">Go to Suppliers</a>
            </div>
            <div class="card">
                <h3>Manage Employees</h3>
                <p><?php echo $employeeCount; ?> Employees</p>
                <form action="report-employee.php" method="post">
        <button type="submit" name="generate_employee_pdf" class="btn report-btn">Generate PDF Report</button>
    </form>
                <a href="employee.php" class="btn">Go to Employees</a>
            </div>
            <div class="card">
    <h3>Manage Feedback</h3>
    <p><?php echo $feedbackCount; ?> Feedbacks</p>
    <form action="report-feedback.php" method="post">
        <button type="submit" name="generat_feedback_pdf" class="btn report-btn">Generate PDF Report</button>
    </form>
    <a href="admin-feedback.php" class="btn">Go to Feedbacks</a>

</div>

            <div class="card">
                <h3>Manage Orders</h3>
                <p><?php echo $orderCount; ?> Orders</p>
                <form action="report-order.php" method="post">
        <button type="submit" name="generate_order_pdf" class="btn report-btn">Generate PDF Report</button>
    </form>
                <a href="admin_order.php" class="btn">Go to Orders</a>
            </div>
        </div>
    </div>
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


