<?php

@include 'config.php';

require('fpdf185/fpdf.php');

if (isset($_POST['generate_supplier_pdf'])) {

    
    $pdf = new FPDF();
    $pdf->AddPage();

    
    $pdf->SetFont('Arial', 'B', 16);


    $pdf->Cell(0, 10, 'Norwood Suppliers Report', 1, 1, 'C');

    
    $pdf->Ln(10);

    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Supplier ID', 1);
    $pdf->Cell(40, 10, 'Supplier Name', 1);
    $pdf->Cell(40, 10, 'Supplier Email', 1);
    $pdf->Cell(40, 10, 'Contact Number', 1);
    $pdf->Cell(40, 10, 'Supplier Location', 1);
    $pdf->Ln();

    
    $pdf->SetFont('Arial', '', 12);

    
    $select = mysqli_query($conn, "SELECT * FROM tbl_supplier");

    
    while ($row = mysqli_fetch_assoc($select)) {
        $pdf->Cell(30, 10, $row['supplierId'], 1);
        $pdf->Cell(40, 10, $row['name'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Cell(40, 10, $row['contactNumber'], 1);
        $pdf->Cell(40, 10, $row['location'], 1);
        $pdf->Ln();
    }

    
    $pdf->Output('D', 'Supplier_report.pdf');
}
?>
