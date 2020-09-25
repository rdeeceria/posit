<?php namespace App\Models;

use CodeIgniter\Model;
  
class M_Product extends Model
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
        'rules' => 'required|is_natural|numeric|less_than_equal_to[4000000000]',
        'errors' => [
            'numeric' => '{field} Harus Numeric',
            'is_natural' => '{field} Tidak Bisa Bernilai Negatif',
            'less_than_equal_to' => '{field} Maksimal 4 Milyar',
          ]
      ],
      'product_sku' => [
        'label' => 'Product SKU',
        'rules' => 'required|max_length[15]|is_unique[products.product_name,product_id,'.$id.']',
        'errors' => [
            'is_unique' => 'Nomor {field} {value} Sudah Ada',
            'max_length' => '{field} Maximum {param} Character',
          ]
      ],
      'product_image' => [
        'label' => 'Product Image',
        'rules' => 'is_image[product_image]|mime_in[product_image,image/jpeg,image/jpg,image/bmp,image/png,image/gif]|max_size[product_image,1024]',
        'errors' => [
            'mime_in' => '{field} Dierekomendasikan File Berekstensi .jpg, .bmp, .png, .gif',
            'max_size' => '{field} Maksimal {param}',
          ]
      ],
    ];
  }

  public function getProduct($where = null, $like = null, $orLike = null, $paginate = 5, $id = null)
  {
    if(empty($id)) {
      return $this->join('categories', 'categories.category_id = products.category_id')
      ->where($where)->like($like)->orLike($orLike)
      ->orderBy('Product_id DESC')->paginate($paginate, 'product');
    }
    else
    {
      return $this->join('categories', 'categories.category_id = products.category_id')->where('Product_id', $id)->first();
    } 
  }

  public function postProduct($data) 
  {
    $this->insert(array('product_id' => uniqid()) + $data);
    return true;
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

  public function getPrice($id)
  {
    return $this->where('product_id', $id)->first();
  }

}