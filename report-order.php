<?php
require('fpdf185/fpdf.php');
@include 'config.php';

if (isset($_POST['generate_order_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Order Report', 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Set header for the table
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 10, 'Order ID', 1);
    $pdf->Cell(20, 10, 'User ID', 1);
    $pdf->Cell(30, 10, 'Order Date', 1);
    $pdf->Cell(50, 10, 'Delivery Location', 1);
    $pdf->Cell(30, 10, 'Total Amount', 1);
    $pdf->Cell(30, 10, 'Status', 1);
    $pdf->Ln();

    // Fetch order data from the database
    $query = "SELECT orderId, userId, orderDate, deliveryLocation, totalAmount, status FROM tbl_order";
    $result = mysqli_query($conn, $query);

    // Add data to the table
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(20, 10, $row['orderId'], 1);
        $pdf->Cell(20, 10, $row['userId'], 1);
        $pdf->Cell(30, 10, $row['orderDate'], 1);
        $pdf->Cell(50, 10, $row['deliveryLocation'], 1);
        $pdf->Cell(30, 10, number_format($row['totalAmount'], 2), 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'order_report.pdf');
}
?>
