<?php namespace App\Models;

use CodeIgniter\Model;

class Category_model extends Model
{
  protected $table = 'categories';
  protected $primaryKey = 'category_id';
  protected $allowedFields = ['category_name','category_status'];

  public function validationRules($id = null)
  {
    return [
      'category_name' => [
      'label' => 'Category Name',
      'rules' => 'required|max_length[10]|is_unique[categories.category_name,category_id,'.$id.']',
      'errors' => [
        'is_unique' => 'Data {field} {value} Sudah Ada',
        'max_length' => '{field} Maximum {param} Character',
        ]
      ]
    ];
  }

  public function getCategory($id = null)
  {
    if(empty($id)) {
      return $this->orderBy('category_id DESC')->findAll();
    }
    else
    {
      return $this->where('category_id', $id)->first();
    } 
  }

  public function postCategory($data) 
  {
    return $this->insert($data);
  }

  public function putCategory($id, $data)
  {
    return $this->update($id, $data);
  }

  public function deleteCategory($id)
  {
    return $this->delete($id);
  }
}