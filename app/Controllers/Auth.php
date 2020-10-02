<?php namespace App\Controllers;
  
class Auth extends BaseController
{
  public function index()
  {
    if($this->session->has('id')) {
      return redirect()->route('dashboard');
    }
    else
    {
      $data = [
        'validation' => $this->validation,
        'action' => '/login',
        'register' => '/register',
      ];
      echo view('auth/login', $data);
    }
  }

  public function login()
  {
    if($this->request->getMethod() === 'get') 
    {
      return redirect()->to('/');
    }
    else
    {
      $rules = $this->M_Auth->authlogin();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');

      $check = $this->M_Auth->userLogin($email, $password);

      switch($check) {

        case 1:
          $this->session->setFlashdata('errors', 'Password yang Anda masukan salah');
          return redirect()->back();
          break;

        case 2:
          $this->session->setFlashdata('errors', 'Akun anda belum aktif, Silahkan Contact Administrator');
          return redirect()->to('/');
          break;

        case true:
          return redirect()->route('dashboard');
          break;

        case false:
          $this->session->setFlashdata('errors', 'Email yang Anda masukan tidak terdaftar');
          return redirect()->to('/');
          break;
      }
      
    }
  }

  public function register()
  {
    if($this->request->getMethod() === 'get') 
    {
      $data = [
        'validation' => $this->validation,
        'action' => '/register',
        'cancel' => '/login',
      ];
      echo view('auth/register', $data);
    }
    else
    {
      $rules = $this->M_Auth->validationRegister();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $data = [
        'email' => $this->request->getPost('email'),
        'name' => $this->request->getPost('name'),
        'username' => $this->request->getPost('username'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'status' => "Inactive",
        'level' => "User",
      ];
      $simpan = $this->M_Auth->register($data);

      if($simpan) {
        $this->session->setFlashdata('success_register', 'Register Successfully');
        return redirect()->to('/');
      }
    }
  }

  public function logout()
  {
    $this->session->destroy();
    return redirect()->to('/');
  }

}