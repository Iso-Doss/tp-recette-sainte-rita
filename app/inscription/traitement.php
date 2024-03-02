<!-- inscription-traitement.php -->
<?php
// Le message de success global pour l'inscription.
$message = "";
// Le message d'erreur global pour l'inscription.
$erreur = "";
// Les données envoyées depuis le formulaire d'inscription.
$donnees = $_POST;
// Les messages d'erreur spécifique a chaque champ incorrect du formulaire d'inscription.
$erreurs = [];

if (empty($_POST)) {
    $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
} else {
    //$message = "Tous est Ok";
    if (!isset($_POST['nom']) || empty($_POST['nom'])) {
        $erreurs['nom'] = "Le champ nom de famille est vide ou inccorect.";
    }

    if (!isset($_POST['prenoms']) || empty($_POST['prenoms'])) {
        $erreurs['prenoms'] = "Le champ prénoms est vide ou inccorect.";
    }

    if (
        !isset($_POST['sexe']) ||
        empty($_POST['sexe']) ||
        ($_POST['sexe'] !== 'A' && $_POST['sexe'] !== 'F' && $_POST['sexe'] !== 'M')
    ) {
        $erreurs['sexe'] = "Le champ sexe est vide ou inccorect.";
    }

    if (!empty($erreurs)) {
        $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
    }
}

header("location:index.php?page=inscription&message=" . $message . "&erreur=" . $erreur . "&donnees=" . json_encode($donnees) . "&erreurs=" . json_encode($erreurs));
