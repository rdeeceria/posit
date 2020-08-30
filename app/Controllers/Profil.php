<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Profil_model;

class Profil extends Controller
{	
	public function index()
	{
		$model = new Profil_model();
		$data = [
			'judul' => 'Daftar Nama',
			'profil' => $model->getProfil()
		];
		echo view('Profil_view', $data);
	}

	public function inputProfil()
	{
		$id = $this->request->uri->getSegment(3);
		if( empty($id) )
        {
			$data = [ 
				'judul' => 'Tambah Profil',
				'action' => base_url('profil/tambah')
			];
            echo view('inputProfil_view', $data);
        }
       		else
        {	
			$model = new Profil_model();
			$data = [
				'judul' => 'Edit Profil',
				'action' => base_url('profil/ubah/'.$id),
				'row' => $model->getProfil($id)
			];
			echo view('inputProfil_view', $data);
        }
	}

	public function deleteProfil()
	{
		$model = new Profil_model();
		$model->delete( $this->request->uri->getSegment(3) );
		return redirect()->route('/');
	}

	public function getDataPost()
	{
		$data = [
			'nama' => $this->request->getPost('nama'),
			'berat' => $this->request->getPost('berat'),
			'tinggi' => $this->request->getPost('tinggi'),
			'bmi' => $this->request->getPost('bmi')
		];
		return $data;
	}

	public function tambah()
	{
		$model = new Profil_model;
		$model->saveProfil( null, Profil::getDataPost() );
		return redirect()->route('/');
	}

	public function ubah()
	{
		$model = new Profil_model;
		$model->saveProfil( $this->request->uri->getSegment(3), Profil::getDataPost() );
		return redirect()->route('/');
	}
	//--------------------------------------------------------------------

}