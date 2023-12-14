<?php

require_once 'includes/bdd.php';

if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['token']) && !empty($_GET['token'])) {
    
    $email = $_GET['email'];
    $token = $_GET['token'];

    $requete = $bdd->prepare('SELECT * FROM webcms.utilisateurs WHERE email_utilisateur =:email AND token_utilisateur =:token');
    $requete->bindValue(':email', $email);
    $requete->bindValue(':token', $token);

    $requete->execute();

    $nombre = $requete->rowCount();

    if ($nombre == 1) {
        $update = $bdd->prepare('UPDATE webcms.utilisateurs SET validattion_email_utilisateur =:validation, token_utilisateur =:token
        WHERE email_utilisateur =:email');

        $update->bindValue(':email', $email);
        $update->bindValue(':token', "Valide");
        $update->bindValue(':validation', 1);

        $resultUpdate = $update->execute();
        

        if ($resultUpdate) {
            echo "<script type=\"text/javascript\">alert('Votre adresse email est confirmée');
            document.location.href='login.php'</script>";
        }


    }
}
?>