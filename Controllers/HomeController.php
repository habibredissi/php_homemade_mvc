<?php

class Home extends Controller
{
    public function index()
    {
        Controller::pageRole(0);
        if($_SESSION['userGroup'] == 2)
        {
            Controller::redirect(['admin', 'index']);
        }
        else if($_SESSION['userGroup'] == 1)
        {
            Controller::redirect(['writer', 'index']);
        }
        else if($_SESSION['userGroup'] == 0)
        {
            Controller::redirect(['posts', 'index']);
        }
    }
}