<?php

class MPosts extends Model
{
    private $bdd;

    public function __construct()
    {
        parent::__construct();
        $this->bdd = $this->getDB();
    }

    public function get($id = null)
    {   
        if($id == null)
        {
            $sql = 'SELECT * FROM posts';
            $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        else
        {
            $sql = 'SELECT * FROM posts WHERE id='.$id;
            $req = $this->bdd->query($sql);
            return $req->fetch();
        }
    }

    public function create($param)
    {
        $sql = "INSERT INTO posts (title, content, author_id, category_id, creation_date, modification_date)
                VALUES(:title, :content, :author_id, :category_id, :creation_date, :modification_date)";
        $req = $this->bdd->prepare($sql);
        $res = $req->execute($param);
    }
    
    public function delete($id)
    {
        $sql = "DELETE from posts WHERE id=".$id;
        $req = $this->bdd->prepare($sql);
        $res = $req->execute();
    }

    public function updateAfterCatDelete($id)
    {
        $sql = "UPDATE posts SET category_id=-1, modification_date=NOW() WHERE category_id=".$id;
        $stmt= $this->bdd->prepare($sql);
        $stmt->execute();
    }

    public function getPostsByAuthorId($id)
    {
        $sql = 'SELECT * FROM posts WHERE author_id='.$id;
        $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($data)
    {
        $sql = "UPDATE posts SET title=:title, content=:content, category_id=:category_id, modification_date=NOW() WHERE id=:id";
        $stmt= $this->bdd->prepare($sql);
        $stmt->execute($data);
    }

    public function search($keyword)
    {
        $sql = "SELECT id, title, content FROM posts WHERE content LIKE '%" . $keyword . "%'";
        $req = $this->bdd->query($sql);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}