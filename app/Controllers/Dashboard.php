<?php namespace App\Controllers;
 
class Dashboard extends BaseController
{
  function __construct()
  {
    view('partials/index', array('subtitle' => 'Dasboard'));
  }
  public function index()
  {
    $data = [
      'total_transaction' => $this->M_Dashboard->getCountTrx(),
      'total_product' => $this->M_Dashboard->getCountProduct(),
      'total_category' => $this->M_Dashboard->getCountCategory(),
      'total_user' => $this->M_Dashboard->getCountUser(),
      'latest_trx' => $this->M_Dashboard->getLatestTrx(),
      'grafik' => $this->M_Dashboard->getGrafik(),
    ];
    echo view('events/dashboard', $data);
  }
    
}