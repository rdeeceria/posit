<?php namespace App\Controllers;

class Product extends BaseController
{
  public $product;
  public $getFile;
  public $imgName;

  public function index()
  { 
    $pager = \Config\Services::pager();
    
    $where = [];
    $like = [];
    $orLike = [];

    $categories = array('' => 'Choose Category') + array_column($this->M_Category->getStatus(1), 'category_name', 'category_id');
    $data['categories'] = $categories;

    $category = $this->request->getGet('category');
    $keyword = $this->request->getGet('keyword');

    $data['category'] = $category;
    $data['keyword'] = $keyword;

    if(! empty($category)) {
      $where = ['products.category_id' => $category];
    }

    if(! empty($keyword)) {
      $like = ['products.product_name' => $keyword];
      $orLike = ['products.product_sku' => $keyword, 'products.product_description' => $keyword];
    }

    $data += [
      'list' => $this->M_Product->getProducts($where, $like, $orLike),
      'pager' => $this->M_Product->pager,
      'create' => '/product/create',
      'read' => '/product/read/',
      'update' => '/product/update/',
      'delete' => '/product/delete/',
    ];
    echo view('product/list', $data);
  }

  public function create()
  {
    $segment = $this->request->uri->getSegment(2);

    if($this->request->getMethod() === 'get') 
    {
      $categories = array('' => 'Choose Category') + array_column($this->M_Category->getStatus(1), 'category_name', 'category_id');
      $data = [
        'validation' => $this->validation,
        'categories' => $categories,
        'action' => '/product/create',
        'back' => '/product',
      ];
      echo view('product/create', $data);
    }
    else
    {
      $rules = $this->M_Product->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $file = $this->upload($segment);

      if($file) {
        $this->getFile->move('uploads/product', $this->imgName);
      } 
      $data = $this->request->getPost() + array('product_image' => $this->imgName);
      $post = $this->M_Product->postProduct($data);
      
      if($post) {
        $this->session->setFlashdata('success', 'Create product Name '.$data['product_name'].' Successfully');
        return redirect()->back();
      }
    }
  }
  
  public function read($id)
  {
    $data = [
      'v' => $this->M_Product->getProductOmzet($id),
    ];
    echo view('product/read', $data);
  }

  public function update($id)
  {
    $segment = $this->request->uri->getSegment(2);
    $this->product = $this->M_Product->getProduct($id);
    
    if($this->request->getMethod() === 'get') 
    {
      $categories = array('' => 'Choose Category') + array_column($this->M_Category->getStatus(1), 'category_name', 'category_id');
      $data = [
        'action' => '/product/update/'.$id,
        'back' => '/product',
        'validation' => $this->validation,
        'categories' => $categories,
        'v' => $this->product,
      ];
      echo view('product/update', $data);
    }
    else
    {
      $rules = $this->M_Product->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $file = $this->upload($segment);

      if($file) {
        $this->getFile->move('uploads/product', $this->imgName);
      } 
      $data = $this->request->getPost() + array('product_image' => $this->imgName);
      $put = $this->M_Product->putProduct($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update product Name '.$data['product_name'].' Successfully');
        return redirect()->back()->withInput();
      }
    }
  }

  public function delete($id)
  {
    $data = $this->M_Product->getProduct($id);

    if($data['product_image'] != 'default.png')
    {
      unlink('uploads/product/'. $data['product_image']);
    }
    $delete = $this->M_Product->deleteProduct($id);
    
    if($delete) {
      $this->session->setFlashdata('warning', 'Delete product Name '.$data['product_name'].' Successfully');
      return redirect()->route('product'); 
    }
  }

  function upload($segment)
  {
    $file = $this->request->getFile('product_image');
    switch($segment)
    {
      case 'create':

        if($file->getErrorString() == "No file was uploaded.")
        {
          $this->imgName = 'default.png';
          return false;
        }
        else
        {
          $this->imgName = $file->getRandomName();
          $this->getFile = $file;
          return true;
        }
        break;

      case 'update':

        $oldImg = $this->product['product_image'];

        if($file->getErrorString() == "No file was uploaded.")
        {
          $this->imgName = $oldImg;
          return false;
        }
        else
        {
          $this->imgName = $file->getRandomName();
          $this->getFile = $file;

          if($oldImg != 'default.png')
          {
            unlink('uploads/product/'. $oldImg);
          }
          return true;
        }
        break;
    }
  }

}