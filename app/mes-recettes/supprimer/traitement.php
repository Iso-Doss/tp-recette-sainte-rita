<!-- ajouter recette traitement.php -->

<?php

if (!est_connecter()) {
    header("location:index.php?page=connexion&erreur=Vous devez vous connectez.");
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de supprimer n'existe pas.");
}

$recette = recuperer_recette_par_son_id($_GET['id']);

if (!isset($recette) || empty($recette)) {
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de modifier n'existe pas.");
} else if ($recette['id_utilisateur'] != $_SESSION['utilisateur_connecter']['id']) {
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de modifier ne vous appartiens pas.");
}

$message = "";
$erreur = "";
$supprimer_recette = supprimer_recette($_GET['id']);
if ($supprimer_recette) {
    $message = "Recette supprimé avec succès.";
} else {
    $erreur = "Une erreur inattendue s'est produite lors de la suppression de la recette.";
}

header("location:index.php?page=mes-recettes&message=" . $message . "&erreur="  . $erreur);
