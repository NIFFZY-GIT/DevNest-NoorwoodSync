<?php
require('fpdf185/fpdf.php');
@include 'config.php';

if (isset($_POST['generate_employee_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Employee Report', 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Set header for the table
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Employee ID', 1);
    $pdf->Cell(45, 10, 'Name', 1);
    $pdf->Cell(35, 10, 'Contact Number', 1);
    $pdf->Cell(25, 10, 'Salary', 1);
    $pdf->Cell(40, 10, 'Email', 1);
    $pdf->Ln();

    // Fetch employee data from the database
    $query = "SELECT * FROM tbl_employee";
    $result = mysqli_query($conn, $query);

    // Add data to the table
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 10, $row['employeeId'], 1);
        $pdf->Cell(45, 10, $row['name'], 1);
        $pdf->Cell(35, 10, $row['contactNumber'], 1);
        $pdf->Cell(25, 10, $row['salary'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'employee_report.pdf');
}
?>
