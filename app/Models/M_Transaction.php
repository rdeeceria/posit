<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Transaction extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'product_id';
  protected $allowedFields = [
    'product_id','category_id','product_name','product_price','product_sku',
    'product_status','product_image','product_description',
  ];

  public function validationRules($id = null)
  {
    return [
      'trx_file' => [
        'label' => 'Transaction File',
        'rules' => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
        'errors' => [
            'ext_in'    => '{field} hanya berextensi file .xls atau .xlsx',
            'max_size' => '{field} Maksimal {param}',
            'uploaded'  => 'File Excel product wajib diisi'
          ]
      ],
    ];
  }

}