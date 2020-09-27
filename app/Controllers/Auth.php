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
      return redirect()->route('/');
    }
    else
    {
      $rules = $this->M_Auth->authlogin();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');

      $data = $this->M_Auth->userCheck($email);
      
      if($data != null) {

        if(password_verify($password, $data['password'])) {
          $this->session->set('email', $data['email']);
          $this->session->set('name', $data['name']);
          $this->session->set('level', $data['level']);
          $this->session->set('status', $data['status']);

          return redirect()->route('dashboard');
        }
        else
        {
          $this->session->setFlashdata('errors', ['' => 'Password yang Anda masukan salah']);
          return redirect()->back();
        }
      } 
      else 
      {
        $this->session->setFlashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
        return redirect()->route('/');
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
        'status' => "Active",
        'level' => "Admin",
      ];
      $simpan = $this->M_Auth->register($data);

      if($simpan) {
        $this->session->setFlashdata('success_register', 'Register Successfully');
        return redirect()->route('/');
      }
    }
  }

  public function logout()
  {
    $this->session->destroy();
    return redirect()->route('/');
  }

}