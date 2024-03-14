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

/**
 * Cette fonction permet de verifier si un utilisateur est connecter ou pas.
 * 
 * @return bool
 */
function est_connecter(): bool
{
    return isset($_SESSION['utilisateur_connecter']) && !empty($_SESSION['utilisateur_connecter']) && is_array($_SESSION['utilisateur_connecter']);
}

/**
 * Cette fonction s'assure que le televersement du ficher est effectué avec succès.
 * 
 * @param string $nom_du_champ Le nom du champ.
 * @return bool|string
 */
function verfier_image_televerser(string $nom_du_champ): bool | string
{
    // Testons si le fichier a bien été envoyé et s'il n'y a pas des erreurs
    if (isset($_FILES[$nom_du_champ]) && $_FILES[$nom_du_champ]['error'] === 0) {

        // Testons, si le fichier est trop volumineux
        if ($_FILES[$nom_du_champ]['size'] > 1000000) {
            return "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse.";
        }

        // Testons, si l'extension n'est pas autorisée
        $fileInfo = pathinfo($_FILES[$nom_du_champ]['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        if (!in_array($extension, $allowedExtensions)) {
            return  "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée.";
        }

        // Testons, si le dossier uploads est manquant
        $path =  __DIR__ . '/uploads/';
        if (!is_dir($path)) {
            mkdir(__DIR__ . '/uploads/');
        }

        // On peut valider le fichier et le stocker définitivement
        return move_uploaded_file($_FILES[$nom_du_champ]['tmp_name'], $path . basename($_FILES[$nom_du_champ]['name']));
    }
    return "Le champ image est vide ou incorrect.";
}

/**
 * Cette fonction permet d'ajouter une recette dans la base de données grace qu information de la recette envoyer par l'utilisateur.
 * 
 * @param array $donnees_recette Les données de la recette.
 * @return bool
 */
function ajouter_recette(array $donnees_recette): bool
{
    $ajouter_recette = false;

    $db = connexion_db();

    if (is_object($db)) {
        // Ecriture de la requête
        $requetteSql = "INSERT INTO `recette`(`nom`, `description`, `recette`, `image`, `id_utilisateur`) VALUES (:nom, :description, :recette, :image, :id_utilisateur)";

        // Préparation
        $requette = $db->prepare($requetteSql);

        // Exécution ! La recette est maintenant en base de données
        try {
            $ajouter_recette = $requette->execute($donnees_recette);
        } catch (Exception $e) {
            $ajouter_recette = false;
        }
    }

    return $ajouter_recette;
}

/**
 * Cette fonction permet de récuprer depuis la base de données la liste des recettes.
 * 
 * @return array $list_des_recettes La liste des recettes.
 */
function list_des_recettes(int $id_utilisateur = null): array
{
    $list_des_recettes = [];

    $db = connexion_db();

    if (is_object($db)) {
        // Ecriture de la requête
        $requetteSql = "SELECT * FROM recette";

        if (!is_null($id_utilisateur)) {
            $requetteSql = $requetteSql . " where id_utilisateur = :id_utilisateur";
        }

        // Préparation
        $requette = $db->prepare($requetteSql);

        // Exécution ! La recette est maintenant en base de données
        try {
            $donnees = [];

            if (!is_null($id_utilisateur)) {
                $donnees['id_utilisateur'] = $id_utilisateur;
            }

            $requette->execute($donnees);
            $recettes = $requette->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($recettes)) {
                $list_des_recettes = $recettes;
            }
        } catch (Exception $e) {
            $list_des_recettes = [];
        }
    }

    return $list_des_recettes;
}
