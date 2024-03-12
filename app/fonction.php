<?php

/**
 * Cette fonction permet de se connecter a une base de données.
 * 
 * @return string|object $db Le message d'erreur en cas d'erreur ou l'instance de la base de données.
 */
function connexion_db(): string | object
{
    try {
        $db =  new PDO('mysql:host=localhost:8889;dbname=recette-sainte-rita;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        $db =  'Erreur : Impossible de se connecter a la base de données.';
    }

    return $db;
}

/**
 * Cette fonction permet d'inscrire ou de créer ou d'ajouter un utilisateur dans la base de données grace à ces informations.
 * 
 * @param array $donnees Les données de l'utilisateur.
 * @return bool L'utilisateur est créer ou pas.
 */
function inscrire_utilisateur(array $donnees): bool
{
    $inscrire_utilisateur = false;
    $db = connexion_db();

    if (is_object($db)) {
        // Ecriture de la requête
        $requetteSql = "INSERT INTO `utilisateur`(`nom`, `prenoms`, `sexe`, `email`, `mot-de-passe`) VALUES (:nom, :prenoms, :sexe, :email, :mot_de_passe)";

        // Préparation
        $ajouter_utilisateur = $db->prepare($requetteSql);

        // Exécution ! L'utilisateur est maintenant en base de données
        try {
            $inscrire_utilisateur = $ajouter_utilisateur->execute($donnees);
        } catch (Exception $e) {
            $inscrire_utilisateur = false;
        }
    }

    return $inscrire_utilisateur;
}

/**
 * Cette fonction permet de verifier si un utilisateur exist ou pas grace a son email.
 * 
 * @param string $email L'adresse email de l'utilisateur.
 * @return bool Es ce que l'utilisateur a été trouver ou pas.
 */
function verifier_si_un_utilisateur_exist_grace_a_son_email(string $email): bool
{
    $utilisateur_exist = false;
    $db = connexion_db();

    if (is_object($db)) {
        // Ecriture de la requête
        $requetteSql = "SELECT * FROM `utilisateur` WHERE `email` = :email";

        // Préparation
        $verifier_utilisateur = $db->prepare($requetteSql);

        // Exécution ! L'utilisateur est maintenant en base de données
        try {
            $verifier_utilisateur->execute([
                'email' => $email
            ]);

            $utilisateur =  $verifier_utilisateur->fetch();
            if (is_array($utilisateur)) {
                $utilisateur_exist = true;
            }
        } catch (Exception $e) {
            $utilisateur_exist = false;
        }
    }

    return $utilisateur_exist;
}


/**
 * Cette fonction permet de verifier s'il exist un utilisateur dans la base de données qui correctiond aux informations de l'utilisateur (email et mot de passe).
 * 
 * @param array $donnees Les données de l'utilisateur.
 * @retrun array $utilisateur Les données de l'utilisateur.
 */
function connexion_utilisateur($donnees_utilisateur): array
{
    $utilisateur = [];
    $db = connexion_db();

    if (is_object($db)) {
        // Ecriture de la requête
        $requetteSql = "SELECT * FROM `utilisateur` WHERE `email` = :email and `mot-de-passe` = :mot_de_passe";

        // Préparation
        $verifier_utilisateur = $db->prepare($requetteSql);

        // Exécution ! L'utilisateur est maintenant en base de données
        try {
            $verifier_utilisateur->execute($donnees_utilisateur);

            $utilisateur =  $verifier_utilisateur->fetch(PDO::FETCH_ASSOC);
            if (is_array($utilisateur)) {
                $utilisateur = $utilisateur;
            } else {
                $utilisateur = [];
            }
        } catch (Exception $e) {
            $utilisateur = [];
        }
    }

    return $utilisateur;
}

function est_connecter(): bool
{
    return isset($_SESSION['utilisateur_connecter']) && !empty($_SESSION['utilisateur_connecter']) && is_array($_SESSION['utilisateur_connecter']);
}
