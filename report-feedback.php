<?php
require('fpdf185/fpdf.php');
@include 'config.php';

if (isset($_POST['generat_feedback_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Feedback Report', 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Set header for the table
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Feedback ID', 1);
    $pdf->Cell(30, 10, 'User ID', 1);
    $pdf->Cell(50, 10, 'Email', 1);
    $pdf->Cell(60, 10, 'Message', 1);
    $pdf->Cell(20, 10, 'Stars', 1);
    $pdf->Ln();

    // Fetch feedback data from the database
    $query = "SELECT * FROM tbl_feedback";
    $result = mysqli_query($conn, $query);

    // Add data to the table
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 10, $row['feedbackId'], 1);
        $pdf->Cell(30, 10, $row['userId'], 1);
        $pdf->Cell(50, 10, $row['email'], 1);
        $pdf->Cell(60, 10, $row['message'], 1);
        $pdf->Cell(20, 10, $row['stars'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'feedback_report.pdf');
}
?>
