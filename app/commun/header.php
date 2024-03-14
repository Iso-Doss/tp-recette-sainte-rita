<!-- header.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=accueil">Site de recettes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] == 'accueil') ? 'active' : '' ?>" aria-current="page" href="index.php?page=accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] == 'contact') ? 'active' : '' ?>" href="index.php?page=contact">Contact</a>
                </li>
                <?php
                if (est_connecter()) { ?>
                    <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page'] == 'mes-recettes' || $_GET['page'] == 'ajouter-recette')) ? 'active' : '' ?>"  href="index.php?page=mes-recettes">
                            Mes recettes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=se-deconnecter">Se déconnecter</a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page'] == 'inscription' || $_GET['page'] == 'connexion' || $_GET['page'] == 'mot-de-passe-oublie')) ? 'active' : '' ?>" href="index.php?page=connexion">S'inscrire / Se connecter</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
        if (est_connecter()) {
            echo "Bonjour " . $_SESSION['utilisateur_connecter']['nom'] . " " .  $_SESSION['utilisateur_connecter']['prenoms'];
        } ?>
    </div>
</nav>