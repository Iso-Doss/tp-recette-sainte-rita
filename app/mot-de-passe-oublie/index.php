<!-- inscription.php -->

<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h1 class="text-center">Mot de passe oublié</h1>
        <form action="index.php?page=inscription-traitement" method="post">
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
                <button type="submit" class="btn btn-primary">Mot de passe oublié</button>
            </div>

            <div class="mb-3 text-center">
                <a href="index.php?page=connexion">J'ai déja un compte</a>
            </div>
        </form>
    </div>
</div>