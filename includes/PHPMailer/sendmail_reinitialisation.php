<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP(); // Specifier que PHPMailer utilise le protocole SMTP;
$mail->Host = 'smtp.gmail.com'; // Specifier le serveur
$mail->SMTPAuth = true; // Pour activer l'authentification
$mail->Username = 'andreakounkoud@gmail.com';
$mail->Password = 'dzbyhgcifhkrixri';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->CharSet = "utf-8";
$mail->setFrom('andreakounkoud@gmail.com', 'Webcms');
$mail->addAddress($_POST['email'], 'Webcms');
$mail->isHTML(true); // Pour activer l'envoi de mail sous forme HTML
$mail->Subject = 'Réinitialisation de mot de passe';
$mail->Body = 'Afin de réinitialiser votre mot de passe, merci de cliquer sur le lien suivant : <a href="localhost/webcms/new_password.php?token=' . $token . '&email=' . $_POST['email'] . '">Réinitialiser mot de passer</a>';
$mail->SMTPDebug = 0; // Pour désactiver le debug;

if (!$mail->send()) {
    $message = "mail non envoyer";
    echo 'Erreur: ' . $$mail->ErrorInfo;
} else {
    $message = "Un mail vient d'être envoyer à votre adresse email pour réinitialiser votre mot de passe";
}
?>
