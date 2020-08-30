<?php namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Models\Profil_model;

class Sse extends Controller
{	
    public function index()
    {
		return view('sse_view');
    }

    public function stream()
    {
        $this->response->setHeader('Content-Type', 'text/event-stream');
        $model = new Profil_model();
        $data = json_encode( $model->getProfil(1) );
        echo "data: {$data}\n\n";
    }   
}