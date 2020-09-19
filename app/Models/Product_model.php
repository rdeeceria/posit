<?php namespace App\Models;

use CodeIgniter\Model;
  
class Product_model extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'product_id';
  protected $allowedFields = [
    'product_id','category_id','product_name','product_price','product_sku',
    'product_status','product_image','product_description',
  ];

  protected $image = "default.jpg";

  public function validationRules($id = null)
  {
    return [
      'product_name' => [
        'label' => 'Product Name',
        'rules' => 'required|max_length[30]|is_unique[products.product_name,product_id,'.$id.']',
        'errors' => [
            'is_unique' => 'Data {field} {value} Sudah Ada',
            'max_length' => '{field} Maximum {param} Character',
          ]
      ],
      'product_price' => [
        'label' => 'Product Price',
        'rules' => 'required|numeric|max_length[10]',
        'errors' => [
            'numeric' => '{field} Harus Numeric',
            'max_length' => '{field} Maximum {param} Character',
          ]
      ],
      'product_sku' => [
        'label' => 'Product SKU',
        'rules' => 'required|max_length[10]|is_unique[products.product_name,product_id,'.$id.']',
        'errors' => [
            'is_unique' => 'Nomor {field} {value} Sudah Ada',
            'max_length' => '{field} Maximum {param} Character',
          ]
      ],
      'product_image' => [
        'label' => 'Product Image',
        'rules' => 'mime_in[product_image,image/jpg,image/jpeg,image/png,image/gif]|max_size[product_image,1000]',
        'errors' => [
            'mime_in' => '{field} Dierekomendasikan File Berekstensi .jpg, .jpeg, .png, .gif',
            'max_size' => '{field} Maksimal {param} MB',
          ]
      ],
    ];
  }

  public function getProduct($id = null)
  {
    if(empty($id)) {
      return $this->join('categories', 'categories.category_id = products.category_id')->orderBy('Product_id DESC')->findAll();
    }
    else
    {
      return $this->join('categories', 'categories.category_id = products.category_id')->where('Product_id', $id)->first();
    } 
  }

  public function postProduct($data) 
  {
    return $this->insert($data);
  }

  public function putProduct($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteProduct($id)
  {
    return $this->delete($id);
  }

  public function getStatus($status)
  {
    return $this->where('products_status', $status)->findAll();
  }
}