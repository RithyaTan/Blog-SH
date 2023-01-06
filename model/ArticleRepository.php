<?php

namespace model;

class ArticleRepository
{
    private $db;
    public $table;

    // METHODE : getDb pour construire la connexion à la BDD
    public function getDb()
    {
        if(!$this->db)
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml');
                    // echo '<pre>'; print_r($xml); echo '</pre>';
                $this->table = $xml->table;
                try
                {
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
                }
                catch(\PDOException $e)
                {
                    echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
                    echo " 🛑 Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage();
                    echo '</div>';
                }
            }
            catch (\Exception $e)
            {
                echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
                echo " 🛑 Une erreur s'est produite lors du chargement du fichier XML : " . $e->getMessage();
                echo '</div>';
            }
        }
        return $this->db;
    }

    // SELECTIONNER L'ENSEMBLE DES ARTICLES DANS LA TABLE "article"
    public function selectAllArticleRepo()
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table);
        $resultat = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $resultat;
    }
    
    // SELECTIONNER TOUS LES NOMS DES COLONNES DE LA TABLE "article"
    public function getFields()
    {
        $data = $this->getDb()->query("DESC " . $this->table);
        $resultat = $data->fetchAll(\PDO::FETCH_ASSOC);
        return array_slice($resultat, 1);
    }

    // SELECTIONNER UN ARTICLE DANS LA BDD EN FONCTION DE SON ID
    public function selectArticleRepo($id)
    {
        $data = $this->getDb()->query("SELECT * FROM " . $this->table . " WHERE id_" . $this->table . " = " . $id);
        $resultat = $data->fetch(\PDO::FETCH_ASSOC);
        return $resultat;
    }

    // SUPPRIMER UN ARTICLE DE LA BDD EN FONCTION DE SON ID
    public function deleteArticleRepo($id)
    {
        $q = $this->getDb()->query('DELETE FROM ' .$this->table . ' WHERE id_' . $this->table . ' = ' . $id);
    }

    // AJOUTER OU MODIFIER UN ARTICLE
    public function saveArticleRepo()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        $q = $this->getDb()->query('REPLACE INTO ' . $this->table . '(id_' . $this->table . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');
    }

    // RECHERCHER UN ARTICLE
    public function rechercheArticleRepo($value)
    {
        $valeur = "%" . $value . '%';
        $data = $this->getDb()->query('SELECT * FROM ' . $this->table . ' WHERE titre LIKE "' . $valeur . '"');
        if($data->rowCount() == 0)
        {
            $resultat = '';
        }
        else
        {
            $resultat = $data->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $resultat;
    }

}