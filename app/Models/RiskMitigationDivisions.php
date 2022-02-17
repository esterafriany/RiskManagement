<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationDivisions extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_divisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id",
        "id_risk_mitigation",
        "id_division"
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

    public function get_risk_division_by_risk_mitigation_id($id_risk_mitigation)
    {	
		return $this->db->query("
        SELECT id_division as id, divisions.name as text
        FROM risk_mitigation_divisions JOIN divisions
        ON divisions.id = risk_mitigation_divisions.id_division WHERE id_risk_mitigation ='".$id_risk_mitigation."'")->getResultArray();
    }
}
