<?php

@include 'config.php';

require('fpdf185/fpdf.php');

if (isset($_POST['generate_product_pdf'])) {

    
    $pdf = new FPDF();
    $pdf->AddPage();

    
    $pdf->SetFont('Arial', 'B', 16);


    $pdf->Cell(0, 10, 'Norwood Products Report', 1, 1, 'C');

    
    $pdf->Ln(10);

    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Product ID', 1);
    $pdf->Cell(50, 10, 'Product Name', 1);
    $pdf->Cell(50, 10, 'Price', 1);
    $pdf->Cell(50, 10, 'Category', 1);
    $pdf->Ln();

    
    $pdf->SetFont('Arial', '', 12);

    
    $select = mysqli_query($conn, "SELECT * FROM tbl_product");

    
    while ($row = mysqli_fetch_assoc($select)) {
        $pdf->Cell(40, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['name'], 1);
        $pdf->Cell(50, 10, $row['price'], 1);
        $pdf->Cell(50, 10, $row['category'], 1);
        $pdf->Ln();
    }

    
    $pdf->Output('D', 'product_report.pdf');
}
?>
