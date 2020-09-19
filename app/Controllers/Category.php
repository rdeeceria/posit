<?php namespace App\Controllers;

class Category extends BaseController
{
  function __construct()
  {
    helper('form');
    view('partials/index', array('subtitle' => 'Categories'));
  }

  public function index()
  { 
    $data = [
      'list' => BaseController::Categories()->getCategory(),
      'create' => '/category/create',
      'update' => '/category/update/',
      'delete' => '/DELETE/category/delete/',
    ];
    echo view('category/list', $data);
  }

  public function create()
  {
    if($this->request->getMethod() === 'get') 
    {
      $data = [
        'validation' => $this->validation,
        'action' => '/category/create',
        'back' => '/category',
      ];
      echo view('category/create', $data);
    }
    else
    {
      $rules = BaseController::Categories()->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }

      $data = $this->request->getPost();
      $post = BaseController::Categories()->postCategory($data);
      
      dd($post);
      if($post) {
        $this->session->setFlashdata('success', 'Create Category Name '.$data['category_name'].' Successfully');
        return redirect()->route('category');
      }
    }
  }

  public function update($id)
  {
    if($this->request->getMethod() === 'get') 
    {
      $v = BaseController::Categories()->getCategory($id);
      $data = [
        'action' => '/category/update/'.$id,
        'back' => '/category',
        'validation' => $this->validation,
        'category_name' => $v['category_name'],
        'category_status' => $v['category_status'],
      ];
      echo view('category/update', $data);
    }
    else
    {
      $rules = BaseController::Categories()->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
  
      $data = $this->request->getPost();
      $put = BaseController::Categories()->putCategory($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update Category Name '.$data['category_name'].' Successfully');
        return redirect()->route('category');
      }
    }
  }

  public function delete($id)
  {
    $data = BaseController::Categories()->getCategory($id);
    $delete = BaseController::Categories()->deleteCategory($id);

    if($delete) {
      $this->session->setFlashdata('warning', 'Delete Category Name '.$data['category_name'].' Successfully');
      return redirect()->route('category'); 
    }
  }
}