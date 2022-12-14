<?php

namespace App\Models;

use CodeIgniter\Model;

class KPIs extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kpis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name",
		"year",
		"description",
		"is_active",
        "level",
        "created_at",
        "updated_at"
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

    public function get_kpi($id)
    {	
		  return $this->db->query("SELECT * FROM kpis WHERE id ='".$id."'")->getRow();
    }

    public function get_list_kpis()
    {
        return $this->db->query("SELECT * FROM kpis WHERE is_active='1'")->getResultArray();
    }
}
