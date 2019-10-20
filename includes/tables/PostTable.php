<?php
//CLASSE QUI GERE LES ARTICLES
class PostTable
{//ATTRIBUTS
    protected $table = 'posts';
    private $db;
//CONSTRUCTEUR
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
//RECUP POST DEPUIS UN ID
    public function get(int $id): Post
    {
        $modif = $this->db->prepare("SELECT * from  {$this->table} where id= :id");
        $modif->bindParam(':id', $id);
        $res1 = $modif->execute();
        $res2 = $modif->fetch(\PDO::FETCH_ASSOC);
        $post = new Post();
        $post->setID($res2['id']);
        $post->setTitle($res2['title']);
        $post->setContent($res2['content']);
        $post->setCat($res2['id_cat']);
        return $post;
    }
//RECUP TOUS LES ARTICLES
    public function all(): array
    {
        $sth = $this->db->query("SELECT * FROM {$this->table}");
        return $sth->fetchAll();
    }
//CREER UN POST
    public function create(Post $post): void
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (title, content,id_cat) VALUES (:title, :content, :cat)");
        $titre = $post->getTitle();
        $content = $post->getContent();
        $cat = $post->getCat();
        $sth->bindParam(':title', $titre);
        $sth->bindParam(':content', $content);
        $sth->bindParam(':cat', $cat);
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }
//MAJ POST
    public function update(Post $post): void
    {

        $modif = $this->db->prepare("UPDATE {$this->table}  SET title =:title ,content =:content where id=:id");
        $titre = $_POST['titre'];
        $content=$_POST['article'];
        $id = $post->getID();
        $modif->bindParam(':title', $titre);
        $modif->bindParam(':content', $content);
        $modif->bindParam(':id', $id);
        $res = $modif->execute();
    }
//SUPP POST
    public function delete(int $id): void
    {
        $supp = $this->db->prepare("DELETE FROM {$this->table} where id = :id");
        $supp->bindParam(':id', $id);
        $res = $supp->execute();
    }
//RECUP CATEGORIE D'UN POSt
    public function get_cat_by_id($num):string
    {

        global $db;
        $contenu = $db->prepare("SELECT * FROM cat where id = ?");
        $contenu->execute(array($num));
        $res = $contenu->fetch(\PDO::FETCH_ASSOC);

        return $res['categorie'];
    }
}
