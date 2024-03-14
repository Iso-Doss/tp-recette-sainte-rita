<!-- Mes recettes (liste) -->
<?php

if (!est_connecter()) {
    header("location:index.php?page=connexion&erreur=Vous devez vous connectez.");
}

$recettes = list_des_recettes($_SESSION['utilisateur_connecter']['id']);

if (isset($_GET['message']) && !empty($_GET['message'])) {
    $message = $_GET['message'];
}

if (!empty($message)) {
?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
<?php
}

?>

<div class="row d-flex justify-content-between align-items-center">

    <div class="col-md-6">
        <h1>Liste de mes recettes</h1>
    </div>

    <div class="col-md-6 text-end">
        <a href="index.php?page=ajouter-recette" class="btn btn-success">
            Ajouter une recette
        </a>
    </div>

</div>

<?php

if (empty($recettes)) {
    echo "Aucune recette n'a été trouvées pour le moment.";
} else { ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recettes as $recette) { ?>

                <tr>
                    <th scope="row">
                        <?= $recette['id']; ?>
                    </th>
                    <td>
                        <?= $recette['nom']; ?>
                    </td>
                    <td>
                        <?= $recette['description']; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#details-recette-<?= $recette['id']; ?>">
                            Détails
                        </button>
                        <a href="" class="btn btn-warning">
                            Modifier
                        </a>
                        <a href="" class="btn btn-danger">
                            Supprimer
                        </a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="details-recette-<?= $recette['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Détails sur la recette <?= $recette['nom']; ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <img style="height: 200px; width: auto; object-fit: contain;" src="/app/uploads/<?= $recette['image']; ?>" class="card-img-top" alt="Image de la recette">
                                </p>
                                <p>
                                    Nom :
                                    <span>
                                        <?= $recette['nom']; ?>
                                    </span>
                                </p>
                                <p>
                                    Description :
                                    <span>
                                        <?= $recette['description']; ?>
                                    </span>
                                </p>
                                <p>
                                    Étapes de la recettce :
                                    <span>
                                        <?= $recette['recette']; ?>
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </tbody>
    </table>
<?php } ?>