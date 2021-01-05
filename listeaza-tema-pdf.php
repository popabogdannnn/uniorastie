<?php


require_once 'fpdf.php';
require_once 'includes/database.php';
session_start();

if(!isset($_SESSION['sessionId']) && ($_SESSION['privilege'] === 1 || $_SESSION['privilege'] === 3)) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

    $temaID = $_GET['temaid'];
    $privilege = $_SESSION['privilege'];
    $ans = getFromTableBy($conn, "primeste_tema", "temaID", $temaID);
    $username = $_SESSION['sessionUser'];
    
    if(count($ans) == 0) {
        header("Location: index.php?error=temainexistenta");
        exit();
    }

    $row = $ans[0];

    if(!($username == $row['profesor_username'] || $username == $row['student_username'])) {
        header("Location: index.php?error=insufficientrights");
        exit();
    }

   $pdf = new FPDF();
   $pdf->AddPage();
   $pdf->SetFont('Arial', 'B', 18);
   $pdf->Cell(40, 10, 'Cerinta');
   $pdf->Ln();
   $pdf->SetFont('Arial', '', 12);
   $pdf->write(12, $row['cerinta']);
   $pdf->Ln();
   $pdf->SetFont('Arial', 'B', 18);
   $pdf->Cell(40, 10, 'Submisie');
   $pdf->SetFont('Arial', '', 12);
   $pdf->Ln();
   $pdf->write(12, $row['submisie']);
   $pdf->output();

?>

<?php

require_once 'includes/footer.php';
?>
