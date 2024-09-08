<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

if (isset($_POST['submitFeedback'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $query = "INSERT INTO tbl_feedback (userId, email, message, stars) VALUES ('$userId', '$email', '$message', '$stars')";
    mysqli_query($conn, $query);
    header("Location: feedback.php");
}

if (isset($_POST['updateFeedback'])) {
    $feedbackId = $_POST['feedbackId'];
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $query = "UPDATE tbl_feedback SET message='$message', stars='$stars' WHERE feedbackId='$feedbackId' AND userId='$userId'";
    mysqli_query($conn, $query);
    header("Location: feedback.php");
}

if (isset($_POST['deleteFeedback'])) {
    $feedbackId = $_POST['feedbackId'];

    $query = "DELETE FROM tbl_feedback WHERE feedbackId='$feedbackId' AND userId='$userId'";
    mysqli_query($conn, $query);
    header("Location: feedback.php");
}

$feedbacks = mysqli_query($conn, "SELECT * FROM tbl_feedback");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
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
        .form-group input, .form-group textarea, .form-group select {
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
        .feedback {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .feedback-actions {
            margin-top: 10px;
        }
        .feedback-actions button {
            margin-right: 5px;
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
        <h1>Submit Feedback</h1>
        <form action="feedback.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
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

        <h2>All Feedback</h2>
        <?php while ($row = mysqli_fetch_assoc($feedbacks)) { ?>
            <div class="feedback">
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Message:</strong> <?php echo $row['message']; ?></p>
                <p><strong>Stars:</strong> <?php echo $row['stars']; ?></p>
                <?php if ($row['userId'] == $userId) { ?>
                    <div class="feedback-actions">
                        <button onclick="openModal(<?php echo $row['feedbackId']; ?>, '<?php echo $row['message']; ?>', <?php echo $row['stars']; ?>)">Update</button>
                        <form action="feedback.php" method="post" style="display:inline;">
                            <input type="hidden" name="feedbackId" value="<?php echo $row['feedbackId']; ?>">
                            <button type="submit" name="deleteFeedback">Delete</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <!-- The Modal -->
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
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Function to open the modal
        function openModal(feedbackId, message, stars) {
            document.getElementById("feedbackId").value = feedbackId;
            document.getElementById("editMessage").value = message;
            document.getElementById("editStars").value = stars;
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
</html