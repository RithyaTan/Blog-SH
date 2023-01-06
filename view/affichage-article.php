<?php
// echo '<pre>'; print_r($data); echo '</pre>';
// echo '<pre>'; print_r($fields); echo '</pre>';
?>

<div class="container">
    <div class="row" style="justify-content:space-around;">
        <?php foreach($data AS $dataArticle): ?>
            <div class="card text-center" style="width: 18rem; margin-bottom:20px;">
                <img src="<?= $dataArticle['image'] ?>" class="card-img-top" alt="photo article" style="margin: 10px auto; width:250px; height:350px;">
                <div class="card-body">
                    <h5 class="card-title"><?= $dataArticle['titre'] ?></h5>
                    <p class="card-text" style="overflow-y:hidden; height:50px;"><?= $dataArticle['description'] ?></p>
                    <a href="?op=select&id=<?= $dataArticle[$id] ?>" class="btn btn-primary">Voir l'article</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>