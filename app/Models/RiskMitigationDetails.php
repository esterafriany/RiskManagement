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
        "progress_percentage",
        "risk_mitigation_detail",
        "id_division",
        "is_active",
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

    public function get_detail_mitigation($id)
    {	
		  return $this->db->query("SELECT * FROM risk_mitigation_details WHERE id ='".$id."'")->getRow();
    }

    public function get_mitigation_with_detail($id)
    {	
		  return $this->db->query("SELECT risk_mitigation_details.id, risk_mitigation_details.risk_mitigation_detail, risk_mitigations.risk_mitigation
                                    FROM risk_mitigation_details JOIN risk_mitigations
                                    ON risk_mitigation_details.id_risk_mitigation = risk_mitigations.id 
                                    WHERE risk_mitigation_details.id ='".$id."'")->getRow();
    }

    public function get_list_risk_event_by_risk_detail($risk_detail)
    {	
		  return $this->db->query("SELECT DISTINCT(_tb.id_risk_event)
                            FROM (
                                SELECT risk_mitigation_details.id as id_risk_mitigation_detail, risk_mitigation_details.risk_mitigation_detail, risk_mitigations.id_risk_event
                                FROM risk_mitigation_details JOIN risk_mitigations ON risk_mitigation_details.id_risk_mitigation = risk_mitigations.id
                                WHERE risk_mitigation_detail = '".$risk_detail."'
                            ) _tb;")->getResultArray();
    }

}
