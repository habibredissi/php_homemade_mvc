<?php

class Post extends Model 
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
            $res = $req->fetchAll(PDO::FETCH_OBJ);
            return $res;
        }else{
            $sql = 'SELECT * FROM posts WHERE id=' .$id;
            $req = $this->bdd->query($sql);
            $res = $req->fetch();
            return $res;
        }
    }

    public function create($param)
    {
        $sql = "INSERT INTO posts (title, content, author_id, creation_date, modification_date)
                VALUES(:title, :content, :author_id, :creation_date, :modification_date)";
        $req = $this->bdd->prepare($sql);
        $res = $req->execute($param);
    }

    public function update($data)
    {
       $sql = "UPDATE  set username=:username, password=:password, email=:email, userGroup=:userGroup, status=:status, modification_date=NOW() WHERE id=:id"; 
       $req = $this->bdd->prepare($sql);
       $res = $req->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE from posts WHERE id=".$id;
        $req = $this->bdd->prepare($sql);
        $res = $req->execute();
    }

        
}