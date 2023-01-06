<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Blog Super Héros</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="?op=null"><img src="images\logo_superheros.png" style="width:200px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?op=null"><i class="fa-sharp fa-solid fa-house"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?op=add"><i class="fa-sharp fa-solid fa-plus"></i> Ajouter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fa-sharp fa-solid fa-user-astronaut"></i> Se connecter</a>
                    </li>
                </ul>
                <form class="d-flex" method="post" role="search" action="?op=recherche">
                    <input class="form-control me-2" name="recherche" type="search" placeholder="Rechercher un article" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <h2 class="text-center mt-5 mb-5"><?= $title; ?></h2>
    <div class="container">
        <div class="alert alert-info text-center"><?= $message; ?></div>
    </div>
    <?php
        if(!empty($alert))
        {
            echo '<div class="container"><div class="alert alert-success text-center">';
            echo $alert;
            echo '</div></div>';
        }
        if(!empty($bad_alert))
        {
            echo '<div class="container"><div class="alert alert-warning text-center">';
            echo $bad_alert;
            echo '</div></div>';
        }
    ?>

    <div class="container mt-5 mb-5" style="min-height: 79vh;">
        <?= $content ?>
    </div>

    <footer class="container-fluid navbar-dark bg-dark text-center" style="min-height:60px; color:white;">
        <p style="padding: 15px;"><?= date('Y') ?> - Tous droits reservés - <i class="fa-solid fa-copyright"></i> SUPER HEROS</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</html>