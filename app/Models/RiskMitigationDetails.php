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

    public function copy_evidence($risk_detail, $id_division, $month, $id_risk_event, $current_id_detail_monitoring)
    {	
		$data = $this->db->query("SELECT risk_events.id as id_risk_event
                                    , risk_mitigations.id as id_risk_mitigation
                                    , risk_mitigation_details.id as id_detail_mitigation
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , risk_mitigation_detail_monitorings.id as id_detail_monitoring
                                    FROM risk_mitigation_details 
                                    JOIN risk_mitigations ON risk_mitigations.id = risk_mitigation_details.id_risk_mitigation
                                    JOIN risk_events ON risk_events.id = risk_mitigations.id_risk_event
                                    JOIN risk_mitigation_detail_monitorings ON risk_mitigation_details.id = risk_mitigation_detail_monitorings.id_detail_mitigation
                                    WHERE risk_mitigation_detail = '".$risk_detail."'
                                    AND risk_events.id = '".$id_risk_event."' AND risk_mitigation_details.id_division = '".$id_division."' AND (MONTH(target_month) = '".$month."' or MONTH(monitoring_month) = '".$month."');")->getRow();

        $id_detail_monitoring = $data->id_detail_monitoring;

        $data =  $this->db->query("SELECT *
                                    FROM risk_mitigation_detail_evidences
                                    WHERE id_detail_monitoring = '".$current_id_detail_monitoring."'")->getResultArray();

        for($i = 0; $i < count($data); $i++){
            $sql = "INSERT INTO risk_mitigation_detail_evidences (id_detail_monitoring, filename, pathname, flags, created_at)
                    VALUES ('".$id_detail_monitoring."', '".$data[$i]['filename']."', '".$data[$i]['pathname']."', '".$data[$i]['flags']."', '".date("Y-m-d H:i:s")."')";
    
            $result = $this->db->query($sql);
        }

        return $result;
    }

}
