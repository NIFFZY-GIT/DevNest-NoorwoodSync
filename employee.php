<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .container {
            max-width: 800px;
            margin: 200px auto;
            /* background: #f5f5dc; */
            background-color: #C2B280;
            padding: 100px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
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
            transition: background 0.3s ease;
        }

        .form-group button:hover {
            background: #014f2a;
        }

        .employee-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .employee-card p {
            margin: 5px 0;
        }

        .employee-actions {
            margin-top: 10px;
        }

        .employee-actions button {
            margin-right: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            padding-top: 60px;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
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
.employee-actions button{
    padding: 12px 20px;
    background: #017143;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease;
}
    </style>
</head>
<body>

<?php
// Handle adding a new employee
if (isset($_POST['addEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contactNumber'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];

    $query = "INSERT INTO tbl_employee (employeeId, name, contactNumber, salary, email) VALUES ('$employeeId', '$name', '$contactNumber', '$salary', '$email')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Employee added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error adding employee: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle deleting an employee
if (isset($_POST['deleteEmployee'])) {
    $employeeId = $_POST['employeeId'];

    $query = "DELETE FROM tbl_employee WHERE employeeId='$employeeId'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Employee deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error deleting employee: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle updating an employee
if (isset($_POST['updateEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contactNumber'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];

    $query = "UPDATE tbl_employee SET name='$name', contactNumber='$contactNumber', salary='$salary', email='$email' WHERE employeeId='$employeeId'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Employee updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating employee: " . mysqli_error($conn) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'employee.php';
                    }
                });
            });
        </script>";
    }
    exit();
}

// Handle searching for an employee
$employees = [];
if (isset($_POST['searchEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_employee WHERE employeeId='$employeeId'");
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($employees) > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Search successful! Employee found.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'No Employee Found',
                    text: 'No employee found with the given ID.',
                    icon: 'info',
                    confirmButtonText: 'OK'
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
        <h2>Employee Management</h2>
        <h3>Search Employee</h3>
        <form action="employee.php" method="post">
            <div class="form-group">
                <label for="searchEmployeeId">Employee ID:</label>
                <input type="number" name="employeeId" id="searchEmployeeId" required>
            </div>
            <div class="form-group">
                <button type="submit" name="searchEmployee">Search</button>
            </div>
        </form>
        <?php if (!empty($employees)) { ?>
            <h3>Employee Details</h3>
            <?php foreach ($employees as $row) { ?>
                <div class="employee-card">
                    <p><strong>ID:</strong> <?php echo $row['employeeId']; ?></p>
                    <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                    <p><strong>Contact Number:</strong> <?php echo $row['contactNumber']; ?></p>
                    <p><strong>Salary:</strong> <?php echo $row['salary']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <div class="employee-actions">
                        <button onclick="openModal(<?php echo $row['employeeId']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['contactNumber']; ?>', <?php echo $row['salary']; ?>, '<?php echo $row['email']; ?>')">Update</button>
                        <form action="employee.php" method="post" style="display: inline;">
                            <input type="hidden" name="employeeId" value="<?php echo $row['employeeId']; ?>">
                            <button type="submit" name="deleteEmployee">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        
        <form action="employee.php" method="post">
            <div class="form-group">
                <label for="employeeId">Employee ID:</label>
                <input type="number" name="employeeId" id="employeeId" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" id="contactNumber" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" step="0.01" name="salary" id="salary" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <button type="submit" name="addEmployee">Add Employee</button>
            </div>
        </form>

   
       
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Update Employee</h2>
            <form action="employee.php" method="post">
                <input type="hidden" name="employeeId" id="modalEmployeeId">
                <div class="form-group">
                    <label for="modalName">Name:</label>
                    <input type="text" name="name" id="modalName" required>
                </div>
                <div class="form-group">
                    <label for="modalContactNumber">Contact Number:</label>
                    <input type="text" name="contactNumber" id="modalContactNumber" required>
                </div>
                <div class="form-group">
                    <label for="modalSalary">Salary:</label>
                    <input type="number" step="0.01" name="salary" id="modalSalary" required>
                </div>
                <div class="form-group">
                    <label for="modalEmail">Email:</label>
                    <input type="email" name="email" id="modalEmail" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="updateEmployee">Update Employee</button>
                </div>
            </form>
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
        function openModal(employeeId, name, contactNumber, salary, email) {
            document.getElementById('modalEmployeeId').value = employeeId;
            document.getElementById('modalName').value = name;
            document.getElementById('modalContactNumber').value = contactNumber;
            document.getElementById('modalSalary').value = salary;
            document.getElementById('modalEmail').value = email;
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
        }
    </script>
</body>
</html>