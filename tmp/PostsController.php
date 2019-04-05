<?php

class Posts extends Controller
{
    public function index()
    {
      $data = $this->indexPosts();
              $this->render('posts/index', $data);

    }

    public function read($id = null)
    {
      if($id==null)
      {
        Controller::redirect(['posts', 'index']);
      }
      $posts = $this->loadModel('Post');
      $data = $posts->get($id);

      $users = $this->loadModel('User');
      $dataAuthor = $users->get($data['author_id']);
      $data['author'] = $dataAuthor['username'];
      $this->render('posts/read', $data);
    }

    public function publish()
    {
      new Session();
      $alert = "";
      $data_user = $_SESSION;
        if(isset($_POST['title']) && $_POST['title'] != null)
        {
          $titre = $this->secure_input($_POST['title']);
          if(isset($_POST['content']))
          {
            $content = $this->secure_input($_POST['content']);
            $data = [
              'title' => $titre,
              'content' => $content,
              'author_id' => $_SESSION['id'],
              'creation_date' => date("Y-m-d H:i:s"),
              'modification_date' => date("Y-m-d H:i:s"),
            ];
            $user = $this->loadModel('Post');
            $user->create($data);
            Controller::redirect(['posts', 'index']);
          }
        }
        else
        {
          $alert .= "<div class='alert alert-danger' role='alert'>
          Please fill all the fields</div>";
        }
        $data['alert']  = $alert;
      $this->render('posts/publish', $data);
      }
}