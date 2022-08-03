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

    public function get_list_risk_mitigation($id_risk)
    {	
		  return $this->db->query("SELECT * FROM risk_mitigations WHERE id_risk_event='".$id_risk."'")->getResultArray();
    }

    public function get_list_risk_mitigation_by_risk_owner($id_risk, $id_risk_owner)
    {	
		  return $this->db->query("SELECT 
                              risk_mitigations.id as id_risk_mitigation
                              , risk_mitigations.id_risk_event
                              , risk_mitigation_divisions.id as id_risk_mitigation_division
                              , risk_mitigation_divisions.id_division
                              , risk_mitigations.risk_mitigation
                              FROM risk_mitigations
                              JOIN risk_mitigation_divisions ON risk_mitigations.id = risk_mitigation_divisions.id_risk_mitigation
                              WHERE id_risk_event='".$id_risk."' AND risk_mitigation_divisions.id_division = '".$id_risk_owner."'
                              ORDER BY risk_mitigations.id ASC")->getResultArray();
    }

    public function get_risk_mitigation($id_risk_mitigation)
    {	
		  return $this->db->query("SELECT * FROM risk_mitigations WHERE id='".$id_risk_mitigation."'")->getRow();
    }

    public function delete_by_id_risk($id_risk_event)
    {	
      $sql = "DELETE FROM risk_mitigations WHERE id_risk_event='".$id_risk_event."'";
      $result = $this->db->query($sql);
    }

    public function delete_not_in($not_deleted_id,$id_risk_event)
    {	
      $sql = "DELETE FROM risk_mitigations WHERE id_risk_event = ".$id_risk_event." AND risk_mitigations.id NOT IN (".$not_deleted_id.")";
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

    public function get_count_target($id_division, $year, $target_month){
      return $this->db->query("
        SELECT COUNT(target_month) as target
        FROM risk_mitigation_detail_monitorings 
        JOIN risk_mitigation_details ON risk_mitigation_details.id = risk_mitigation_detail_monitorings.id_detail_mitigation
        WHERE MONTH(target_month) = '".$target_month."' AND YEAR(target_month) = '".$year."' AND risk_mitigation_details.id_division = '".$id_division."'
      ")->getRow();
    }

    public function get_count_monitoring($id_division, $year, $target_month){
      return $this->db->query("
                        SELECT COUNT(monitoring_month) as realisasi
                        FROM risk_mitigation_detail_monitorings
                        JOIN risk_mitigation_details ON risk_mitigation_details.id = risk_mitigation_detail_monitorings.id_detail_mitigation
                        WHERE MONTH(monitoring_month) = '".$target_month."' AND YEAR(target_month) = '".$year."' AND risk_mitigation_details.id_division = '".$id_division."'")->getRow();
    }



     


    
}
