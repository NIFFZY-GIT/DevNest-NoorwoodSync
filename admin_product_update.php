<?php
@include 'config.php';

$id=$_GET['edit'];

if(isset($_POST['update_product'])){

    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_FILES['product_image']['name'];
    $product_category=$_POST['product-type'];
    $product_image_tmp_name=$_FILES['product_image']['tmp_name'];
    $product_image_folder='uploaded/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category))
    {
        $message[]='Please fill out all';
    }
    else{
        $update="UPDATE tbl_product SET name='$product_name', price='$product_price', image='$product_image' , category='$product_category' WHERE id=$id";
        $upload=mysqli_query($conn,$update);
        
        if($upload)
        {
            move_uploaded_file($product_image_tmp_name,$product_image_folder);
        }
        else{
            echo '<script> alert("Could not update the product") </script>';
        }
        header('location:admin-product.php');
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_product_update.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
</head>
<body>
    <div class="container">
            <div class="form-box-centered">


            <?php

            $select=mysqli_query($conn,"SELECT * FROM tbl_product WHERE id=$id");
            while($row = mysqli_fetch_assoc($select)){

            ?>
                <h2>Update Product</h2>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_name" value="<?php echo $row['name']?>" placeholder="Enter product name" required>
                    <input type="number" name="product_price" value="<?php echo $row['price']?>" placeholder="Enter product price" required>
                    <input type="file" name="product_image" value="<?php echo $row['image']?>" accept="imae/png, image/jpg, image/jpeg" required>
                    <select class="productType" name="product-type">
                    <option value="None" <?php echo $row['category']; ?>>None</option>
                    <option value="tea" <?php echo $row['category']; ?>>Tea</option>
                    <option value="snacks" <?php echo $row['category']; ?>>Snacks</option>
                </select>
                    <button type="submit" name="update_product">Update Product</button>
                    <br><br>
                    <a href="admin-product.php" class="btn">Go back</a>
                </form>

                <?php

            };

            ?>
            </div>
    </div>
</body>
</html>