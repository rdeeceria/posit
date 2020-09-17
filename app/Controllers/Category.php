<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\Category_model;
  
class Category extends BaseController
{
    public function index()
    { 
        $view = array(
            'content' => 'category/list',
            'title' => 'Categories',
            'data' => [
                'categories' => $this->CategoryModel->getCategory(),
            ],
        );
        echo view('index', $view);
    }

    public function create()
    {
        $view = array(
            'content' => 'category/create',
            'title' => 'Categories',
            'data' => [
                'action' => base_url('category/post'),
                'validation' => \Config\Services::validation(),
            ],
        );
        echo view('index', $view);
    }

    public function update($id)
    {
        $v = $this->CategoryModel->getCategory($id);
        $view = array(
            'content' => 'category/update',
            'title' => 'Categories',
            'data' => [
                'action' => base_url('category/put'),
                'validation' => \Config\Services::validation(),
                'category_id' => $v['category_id'],
                'category_name' => $v['category_name'],
                'category_status' => $v['category_status'],
            ],
        );
        echo view('index', $view);
    }
    
    public function delete($id)
	{
        $data = $this->CategoryModel->getCategory($id);
        $delete = $this->CategoryModel->deleteCategory($id);
        if($delete) {
            $this->session->setFlashdata('warning', 'Delete Category Name '.$data['category_name'].' Successfully');
            return redirect()->to('/category'); 
        }
	}

    public function post()
    {
        $rules = $this->CategoryModel->validationRules();

        if(! $this->validate($rules)) {
            return redirect()->to('/category/create')->withInput();
        }
        
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('category_status'),
        );
        $post = $this->CategoryModel->postCategory($data);

        if($post) {
            $this->session->setFlashdata('success', 'Create Category Name '.$data['category_name'].' Successfully');
            return redirect()->to('/category');
        }
    }

    public function put()
    {
        $id = $this->request->getPost('category_id');
        $rules = $this->CategoryModel->validationRules($id);

        if(! $this->validate($rules)) {
            return redirect()->to('/category/update/'.$id)->withInput();
        }
        
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('category_status'),
        );
        $put = $this->CategoryModel->putCategory($id, $data);

        if($put) {
            $this->session->setFlashdata('info', 'Update Category Name '.$data['category_name'].' Successfully');
            return redirect()->to('/category');
        }
    }
}