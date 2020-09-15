<?php namespace App\Models;

use CodeIgniter\Model;
  
class Category_model extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name','category_status'];

    public function rules()
    {
        return [
        'category_name' => [
            'label' => 'category_name',
            'rules' => 'is_unique[users.category_name]|max_length[100]',
            'errors' => [
                'is_unique' => 'Anda Memasukan nama {field} sudah ada',
                'max_length' => 'Anda Memasukan nama {field} terlalu panjang',
                ]
            ]
        ];
    }

    public function getCategory($id = NULL)
    {
        if(empty($id))
        {
            return $this->orderBy('category_id DESC')->findAll();
        }
        else
        {
            return $this->where('category_id', $id)->first();
        } 
    }

    public function putCategory($id, $data)
    {
        if(empty($id))
        {
            return $this->insert($data);
        }
        else
        {
            return $this->update($id, $data);
        }
    }

    public function delCategory($id)
    {
        return $this->delete($id);
    }
}