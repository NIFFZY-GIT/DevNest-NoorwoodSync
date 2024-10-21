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

// Fetch user's email from tbl_user
$userQuery = $conn->prepare("SELECT email FROM tbl_user WHERE userId = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userQuery->bind_result($email);
$userQuery->fetch();
$userQuery->close();

// Check if the user has already submitted feedback
$feedbackCheckQuery = $conn->prepare("SELECT COUNT(*) FROM tbl_feedback WHERE userId = ?");
$feedbackCheckQuery->bind_param("i", $userId);
$feedbackCheckQuery->execute();
$feedbackCheckQuery->bind_result($feedbackCount);
$feedbackCheckQuery->fetch();
$feedbackCheckQuery->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Feedback</title>


    <?php


// Handle feedback submission
// if (isset($_POST['submitFeedback']) && $feedbackCount == 0) {
//     $message = $_POST['message'];
//     $stars = $_POST['stars'];

//     $stmt = $conn->prepare("INSERT INTO tbl_feedback (userId, email, message, stars) VALUES (?, ?, ?, ?)");
//     $stmt->bind_param("isss", $userId, $email, $message, $stars);
//     $stmt->execute();
//     $stmt->close();
    
//     echo "<script>alert('Feedback submitted successfully!'); window.location.href = 'feedback.php';</script>";
// }

if (isset($_POST['submitFeedback']) && $feedbackCount == 0) {
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $stmt = $conn->prepare("INSERT INTO tbl_feedback (userId, email, message, stars) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userId, $email, $message, $stars);
    $stmt->execute();
    $stmt->close();
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Feedback submitted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'feedback.php';
                }
            });
        });
    </script>";
}

// Handle feedback update
if (isset($_POST['updateFeedback'])) {
    $feedbackId = $_POST['feedbackId'];
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $stmt = $conn->prepare("UPDATE tbl_feedback SET message=?, stars=? WHERE feedbackId=? AND userId=?");
    $stmt->bind_param("ssii", $message, $stars, $feedbackId, $userId);
    $stmt->execute();
    $stmt->close();
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Feedback updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'feedback.php';
                }
            });
        });
    </script>";
}



// Handle feedback deletion
if (isset($_POST['deleteFeedback'])) {
    $feedbackId = $_POST['feedbackId'];

    $stmt = $conn->prepare("DELETE FROM tbl_feedback WHERE feedbackId=? AND userId=?");
    $stmt->bind_param("ii", $feedbackId, $userId);
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
                    window.location.href = 'feedback.php';
                }
            });
        });
    </script>";
}


// Fetch all feedbacks
$feedbacks = $conn->query("SELECT * FROM tbl_feedback");

// Fetch the logged-in user's feedback
$userFeedbackQuery = $conn->prepare("SELECT * FROM tbl_feedback WHERE userId = ?");
$userFeedbackQuery->bind_param("i", $userId);
$userFeedbackQuery->execute();
$userFeedbackResult = $userFeedbackQuery->get_result();
$userFeedback = $userFeedbackResult->fetch_assoc();
$userFeedbackQuery->close();
?>
</head>
<body>
<section>
    <div class="circle"></div>
    <header>
        <div class="hi">
            <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
            <h1>Norwood International</h1>
        </div>
        <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Products</a>
                    <ul class="dropdown-content">
                        <li><a href="tea.php">Tea</a></li>
                        <li><a href="bites.php">Snacks</a></li>
                    </ul>
                </li>
             
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="about-us.php">About Us</a></li>
            </ul>
    </header>
    
    <div class="container">
       
        <?php if ($feedbackCount == 0) { ?>
            <h1>Submit Feedback</h1>
            <form action="feedback.php" method="post" class="feedback-form">
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" required></textarea>
                </div>
                <div class="form-group">
                    <label for="stars">Stars:</label>
                    <select name="stars" id="stars" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitFeedback">Submit</button>
                </div>
            </form>
        <?php } else { ?>
            <!-- <p>You have already submitted feedback.</p> -->
        <?php } ?>
        <!-- <form action="feedbackpdf.php" method="post">
            <button type="submit" name="generat_feedback_pdf" class="btn">Generate PDF Report</button>
        </form> -->
       
        <?php if ($userFeedback) { ?>
            <h2>Your Feedback</h2>
            <div class="feedback">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userFeedback['email']); ?></p>
                <p><strong>Message:</strong> <?php echo htmlspecialchars($userFeedback['message']); ?></p>
                <p><strong>Stars:</strong> <?php echo htmlspecialchars($userFeedback['stars']); ?></p>
                <div class="feedback-actions">
                    <button onclick="openModal(<?php echo $userFeedback['feedbackId']; ?>, '<?php echo htmlspecialchars($userFeedback['message']); ?>', <?php echo $userFeedback['stars']; ?>)">Update</button>
                    <form action="feedback.php" method="post" style="display:inline;">
                        <input type="hidden" name="feedbackId" value="<?php echo $userFeedback['feedbackId']; ?>">
                        <button type="submit" name="deleteFeedback">Delete</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        <h2>All Feedbacks</h2>
        <?php while ($row = $feedbacks->fetch_assoc()) { ?>
            <?php if ($row['userId'] != $userId) { ?>
                <div class="feedback">
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                    <p><strong>Stars:</strong> <?php echo htmlspecialchars($row['stars']); ?></p>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Edit Feedback</h2>
            <form action="feedback.php" method="post">
                <input type="hidden" name="feedbackId" id="feedbackId">
                <div class="form-group">
                    <label for="editMessage">Message:</label>
                    <textarea name="message" id="editMessage" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editStars">Stars:</label>
                    <select name="stars" id="editStars" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="updateFeedback">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        function openModal(feedbackId, message, stars) {
            document.getElementById("feedbackId").value = feedbackId;
            document.getElementById("editMessage").value = message;
            document.getElementById("editStars").value = stars;
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    
</section>
<footer class="footer">
            <div class="social">
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-brands fa-facebook" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-solid fa-envelope" style="color: #000000;"></i></a>                    
            </div>
            <p align="center"> © Copyright Norwood.lk 2023. All rights reserved</p>
            <p align="center"> Established in 2022</p>
            <p align="center"> Privacy Policy | Terms of Service | Contact Us</p>
            <br>
        </footer>
</body>
</html>
