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
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            background-color: #4CAF50;
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
    </style>
</head>
<body>
    <header class="header">
        <h1>Admin Dashboard</h1>
        <a href="admin-index.html" class="home-button">Go Home</a>
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
                <a href="admin-product.php">Go to Products</a>
            </div>
            <div class="card">
                <h3>Manage Suppliers</h3>
                <p><?php echo $supplierCount; ?> Suppliers</p>
                <a href="supplier.php">Go to Suppliers</a>
            </div>
            <div class="card">
                <h3>Manage Employees</h3>
                <p><?php echo $employeeCount; ?> Employees</p>
                <a href="employee.php">Go to Employees</a>
            </div>
            <div class="card">
                <h3>Manage Feedback</h3>
                <p><?php echo $feedbackCount; ?> Feedbacks</p>
                <a href="feedback.php">Go to Feedbacks</a>
            </div>
            <div class="card">
                <h3>Manage Orders</h3>
                <p><?php echo $orderCount; ?> Orders</p>
                <a href="admin_order.php">Go to Orders</a>
            </div>
        </div>
    </div>
</body>
</html>
