<?php
require 'config.php'; // Including the database configuration file
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start a session if it hasn't started yet
}

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit();
}

$userId = $_SESSION['userId']; // Store the logged-in user's ID

// Fetch user's email from tbl_user
$userQuery = $conn->prepare("SELECT email FROM tbl_user WHERE userId = ?");
$userQuery->bind_param("i", $userId); // Binding userId parameter for security
$userQuery->execute();
$userQuery->bind_result($email); // Storing the result (email)
$userQuery->fetch();
$userQuery->close(); // Close the query to free up resources

// Check if the user has already submitted feedback
$feedbackCheckQuery = $conn->prepare("SELECT COUNT(*) FROM tbl_feedback WHERE userId = ?");
$feedbackCheckQuery->bind_param("i", $userId); // Binding userId parameter
$feedbackCheckQuery->execute();
$feedbackCheckQuery->bind_result($feedbackCount); // Storing the result (feedback count)
$feedbackCheckQuery->fetch();
$feedbackCheckQuery->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External CSS files -->
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert library for alerts -->
    <script>
window.embeddedChatbotConfig = {
chatbotId: "xYab3amLnm91LwMETAtb3",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="xYab3amLnm91LwMETAtb3"
domain="www.chatbase.co"
defer>
</script>
    <title>Feedback</title>
    
    <?php
    // Handle feedback submission
    if (isset($_POST['submitFeedback']) && $feedbackCount == 0) { // Check if feedback is being submitted and no previous feedback exists
        $message = $_POST['message'];
        $stars = $_POST['stars'];

        // Insert feedback into the database
        $stmt = $conn->prepare("INSERT INTO tbl_feedback (userId, email, message, stars) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $email, $message, $stars);
        $stmt->execute();
        $stmt->close();
        
        // SweetAlert success message after feedback submission
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Feedback submitted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'feedback.php'; // Redirect after confirmation
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

        // Update feedback in the database
        $stmt = $conn->prepare("UPDATE tbl_feedback SET message=?, stars=? WHERE feedbackId=? AND userId=?");
        $stmt->bind_param("ssii", $message, $stars, $feedbackId, $userId);
        $stmt->execute();
        $stmt->close();
        
        // SweetAlert success message after feedback update
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Feedback updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'feedback.php'; // Redirect after confirmation
                    }
                });
            });
        </script>";
    }

    // Handle feedback deletion
    if (isset($_POST['deleteFeedback'])) {
        $feedbackId = $_POST['feedbackId'];

        // Delete feedback from the database
        $stmt = $conn->prepare("DELETE FROM tbl_feedback WHERE feedbackId=? AND userId=?");
        $stmt->bind_param("ii", $feedbackId, $userId);
        $stmt->execute();
        $stmt->close();
        
        // SweetAlert success message after feedback deletion
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Feedback deleted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'feedback.php'; // Redirect after confirmation
                    }
                });
            });
        </script>";
    }

    // Fetch all feedbacks to display them on the page
    $feedbacks = $conn->query("SELECT * FROM tbl_feedback");

    // Fetch the logged-in user's feedback to enable update/delete functionality
    $userFeedbackQuery = $conn->prepare("SELECT * FROM tbl_feedback WHERE userId = ?");
    $userFeedbackQuery->bind_param("i", $userId);
    $userFeedbackQuery->execute();
    $userFeedbackResult = $userFeedbackQuery->get_result();
    $userFeedback = $userFeedbackResult->fetch_assoc(); // Fetch the user's feedback
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
        <?php if ($feedbackCount == 0) { // If no feedback was submitted yet ?>
            <h1>Submit Feedback</h1>
            <form action="feedback.php" method="post" class="feedback-form">
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" required></textarea> <!-- Message textarea -->
                </div>
                <div class="form-group">
                    <label for="stars">Stars:</label>
                    <select name="stars" id="stars" required> <!-- Stars dropdown -->
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitFeedback">Submit</button> <!-- Submit button -->
                </div>
            </form>
        <?php } ?>
        
        <!-- If the user already submitted feedback, allow update and delete actions -->
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
                        <button type="submit" name="deleteFeedback">Delete</button> <!-- Delete feedback button -->
                    </form>
                </div>
            </div>
        <?php } ?>
        
        <!-- Display all feedbacks from other users -->
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

    <!-- Modal for editing feedback -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Edit Feedback</h2>
            <form action="feedback.php" method="post">
                <input type="hidden" name="feedbackId" id="feedbackId">
                <div class="form-group">
                    <label for="editMessage">Message:</label>
                    <textarea name="message" id="editMessage" required></textarea> <!-- Editing message textarea -->
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
                    <button type="submit" name="updateFeedback">Update</button> <!-- Update button -->
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for handling modal functionality -->
    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        function openModal(feedbackId, message, stars) {
            document.getElementById("feedbackId").value = feedbackId;
            document.getElementById("editMessage").value = message;
            document.getElementById("editStars").value = stars;
            modal.style.display = "block"; // Show the modal
        }

        span.onclick = function() {
            modal.style.display = "none"; // Hide the modal when close button is clicked
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none"; // Hide the modal if the user clicks outside of it
            }
        }
    </script>
    
</section>

<!-- Footer section with social links -->
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

    <!-- Styling for hover effects on footer icons -->
    <style>
        footer a:hover {
            color: #ffffff;
        }

        footer i {
            transition: transform 0.3s ease;
        }

        footer a:hover i {
            transform: scale(1.2); /* Scale effect on hover */
        }
    </style>
</footer>
</body>
</html>
