<?php

class Users extends Controller
{
    public function index()
    {
        echo 'index';
    }

    public function registration()
    {
        $alert = '';
        if(isset($_POST['username']))
        {
            if(!$this->isValidEmail($_POST['email']))
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Email.</div>';
            }
            else if($_POST['password'] != $_POST['confirm'])
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Mot de passe.</div>';
            }
            else
            {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $username = $this->secure_input($_POST['username']);
                $email = $this->secure_input($_POST['email']);
                
                $data = [
                    'username' => $username,
                    'password' => $hash,
                    'email' => $email,
                    'userGroup' => 0, 
                    'status' => 0
                ];
                $user = $this->loadModel('MUsers');
                if($user->userExist($email))
                {
                    $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Existe déjà.</div>';
                }
                else
                {
                    $user->create($data);  
                    $data['id'] = $user->getLastID();
                    new Session($data);
                    $alert = '<div class="alert alert-success"><strong>Succès!</strong> Utilisateur ajouté avec succès.</div>';
                }
            }
        }
        $this->render('register/index', ['alert' => $alert]);
    }

    public function edit()
    {
        Controller::PageRole(0);
        $alert = "";
        $data = $_SESSION;

        if(isset($_POST['username']) && !isset($_POST['delete']))
        {
            if(!$this->isValidEmail($_POST['email']))
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Email.</div>';
            }
            else if($_POST['password'] != $_POST['verify_password'])
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Mot de passe.</div>';
            }
            else
            {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $username = $this->secure_input($_POST['username']);
                $email = $this->secure_input($_POST['email']);
                $data = [
                    'username' => $username,
                    'password' => $hash,
                    'email' => $email,
                    'userGroup' => $_SESSION['userGroup'], 
                    'status' => $_SESSION['status'],
                    'id' => $_SESSION['id']
                ];

                $user = $this->loadModel('MUsers');
                $user->update($data);  
                Session::init($data);
                $alert = '<div class="alert alert-success"><strong>Succès!</strong> Modifications pris en compte.</div>';
                Controller::redirect(['home', 'index']);
            }

        }
        elseif(isset($_POST['delete']))
        {
            $user = $this->loadModel('MUsers');
            $id = $_SESSION['id'];
            $user->delete($id);
            $alert = '<div class="alert alert-success"><strong>Succès!</strong> Modifications pris en compte.</div>';
            $data['alert'] = $alert;
            // $this->render('login/index', $data);
            // sleep(5);
            Controller::redirect(['logout', 'index']);
        }
        $data['alert'] = $alert;
        $this->render('user/edit',$data);
    }
}