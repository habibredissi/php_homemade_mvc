<?php

class Writer extends Controller
{
    public function index()
    {
        Controller::pageRole(1);
        $data = $this->indexPosts();
        
        $this->render('writer/index', $data);
    }
}

?>