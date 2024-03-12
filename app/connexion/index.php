<!-- connexion.php -->

<?php
// Le message de success global pour la connexion.
$message = "";
// Le message d'erreur global pour la connexion.
$erreur = "";
// Les données envoyées depuis le formulaire de la connexion.
$donnees = [];
// Les messages d'erreur spécifique a chaque champ incorrect du formulaire de la connexion.
$erreurs = [];

if (isset($_GET['message']) && !empty($_GET['message'])) {
    $message = $_GET['message'];
}

if (isset($_GET['erreur']) && !empty($_GET['erreur'])) {
    $erreur = $_GET['erreur'];
}

if (isset($_GET['donnees']) && !empty($_GET['donnees'])) {
    $donnees = json_decode($_GET['donnees'], true);
}

if (isset($_GET['erreurs']) && !empty($_GET['erreurs'])) {
    $erreurs = json_decode($_GET['erreurs'], true);
}

?>


<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h1 class="text-center">Se connecter</h1>
        
        <?php
        if (!empty($message)) {
        ?>
            <div class="alert alert-success" role="alert">
                <?= $message; ?>
            </div>
        <?php
        }

        if (!empty($erreur)) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $erreur; ?>
            </div>
        <?php
        }
        ?>
        <form action="index.php?page=connexion-traitement" method="post" novalidate>

            <div class="mb-3">
                <label for="connexion-email" class="form-label">
                    Adresse mail :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="email" name="email" class="form-control connexion-email" id="connexion-email" placeholder="Veuillez entrer votre adresse mail" value="<?= (isset($donnees['email']) && !empty($donnees['email'])) ? $donnees['email'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['email']) && !empty($erreurs['email'])) ? $erreurs['email'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="connexion-mot-de-passe" class="form-label">
                    Mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="mot-de-passe" class="form-control connexion-mot-de-passe" id="connexion-mot-de-passe" placeholder="Veuillez entrer votre mot de passe" value="<?= (isset($donnees['mot-de-passe']) && !empty($donnees['mot-de-passe'])) ? $donnees['mot-de-passe'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['mot-de-passe']) && !empty($erreurs['mot-de-passe'])) ? $erreurs['mot-de-passe'] : ''; ?>
                </p>
            </div>

            <div class="mb-3 form-check">
                <div class="row d-flex justify-content-space-between">
                    <div class="col-md-8">
                        <input type="checkbox" class="form-check-input" id="connexion-terms-conditions">
                        <label class="form-check-label" for="connexion-terms-conditions">Se souvenir de moi</label>
                    </div>
                    <div class="col-md-4">
                        <a href="index.php?page=mot-de-passe-oublie" class="text-right">
                            Mot de passe oublié
                        </a>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>

            <div class="mb-3 text-center">
                <a href="index.php?page=inscription">Je n'ai pas de compte</a>
            </div>
        </form>
    </div>
</div>