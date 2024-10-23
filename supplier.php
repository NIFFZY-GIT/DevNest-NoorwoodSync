<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/supplier.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Supplier Management</title>

</head>
<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Handle adding a new supplier
if (isset($_POST['addSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $contactNumber = $_POST['contactNumber'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $productName = $_POST['productName'];

    $query = "INSERT INTO tbl_supplier (supplierId, name, email, quantity, contactNumber, location, category, productName) VALUES ('$supplierId', '$name', '$email', '$quantity', '$contactNumber', '$location', '$category', '$productName')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Supplier added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error adding supplier: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle deleting a supplier
if (isset($_POST['deleteSupplier'])) {
    $supplierId = $_POST['supplierId'];

    $query = "DELETE FROM tbl_supplier WHERE supplierId='$supplierId'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Supplier deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error deleting supplier: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle updating a supplier
if (isset($_POST['updateSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $contactNumber = $_POST['contactNumber'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $productName = $_POST['productName'];

    $query = "UPDATE tbl_supplier SET name='$name', email='$email', quantity='$quantity', contactNumber='$contactNumber', location='$location', category='$category', productName='$productName' WHERE supplierId='$supplierId'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Supplier updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating supplier: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'supplier.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle searching for a supplier
$suppliers = [];
if (isset($_POST['searchSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_supplier WHERE supplierId='$supplierId'");
    $suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($suppliers) > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Search successful! Supplier found.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'No Supplier Found',
                    text: 'No supplier found with the given ID.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
?>

<body>
<section>
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
        <div class="search-container">
    <h2>Search Supplier</h2>
    <form action="supplier.php" method="post">
        <div class="form-group">
            <label for="searchSupplierId">Supplier ID:</label>
            <input type="number" name="supplierId" id="searchSupplierId" required>
        </div>
        <div class="form-group">
            <button type="submit" name="searchSupplier">Search</button>
        </div>
    </form>

<?php if (!empty($suppliers)) { ?>
    <h2>Supplier Details</h2>
    <?php foreach ($suppliers as $row) { ?>
        <div class="supplier">
            <p><strong>ID:</strong> <?php echo $row['supplierId']; ?></p>
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
            <p><strong>Contact Number:</strong> <?php echo $row['contactNumber']; ?></p>
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Category:</strong> <?php echo $row['category']; ?></p>
            <p><strong>Product Name:</strong> <?php echo $row['productName']; ?></p>
            <div class="supplier-actions">
                <button onclick="openModal(<?php echo $row['supplierId']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', <?php echo $row['quantity']; ?>, '<?php echo $row['contactNumber']; ?>', '<?php echo $row['location']; ?>', '<?php echo $row['category']; ?>', '<?php echo $row['productName']; ?>')">Update</button>
                <form action="supplier.php" method="post" style="display:inline;">
                    <input type="hidden" name="supplierId" value="<?php echo $row['supplierId']; ?>">
                    <button type="submit" name="deleteSupplier">Delete</button>
                </form>
            </div>
        </div>
    <?php } ?>
<?php } ?>

</div>


        <h1>Supplier Management</h1>

        
        <form action="supplier.php" method="post">
    <div class="form-group">
        <label for="supplierId">Supplier ID:</label>
        <input type="number" name="supplierId" id="supplierId" required>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
    </div>
    <div class="form-group">
        <label for="contactNumber">Contact Number:</label>
        <input type="text" name="contactNumber" id="contactNumber" required>
    </div>
    <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value=""></option>
            <option value="Tea">Tea</option>
            <option value="Snacks">Snacks</option>
        </select>
    </div>
    <div class="form-group">
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" id="productName" required>
    </div>
    <div class="form-group">
        <button type="submit" name="addSupplier">Add Supplier</button>
    </div>
</form>





<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Edit Supplier</h2>
        <form action="supplier.php" method="post">
            <input type="hidden" name="supplierId" id="editSupplierId">
            <div class="form-group">
                <label for="editName">Name:</label>
                <input type="text" name="name" id="editName" required>
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" name="email" id="editEmail" required>
            </div>
            <div class="form-group">
                <label for="editQuantity">Quantity:</label>
                <input type="number" name="quantity" id="editQuantity" required>
            </div>
            <div class="form-group">
                <label for="editContactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" id="editContactNumber" required>
            </div>
            <div class="form-group">
                <label for="editLocation">Location:</label>
                <input type="text" name="location" id="editLocation" required>
            </div>
            <div class="form-group">
                <label for="editCategory">Category:</label>
                <select name="category" id="editCategory" required>
                    <option value="Tea">Tea</option>
                    <option value="Snacks">Snacks</option>
                </select>
            </div>
            <div class="form-group">
        <label for="editProductName">Product Name:</label>
        <input type="text" name="productName" id="editProductName" required>
    </div>
            <div class="form-group">
                <button type="submit" name="updateSupplier">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Function to open the modal
        function openModal(supplierId, name, email, quantity, contactNumber, location, category, productName) {
            document.getElementById("editSupplierId").value = supplierId;
            document.getElementById("editName").value = name;
            document.getElementById("editEmail").value = email;
            document.getElementById("editQuantity").value = quantity;
            document.getElementById("editContactNumber").value = contactNumber;
            document.getElementById("editLocation").value = location;
            document.getElementById("editCategory").value = category;
            document.getElementById("editProductName").value = productName;
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

<!-- <div style="text-align: right; margin: 20px;">
           <form action="report-supplier.php" method="post">
                <button type="submit" name="generate_pdf" class="btn">Generate PDF Report</button>
           </form>
        </div> -->
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