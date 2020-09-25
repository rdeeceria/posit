<?php namespace App\Controllers;

class Transaction extends BaseController
{
  function __construct()
  {
    view('partials/index', array('subtitle' => 'Transactions'));
  }

  public function index()
  { 
    $data = [
      'list' => $this->M_Transaction->getTransaction(),
      'validation' => $this->validation,
      'import' => '/transaction/import',
      'export' => '/transaction/export',
      'create' => '/transaction/create',
      'update' => '/transaction/update/',
      'delete' => '/transaction/delete/',
    ];
    echo view('transaction/list', $data);
  }

  public function import()
  { 
    if($this->request->getMethod() === 'get') 
    {
      $data = [
        'validation' => $this->validation,
        'action' => '/transaction/upload',
        'back' => '/transaction',
      ];
      echo view('transaction/import', $data);
    }
    else
    {
      
    }
  }

}
