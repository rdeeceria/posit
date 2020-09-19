<?php namespace App\Controllers;

class Product extends BaseController
{
  protected $categories = [];

  public function __construct()
  {
    helper('form');
    $this->categories = array(
      '' => 'Choose Category'
      ) + array_column(BaseController::Categories()->getStatus(1), 'category_name', 'category_id');
  }

  public function index()
  { 
    $view = array(
      'content' => 'product/list',
      'title' => 'Product',
      'data' => [
        'list' => BaseController::Products()->getProduct(),
        'create' => '/product/create',
        'update' => '/product/update/',
        'delete' => '/product/delete/',
        ],
    );
    echo view('index', $view);
  }

  public function create()
  {
    if($this->request->getMethod() === 'get') 
    {
      $view = array(
        'content' => 'product/create',
        'title' => 'Product',
        'data' => [
          'validation' => $this->validation,
          'categories' => $this->categories,
          'action' => '/product/create',
          'back' => '/product',
          ],
      );
      echo view('index', $view);
    }
    else
    {
      $rules = BaseController::Products()->validationRules();

      
      $image = $this->request->getFile('product_image');
      $data = $this->request->getPost();
      
      //dd($data);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }


      $post = $this->productModel->postProduct($data);
  
      if($post) {
        $this->session->setFlashdata('success', 'Create product Name '.$data['product_name'].' Successfully');
        return redirect()->route('product');
      }
    }
  }

  public function update($id)
  {
    if($this->request->getMethod() === 'get') 
    {
      $v = $this->productModel->getProduct($id);
      $view = array(
        'content' => 'product/update',
        'title' => 'Product',
        'data' => [
          'action' => '/product/update/'.$id,
          'back' => '/product',
          'validation' => $this->validation,
          'product_name' => $v['product_name'],
          'product_status' => $v['product_status'],
          ],
      );
      echo view('index', $view);
    }
    else
    {
      $rules = $this->productModel->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
  
      $data = $this->request->getPost();
      $put = $this->productModel->putProduct($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update product Name '.$data['product_name'].' Successfully');
        return redirect()->route('product');
      }
    }
  }

  public function delete($id)
  {
    $data = $this->productModel->getProduct($id);
    $delete = $this->productModel->deleteProduct($id);
    
    if($delete) {
      $this->session->setFlashdata('warning', 'Delete product Name '.$data['product_name'].' Successfully');
      return redirect()->route('product'); 
    }
  }
}