<?php

$instance = Database::getInstance();
$DB = $instance->getConnection();

class Home extends Controller
{
    public function index($name = null)
    {
        var_dump($DB);
        $user = $this->model('User');
        $user->name = $name;
        $this->view('home/index', ['name' => $name]);
    }


}