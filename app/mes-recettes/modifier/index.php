<!-- Modifier recette -->

<?php

if(!est_connecter()){
    header("location:index.php?page=connexion&erreur=Vous devez vous connectez.");
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de modifier n'existe pas.");
}

$recette = recuperer_recette_par_son_id($_GET['id']);

//die(var_dump($recette));

if(!isset($recette) || empty($recette)){
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de modifier n'existe pas.");
}else if($recette['id_utilisateur'] != $_SESSION['utilisateur_connecter']['id']){
    header("location:index.php?page=mes-recettes&erreur=La recette que vous essayez de modifier ne vous appartiens pas.");
}



// Le message de success global pour la modification d'une recette.
$message = "";
// Le message d'erreur global pour la modification d'une recette.
$erreur = "";
// Les données envoyées depuis le formulaire de modification de recette.
$donnees = [];
// Les messages d'erreur spécifique a chaque champ incorrect du formulaire de modification de recette.
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

if(empty($donnees)){
    $donnees = $recette;
}

if (isset($_GET['erreurs']) && !empty($_GET['erreurs'])) {
    $erreurs = json_decode($_GET['erreurs'], true);
}

?>

<div class="row d-flex justify-content-between align-items-center">

    <div class="col-md-9">
        <h1>Modification de la recette <?= $recette['nom'];?></h1>
    </div>

    <div class="col-md-3 text-end">
        <a href="index.php?page=mes-recettes" class="btn btn-success">
            Liste des recettes
        </a>
    </div>

</div>

<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-md-8">

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
        <form action="index.php?page=modifier-recette-traitement&id=<?=$_GET['id'];?>" method="post" novalidate enctype="multipart/form-data">

            <div class="mb-3">
                <label for="ajouter-recette-nom" class="form-label">
                    Nom de la recette :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="nom" class="form-control ajouter-recette-nom" id="ajouter-recette-nom" placeholder="Veuillez entrer le nom de la recette" value="<?= (isset($donnees['nom']) && !empty($donnees['nom'])) ? $donnees['nom'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['nom']) && !empty($erreurs['nom'])) ? $erreurs['nom'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="ajouter-recette-description" class="form-label">
                    Description de la recette :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input type="text" name="description" class="form-control ajouter-recette-description" id="ajouter-recette-description" placeholder="Veuillez entrer la desription de la recette" value="<?= (isset($donnees['description']) && !empty($donnees['description'])) ? $donnees['description'] : ''; ?>" required>
                <p class="text-danger">
                    <?= (isset($erreurs['description']) && !empty($erreurs['description'])) ? $erreurs['description'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="ajouter-recette-recette" class="form-label">
                    Étape de la recette :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <textarea class="form-control" name="recette" id="ajouter-recette-recette" rows="3"><?= (isset($donnees['recette']) && !empty($donnees['recette'])) ? $donnees['recette'] : ''; ?></textarea>
                <p class="text-danger">
                    <?= (isset($erreurs['recette']) && !empty($erreurs['recette'])) ? $erreurs['recette'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <label for="ajouter-recette-image" class="form-label">
                    Image de la recette :
                    <span class="text-danger">
                        (*)
                    </span>
                </label>
                <input class="form-control" type="file" id="ajouter-recette-image" name="image">
                <p class="text-danger">
                    <?= (isset($erreurs['image']) && !empty($erreurs['image'])) ? $erreurs['image'] : ''; ?>
                </p>
            </div>

            <div class="mb-3">
                <button type="reset" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-primary">Modifier une recette</button>
            </div>
        </form>
    </div>
</div>