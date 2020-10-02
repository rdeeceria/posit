<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Auth extends Model
{
  protected $table = "users";
  protected $primaryKey = 'id';
  protected $allowedFields = ['id','username','name','email','password','status','level'];
 
  public function userLogin($email, $password)
  {
    $query = $this->where('email', $email)->countAll();

    if($query > 0) {
      $data = $this->where('email', $email)
      ->limit(1)->get()->getRowArray();
    } 
    else 
    {
      $data = array(); 
    }
    
    if(! empty($data)) {
        
      if($data['status'] == 'Inactive') {
        return 2;
      }

      if(password_verify($password, $data['password'])) {
        $dataSession = [
          'id' => $data['id'],
          'username' => $data['username'],
          'name' => $data['name'],
          'email' => $data['email'],
          'status' => $data['status'],
        ];
        session()->set($dataSession);

        return true;
      }
      else
      {
        return 1;
      }

    } 
    else 
    {
      return false;
    }

  }
 
  public function register($data)
  {
    $this->insert(array('id' => uniqid()) + $data);
    return true;
  }

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
        'rules' => 'required|alpha_numeric|is_unique[users.username]|min_length[6]|max_length[13]',
        'errors' => [
          'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka',
          'is_unique' => '{field} sudah terdaftar',
          'min_length' => '{field} minimal 6 karakter',
          'max_length' => '{field} maksimal 13 karakter'
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

}