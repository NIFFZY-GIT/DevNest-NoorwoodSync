<?php
session_start();
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
    <title>Supplier Management</title>
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
        .supplier {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .supplier-actions {
            margin-top: 10px;
        }
        .supplier-actions button {
            margin-right: 5px;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
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

    <!-- The Modal -->
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
</body>
</html>
