<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Dashboard extends Model
{
  protected $table = 'transactions';

  public function getCountTrx()
  {
    return $this->db->table("transactions")->countAll();
  }

  public function getCountProduct()
  {
    return $this->db->table("products")->countAll();
  }

  public function getCountCategory()
  {
    return $this->db->table("categories")->countAll();
  }

  public function getCountUser()
  {
    return $this->db->table("users")->countAll();
  }

  public function getGrafik()
  {
    $query = $this->query("SELECT 
      trx_price, MONTHNAME(trx_date) as month, 
      COUNT(product_id) as total 
      FROM transactions 
      GROUP BY MONTHNAME(trx_date) 
      ORDER BY MONTH(trx_date)");
      
    if(! empty($query)){
      foreach($query->getResultArray() as $data) {
        $hasil[] = $data;
      }
      return $hasil;
    }
  }

  public function getLatestTrx()
  {
    return $this->table('transactions')
    ->select('products.product_name, transactions.*')
    ->join('products', 'products.product_id = transactions.product_id')
    ->orderBy('transactions.trx_id', 'DESC')
    ->limit(5)->get()->getResultArray();
  }
}