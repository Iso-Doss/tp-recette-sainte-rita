<!-- connexion.php -->

<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h1 class="text-center">Se connecter</h1>
        <form action="index.php?page=connexion-traitement" method="post">

            <div class="mb-3">
                <label for="connexion-email" class="form-label">
                    Adresse mail :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="email" name="email" class="form-control connexion-email" id="connexion-email" placeholder="Veuillez entrer votre adresse mail">
            </div>

            <div class="mb-3">
                <label for="connexion-mot-de-passe" class="form-label">
                    Mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="mot-de-passe" class="form-control connexion-mot-de-passe" id="connexion-mot-de-passe" placeholder="Veuillez entrer votre mot de passe">
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