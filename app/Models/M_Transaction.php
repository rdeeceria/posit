<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Transaction extends Model
{
  protected $table = 'transactions';
  protected $primaryKey = 'trx_id';
  protected $allowedFields = ['trx_id','product_id','trx_qty','trx_price','trx_date'];

  public function getTransaction($id = null)
  {
    if(empty($id)) {
      return $this->select('products.product_name, transactions.*')
      ->join('products', 'products.product_id = transactions.product_id')
      ->orderBy('trx_id DESC')->get()->getResultArray();
    }
    else
    {
      return $this->select('products.product_name, transactions.*')
      ->join('products', 'products.product_id = transactions.product_id')
      ->where('transactions.trx_id', $id)
      ->get()->getRowArray();
    }
  }

  public function postTransaction($data) 
  {
    $this->insert(array('trx_id' => uniqid()) + $data);
    return true;
  }
  
  public function putTransaction($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteTransaction($id)
  {
    return $this->delete($id);
  }

  public function validationRules()
  {
    return [
      'trx_qty' => [
        'label' => 'Quantity',
        'rules' => 'required|numeric|max_length[3]|less_than_equal_to[125]',
        'errors' => [
            'numeric' => '{field} Harus Numeric',
            'max_length' => '{field} Maximum {param} Character',
            'less_than_equal_to' => '{field} Maksimal 125',
          ]
      ],
    ];
  }

  public function validationImport()
  {
    return [
      'trx_file' => [
        'label' => 'Transaction File',
        'rules' => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
        'errors' => [
            'ext_in' => '{field} hanya berextensi file .xls atau .xlsx',
            'max_size' => '{field} Maksimal {param}',
            'uploaded' => 'File Excel Belum dipilih'
          ]
      ],
    ];
  }

}