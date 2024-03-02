<!-- inscription.php -->

<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h1 class="text-center">S'inscrire</h1>
        <form action="index.php?page=inscription-traitement" method="post">
            <div class="mb-3">
                <label for="inscription-nom" class="form-label">
                    Nom de famille :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="nom" class="form-control inscription-nom" id="inscription-nom" placeholder="Veuillez entrer votre nom de famille">
            </div>

            <div class="mb-3">
                <label for="inscription-prenoms" class="form-label">
                    Prénoms :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="prenoms" class="form-control inscription-prenoms" id="inscription-prenoms" placeholder="Veuillez entrer vos prénoms">
            </div>

            <div class="mb-3">
                <label for="inscription-sexe" class="form-label">
                    Sexe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <select class="form-select" id="inscription-sexe" name="sexe">
                    <option selected>Veuillez sélectionner votre sexe</option>
                    <option value="M">Homme</option>
                    <option value="F">Femme</option>
                    <option value="A">Autres</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="inscription-email" class="form-label">
                    Adresse mail :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="email" name="email" class="form-control inscription-email" id="inscription-email" placeholder="Veuillez entrer votre adresse mail">
            </div>

            <div class="mb-3">
                <label for="inscription-mot-de-passe" class="form-label">
                    Mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="mot-de-passe" class="form-control inscription-mot-de-passe" id="inscription-mot-de-passe" placeholder="Veuillez entrer votre mot de passe">
            </div>

            <div class="mb-3">
                <label for="inscription-confirmation-mot-de-passe" class="form-label">
                    Confirmation mot de passe :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="password" name="confirmation-mot-de-passe" class="form-control inscription-confirmation-mot-de-passe" id="inscription-confirmation-mot-de-passe" placeholder="Veuillez entrer confirmer votre mot de passe">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="inscription-terms-conditions">
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