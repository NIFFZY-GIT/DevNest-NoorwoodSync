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

// Handle feedback submission
if (isset($_POST['submitFeedback']) && $feedbackCount == 0) {
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $stmt = $conn->prepare("INSERT INTO tbl_feedback (userId, email, message, stars) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userId, $email, $message, $stars);
    $stmt->execute();
    $stmt->close();
    
    echo "<script>alert('Feedback submitted successfully!'); window.location.href = 'feedback.php';</script>";
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
    
    echo "<script>alert('Feedback updated successfully!'); window.location.href = 'feedback.php';</script>";
}


// Handle feedback deletion
if (isset($_POST['deleteFeedback'])) {
    $feedbackId = $_POST['feedbackId'];

    $stmt = $conn->prepare("DELETE FROM tbl_feedback WHERE feedbackId=? AND userId=?");
    $stmt->bind_param("ii", $feedbackId, $userId);
    $stmt->execute();
    $stmt->close();
    
    echo "<script>alert('Feedback deleted successfully!'); window.location.href = 'feedback.php';</script>";
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <style>
@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins';
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
    width: 100%;
    max-width: 900px;
    padding: 40px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

h1, h2 {
    text-align: center;
    font-weight: 600;
    color: #017143;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #333;
}

.form-group input, .form-group textarea, .form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    background-color: #f7f7f7;
    transition: border-color 0.3s ease;
}

.form-group input:focus, .form-group textarea:focus, .form-group select:focus {
    border-color: #017143;
}

.form-group button {
    width: 100%;
    background-color: #017143;
    color: #fff;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-group button:hover {
    background-color: #025d32;
}

.feedback {
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #eee;
    border-radius: 10px;
    background-color: #fafafa;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
}

.feedback p {
    margin-bottom: 10px;
    font-size: 16px;
}

.feedback-actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.feedback-actions button {
    padding: 8px 15px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    background-color: #017143;
    color: #fff;
}

.feedback-actions button:hover {
    background-color: #025d32;
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
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover, .close:focus {
    color: #000;
    cursor: pointer;
}



    </style>

</head>
<body>
<section>
    <div class="circle"></div>
    <header>
        <div class="hi">
            <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
            <h1>Norwood International</h1>
        </div>
        <ul>
                <li><a href="customer-index.html">Home</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Log Out</a></li>
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
</body>
</html>
