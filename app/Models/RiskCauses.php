<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskCauses extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_causes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_risk_event",
        "risk_cause",
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

    public function get_list_risk_cause()
    {	
		  return $this->db->query("SELECT * FROM risk_causes")->getResultArray();
    }

    public function delete_by_id_risk($id_risk_event)
    {	
      $sql = "DELETE FROM risk_causes WHERE id_risk_event='".$id_risk_event."'";
      $result = $this->db->query($sql);
    }
    
}
