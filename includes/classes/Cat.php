<?php
// CLASSE D'UNE CATEGORIE
class Cat
{//ATTRIBUTS
    private $id;
    private $categorie;
//GUETEUR ET SETTEUR
    public function getID(): int
    {
        return $this->id;
    }

    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCategorie(): string
    {
        return $this->title;
    }

    public function setCategorie(string $title): self
    {
        $this->title = $title;
        return $this;
    }
//RECUP CATEGORIE DEPUIS UN ID
    public function categorie($num): title
    {

        global $db;
        $titre = $db->prepare("SELECT categorie FROM cat where id = ?");
        $titre->execute(array($num));
        $res = $titre->fetch(\PDO::FETCH_ASSOC);

        return $res['categorie'];
    }
}
