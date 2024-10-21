<?php
// delete_feedback.php
include 'config.php'; // Include your database connection
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = $_SESSION['userId'];
if (isset($_POST['deleteFeedback'])) {
    $feedbackId = $_POST['feedbackId'];

    $stmt = $conn->prepare("DELETE FROM tbl_feedback WHERE feedbackId=? AND userId=?");
    $stmt->bind_param("ii", $feedbackId, $userId);
    $stmt->execute();
    $stmt->close();
    
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Feedback deleted successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin-feedback.php';
            }
        });
    </script>";
}
?>
