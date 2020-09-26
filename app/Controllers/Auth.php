<?php namespace App\Controllers;
  
class Auth extends BaseController
{
  public function __construct()
  {
    $this->cek_login();
  }

  public function index()
  {
    if($this->cek_login() == TRUE) {
      return redirect()->route('dashboard');
    }
    else
    {
      echo view('auth/login');
    }
  }
}