<!-- inscription-traitement.php -->
<?php

if(est_connecter()){
    header("location:index.php?page=mes-recettes&message=Vous êtes déja connectez.");
}

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

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email est vide ou inccorect.";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le champ adresse email est inccorect.";
    }
    if (verifier_si_un_utilisateur_exist_grace_a_son_email($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email contient une valeur qui est déja pris par un autre utilisateur.";
    }

    $erreurs['mot-de-passe'] = '';
    $erreurs['confirmation-mot-de-passe'] = '';

    if (!isset($_POST['mot-de-passe']) || empty($_POST['mot-de-passe'])) {
        $erreurs['mot-de-passe'] .= "Le champ mot de passe est vide ou inccorect.";
    } else if (strlen($_POST['mot-de-passe']) < 8) {
        $erreurs['mot-de-passe'] .= "Le champ mot de passe doit contenir au minimum huit (8) caractères.";
    }

    if (!isset($_POST['confirmation-mot-de-passe']) || empty($_POST['confirmation-mot-de-passe'])) {
        $erreurs['confirmation-mot-de-passe'] .= "Le champ de confirmation du mot de passe est vide ou inccorect.";
    } else if (strlen($_POST['confirmation-mot-de-passe']) < 8) {
        $erreurs['confirmation-mot-de-passe'] .= "Le champ de confirmation du mot de passe doit contenir au minimum huit (8) caractères.";
    }

    if (
        isset($_POST['mot-de-passe']) && !empty($_POST['mot-de-passe']) &&
        isset($_POST['confirmation-mot-de-passe']) && !empty($_POST['confirmation-mot-de-passe']) &&
        $_POST['mot-de-passe'] !== $_POST['confirmation-mot-de-passe']
    ) {
        $erreurs['mot-de-passe'] .= "Les champs mot de passe et confirmation de mot de passe doivent être identiques.";
        $erreurs['confirmation-mot-de-passe'] .= "Les champs mot de passe et confirmation de mot de passe doivent être identiques.";
    }

    if (!isset($_POST['terms-conditions']) || empty($_POST['terms-conditions'])) {
        $erreurs['terms-conditions'] = "Le champ terms et conditions du site de recettes n'est pas coché.";
    }

    if (empty($erreurs['mot-de-passe'])) {
        unset($erreurs['mot-de-passe']);
    }

    if (empty($erreurs['confirmation-mot-de-passe'])) {
        unset($erreurs['confirmation-mot-de-passe']);
    }

    if (!empty($erreurs)) {
        $erreur = "Oupss!!! Un ou plusieur(s) champs sont incorrect";
    } else {
        $donnees_utilisateur = $donnees;
        $donnees_utilisateur["mot_de_passe"] = sha1($donnees_utilisateur["mot-de-passe"]);
        unset($donnees_utilisateur["confirmation-mot-de-passe"]);
        unset($donnees_utilisateur["terms-conditions"]);
        unset($donnees_utilisateur["terms-conditions"]);
        unset($donnees_utilisateur["mot-de-passe"]);
        $inscrire_utilisateur = inscrire_utilisateur($donnees_utilisateur);
        if ($inscrire_utilisateur) {
            $message = "Inscription effectuée avec succès.";
        } else {
            $erreur = "Oupss!!! Une erreur inatendue est survenue lors de l'inscrption. Veuillez reessayer ou contacter nos administrateur.";
        }
    }
}

header("location:index.php?page=inscription&message=" . $message . "&erreur=" . $erreur . "&donnees=" . json_encode($donnees) . "&erreurs=" . json_encode($erreurs));
