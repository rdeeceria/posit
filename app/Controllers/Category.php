<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\Category_model;
  
class Category extends Controller
{
    public function breadcrumb()
    {
        $uri = service('uri');
        $segment = $uri->getSegments();
        $total = $uri->getTotalSegments();

        foreach($segment as $k => $v) {
            $bread[$k] = '<li class="breadcrumb-item"><a href="/'.$v.'">'.ucfirst($v).'</a></li>';
        }
        
        if($bread > 2) {
            array_pop($bread);
        }
        array_splice($bread, -1, $total, '<li class="breadcrumb-item active">'.ucfirst($v).'</li>');
        
        return $bread;
    }

    public function index()
    { 
        $model = new Category_model();
        $view = array(
            'title' => 'Categories',
            'categories' => $model->getCategory(),
            'bread' => $this->breadcrumb(),
        );
        echo view('category/main', $view);
    }

    public function create()
    {
        $view = array(
            'title' => 'Tambah Category',
            'action' => base_url('category/tambah'),
            'bread' => $this->breadcrumb(),
        );

        if(session()->getFlashdata('inputs')) {       
            echo view('category/create', $view);
        }
        else
        {
            $data = array(
                'category_name' => '',
                'category_status' => '',
            );
            session()->setFlashdata('inputs', $data);
            echo view('category/create', $view);
        }  
    }

    public function edit($id)
    {
        $model = new Category_model();
        $row = $model->getCategory($id);
        $view = array(
            'title' => 'Edit Category',
            'action' => base_url('category/ubah/'.$id),
            'bread' => $this->breadcrumb(),
        );
        $data = array(
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'category_status' => $row['category_status'],
        );
        session()->setFlashdata('inputs', $data);
        echo view('category/edit', $view); 
    }
    
    public function delete()
	{
        $id = $this->request->uri->getSegment(3);
		$model = new Category_model();
        $hapus = $model->delete($id);
        if($hapus) {
            session()->setFlashdata('warning', 'Deleted Category successfully');
            return redirect()->route('/category'); 
        }
	}

    public function getDataPost()
    {
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('category_status'),
        );
        return $data;
    }
 
    public function tambah()
    {
        $validation = \Config\Services::validation();

        if($validation->run(Category::getDataPost(), 'category') == FALSE) {
            session()->setFlashdata('inputs', $this->getDataPost());
            session()->setFlashdata('errors', $validation->getErrors());
        
            $model = new Category_model();
            $simpan = $model->putCategory(NULL, $this->getDataPost());
            if($simpan) {
                session()->setFlashdata('success', 'Created Category successfully');
                return redirect()->route('/category');
            }
        }
        else
        {
            return redirect()->to(base_url('category/create'));
        }
    }

    public function ubah()
    {
        $validation = \Config\Services::validation();
        $id = $this->request->uri->getSegment(3);

        if($validation->run(Category::getDataPost(), 'category') == FALSE) {
            session()->setFlashdata('inputs', $this->getDataPost());
            session()->setFlashdata('errors', $validation->getErrors());
        
            $model = new Category_model();
            $simpan = $model->putCategory($id, $this->getDataPost());
            if($simpan) {
                session()->setFlashdata('info', 'Updated Category successfully');
                return redirect()->route('/category'); 
            }
        }
        else
        {
            return redirect()->to(base_url('category/edit/'.$id));
        }
    }

}