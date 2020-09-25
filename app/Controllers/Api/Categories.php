<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;

class Categories extends ResourceController
{
  protected $modelName = 'App\Models\M_Category';
  protected $format    = 'json';
  protected $request;

  public function index()
  {
    $data = $this->model->orderBy('category_id', 'DESC')->findAll();
    return $this->respond($data);
  }

  public function show($name = null)
  {
    $data = $this->model->where('category_name', $name)->first();
    return $this->respond($data);
  }

  public function create()
  {
    $data = array('category_id' => uniqid()) + $this->request->getPost();
    return $this->respond($this->model->insert($data));
  }

  public function update($id = null)
  {
    if ($this->request->getHeaderLine('KEY') == '123')
    {
      $data = $this->request->getRawInput();
      return $this->respond($this->model->update($id, $data));
    }
    else
    {
      $this->response->setStatusCode(401, 'Unauthorized');
      $data = [
        'status' => '401',
        'message' => 'Access Denied.'
      ];
      return $this->response->setJSON($data);
    }
  }

  public function delete($id = null)
  {
    if ($this->request->getHeaderLine('KEY') == '123')
    {
      $data = $this->request->getRawInput();
      return $this->respond($this->model->delete($id));
    }
    else
    {
      $this->response->setStatusCode(401, 'Unauthorized');
      $data = [
        'status' => '401',
        'message' => 'Access Denied.'
      ];
      return $this->response->setJSON($data);
    }
  }

}