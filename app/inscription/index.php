<!-- inscription.php -->
<?php
// Le message de success global pour l'inscription.
$message = "";
// Le message d'erreur global pour l'inscription.
$erreur = "";
// Les données envoyées depuis le formulaire d'inscription.
$donnees = [];
// Les messages d'erreur spécifique a chaque champ incorrect du formulaire d'inscription.
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
        <h1 class="text-center">S'inscrire</h1>

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

        <form action="index.php?page=inscription-traitement" method="post" novalidate>
            <div class="mb-3">
                <label for="inscription-nom" class="form-label">
                    Nom de famille :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="nom" class="form-control inscription-nom" id="inscription-nom" placeholder="Veuillez entrer votre nom de famille" value="<?= (isset($donnees['nom']) && !empty($donnees['nom'])) ? $donnees['nom'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['nom']) && !empty($erreurs['nom'])) ? $erreurs['nom'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="inscription-prenoms" class="form-label">
                    Prénoms :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="prenoms" class="form-control inscription-prenoms" id="inscription-prenoms" placeholder="Veuillez entrer vos prénoms" value="<?= (isset($donnees['prenoms']) && !empty($donnees['prenoms'])) ? $donnees['prenoms'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['prenoms']) && !empty($erreurs['prenoms'])) ? $erreurs['prenoms'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="inscription-sexe" class="form-label">
                    Sexe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <select class="form-select" id="inscription-sexe" name="sexe" required>
                    <option <?= (isset($donnees['sexe']) && !empty($donnees['sexe']) && $donnees['sexe'] == '') ? 'selected' : '' ?>>Veuillez sélectionner votre sexe</option>
                    <option <?= (isset($donnees['sexe']) && !empty($donnees['sexe']) && $donnees['sexe'] == 'M') ? 'selected' : '' ?> value="M">Homme</option>
                    <option <?= (isset($donnees['sexe']) && !empty($donnees['sexe']) && $donnees['sexe'] == 'F') ? 'selected' : '' ?> value="F">Femme</option>
                    <option <?= (isset($donnees['sexe']) && !empty($donnees['sexe']) && $donnees['sexe'] == 'A') ? 'selected' : '' ?> value="A">Autres</option>
                </select>
                <p class="text-danger">
                    <?= (isset($erreurs['sexe']) && !empty($erreurs['sexe'])) ? $erreurs['sexe'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="inscription-email" class="form-label">
                    Adresse mail :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="email" name="email" class="form-control inscription-email" id="inscription-email" placeholder="Veuillez entrer votre adresse mail" required>
            </div>

            <div class="mb-3">
                <label for="inscription-mot-de-passe" class="form-label">
                    Mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="mot-de-passe" class="form-control inscription-mot-de-passe" id="inscription-mot-de-passe" placeholder="Veuillez entrer votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="inscription-confirmation-mot-de-passe" class="form-label">
                    Confirmation mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="confirmation-mot-de-passe" class="form-control inscription-confirmation-mot-de-passe" id="inscription-confirmation-mot-de-passe" placeholder="Veuillez entrer confirmer votre mot de passe" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="inscription-terms-conditions" required>
                <label class="form-check-label" for="inscription-terms-conditions">Oui j'accepte les terms et conditions du site de recettes</label>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>

            <div class="mb-3 text-center">
                <a href="index.php?page=connexion">J'ai déja un compte</a>
            </div>
        </form>
    </div>
</div>