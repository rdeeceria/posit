<?php namespace App\Controllers;
 
class Dashboard extends BaseController
{
    public function index()
    {
        $view = array(
            'content' => 'dashboard',
            'title' => 'Dashboard',
            'data' => [],
        );

        echo view('index', $view);
    }
     
}