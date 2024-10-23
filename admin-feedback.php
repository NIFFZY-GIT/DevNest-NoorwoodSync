<?php
require 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/feedback.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Feedback</title>
</head>
<style>
    button[name="deleteFeedback"] {
    background-color: #ff4d4d; /* Red background */
    color: white; /* White text */
    border: none; /* Remove border */
    padding: 10px 20px; /* Add some padding */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition */
}

button[name="deleteFeedback"]:hover {
    background-color: #ff1a1a; /* Darker red on hover */
}
.button-container {
    display: flex;
    justify-content: flex-end; /* Aligns the button to the right */
    margin-top: 20px; /* Add some space at the top */
}

.delete-all-btn {
    background-color: white; 
    color: #ff4d4d; /* Red text */
    border: none; /* Remove border */
    padding: 10px 20px; /* Add some padding */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition */
}
.delete-all-btn:hover {
    background-color: #ff4d4d; /* Light red on hover */
    color: white; /* White text on hover */
}
.redh3 {
    text-align: center; /* Center-align the text */
    color: red; /* Red text color */
}

</style>
<?php
require 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['userId'];

// Handle feedback deletion
if (isset($_POST['deleteFeedback'])) {
    $feedbackId = $_POST['feedbackId'];

    $stmt = $conn->prepare("DELETE FROM tbl_feedback WHERE feedbackId=?");
    $stmt->bind_param("i", $feedbackId);
    $stmt->execute();
    $stmt->close();
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Feedback deleted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'admin-feedback.php';
                }
            });
        });
    </script>";
}

// Fetch all feedbacks
$feedbacks = $conn->query("SELECT * FROM tbl_feedback");

// Handle delete all feedback
if (isset($_POST['deleteAllFeedback'])) {
    $stmt = $conn->prepare("DELETE FROM tbl_feedback");
    $stmt->execute();
    $stmt->close();
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'All feedback deleted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'admin-feedback.php';
                }
            });
        });
    </script>";
}
?>

<body>
<section>
    <div class="circle"></div>
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
    
    <div class="container">

    <h2>All Feedbacks</h2>

    <div class="button-container">
    <form action="admin-feedback.php" method="post" style="display:inline;">
        <button type="submit" name="deleteAllFeedback" class="delete-all-btn">Delete All</button>
    </form>
</div>


<?php if ($feedbacks->num_rows > 0) { ?>
    <?php while ($row = $feedbacks->fetch_assoc()) { ?>
      
            <div class="feedback">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                <p><strong>Stars:</strong> <?php echo htmlspecialchars($row['stars']); ?></p>
                <form action="admin-feedback.php" method="post" style="display:inline;">
                    <input type="hidden" name="feedbackId" value="<?php echo $row['feedbackId']; ?>">
                    <button type="submit" name="deleteFeedback">Delete</button>
                </form>
            </div>
        <?php } ?>
    <?php } 
 else { ?>
    <h3 class="redh3">No feedback available.</h3>
<?php } ?>



    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Edit Feedback</h2>

        </div>
    </div>

</section>
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
