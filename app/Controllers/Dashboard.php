<?php namespace App\Controllers;
 
class Dashboard extends BaseController
{
    public function index()
    {
        $view = array(
            'title' => 'Dashboard',
        );

        echo view('dashboard', $view);
    }
     
}