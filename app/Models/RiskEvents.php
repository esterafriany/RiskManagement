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
        "risk_number_residual",
        "risk_number_target",
        "risk_event",
        "year",
        "objective",
        "existing_control_1",
        "existing_control_2",
        "existing_control_3",
        "probability_level",
        "impact_level",
        "final_level",
        "target_probability_level",
        "target_impact_level",
        "target_final_level",
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

    public function get_data_matrix($year)
    {	
		  return $this->db->query("SELECT id
                                , risk_number, risk_number_target, risk_number_residual
                                , probability_level, impact_level
                                , target_probability_level, target_impact_level
                                , probability_level_residual, impact_level_residual
                                , concat(probability_level,impact_level)  as td_id
                                , concat(target_probability_level,target_impact_level) as target_td_id
                                , concat(probability_level_residual,impact_level_residual) as residual_td_id
                                FROM risk_events
                                WHERE YEAR = '".$year."'")->getResultArray();
    }

    public function get_data_progress_matrix($year)
    {	
		  return $this->db->query("SELECT id, risk_number, probability_level, impact_level,concat(probability_level,impact_level)  as td_id
                                    FROM risk_events
                                    WHERE probability_level_residual IS NULL AND YEAR = '".$year."'
                                    UNION
                                    SELECT id, risk_number, probability_level_residual, impact_level_residual, concat(probability_level_residual,impact_level_residual)
                                    FROM risk_events
                                    WHERE probability_level_residual IS NOT NULL AND YEAR = '".$year."'")->getResultArray();
    }

    public function get_list_risk_event($year)
    {
        return $this->db->query("SELECT risk_events.id, final_level, kpis.level
                                FROM risk_events JOIN kpis 
                                ON kpis.id = risk_events.id_kpi
                                WHERE risk_events.year = '".$year."'")->getResultArray();
    }

    public function get_list_risk_event_target($year)
    {
        return $this->db->query("SELECT risk_events.id, target_final_level, kpis.level
                                FROM risk_events JOIN kpis 
                                ON kpis.id = risk_events.id_kpi
                                WHERE risk_events.year = '".$year."'")->getResultArray();
    }

    public function get_list_risk_event_residual($year)
    {
        return $this->db->query("SELECT risk_events.id, final_level_residual, kpis.level
                                FROM risk_events JOIN kpis 
                                ON kpis.id = risk_events.id_kpi
                                WHERE risk_events.year = '".$year."'")->getResultArray();
    }

    
}
