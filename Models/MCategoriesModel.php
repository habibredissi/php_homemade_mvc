<?php

class MCategories extends Model
{
    private $bdd;
    public function __construct()
    {
        parent::__construct();
        $this->bdd = $this->getDB();
    }

    public function create($data)
    {
        $sql = "INSERT INTO categories(name) VALUES (:name)";
        $req = $this->bdd->prepare($sql);
        $req->execute($data);
    }

    public function update($data, $id)
    {
        $sql  = "UPDATE categories set NAME=:name WHERE id=".$id;
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE from categories WHERE id=".$id;
        $req = $this->bdd->prepare($sql);
        $res = $req->execute();
    }

    public function get($id = null)
    {   
        if($id == null)
        {
            $sql = 'SELECT * FROM categories ORDER BY id';
            $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        else
        {
            $sql = 'SELECT * FROM categories WHERE id='.$id;
            $req = $this->bdd->query($sql);
            return $req->fetch();
        }
    }

    public function getName($id)
    {
        $sql = 'SELECT name FROM categories WHERE id='.$id;
        $req = $this->bdd->query($sql);
        return $req->fetch();
    }

    public function search($keyword)
    {
        $sql ="SELECT posts.id, posts.content, posts.title FROM posts INNER JOIN categories ON posts.category_id = categories.id WHERE categories.name LIKE '%".$keyword."%'";
        $req = $this->bdd->query($sql);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
