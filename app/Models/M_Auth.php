<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Auth extends Model
{
  protected $table = "users";
  protected $primaryKey = 'id';
  protected $allowedFields = ['id','username','name','email','password','status','level'];

  public function authlogin()
  {
    return [
      'email' => [
        'label' => 'email',
        'rules' => 'required|valid_email',
        'errors' => [
          'valid_email' => '{field} tidak valid',
        ]
      ],
      'password' => [
        'label' => 'password',
        'rules' => 'required',
      ],
    ];
  }

  public function validationRegister()
  {
    return [
      'email' => [
        'label' => 'email',
        'rules' => 'required|valid_email|is_unique[users.email]',
        'errors' => [
          'valid_email' => '{field} tidak valid',
          'is_unique' => '{field} sudah terdaftar'
        ]
      ],
      'username' => [
        'label' => 'username',
        'rules' => 'required|alpha_numeric|is_unique[users.username]|min_length[6]|max_length[30]',
        'errors' => [
          'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka',
          'is_unique' => '{field} sudah terdaftar',
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} maksimal 30 karakter'
        ]
      ],
      'name' => [
        'label' => 'name',
        'rules' => 'required|alpha_numeric_space|min_length[6]|max_length[30]',
        'errors' => [
          'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka',
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} maksimal 30 karakter'
        ]
      ],
      'password' => [
        'label' => 'password',
        'rules' => 'required|min_length[6]|max_length[30]',
        'errors' => [
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} maksimal 30 karakter'
        ]
      ],
      'confirm_password' => [
        'label' => 'confirm password',
        'rules' => 'required|matches[password]|min_length[6]|max_length[30]',
        'errors' => [
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} maksimal 30 karakter'
        ]
      ],
    ];
  }
 
  public function userCheck($email)
  {
    $query = $this->where('email', $email)->countAll();

    if($query > 0) {
      $hasil = $this->where('email', $email)
      ->limit(1)->get()->getRowArray();
    } 
    else 
    {
      $hasil = array(); 
    }
    return $hasil;
  }
 
  public function register($data)
  {
    $this->insert(array('id' => uniqid()) + $data);
    return true;
  }


}