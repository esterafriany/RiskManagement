<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationDetailMonitorings extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_detail_monitorings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_detail_mitigation",
        "target_month",
        "monitoring_month",
        "notes",
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

    public function get_list_monitoring_by_id_detail_mitigation($id){
        return $this->db->query("SELECT * FROM risk_mitigation_detail_monitorings WHERE id_detail_mitigation ='".$id."'")->getResultArray();
    }

    public function get_notes($id, $month){
        return $this->db->query("SELECT * FROM risk_mitigation_detail_monitorings 
        WHERE id_detail_mitigation ='".$id."' AND  (MONTH(target_month) = '".$month."' OR MONTH (monitoring_month) = '".$month."')")->getRow();
    }

    public function  delete_by_detail_mitigation_id($id){
        $sql = "DELETE FROM risk_mitigation_detail_monitorings WHERE id_detail_mitigation='".$id."'";
        $result = $this->db->query($sql);
    }

    public function update_notes($id_detail, $notes){
        $sql = "UPDATE risk_mitigation_detail_monitorings 
                SET notes = '".$notes."' 
                WHERE id ='".$id_detail."'";
        $result = $this->db->query($sql);
    }

    public function update_data_monitoring($id_detail_mitigation, $monitoring_month){
        $month = date("Y")."-".$monitoring_month."-01";
        $sql = "UPDATE risk_mitigation_detail_monitorings 
                SET monitoring_month = '".$month."'
                WHERE id_detail_mitigation='".$id_detail_mitigation."'and target_month = '".$month."'";
        $result = $this->db->query($sql);
    }

    public function update_data_monitoring_2($id_detail_mitigation, $monitoring_month){
        $month = "0000-00-00";
        $monitoring_month = date("Y")."-".$monitoring_month."-01";
        $sql = "UPDATE risk_mitigation_detail_monitorings 
                SET monitoring_month = '".$month."'
                WHERE id_detail_mitigation='".$id_detail_mitigation."'and monitoring_month = '".$monitoring_month."'";
        $result = $this->db->query($sql);
    }

    public function update_data_target($id_detail_mitigation, $target_month){
        $month = date("Y")."-".$target_month."-01";
        $sql = "UPDATE risk_mitigation_detail_monitorings 
                SET target_month = '".$month."'
                WHERE id_detail_mitigation='".$id_detail_mitigation."'and target_month = '".$month."'";
        $result = $this->db->query($sql);
    }

    public function update_data_target_2($id_detail_mitigation, $target_month){
        $month = "0000-00-00";
        $target_month = date("Y")."-".$target_month."-01";

        $sql = "UPDATE risk_mitigation_detail_monitorings 
                SET target_month = '".$month."'
                WHERE id_detail_mitigation='".$id_detail_mitigation."'and target_month = '".$target_month."'";
        $result = $this->db->query($sql);
    }

    public function get_id_monitoring($month, $id_detail_mitigation){
        return $this->db->query("SELECT id FROM risk_mitigation_detail_monitorings 
        
        WHERE (id_detail_mitigation ='".$id_detail_mitigation."' AND MONTH(target_month) = '".$month."')
        OR (id_detail_mitigation ='".$id_detail_mitigation."' AND MONTH(monitoring_month) = '".$month."')
        ")->getRow();
    }

    public function get_data_by_month_target($id, $month){
        return $this->db->query("SELECT *, MONTH(target_month) as t_month FROM risk_mitigation_detail_monitorings 
        WHERE id_detail_mitigation ='".$id."' AND MONTH(target_month) = '".$month."'")->getRow();
    }

    public function get_data_by_month_monitoring($id, $month){
        return $this->db->query("SELECT * FROM risk_mitigation_detail_monitorings 
        WHERE id_detail_mitigation ='".$id."' AND MONTH(monitoring_month) = '".$month."'")->getRow();
    }

    public function delete_evidence_by_id_monitoring($id){
        $sql = "DELETE FROM risk_mitigation_detail_evidences 
        WHERE risk_mitigation_detail_evidences.id_detail_monitoring IN (
            SELECT id from risk_mitigation_detail_monitorings WHERE
            risk_mitigation_detail_monitorings.id_detail_mitigation = '".$id."')";
        
        $result = $this->db->query($sql);
    }

    public function delete_null_target_monitoring(){
        $sql = "DELETE FROM risk_mitigation_detail_monitorings 
        WHERE target_month LIKE '0000-00-00' AND monitoring_month LIKE '0000-00-00'";
        
        $result = $this->db->query($sql);
    }
}
