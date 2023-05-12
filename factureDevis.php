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

        $this->Cell(40, 10, 'Entreprise :', 1);
        $this->Cell(0, 10, $data['entreprise'], 1, 1);

        $this->Cell(40, 10, 'Date :', 1);
        $this->Cell(0, 10, $data['date'], 1, 1);

        $this->Cell(40, 10, 'Nombre de participants :', 1);
        $this->Cell(0, 10, $data['nbParticipants'], 1, 1);

        $this->Cell(40, 10, 'Prix :', 1);
        $this->Cell(0, 10, $data['prix'], 1, 1);

        $this->Cell(40, 10, 'Activités :', 1);
        $this->Cell(0, 10, $activite['nomActivite'], 1, 1);

        $this->Output();
    }
}

$q = "SELECT * FROM devis WHERE idDevis = ?";
$stmt = $db->prepare($q);

$idDevis = $_POST['idDevis'];

/*$activiteReq = $db->query("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis='" . $devis['idDevis'] . "'");
$activites = array();
while ($activite = $activiteReq->fetch()) {
    $activites[] = $activite;
}

*/
$stmt->bindValue(1, $idDevis, PDO::PARAM_INT);

$q = "SELECT * FROM devis WHERE idDevis = ?";
$stmt = $db->prepare($q);
$stmt->bindParam(1, $idDevis);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$invoice = new Invoice();
$invoice->AliasNbPages();
$invoice->AddPage();
$invoice->create_invoice($row);

$this->Output('D', 'factureDevis.pdf');

?>