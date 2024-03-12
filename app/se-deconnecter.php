<?php
if (est_connecter()) {
    session_destroy();
}
$message = "Vous etes déconnecter";
header("location:index.php?page=accueil&message=" . $message);