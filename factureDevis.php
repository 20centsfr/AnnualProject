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

    function create_devis($devis) {
        // Récupération des informations de l'utilisateur
        $idUser = $_SESSION['idUser'];
        $userReq = $db->query("SELECT * FROM users WHERE idUser='" . $idUser . "'");
        $user = $userReq->fetch();

        // Informations de l'entreprise
        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'Entreprise :',0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$user['entreprise'],0,1);

        // Informations de l'utilisateur
        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'Devis pour :',0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$user['nom'].' '.$user['prenom'],0,1);

        // Informations du devis
        $this->Ln(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'Date :',0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$devis['date'],0,1);

        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'Nombre de participants :',0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$devis['nbParticipants'],0,1);

        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'Prix :',0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$devis['prix'].' €',0,1);

        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Activités :', 0, 1);

        $activiteReq = $db->query("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis='" . $devis['idDevis'] . "'");

        if ($activiteReq->rowCount() > 0) {
        while ($activite = $activiteReq->fetch(PDO::FETCH_ASSOC)) {
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, '- ' . $activite['nomActivite'], 0, 1);
        }
        }

        $this->Output();
    }
}

$q = "SELECT * FROM devis WHERE idDevis = ?";
$stmt = $db->prepare($q);

$idDevis = $_POST['idDevis'];

/*
$activiteReq = $db->query("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis='" . $devis['idDevis'] . "'");
$activites = array();
while ($activite = $activiteReq->fetch()) {
    $activites[] = $activite;
}
var_dump($activites);
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
$invoice_data = array(
    'entreprise' => 'Nom de l\'entreprise',
    'date' => $row['date'],
    'nbParticipants' => $row['nbParticipants'],
    'prix' => $row['prix'],
    'activites' => $activites
);

$invoice->Output('D', 'factureDevis.pdf');
?>