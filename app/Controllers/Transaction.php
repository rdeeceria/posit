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
      'import' => '/transaction/import',
      'export' => '/transaction/export',
      'create' => '/transaction/create',
      'update' => '/transaction/update/',
      'delete' => '/transaction/delete/',
    ];
    echo view('transaction/list', $data);
  }

}
