<?php namespace App\Controllers;

class Product extends BaseController
{
  protected $product = [];
  protected $getFile;
  protected $imgName;

  public function __construct()
  {
    view('partials/index', array('subtitle' => 'Products'));
  }

  public function index()
  { 
    $data = [
      'list' => $this->M_Product->getProduct(),
      'create' => '/product/create',
      'read' => '/product/read',
      'update' => '/product/update/',
      'delete' => '/product/delete/',
    ];
    echo view('product/list', $data);
  }

  public function create()
  {
    $segment = $this->request->uri->getSegments(1);

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
      $file = $this->upload($segment);
      $rules = $this->M_Product->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }

      if($file) {
        $this->getFile->move('uploads/product', $this->imgName);
      } 

      $data = $this->request->getPost() + array('product_image' => $this->imgName);
      $post = $this->M_Product->postProduct($data);
      
      if($post) {
        $this->session->setFlashdata('success', 'Create product Name '.$data['product_name'].' Successfully');
        return redirect()->route('product');
      }
    }
  }

  public function update($id)
  {
    $segment = $this->request->uri->getSegments(1);

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
      $file = $this->upload($segment);
      $rules = $this->M_Product->validationRules($id);

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }

      if($file) {
        $this->getFile->move('uploads/product', $this->imgName);
      } 
  
      $data = $this->request->getPost() + array('product_image' => $this->imgName);
      $put = $this->M_Product->putProduct($id, $data);
  
      if($put) {
        $this->session->setFlashdata('info', 'Update product Name '.$data['product_name'].' Successfully');
        return redirect()->route('product');
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

  public function upload($segment)
  {
    $file = $this->request->getFile('product_image');

    if($segment === 'create')
    {
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
    }
    else
    {
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
    }
  }

}