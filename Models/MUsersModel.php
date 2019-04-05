<?php

class MUsers extends Model
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
            $sql = 'SELECT * FROM users';
            $req = $this->bdd->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        else
        {
            $sql = 'SELECT * FROM users WHERE id='.$id;
            $req = $this->bdd->query($sql);
            return $req->fetch();
        }
    }

    public function create($data)
    {
        $sql = "INSERT INTO users(username, password, email, userGroup, status, creation_date, modification_date) VALUES (:username, :password, :email, :userGroup, :status, NOW(), NOW())";
        $stmt= $this->bdd->prepare($sql);
        $stmt->execute($data);
    }

    public function update($data)
    {
        $sql = "UPDATE users SET username=:username, password=:password, email=:email, userGroup=:userGroup, status=:status, modification_date=NOW() WHERE id=:id";
        $stmt= $this->bdd->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM users WHERE id='.$id;
        $this->bdd->prepare($sql)->execute();
    }

    public function userExist($email)
    {
        $sql = 'SELECT * FROM users where email="'.$email.'"';
        $req = $this->bdd->query($sql);
        if($req->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getUserDataByEmail($email)
    {
        $sql = 'SELECT * FROM users where email="'.$email.'"';
        $req = $this->bdd->query($sql);
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    
    public function search($keyword)
    {
        $sql ="SELECT posts.id, posts.content, posts.title FROM users INNER JOIN posts ON posts.author_id = users.id WHERE users.username LIKE '%".$keyword."%'";
        $req = $this->bdd->query($sql);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}