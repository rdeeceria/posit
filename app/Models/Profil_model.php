<?php namespace App\Models;

use CodeIgniter\Model;

class Profil_model extends Model
{
    protected $table = 'm_profil';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'berat', 'tinggi', 'bmi'];

    public function getProfil( $id = null )
    {
        if( empty($id) )
        {
            return $this->orderBy('id ASC')->findAll();
        }
            else
        {
            return $this->where('id', $id)->first();
        }
    }

    public function saveProfil( $id, $data )
    {
        if( empty($id) )
        {
            return $this->insert($data);
        }
            else
        {
            return $this->update($id, $data);
        }
    }
}