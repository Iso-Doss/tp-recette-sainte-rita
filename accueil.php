<!-- accueil.php -->

<?php

$recettes = list_des_recettes();
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

<h1>Site de recettes</h1>

<p>Liste des recettes</p>

<?php

if (empty($recettes)) {
    echo "Aucune recette n'ai disponible pour le moment.";
} else { ?>
    <div class="row g-4">
        <?php foreach ($recettes as $recette) { ?>
            <div class="col-md-3">
                <div class="card">
                    <img style="height: 200px; width: auto; object-fit: contain;" src="/app/uploads/<?= $recette['image']; ?>" class="card-img-top" alt="Image de la recette">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $recette['nom']; ?>
                        </h5>
                        <a href="#" class="btn btn-primary">Voir les détails</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

<?php } ?>