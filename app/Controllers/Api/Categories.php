<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;

class Categories extends ResourceController
{
  protected $modelName = 'App\Models\M_Category';
  protected $format    = 'json';
  protected $request;
  protected $validation;

  public function __construct()
  {
    $this->validation = \Config\Services::validation();
  }

  public function headerApp()
  {
    $this->request->getHeaderLine('App') == 'posit' ? $sts = true : $sts = false;
    return $sts;
  }

  public function index()
  {
    $data = $this->model->orderBy('category_id', 'DESC')->findAll();

    if(! empty($data)) {
      return $this->respond($data);
    }
    else
    {
      $code = '404';
      $this->response->setStatusCode($code);
      $message = [
        'status' => $code,
        'message' => $this->response->getReason(),
      ];
      return $this->respond($message, $code);
    }
  }

  public function show($data = null)
  {
    $data = $this->model
    ->where('category_id', $data)
    ->orWhere('category_name', $data)
    ->first();

    if(! empty($data)) {
      return $this->respond($data);
    }
    else
    {
      $code = '404';
      $this->response->setStatusCode($code);
      $message = [
        'status' => $code,
        'message' => $this->response->getReason(),
      ];
      return $this->respond($message, $code);
    }
  }

  public function create()
  {
    if($this->headerApp()) 
    {
      $rules = $this->model->validationRules();

      if(! $this->validate($rules)) {
        $code = '406';
        $this->response->setStatusCode($code);
        $message = [
          'status' => $code,
          'message' => $this->response->getReason(),
          'errors' => $this->validation->getErrors(),
        ];
        return $this->respond($message, $code);
      }

      $data = $this->request->getRawInput();
      $post = $this->model->postCategory($data);

      if($post) {
        $code = '201';
        $this->response->setStatusCode($code);
        $message = [
          'status' => $code,
          'message' => $this->response->getReason(),
        ];
        return $this->respond($message, $code);
      }
    }
    else
    {
      $code = '401';
      $this->response->setStatusCode($code);
      $message = [
        'status' => $code,
        'message' => $this->response->getReason(),
      ];
      return $this->respond($message, $code);
    }
  }

  public function update($id = null)
  {
    if($this->headerApp()) 
    {
      $rules = $this->model->validationRules($id);

      if(! $this->validate($rules)) {
        $code = '406';
        $this->response->setStatusCode($code);
        $message = [
          'status' => $code,
          'message' => $this->response->getReason(),
          'errors' => $this->validation->getErrors(),
        ];
        return $this->respond($message, $code);
      }

      $data = $this->request->getRawInput();
      $put = $this->model->putCategory($id, $data);

      if($put) {
        $code = '202';
        $this->response->setStatusCode($code);
        $message = [
          'status' => $code,
          'message' => $this->response->getReason(),
        ];
        return $this->respond($message, $code);
      }
    }
    else
    {
      $code = '401';
      $this->response->setStatusCode($code);
      $message = [
        'status' => $code,
        'message' => $this->response->getReason(),
      ];
      return $this->respond($message, $code);
    }
  }

  public function delete($id = null)
  {
    if($this->headerApp())
    {
      $delete = $this->model->deleteCategory($id);

      if($delete) {
        $code = '200';
        $this->response->setStatusCode($code);
        $message = [
          'status' => $code,
          'message' => $this->response->getReason(),
        ];
        return $this->respond($message, $code);
      }
    }
    else
    {
      $code = '401';
      $this->response->setStatusCode($code);
      $message = [
        'status' => $code,
        'message' => $this->response->getReason(),
      ];
      return $this->respond($message, $code);
    }
  }

}