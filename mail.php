<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/PHPMailer-master/src/Exception.php';
require 'phpMailer/PHPMailer-master/src/PHPMailer.php';
require 'phpMailer/PHPMailer-master/src/SMTP.php';
include 'includes/db.php';
include 'includes/generatePwd.php';
session_start();

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$idReserve = htmlspecialchars($_SESSION['idReserve']);

$select = $db->prepare('SELECT idParticipants, nom, prenom, email FROM participants WHERE idReserve = :idReserve');
$select->execute(['idReserve' => $idReserve]);

while ($content = $select->fetch(PDO::FETCH_ASSOC)) {
    try {
        //Server settings
        $mail->SMTPDebug = 2;       //SMTP::DEBUG_SERVER;            //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'togetherstronger.confirmation@gmail.com';         //SMTP username
        $mail->Password   = 'igsgrwgwxcoybsiw';                       //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('togetherstronger.confirmation@gmail.com', 'Together&Stronger');
        $mail->addAddress($content['email'], $content['nom'] . $content['prenom']);     //Add a recipient

        $pwd = generatePassword();

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Code de connexion';
        $mail->Body    = 'Votre mot de passe de pour l\'application android est : <b>'. $pwd .'</b> <br> ';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $q = "UPDATE participants SET mdp = :mdp WHERE idParticipants = :idParticipants ";
        $req = $db->prepare($q);
        $reponse = $req->execute([
            'mdp'=> hash('sha512', $pwd),
            'idParticipants' => $content['idParticipants']
        ]);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$_SESSION['idReserve'] = 0;
header('location:confirmReserve.php');
exit;