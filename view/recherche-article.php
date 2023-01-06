<?php
if(!empty($result))
{

?>
<div class="alert alert-success text-center">✅ Nombre de résultat(s) : <?= sizeof($result); ?></div>
<div class="container d-flex justify-content-around flex-wrap text-center mt-5">
    <?php foreach($result AS $data): ?>

    <div class="container text-center mt-5">
        <div class="card" style="width: 30rem; margin: 0 auto;">
            <div class="card-body">
                <img src="<?= $data['image'] ?>" class="card-img-top" style="width:200px;">
                <h3 class="card-title"><?= $data['titre'] ?></h3>
                <table class="table table-bordered mt-4 mb-4">
                    <tbody>
                        <tr>
                            <th scope="row">🎭 Type</th>
                            <td><?php if ($data['type'] == 'marvel')
                            {
                                echo '<img src="images\Marvel_Logo.svg.png" alt="logo Marvel" style="width:100px;">';
                            } 
                            else
                            {
                                echo '<img src="images\DC_Comics_logo.png" alt="photo du salarié" style="width:100px;">';
                            }?></td>
                        </tr>
                        <tr>
                            <th scope="row">✍️ Sypnosis</th>
                            <td><p class="card-text" style="overflow-y:hidden; height:70px;"><?= $data['description'] ?></p></td>
                        </tr>
                    </tbody>
                </table>
                <div class="container">
                    <a href="?op=select&id=<?= $data['id_article'] ?>" class="btn btn-primary">Voir l'article</a>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <a href="?op=null" class="btn btn-primary mt-5"><i class="fa-solid fa-right-to-bracket"></i> Retour</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
}
else
{
    echo '<div class="alert alert-danger text-center">⚠️ Aucun résultat ne correspond à votre recherche !</div>';
}