<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['addSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $contactNumber = $_POST['contactNumber'];
    $location = $_POST['location'];
    $productId = $_POST['productId'];

    $query = "INSERT INTO tbl_supplier (supplierId, name, email, quantity, contactNumber, location, productId) VALUES ('$supplierId', '$name', '$email', '$quantity', '$contactNumber', '$location', '$productId')";
    mysqli_query($conn, $query);
    echo '<script> alert("Supplier added successfully")</script>';
    header("Location: supplier.php");
}

if (isset($_POST['deleteSupplier'])) {
    $supplierId = $_POST['supplierId'];

    $query = "DELETE FROM tbl_supplier WHERE supplierId='$supplierId'";
    mysqli_query($conn, $query);
    header("Location: supplier.php");
}

if (isset($_POST['updateSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $contactNumber = $_POST['contactNumber'];
    $location = $_POST['location'];
    $productId = $_POST['productId'];

    $query = "UPDATE tbl_supplier SET name='$name', email='$email', quantity='$quantity', contactNumber='$contactNumber', location='$location', productId='$productId' WHERE supplierId='$supplierId'";
    mysqli_query($conn, $query);
    header("Location: supplier.php");
}

$suppliers = [];
if (isset($_POST['searchSupplier'])) {
    $supplierId = $_POST['supplierId'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_supplier WHERE supplierId='$supplierId'");
    $suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/supplier.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Supplier Management</title>
    <style>
        
        .container {
            width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #C2B280;
        }

        .container h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #F5F5DC;
            color: #333;
        }
        .form-group input:focus {
            border-color: #017143;
            outline: none;
        }
        .form-group button {
            padding: 12px 20px;
            background: #017143;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .form-group button:hover {
            background: #014f2a;
        }

        .search-container {
            margin-top: 30px;
            padding: 15px;
            background: #F5F5DC;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-container h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .search-container .form-group {
            margin-bottom: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }

        .btn {
           padding: 12px 20px;
           background: #017143;
           color: #fff;
           border: none;
           border-radius: 5px;
           cursor: pointer;
           font-size: 16px;
           transition: background 0.3s ease;
        }

        .btn:hover {
           background: #014f2a;
       }
    </style>
</head>
<body>
<section>
        <header>
            <div class="hi">
         
                <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
                <h1>Norwood International</h1>
            </div>


            <ul>
                <li><a href="admin-index.html">Home</a></li>
                <li><a href="admin-product.php">Products</a></li>
                <li><a href="supplier.php">Suppliers</a></li>
                <li><a href="employee.php">Employees</a></li>
                <li><a href="delivery.html">Delivery</a></li>
            </ul>
        </header>
    
    <div class="container">
        <h1>Supplier Management</h1>
        <form action="supplier.php" method="post">
            <div class="form-group">
                <label for="supplierId">Supplier ID:</label>
                <input type="number" name="supplierId" id="supplierId" required>
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
                <label for="productId">Product ID:</label>
                <input type="number" name="productId" id="productId" required>
            </div>
            <div class="form-group">
                <button type="submit" name="addSupplier">Add Supplier</button>
            </div>
        </form>

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
        </div>
        
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
                    <p><strong>Product ID:</strong> <?php echo $row['productId']; ?></p>
                    <div class="supplier-actions">
                        <button onclick="openModal(<?php echo $row['supplierId']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', <?php echo $row['quantity']; ?>, '<?php echo $row['contactNumber']; ?>', '<?php echo $row['location']; ?>', <?php echo $row['productId']; ?>)">Update</button>
                        <form action="supplier.php" method="post" style="display:inline;">
                            <input type="hidden" name="supplierId" value="<?php echo $row['supplierId']; ?>">
                            <button type="submit" name="deleteSupplier">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

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
                    <label for="editProductId">Product ID:</label>
                    <input type="number" name="productId" id="editProductId" required>
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
        function openModal(supplierId, name, email, quantity, contactNumber, location, productId) {
            document.getElementById("editSupplierId").value = supplierId;
            document.getElementById("editName").value = name;
            document.getElementById("editEmail").value = email;
            document.getElementById("editQuantity").value = quantity;
            document.getElementById("editContactNumber").value = contactNumber;
            document.getElementById("editLocation").value = location;
            document.getElementById("editProductId").value = productId;
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

<div style="text-align: right; margin: 20px;">
           <form action="report-supplier.php" method="post">
                <button type="submit" name="generate_pdf" class="btn">Generate PDF Report</button>
           </form>
        </div>
</section>
<footer class="footer">
            <div class="social">
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-brands fa-facebook" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-solid fa-envelope" style="color: #000000;"></i></a>                    
            </div>
            <p align="center"> &#169; Copyright Norwood International 2024. All rights reserved | Powered by Dev Nest</p>
            <p align="center"> Established in 2022</p>
            <p align="center"> Privacy Policy | Terms of Service | Contact Us</p>
            <br>
        </footer>
</body>
</html>
