<?php
session_start();
require_once __DIR__ . '/app/fonction.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/asset/css/bootstrap.min.css" rel="stylesheet">
    <title>Site de recettes</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/app/commun/header.php'); ?>
    <div class="container">
        <?php
        // Router.
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            switch ($_GET['page']) {
                case 'accueil':
                    include_once(__DIR__ . '/accueil.php');
                    break;

                case 'contact':
                    include_once(__DIR__ . '/contact.php');
                    break;

                case 'inscription':
                    include_once(__DIR__ . '/app/inscription/index.php');
                    break;
                    break;

                case 'inscription-traitement':
                    include_once(__DIR__ . '/app/inscription/traitement.php');
                    break;

                case 'connexion':
                    include_once(__DIR__ . '/app/connexion/index.php');
                    break;

                case 'connexion-traitement':
                    include_once(__DIR__ . '/app/connexion/traitement.php');
                    break;
                    break;

                case 'mot-de-passe-oublie':
                    include_once(__DIR__ . '/app/mot-de-passe-oublie/index.php');
                    break;

                case 'mot-de-passe-oublie-traitement':
                    include_once(__DIR__ . '/app/mot-de-passe-oublie/traitement.php');
                    break;

                case 'se-deconnecter':
                    include_once(__DIR__ . '/app/se-deconnecter.php');
                    break;

                case 'mes-recettes':
                    include_once(__DIR__ . '/app/mes-recettes/index.php');
                    break;

                case 'ajouter-recette':
                    include_once(__DIR__ . '/app/mes-recettes/ajouter-recette.php');
                    break;

                case 'ajouter-recette-traitement':
                    include_once(__DIR__ . '/app/mes-recettes/ajouter-recette-traitement.php');
                    break;

                case 'modifier-recette':
                    include_once(__DIR__ . '/app/mes-recettes/modifier-recette.php');
                    break;

                case 'modifier-recette-traitement':
                    include_once(__DIR__ . '/app/mes-recettes/modifier-recette-traitement.php');
                    break;

                default:
                    include_once(__DIR__ . '/404.php');
                    break;
            }
        } else {
            include_once(__DIR__ . '/accueil.php');
        }
        ?>
    </div>
    <?php require_once(__DIR__ . '/app/commun/footer.php'); ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>