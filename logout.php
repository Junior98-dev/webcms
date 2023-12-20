<?php

session_start();

if ($_SESSION) {
    session_unset(); // pour detruire toutes les variables de sessions courantes
    session_destroy();

    header('location:index.php');
} else {
    echo "Vous êtes pas connecté !";
}
?>
