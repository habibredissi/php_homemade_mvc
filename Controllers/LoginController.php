<?php

class Login extends Controller
{
    public function loadInterface($group)
    {
        if($group == 0) // User
        {
            $this->redirect(['posts', 'index']);
        }
        else if($group == 1) // Writer
        {
            $this->redirect(['writer', 'index']);
        }
        else if($group == 2) // Admin
        {
            $this->redirect(['admin', 'index']);
        }
    }

    public function index()
    {
        $alert = '';
        if(isset($_POST['email']))
        {
            
            if(!$this->isValidEmail($_POST['email']))
            {
                $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Bad email syntaxe.</div>';
            }
            else if(isset($_POST['password']))
            {
                $user = $this->loadModel('MUsers');

                if($user->userExist($_POST['email']))
                {
                    $data = $user->getUserDataByEmail($_POST['email']);
                    if (password_verify($_POST['password'], $data->password)) 
                    {
                        //L'email et le mot de passe sont bons
                        if($data->status == 0)
                        {
                            $sent = $user->get($data->id);
                            // var_dump($sent);
                            new Session($sent);
                            //Debute la redirection en fonction du group user
                            $this->loadInterface($data->userGroup);
                        }
                        else
                        {
                            $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Vous etes bannis. Son of the bitch !</div>';
                        }
                    }
                    else
                    {
                        $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Invalid username and/or password.</div>';
                    }
                }
                else
                {
                    $alert = '<div class="alert alert-warning"><strong>Warning!</strong> Invalid username and/or password.</div>';
                }
            }
        }
        $this->render('login/index', ['alert' => $alert]);
    }
}