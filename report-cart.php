<?php
require('fpdf185/fpdf.php');
@include 'config.php';

session_start(); // Start the session if not already started

if (isset($_POST['generate_cart_invoice'])) {
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId']; // Get the userId from the session

        // Clear the output buffer
        ob_end_clean();

        // Create a new PDF document
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add a title
        $pdf->Cell(0, 10, 'Cart Invoice', 0, 1, 'C');

        // Line break
        $pdf->Ln(10);

        // Set header for the table
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Product', 1);
        $pdf->Cell(30, 10, 'Price', 1);
        $pdf->Cell(30, 10, 'Quantity', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        // Fetch cart data from the database
        $query = "SELECT c.cartId, c.productId, c.quantity, p.name, p.price 
                  FROM tbl_cart c 
                  JOIN tbl_product p ON c.productId = p.id 
                  WHERE c.userId = $userId";
        $result = mysqli_query($conn, $query);

        // Add data to the table
        $pdf->SetFont('Arial', '', 12);
        $totalAmount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $pricePerGram = $row['price'] / 100; // Calculate price per gram
            $productTotal = $pricePerGram * $row['quantity']; // Calculate total price based on actual quantity

            $pdf->Cell(40, 10, $row['name'], 1);
            $pdf->Cell(30, 10, number_format($row['price'], 2), 1);
            $pdf->Cell(30, 10, $row['quantity'] . 'g', 1);
            $pdf->Cell(30, 10, number_format($productTotal, 2), 1);
            $pdf->Ln();
            $totalAmount += $productTotal;
        }

        // Total amount
        $pdf->Cell(100, 10, 'Total Amount', 1);
        $pdf->Cell(30, 10, number_format($totalAmount, 2), 1);

        // Output the PDF
        $pdf->Output('D', 'cart_invoice.pdf');
    } else {
        echo "User is not logged in.";
    }
}
?>
