<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminproducts.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
    <style>
  .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        h2 {
            margin-top: 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<?php
@include 'config.php';

// Handle adding a new product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_category = $_POST['product-type'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded/' . $product_image;

    // Check if any required fields are empty
    if (empty($product_name) || empty($product_price) || empty($product_image)) {
        $message[] = 'Please fill out all fields';
    } else {
        // Insert product into the database
        $insert = "INSERT INTO tbl_product(name, price, image, category) VALUES ('$product_name', '$product_price', '$product_image', '$product_category')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            // Move uploaded image to the designated folder
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New Product added successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Could not add the product',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
    }
}

// Handle updating a product
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $update_name = $_POST['update_product_name'];
    $update_price = $_POST['update_product_price'];
    $update_image = $_FILES['update_product_image']['name'];
    $update_category = $_POST['update_product_category'];
    $update_image_tmp_name = $_FILES['update_product_image']['tmp_name'];
    $update_image_folder = 'uploaded/' . $update_image;

    // Build the update query dynamically based on provided fields
    $update_query = "UPDATE tbl_product SET";

    if (!empty($update_name)) {
        $update_query .= " name='$update_name',";
    }

    if (!empty($update_price)) {
        $update_query .= " price='$update_price',";
    }

    if (!empty($update_category)) {
        $update_query .= " category='$update_category',";
    }

    if (!empty($update_image)) {
        $update_query .= " image='$update_image',";
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
    }

    // Remove the last comma
    $update_query = rtrim($update_query, ',');

    $update_query .= " WHERE id='$product_id'";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Product updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Could not update the product',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

// Handle deleting a product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (mysqli_query($conn, "DELETE FROM tbl_product WHERE id=$id")) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Product deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'admin-product.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error deleting product: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'admin-product.php';
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

<div class="container">
    <div class="form-box">
        <h2>Add a New Product</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter product name" required>
            <input type="number" name="product_price" placeholder="Enter product price" required>
            <input type="file" name="product_image" accept="image/png, image/jpg, image/jpeg" required>
            <select class="productType" name="product-type">
                <option value="">None</option>
                <option value="tea">Tea</option>
                <option value="snacks">Snacks</option>
            </select>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>
</div>

<?php
$select = mysqli_query($conn, "SELECT * FROM tbl_product");
?>

<div class="product-display">
    <table class="product-display-table">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><img src="uploaded/<?php echo $row['image']; ?>" height="100px"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td>
                    <a class="btn1" 
                        data-id="<?php echo $row['id']; ?>" 
                        data-name="<?php echo $row['name']; ?>" 
                        data-price="<?php echo $row['price']; ?>" 
                        data-category="<?php echo $row['category']; ?>"
                        data-image="<?php echo $row['image']; ?>">
                        <i class="fas fa-edit"></i> Update
                    </a>
                    <a href="admin-product.php?delete=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>
        <?php }; ?>
    </table>
</div>


<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Product</h2>
        <form id="updateForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" id="product_id">
            <input type="text" name="update_product_name" id="update_product_name" placeholder="Enter product name">
            <input type="number" name="update_product_price" id="update_product_price" placeholder="Enter product price">
            <input type="file" name="update_product_image" id="update_product_image" accept="image/png, image/jpg, image/jpeg">
            <select name="update_product_category" id="update_product_category">
                <option value="tea">Tea</option>
                <option value="snacks">Snacks</option>
            </select>
            <button type="submit" name="update_product">Update Product</button>
        </form>
    </div>
</div>

<!-- <div style="text-align: right; margin: 20px;">
    <form action="report-product.php" method="post">
        <button type="submit" name="generate_pdf" class="btn">Generate PDF Report</button>
    </form>
</div> -->


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
<script>

    
var modal = document.getElementById("updateModal");
var span = document.getElementsByClassName("close")[0];

document.querySelectorAll('.btn1').forEach(button => {
    button.addEventListener('click', function() {
        modal.style.display = "block";
        document.getElementById('product_id').value = this.getAttribute('data-id');
        document.getElementById('update_product_name').value = this.getAttribute('data-name');
        document.getElementById('update_product_price').value = this.getAttribute('data-price');
        document.getElementById('update_product_category').value = this.getAttribute('data-category');
    });
});

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>