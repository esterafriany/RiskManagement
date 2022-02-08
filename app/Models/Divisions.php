<?php

namespace App\Models;

use CodeIgniter\Model;

class Divisions extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'divisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name",
        "division_code",
		"is_active"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function users()
    {
        return $this->hasMany('users', 'App\Models\Users');
    }

    public function get_division($id)
    {	
		return $this->db->query("SELECT * FROM divisions WHERE id ='".$id."'")->getRow();
    }

    public function get_list_divisions()
    {
        return $this->db->query("SELECT * FROM divisions")->getResultArray();
    }
}
