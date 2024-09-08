<?php

@include 'config.php';

if(isset($_POST['add_product'])){

    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_FILES['product_image']['name'];
    $product_category=$_POST['product-type'];
    $product_image_tmp_name=$_FILES['product_image']['tmp_name'];
    $product_image_folder='uploaded/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_image))
    {
        $message[]='Please fill out all';
    }
    else{
        $insert="INSERT INTO tbl_product(name,price,image,Category) VALUES ('$product_name','$product_price','$product_image','$product_category')";
        $upload=mysqli_query($conn,$insert);
        
        if($upload)
        {
            move_uploaded_file($product_image_tmp_name,$product_image_folder);
            echo '<script> alert("New Product added successfully") </script>';
        }
        else{
            echo '<script> alert("Could not add the product") </script>';
        }
    }
};

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    mysqli_query($conn,"DELETE FROM tbl_product WHERE id=$id");
    header('location:admin-product.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-products.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
</head>
<body>

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
            <div class="form-box">
                <h2>Add a New Product</h2>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_name" placeholder="Enter product name" required>
                    <input type="number" name="product_price" placeholder="Enter product price" required>
                    <input type="file" name="product_image" accept="imae/png, image/jpg, image/jpeg" required>
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
        $select=mysqli_query( $conn,"SELECT * FROM tbl_product");
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

                <?php 
                
                    while($row=mysqli_fetch_assoc($select)){ 
                    
                ?>

                    <tr>
                        <td><img src="uploaded/<?php echo $row['image']; ?>" height="100px"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td>
                            <a href="admin_product_update.php?edit=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-edit"></i> Update</a>
                            <a href="admin-product.php?delete=<?php echo $row['id']; ?>" class="btn"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>

                    <?php }; ?>
            </table>
        </div>

        <div style="text-align: right; margin: 20px;">
           <form action="report-product.php" method="post">
                <button type="submit" name="generate_pdf" class="btn">Generate PDF Report</button>
           </form>
        </div>

        <?php

@include 'config.php';

require('fpdf185/fpdf.php');

if (isset($_POST['generate_pdf'])) {

    
    $pdf = new FPDF();
    $pdf->AddPage();

    
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Product Report', 1, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Set header for the table
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Product Name', 1);
    $pdf->Cell(40, 10, 'Price', 1);
    $pdf->Cell(40, 10, 'Category', 1);
    $pdf->Ln();

    // Set font for table content
    $pdf->SetFont('Arial', '', 12);

    // Fetch the product data from the database
    $select = mysqli_query($conn, "SELECT * FROM tbl_product");

    // Loop through each product and add it to the PDF
    while ($row = mysqli_fetch_assoc($select)) {
        $pdf->Cell(60, 10, $row['name'], 1);
        $pdf->Cell(40, 10, $row['price'], 1);
        $pdf->Cell(40, 10, $row['category'], 1);
        $pdf->Ln();
    }

    // Output the PDF to the browser (force download)
    $pdf->Output('D', 'product_report.pdf');
}
?>

    
</body>
</html>