<?php namespace App\Controllers;

class Category extends BaseController
{
  function __construct()
  {
    view('partials/index', array('subtitle' => 'Categories'));
  }

  public function index()
  { 
    $data = [
      'list' => $this->M_Category->getCategory(),
      'create' => '/category/create',
      'update' => '/category/update/',
      'delete' => '/category/delete/',
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
      $rules = $this->M_Category->validationRules();

      if(! $this->validate($rules)) {
        
    dd($this->session);
        return redirect()->back()->withInput();
      }
      $data = $this->request->getPost();
      $post = $this->M_Category->postCategory($data);

      if($post) {
        $this->session->setFlashdata('success', 'Create Category Name '.$data['category_name'].' Successfully');
        return redirect()->back();
      }
    }
  }

  public function update($id)
  {
    if($this->request->getMethod() === 'get') 
    {
      $v = $this->M_Category->getCategory($id);
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
      $rules = $this->M_Category->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $data = $this->request->getPost();
      $put = $this->M_Category->putCategory($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update Category Name '.$data['category_name'].' Successfully');
        return redirect()->back()->withInput();
      }
    }
  }

  public function delete($id)
  {
    $data = $this->M_Category->getCategory($id);
    $delete = $this->M_Category->deleteCategory($id);

    if($delete) {
      $this->session->setFlashdata('warning', 'Delete Category Name '.$data['category_name'].' Successfully');
      return redirect()->route('category'); 
    }
  }
}