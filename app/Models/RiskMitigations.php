<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigations extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_risk_event",
        "risk_mitigation",
        "id_pic",
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

    public function get_list_risk_mitigation($id_risk)
    {	
		  return $this->db->query("SELECT * FROM risk_mitigations WHERE id_risk_event='".$id_risk."'")->getResultArray();
    }
    public function delete_by_id_risk($id_risk_event)
    {	
      $sql = "DELETE FROM risk_mitigations WHERE id_risk_event='".$id_risk_event."'";
      $result = $this->db->query($sql);
    }

    public function get_deleted_risk_mitigation($id_risk)
    {	
		  return $this->db->query("SELECT id FROM risk_mitigations WHERE id_risk_event='".$id_risk."'")->getResultArray();
    }

    public function get_risk_monitoring_data()
    {	
		  return $this->db->query("SELECT risk_events.risk_event
                    , risk_mitigations.risk_mitigation
                    , risk_mitigation_details.id
                    , risk_mitigation_details.risk_mitigation_detail
                  FROM risk_events 
                  LEFT JOIN risk_mitigations ON risk_events.id = risk_mitigations.id_risk_event
                  LEFT JOIN risk_mitigation_details ON risk_mitigation_details.id_risk_mitigation = risk_mitigations.id")->getResultArray();
    }
}
