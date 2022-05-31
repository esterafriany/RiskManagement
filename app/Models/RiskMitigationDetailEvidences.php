<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationDetailEvidences extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_detail_evidences';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_detail_monitoring",
        "filename",
        "pathname",
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

    public function get_list_evidence($id){	
		  return $this->db->query("SELECT * FROM risk_mitigation_detail_evidences WHERE id_detail_monitoring ='".$id."'")->getResultArray();
    }

    public function  delete_by_detail_monitoring_id($id){
      $sql = "DELETE FROM risk_mitigation_detail_evidences WHERE id_detail_monitoring='".$id."'";
      $result = $this->db->query($sql);
    }

    public function get_list_evidence_by_month($month_target, $id_detail_mitigation){	
		  return $this->db->query("SELECT risk_mitigation_detail_evidences.id, id_detail_monitoring, filename, pathname
                              FROM risk_mitigation_detail_evidences
                              JOIN(
                                  SELECT risk_mitigation_detail_monitorings.id
                                  FROM risk_mitigation_detail_monitorings
                                  WHERE (id_detail_mitigation = '".$id_detail_mitigation."' AND MONTH(target_month) = '".$month_target."') OR
                                  (id_detail_mitigation = '".$id_detail_mitigation."' AND MONTH(monitoring_month) = '".$month_target."')
                                ) _tb ON risk_mitigation_detail_evidences.id_detail_monitoring = _tb.id")->getResultArray();
    }
}
