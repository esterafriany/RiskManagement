<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationDetailOutputs extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_detail_outputs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_detail_mitigation",
        "output",
        "created_at",
        "updated_at",
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

    public function get_list_output($id)
    {	
		return $this->db->query("SELECT * FROM risk_mitigation_detail_outputs WHERE id_detail_mitigation ='".$id."'")->getResultArray();
    }

    public function  delete_by_detail_mitigation_id($id){
        $sql = "DELETE FROM risk_mitigation_detail_outputs WHERE id_detail_mitigation='".$id."'";
        $result = $this->db->query($sql);
    }
}
