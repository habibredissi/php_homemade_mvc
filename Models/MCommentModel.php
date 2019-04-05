<?php

class Mcomment extends Model
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
            $sql = 'SELECT * FROM comments';
            $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        else
        {
            $sql = 'SELECT * FROM comments WHERE post_id='.$id;
            $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function create($data)
    {
        $sql = "INSERT INTO comments(content, post_id, author_id, creation_date) VALUES (:content, :post_id, :author_id, NOW())";
        $stmt= $this->bdd->prepare($sql);
        $stmt->execute($data);
    }

    public function deleteByPostID($id)
    {
        $sql = 'DELETE FROM comments WHERE post_id='.$id;
        $this->bdd->prepare($sql)->execute();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM comments WHERE id='.$id;
        $this->bdd->prepare($sql)->execute();
    }

    public function getCommentsByAuthorID($id)
    {
        $sql = 'SELECT comments.id, comments.content FROM posts INNER JOIN comments ON posts.id = comments.post_id WHERE posts.author_id='.$id;
        $req = $this->bdd->query($sql);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}