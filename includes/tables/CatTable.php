<?php
// CLASSE QUI GERE LES CATEGORIES
class PostCat
{//ATTRIBUTS
    protected $table = 'cat';
    private $db;
//CONTRUCTEUR
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
//RECUP CAT
    public function get(int $id): Cat
    {
        $modif = $this->db->prepare("SELECT * from  {$this->table} where id= :id");
        $modif->bindParam(':id', $id);
        $res1 = $modif->execute();
        $res2 = $modif->fetch(\PDO::FETCH_ASSOC);
        $cat = new Cat();
        $cat->setID($res2['id']);
        $cat->setCat($res2['title']);
        return $cat;
    }

    public function all(): array
    {
        $sth = $this->db->query("SELECT * FROM {$this->table}");
        return $sth->fetchAll();
    }

    public function create(Cat $cat): void
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (categorie) VALUES (:categorie)");
        $categorie = $cat->getCategorie();
        $sth->bindParam(':categorie', $categorie);
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }


    public function delete(int $id): void
    {
        $supp = $this->db->prepare("DELETE FROM {$this->table} where id = :id");
        $supp->bindParam(':id', $id);
        $res = $supp->execute();
    }
}
