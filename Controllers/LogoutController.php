<?php

class Logout extends Controller
{
    public function index()
    {
        Session::destroy();
    }
}