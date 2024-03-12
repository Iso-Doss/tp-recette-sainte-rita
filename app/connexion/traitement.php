<!-- connexion-traitement.php -->

<?php
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

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email est vide ou inccorect.";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le champ adresse email est inccorect.";
    }

    if (!isset($_POST['mot-de-passe']) || empty($_POST['mot-de-passe'])) {
        $erreurs['mot-de-passe'] = "Le champ mot de passe est vide ou inccorect.";
    } else if (strlen($_POST['mot-de-passe']) < 8) {
        $erreurs['mot-de-passe'] = "Le champ mot de passe doit contenir au minimum huit (8) caractères.";
    }

    if (!empty($erreurs)) {
        $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
    } else {
        $donnees_utilisateur = $donnees;
        $donnees_utilisateur["mot_de_passe"] = sha1($donnees_utilisateur["mot-de-passe"]);
        unset($donnees_utilisateur["mot-de-passe"]);
        $connexion_utilisateur = connexion_utilisateur($donnees_utilisateur);
        if (!empty($connexion_utilisateur)) {
            unset($connexion_utilisateur['mot-de-passe']);
            $_SESSION['utilisateur_connecter'] = $connexion_utilisateur;
            $message = "Connexion effectuée avec succès.";
        } else {
            $erreur = "Oupss!!! Identifiants (Email ou mot de passe) incorrect.";
        }
    }
}

if (isset($_SESSION['utilisateur_connecter']) && !empty($_SESSION['utilisateur_connecter']) && is_array($_SESSION['utilisateur_connecter'])) {
    header("location:index.php?page=accueil&message=" . $message);
} else {
    header("location:index.php?page=connexion&message=" . $message . "&erreur=" . $erreur . "&donnees=" . json_encode($donnees) . "&erreurs=" . json_encode($erreurs));
}
