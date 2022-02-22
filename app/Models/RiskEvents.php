<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskEvents extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_events';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_kpi",
        "risk_number",
        "risk_event",
        "year",
        "objective",
        "existing_control_1",
        "existing_control_2",
        "existing_control_3",
        "probability_level",
        "impact_level",
        "final_level",
        "risk_analysis",
        "probability_level_residual",
        "impact_level_residual",
        "final_level_residual",
        "risk_analysis_residual",
        "risk_impact_quantitative",
        "description",
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

    public function get_risk_event($id)
    {	
		  return $this->db->query("SELECT * FROM risk_events WHERE id ='".$id."'")->getRow();
    }
    public function get_data_matrix()
    {	
		  return $this->db->query("SELECT id, probability_level, impact_level , concat(probability_level,impact_level)  as td_id
                                FROM risk_events
                                WHERE YEAR = '2022'")->getResultArray();
    }
}
