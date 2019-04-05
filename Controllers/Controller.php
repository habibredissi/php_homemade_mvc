<?php

class Controller
{

    public function loadModel($model)
    {
        require_once '../Models/' . $model . 'Model.php';
        return new $model();
    }

    public function render($view, $data = [])
    {
        require_once '../Views/' . $view . '.php';
    } 

    protected static function redirect($param)
    {

        $param = implode("/", $param);
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $param;
        header('Location: ' . $url);
        exit();
    }

    public function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) 
            && preg_match('/@.+\./', $email);
    }

    public function indexPosts()
    {
        $posts = $this->loadModel('MPosts');
        $users = $this->loadModel('MUsers');

        $data = $posts->get();

        $htmlPosts = '';
        foreach ($data as $key => $value) {
            $dataAuthor = $users->get($value->author_id);
            $htmlPosts .= '
            <div class="post-preview">
                <a href="http://localhost/PHP_Rush_MVC/Webroot/posts/read/'.$value->id.'">
                <h2 class="post-title">
                    '.$value->title.'
                </h2>
                <h3 class="post-subtitle">
                    '.substr($value->content, 0, 100).'...
                </h3>
                </a>
                <p class="post-meta">Posted by
                    '.$dataAuthor['username'].'
                on '.date ("d-m-Y", strtotime($value->creation_date)).'</p>
            </div>
            <hr>';
        }
        $data['htmlPosts'] = $htmlPosts;
        return $data;
    }

    public static function pageRole($role) //0
    {
        new Session();
        if(isset($_SESSION['userGroup']))
        {
            if($_SESSION['status'] == 1)
            {
                self::redirect(['logout', 'index']);
            }

            $userGroup = $_SESSION['userGroup'];
            if($userGroup < $role) //0
            {
                self::redirect(['home', 'index']);
            }
        }
        else
        {
            self::redirect(['login', 'index']);
        }
    }
}