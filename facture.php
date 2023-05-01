<?php

session_start();
require('fpdf/fpdf.php');
include 'includes/db.php';

class Invoice extends FPDF {
    function Header() {

        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(102, 178, 255);
        $this->Cell(80);
        $this->Cell(30, 10, 'TOGETHER&STRONGER', 0, 0, 'C');
        $this->Ln(20);

        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, 'FACTURE', 0, 0, 'C');
        $this->Ln(20);

        $this->Image('assets/img/icons/logo.png', 10, 10, 30);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function create_invoice($data) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Nom :', 1);
        $this->Cell(0, 10, $data['nom'], 1, 1);

        $this->Cell(40, 10, 'Prénom :', 1);
        $this->Cell(0, 10, $data['prenom'], 1, 1);

        $this->Cell(40, 10, 'Email :', 1);
        $this->Cell(0, 10, $data['email'], 1, 1);

        $this->Cell(40, 10, 'Montant :', 1);
        $this->Cell(0, 10, $data['montant'], 1, 1);

        $this->Cell(40, 10, 'Date :', 1);
        $this->Cell(0, 10, $data['date'], 1, 1);

        $this->Output();
    }
}


$q = "SELECT * FROM paiement WHERE idPaiement = ?";
$stmt = $db->prepare($q);

$idPaiement = $_POST['idPaiement'];

$stmt->bindValue(1, $idPaiement, PDO::PARAM_INT);

$q = "SELECT * FROM paiement WHERE idPaiement = ?";
$stmt = $db->prepare($q);
$stmt->bindParam(1, $idPaiement);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$invoice = new Invoice();
$invoice->AliasNbPages();
$invoice->AddPage();
$invoice->create_invoice($row);

$this->Output('D', 'facture.pdf');

?>