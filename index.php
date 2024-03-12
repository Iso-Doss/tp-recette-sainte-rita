<?php
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

</html>