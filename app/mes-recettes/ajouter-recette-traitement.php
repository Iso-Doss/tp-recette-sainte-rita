<!-- ajouter recette traitement.php -->

<?php

if(!est_connecter()){
    header("location:index.php?page=connexion&erreur=Vous devez vous connectez.");
}

// Le message de success global pour la connexion.
$message = "";
// Le message d'erreur global pour la connexion.
$erreur = "";
// Les données envoyées depuis le formulaire de la connexion.
$donnees = $_POST;
// Les messages d'erreur spécifique a chaque champ incorrect du formulaire de la connexion.
$erreurs = [];

if (empty($_POST)) {
    $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
} else {

    if (!isset($_POST['nom']) || empty($_POST['nom'])) {
        $erreurs['nom'] = "Le champ nom de la recette est vide ou inccorect.";
    }

    if (!isset($_POST['description']) || empty($_POST['description'])) {
        $erreurs['description'] = "Le champ description de la recette est vide ou inccorect.";
    }

    if (!isset($_POST['recette']) || empty($_POST['recette'])) {
        $erreurs['recette'] = "Le champ étapes de la recette est vide ou inccorect.";
    }

    if (is_string(verfier_image_televerser('image'))) {
        $erreurs['image'] = verfier_image_televerser('image');
    } else {
        $donnees['image'] = basename($_FILES['image']['name']);
    }


    if (!empty($erreurs)) {
        $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
    } else {
        $donnees['id_utilisateur'] = $_SESSION['utilisateur_connecter']['id'];
        $recette = ajouter_recette($donnees);
        if ($recette) {
            $message = "Recette ajoutée avec succès.";
        } else {
            $erreur = "Oupss!!! Une erreur inatendue s'est produite lors de l'ajout de la recette. Veuillez reesssyer.";
        }
    }
}

if (empty($erreurs)) {
    header("location:index.php?page=mes-recettes&message=" . $message);
} else {
    header("location:index.php?page=ajouter-recette&message=" . $message . "&erreur=" . $erreur . "&donnees=" . json_encode($donnees) . "&erreurs=" . json_encode($erreurs));
}
