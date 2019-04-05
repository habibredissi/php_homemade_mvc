<?php

class User extends Controller
{
    public function index()
    {
        // Session::pageRole(0);
        new Session();
        $this->render('user/index');
    }

    public function edit()
    {
        $alert = "";
        $this->render('user/edit', ['alert' => $alert]);
    }
}