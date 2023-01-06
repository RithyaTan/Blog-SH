<?php

namespace controller;

class Controller 
{
    private $dbArticleRepository;

    public function __construct()
    {
        // INSTANCIATION DE LA CLASS CONTROLLER
        $this->dbArticleRepository = new \model\ArticleRepository;
        // echo "✅ Instanciation de la class Controller réussie !";
    }

    // PILOTAGE DE L'APPLICATION AVEC handleRequest()
    public function handleRequest()
    {
        session_start();
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;

        try
        {
            if($op == 'add' || $op == 'update')
                $this->save($op);
            elseif($op == 'select')
                $this->select();
            elseif($op == 'delete')
                $this->delete();
            elseif($op == 'recherche')
                $this->recherche(); 
            else
                $this->selectAll();
        }
        catch(\Exception $e)
        {
            echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
            echo " 🛑 Une erreur s'est produite : " . $e->getMessage();
            echo '</div>';
        }
    }

    // METHODE render() POUR CONSTRUIRE UNE VUE
    public function render($layout, $template, $parameters = [])
    {
        extract($parameters);           // EXTRACTION DE CHAQUE INDICE D'UN TABLEAU ARRAY SOUS FORME DE VARIABLE
        ob_start();                     // ENCLENCHE LA TEMPORISATION DE SORTIE
        require_once "view/$template";  // L'INCLUSION SERA STOCKE DANS LA VARIABLE $content
        $content = ob_get_clean();      // STOCKE DE LA VARIABLE $content EN VIDANT LA MEMOIRE TAMPON
        ob_start();                     // ENCLENCHE LA TEMPORISATION DE LA SORTIE D'AFFICHAGE
        require_once "view/$layout";    // INCLUS LE LAYOUT
        return ob_end_flush();          // LIBERE ET FAIT APPARAITRE LES ELEMENTS DANS LE NAVIGATEUR
    }

    // METHODE POUR AFFICHER TOUS LES ARTICLES
    public function selectAll()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        if(isset($_GET['id']))
        {
            $confirmation = (!empty($id)) ? "✅ L'article n°$id a été modifié avec succès !" : "✅ La création de l'article a été effectué avec succès !";
        }
        else
        {
            $confirmation = '';
        }
        $this->render('layout.php', 'affichage-article.php', [
            'title' => 'LISTE DES ARTICLES',
            'data' => $this->dbArticleRepository->selectAllArticleRepo(),
            'fields' => $this->dbArticleRepository->getFields(),
            'id' => 'id_' . $this->dbArticleRepository->table,
            'message' => "Ci-dessous vous trouverez tous les articles",
            'alert' => $confirmation
        ]);
    }
    
    // METHODE POUR SELECTIONNER ET AFFICHER LES DETAILS D'UN ARTICLE
    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail-article.php', [
            'title' => "DETAIL DE L'ARTICLE",
            'data' => $this->dbArticleRepository->selectArticleRepo($id),
            'id' => 'id_' . $this->dbArticleRepository->table,
            'message' => "Voici les informations concernant l'article n°$id"
        ]);
    }

    // METHODE POUR SUPPRIMER UN ARTICLE
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $res = $this->dbArticleRepository->deleteArticleRepo($id);

        $this->render('layout.php', 'affichage-article.php', [
            'title' => 'LES ARTICLES',
            'data' => $this->dbArticleRepository->selectAllArticleRepo(),
            'fields' => $this->dbArticleRepository->getFields(),
            'id' => 'id_' . $this->dbArticleRepository->table,
            'message' => "Ci-dessous vous trouverez tous les articles",
            'alert' => "✅ L'article n°$id a bien été supprimé de la base de données"
        ]);
    }

    // METHODE DE REDIRECTION
    public function redirect($location)
    {
        header('Location:' . $location);
    }

    // METHODE POUR ENREGISTRER OU MODIFIER UN ARTICLE
    public function save($op)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $values = ($op == 'update') ? $this->dbArticleRepository->selectArticleRepo($id) : '';
        foreach ($_POST as $indice => $valeur) 
        {
            $_POST[$indice] = htmlentities(addslashes($valeur));
        }

        if($_POST)
        {
            $res = $this->dbArticleRepository->saveArticleRepo();
            $this->redirect("?id=$id");
        }

        $this->render('layout.php', 'contact-form.php', [
            'title' => "AJOUTER / MODIFIER",
            'op' => $op,
            'fields' => $this->dbArticleRepository->getFields(),
            'values' => $values,
            'message' => "Ci-dessous vous trouverez un formulaire pour ajouter ou modifier un article"
        ]);
    }

    // METHODE POUR RECHERCHER UNE ARTICLE
    public function recherche()
    {
        if($_POST)
        {
            $this->render('layout.php', 'recherche-article.php', [
                'title' => "RESULTAT",
                'result' => $this->dbArticleRepository->rechercheArticleRepo($_POST['recherche']),
                'message' => "Voici les résultats de votre recherche."
            ]);
        }
        else
        {
            $this->redirect('?op=null');
        }
    }
}
?>