<?php namespace App\Controllers;

class Category extends BaseController
{
  public function index()
  { 
    $view = array(
      'content' => 'category/list',
      'title' => 'Categories',
      'data' => [
        'categories' => $this->CategoryModel->getCategory(),
        'create' => base_url('category/create'),
        'update' => base_url('category/update').'/',
        'delete' => base_url('category/delete').'/',
        ],
    );
    echo view('index', $view);
  }

  public function create()
  {
    if($this->request->getMethod() === 'get') 
    {
      $view = array(
        'content' => 'category/create',
        'title' => 'Categories',
        'data' => [
          'validation' => $this->validation,
          'action' => base_url('category/create'),
          'back' => base_url('category'),
          ],
      );
      echo view('index', $view);
    }
    else
    {
      $rules = $this->CategoryModel->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
  
      $data = array(
        'category_name' => $this->request->getPost('category_name'),
        'category_status' => $this->request->getPost('category_status'),
      );
      $post = $this->CategoryModel->postCategory($data);
  
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
      $v = $this->CategoryModel->getCategory($id);
      $view = array(
        'content' => 'category/update',
        'title' => 'Categories',
        'data' => [
          'action' => base_url('category/update/'.$id),
          'back' => base_url('category'),
          'validation' => $this->validation,
          'category_name' => $v['category_name'],
          'category_status' => $v['category_status'],
          ],
      );
      echo view('index', $view);
    }
    else
    {
      $rules = $this->CategoryModel->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
  
      $data = array(
        'category_name' => $this->request->getPost('category_name'),
        'category_status' => $this->request->getPost('category_status'),
      );
      $put = $this->CategoryModel->putCategory($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update Category Name '.$data['category_name'].' Successfully');
        return redirect()->route('category');
      }
    }
  }

  public function delete($id)
  {
    $data = $this->CategoryModel->getCategory($id);
    $delete = $this->CategoryModel->deleteCategory($id);
    
    if($delete) {
      $this->session->setFlashdata('warning', 'Delete Category Name '.$data['category_name'].' Successfully');
      return redirect()->route('category'); 
    }
  }
}