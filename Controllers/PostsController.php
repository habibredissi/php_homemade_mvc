<?php

class Posts extends Controller
{
    public function index()
    {
        Controller::pageRole(0);
        $data = $this->indexPosts();
        
        $this->render('posts/index', $data);
    }

    public function read($id=null)
    {
        Controller::pageRole(0);
        if($id==null)
        {
            Controller::redirect(['posts', 'index']);
        }
        $posts = $this->loadModel('MPosts');
        $data = $posts->get($id);
        
        $users = $this->loadModel('MUsers');
        $dataAuthor = $users->get($data['author_id']);
        $data['author'] = $dataAuthor['username'];

        $categories = $this->loadModel('MCategories');
        $dataCategories = $categories->getName($data['category_id']);
        $data['categoryName'] = $dataCategories['name'];

        //Poster un commentaire
        $comments = $this->loadModel('MComment');
        if(isset($_POST['comment']))
        {
            $content = $this->secure_input($_POST['comment']);
            $dataComment = [
                'content' => $content,
                'post_id' => $id,
                'author_id' => $_SESSION['id']
            ];
            $comments->create($dataComment);
        }

        //Récupérer les articles
        $htmlComments = '';
        $dataComment = $comments->get($id);
        foreach ($dataComment as $key => $value) {
            $htmlComments .= '<div class="media comment-box">
                <div class="media-body">
                    <h4 class="media-heading">'.$dataAuthor['username'].'<span class="date"> '.date ("d-m-Y", strtotime($value->creation_date)).'</span></h4> 
                    <p>'.$value->content.'</p>
                </div>
            </div>';
        }
        $data['htmlComments'] = $htmlComments;
        $this->render('posts/read', $data);
    }

    public function publish()
    {
        Controller::pageRole(1);
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
              'category_id' => $_POST['category_id'],
              'creation_date' => date("Y-m-d H:i:s"),
              'modification_date' => date("Y-m-d H:i:s"),
            ];
            $user = $this->loadModel('MPosts');
            $user->create($data);
            if($_SESSION['userGroup'] == 2)
            {
                Controller::redirect(['admin', 'index']);
            }
            else
            {
                Controller::redirect(['writer', 'index']);
            }
          }
          else
            {
            $alert .= "<div class='alert alert-danger' role='alert'>
            Please fill all the fields</div>";
            }
        }

        //Charges la liste des categories
        $categories = $this->loadModel('Mcategories');
        $dataCategories = $categories->get();
        $htmlCategories = '';
        foreach ($dataCategories as $key => $value) {
            $htmlCategories .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        $data['htmlCategories'] = $htmlCategories;

        $data['alert']  = $alert;
        $this->render('posts/publish', $data);
      }

      public function admin()
      {
        Controller::pageRole(1);
        $htmlList = '';
        $posts = $this->loadModel('MPosts');
        if($_SESSION['userGroup'] != 2)
        {
            $data = $posts->getPostsByAuthorId($_SESSION['id']);
            foreach ($data as $key => $value) {
                $htmlList .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->title.'</td>
                <td><a href="edit/'.$value->id.'">Edit</a></td>
                <td><a href="delete/'.$value->id.'">Delete</a></td>
                </tr>';
            }
        }
        else
        {
            $data = $posts->get();
            foreach ($data as $key => $value) {
                $htmlList .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->title.'</td>
                <td><a href="edit/'.$value->id.'">Edit</a></td>
                <td><a href="delete/'.$value->id.'">Delete</a></td>
                </tr>';
            }
        }
        
        $data['htmlList'] = $htmlList;
        $this->render('posts/admin', $data);
      }

      public function delete($id)
      {
        Controller::pageRole(1);
        $posts = $this->loadModel('MPosts');
        $comments = $this->loadModel('MComment');
        $posts->delete($id);
        $comments->deleteByPostID($id);
        Controller::redirect(['posts','admin']);
      }

      public function edit($id=null)
      {
          Controller::pageRole(1);
          if($id == null)
          {
            Controller::redirect(['posts','admin']);
          }
          else
          {
            $alert = '';
            $posts = $this->loadModel('MPosts');

            if(isset($_POST['title']))
            {
                $title = $this->secure_input($_POST['title']);
                $content = $this->secure_input($_POST['content']);
                $data = [
                    'title' => $title,
                    'content' => $content,
                    'category_id' => $_POST['category_id'],
                    'id' => $id
                ];
                $posts->update($data);
                Controller::redirect(['posts', 'admin']);
                $alert .= "<div class='alert alert-success' role='alert'>Updated !</div>";

            }
            
            $data = $posts->get($id);
            //Charges la liste des categories
            $categories = $this->loadModel('Mcategories');
            $dataCategories = $categories->get();
            $htmlCategories = '';
            foreach ($dataCategories as $key => $value) {
                $selected = '';
                if($value->id == $data['category_id'])
                {
                    $selected = 'selected';
                }
                $htmlCategories .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
            }
            $data['alert'] = $alert;
            $data['htmlCategories'] = $htmlCategories;
            $this->render('posts/edit', $data);
          }
      }
}

