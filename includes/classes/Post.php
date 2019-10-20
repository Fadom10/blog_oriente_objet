<?php
// CLASSE D'UN ARTICLE
class Post
{//ATTRIBUTS
    private $id;
    private $title;
    private $content;
    private $cat;
//GETTEUR ET SETTEUR
    public function getID(): int
    {
        return $this->id;
    }

    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCat(): int
    {
        return $this->cat;
    }

    public function setCat(int $cat): self
    {
        $this->cat = $cat;
        return $this;
    }
//RECUP TITLE DEPUIS UN ID
    public function title($num):title
    {

        global $db;
        $titre = $db->prepare("SELECT title FROM posts where id = ?");
        $titre->execute(array($num));
        $res = $titre->fetch(\PDO::FETCH_ASSOC);

        return $res['title'];
    }
//RECUP CONTENT DEPUIS UN ID
    public function content($num):string
    {

        global $db;
        $contenu = $db->prepare("SELECT content FROM posts where id = ?");
        $contenu->execute(array($num));
        $res = $contenu->fetch(\PDO::FETCH_ASSOC);

        return $res['content'];
    }

 
}
