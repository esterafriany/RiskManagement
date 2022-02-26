<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationDetails extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_risk_mitigation",	
        "risk_mitigation_detail",
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

    public function get_detail_mitigation($id)
    {	
		  return $this->db->query("SELECT * FROM risk_mitigation_details WHERE id ='".$id."'")->getRow();
    }
}
