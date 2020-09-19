<?php namespace App\Controllers;
 
class Dashboard extends BaseController
{
  function __construct()
  {
    view('partials/index', array('subtitle' => 'Dasboard'));
  }
  public function index()
  {
    echo view('dashboard');
  }
    
}