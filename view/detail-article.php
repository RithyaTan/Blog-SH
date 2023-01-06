<?php
$date = new DateTime($data['date_creation']);
?>

<div class="container text-center mt-5">
    <div class="card" style="width: 60rem; margin: 0 auto;">
        <div class="card-body">
            <img src="<?= $data['image'] ?>" class="card-img-top" style="width:200px;">
            <h3 class="card-title"><?= $data['titre'] ?></h3>
            <table class="table table-bordered mt-4 mb-4">
                <tbody>
                    <tr>
                        <th scope="row">ID article</th>
                        <td><?= $data['id_article'] ?></td>
                    </tr>
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
                        <th scope="row">📅 Date de Création</th>
                        <td><?= $date->format('d-m-Y') ?></td>
                    </tr>
                    <tr>
                        <th scope="row">📅 Date de Mise à jour</th>
                        <td><?= $date->format('d-m-Y') ?></td>
                    </tr>
                    <tr>
                        <th scope="row">✍️ Sypnosis</th>
                        <td><?= $data['description'] ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="container">
                <a href="?op=update&id=<?= $data['id_article'] ?>" class="btn btn-warning"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                <a href="?op=delete&id=<?= $data['id_article'] ?>" class="btn btn-danger" onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet article. Merci de confirmer'))"><i class="fa-sharp fa-solid fa-trash-can"></i></a>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <a href="?op=null" class="btn btn-primary mt-5"><i class="fa-solid fa-right-to-bracket"></i> Retour</a>
    </div>
</div>