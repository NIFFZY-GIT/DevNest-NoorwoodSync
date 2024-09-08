<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['addEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contactNumber'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];

    $query = "INSERT INTO tbl_employee (employeeId, name, contactNumber, salary, email) VALUES ('$employeeId', '$name', '$contactNumber', '$salary', '$email')";
    mysqli_query($conn, $query);
    header("Location: employee.php");
}

if (isset($_POST['deleteEmployee'])) {
    $employeeId = $_POST['employeeId'];

    $query = "DELETE FROM tbl_employee WHERE employeeId='$employeeId'";
    mysqli_query($conn, $query);
    header("Location: employee.php");
}

if (isset($_POST['updateEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contactNumber'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];

    $query = "UPDATE tbl_employee SET name='$name', contactNumber='$contactNumber', salary='$salary', email='$email' WHERE employeeId='$employeeId'";
    mysqli_query($conn, $query);
    header("Location: employee.php");
}

$employees = [];
if (isset($_POST['searchEmployee'])) {
    $employeeId = $_POST['employeeId'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_employee WHERE employeeId='$employeeId'");
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
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
        .employee {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .employee-actions {
            margin-top: 10px;
        }
        .employee-actions button {
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
        <h1>Employee Management</h1>
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

        <div class="search-container">
            <h2>Search Employee</h2>
            <form action="employee.php" method="post">
                <div class="form-group">
                    <label for="searchEmployeeId">Employee ID:</label>
                    <input type="number" name="employeeId" id="searchEmployeeId" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="searchEmployee">Search</button>
                </div>
            </form>
        </div>

        <?php if (!empty($employees)) { ?>
            <h2>Employee Details</h2>
            <?php foreach ($employees as $row) { ?>
                <div class="employee">
                    <p><strong>ID:</strong> <?php echo $row['employeeId']; ?></p>
                    <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                    <p><strong>Contact Number:</strong> <?php echo $row['contactNumber']; ?></p>
                    <p><strong>Salary:</strong> <?php echo $row['salary']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <div class="employee-actions">
                        <button onclick="openModal(<?php echo $row['employeeId']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['contactNumber']; ?>', <?php echo $row['salary']; ?>, '<?php echo $row['email']; ?>')">Update</button>
                        <form action="employee.php" method="post" style="display:inline;">
                            <input type="hidden" name="employeeId" value="<?php echo $row['employeeId']; ?>">
                            <button type="submit" name="deleteEmployee">Delete</button>
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
        <h2>Edit Employee</h2>
        <form action="employee.php" method="post">
            <input type="hidden" name="employeeId" id="editEmployeeId">
            <div class="form-group">
                <label for="editName">Name:</label>
                <input type="text" name="name" id="editName" required>
            </div>
            <div class="form-group">
                <label for="editContactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" id="editContactNumber" required>
            </div>
            <div class="form-group">
                <label for="editSalary">Salary:</label>
                <input type="number" step="0.01" name="salary" id="editSalary" required>
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" name="email" id="editEmail" required>
            </div>
            <div class="form-group">
                <button type="submit" name="updateEmployee">Update</button>
            </div>
        </form>
    </div>
</div>
            </body>
            <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to open the modal
    function openModal(employeeId, name, contactNumber, salary, email) {
        document.getElementById("editEmployeeId").value = employeeId;
        document.getElementById("editName").value = name;
        document.getElementById("editContactNumber").value = contactNumber;
        document.getElementById("editSalary").value = salary;
        document.getElementById("editEmail").value = email;
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
</html>