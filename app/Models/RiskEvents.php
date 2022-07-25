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
        "risk_number_manual",
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
        "target_risk_analysis",
        "probability_level_residual",
        "impact_level_residual",
        "final_level_residual",
        "risk_analysis_residual",
        "risk_impact_quantitative",
        "description",
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

    public function get_risk_event($id)
    {	
		  return $this->db->query("SELECT * FROM risk_events WHERE id ='".$id."'")->getRow();
    }

    public function get_data_matrix($year)
    {	
		  return $this->db->query("SELECT id
                                , risk_number, risk_number_target, risk_number_residual, risk_number_manual
                                , probability_level, impact_level
                                , target_probability_level, target_impact_level
                                , probability_level_residual, impact_level_residual
                                , final_level_residual
                                , concat(probability_level,impact_level)  as td_id
                                , concat(target_probability_level,target_impact_level) as target_td_id
                                , concat(probability_level_residual,impact_level_residual) as residual_td_id
                                FROM risk_events
                                WHERE YEAR = '".$year."'")->getResultArray();
    }

    public function get_data_matrix_risk_owner($year, $id_division)
    {	
		  return $this->db->query("SELECT DISTINCT risk_events.id
                                    , risk_number, risk_number_target, risk_number_residual
                                    , probability_level, impact_level
                                    , target_probability_level, target_impact_level
                                    , final_level_residual
                                    , probability_level_residual, impact_level_residual
                                    , concat(probability_level,impact_level)  as td_id
                                    , concat(target_probability_level,target_impact_level) as target_td_id
                                    , concat(probability_level_residual,impact_level_residual) as residual_td_id
                                FROM risk_events JOIN risk_mitigations ON risk_events.id = risk_mitigations.id_risk_event
                                JOIN risk_mitigation_divisions ON risk_mitigations.id = risk_mitigation_divisions.id_risk_mitigation
                                WHERE YEAR = '".$year."' AND risk_mitigation_divisions.id_division = '".$id_division."'")->getResultArray();
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

    public function get_data_report($year){
        return $this->db->query("
                        SELECT CONCAT('R',risk_number_manual) as risk_number
                        , risk_event
                        , risk_mitigation
                        , risk_mitigation_details.risk_mitigation_detail
                        , risk_mitigation_details.id as id_detail_mitigation
                        , divisions.name
                        , risk_mitigation_detail_outputs.output
                        FROM risk_events JOIN risk_mitigations on risk_events.id = risk_mitigations.id_risk_event
                        JOIN risk_mitigation_details on risk_mitigations.id = risk_mitigation_details.id_risk_mitigation
                        JOIN divisions ON divisions.id = risk_mitigation_details.id_division
                        JOIN risk_mitigation_detail_outputs on risk_mitigation_detail_outputs.id_detail_mitigation = risk_mitigation_details.id
                        WHERE risk_events.year = '".$year."'
                        ORDER BY risk_events.id ASC, risk_mitigations.id ASC, risk_mitigation_details.id ASC;")->getResultArray();
    }

    public function get_risk_number_count($year){
        return $this->db->query("SELECT CONCAT('R',_tb.risk_number), COUNT(_tb.risk_number) as count FROM 
                                (
                                    SELECT risk_number_manual as risk_number
                                                        , risk_event
                                                        , risk_mitigation
                                                        , risk_mitigation_details.risk_mitigation_detail
                                                        , risk_mitigation_details.id as id_detail_mitigation
                                                        , divisions.name
                                                        , risk_mitigation_detail_outputs.output
                                FROM risk_events JOIN risk_mitigations on risk_events.id = risk_mitigations.id_risk_event
                                                        JOIN risk_mitigation_details on risk_mitigations.id = risk_mitigation_details.id_risk_mitigation
                                                        JOIN divisions ON divisions.id = risk_mitigation_details.id_division
                                                        JOIN risk_mitigation_detail_outputs on risk_mitigation_detail_outputs.id_detail_mitigation = risk_mitigation_details.id
                                                        WHERE risk_events.year = '".$year."'
                                                        ORDER BY risk_events.id ASC, risk_mitigations.id ASC, risk_mitigation_details.id ASC
                                ) _tb

                                GROUP BY _tb.risk_number;")->getResultArray();
    }

    public function get_risk_mitigation_count($year){
        return $this->db->query("SELECT CONCAT('R',_tb.risk_number) as risk_number, _tb.risk_mitigation, _tb.id_detail_mitigation, COUNT(_tb.risk_mitigation) as count FROM (
                                SELECT risk_number_manual as risk_number
                                    , risk_event
                                    , risk_mitigation
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , risk_mitigation_details.id as id_detail_mitigation
                                    , divisions.name
                                    , risk_mitigation_detail_outputs.output
                                FROM risk_events JOIN risk_mitigations on risk_events.id = risk_mitigations.id_risk_event
                                JOIN risk_mitigation_details on risk_mitigations.id = risk_mitigation_details.id_risk_mitigation
                                JOIN divisions ON divisions.id = risk_mitigation_details.id_division
                                JOIN risk_mitigation_detail_outputs on risk_mitigation_detail_outputs.id_detail_mitigation = risk_mitigation_details.id
                                WHERE risk_events.year = '".$year."'
                                ORDER BY risk_events.id ASC, risk_mitigations.id ASC, risk_mitigation_details.id ASC
                            ) _tb
                            GROUP BY _tb.risk_mitigation, _tb.risk_number
                            ORDER BY _tb.risk_number,_tb.id_detail_mitigation;")->getResultArray();
    }
    

    public function get_data_target($year)
    {
        return $this->db->query("
                        SELECT id_detail_mitigation
                        , (case when target_month = '".$year."-01-01' then 1 else 0 end) as Januari
                        , (case when target_month = '".$year."-02-01' then 1 else 0 end) as Februari
                        , (case when target_month = '".$year."-03-01' then 1 else 0 end)  as Maret
                        , (case when target_month = '".$year."-04-01' then 1 else 0 end)  as April
                        , (case when target_month = '".$year."-05-01' then 1 else 0 end)  as Mei
                        , (case when target_month = '".$year."-06-01' then 1 else 0 end)  as Juni
                        , (case when target_month = '".$year."-07-01' then 1 else 0 end)  as Juli
                        , (case when target_month = '".$year."-08-01' then 1 else 0 end)  as Agustus
                        , (case when target_month = '".$year."-09-01' then 1 else 0 end)  as September
                        , (case when target_month = '".$year."-10-01' then 1 else 0 end)  as Oktober
                        , (case when target_month = '".$year."-11-01' then 1 else 0 end)  as November
                        , (case when target_month = '".$year."-12-01' then 1 else 0 end)  as Desember
                        FROM
                        (
                            SELECT id_detail_mitigation, target_month, monitoring_month, notes, risk_mitigation_detail
                            FROM risk_mitigation_detail_monitorings JOIN risk_mitigation_details ON risk_mitigation_details.id = risk_mitigation_detail_monitorings.id_detail_mitigation
                            WHERE LEFT(target_month, 4) LIKE '".$year."' OR LEFT(monitoring_month, 4) LIKE '".$year."'
                        ) _tb
                        GROUP BY id_detail_mitigation, target_month")->getResultArray();
    }

    public function get_data_monitoring($year){
        return $this->db->query("
                                SELECT id_detail_mitigation
                                , (case when monitoring_month = '".$year."-01-01' then 1 else 0 end) as Januari
                                , (case when monitoring_month = '".$year."-02-01' then 1 else 0 end) as Februari
                                , (case when monitoring_month = '".$year."-03-01' then 1 else 0 end)  as Maret
                                , (case when monitoring_month = '".$year."-04-01' then 1 else 0 end)  as April
                                , (case when monitoring_month = '".$year."-05-01' then 1 else 0 end)  as Mei
                                , (case when monitoring_month = '".$year."-06-01' then 1 else 0 end)  as Juni
                                , (case when monitoring_month = '".$year."-07-01' then 1 else 0 end)  as Juli
                                , (case when monitoring_month = '".$year."-08-01' then 1 else 0 end)  as Agustus
                                , (case when monitoring_month = '".$year."-09-01' then 1 else 0 end)  as September
                                , (case when monitoring_month = '".$year."-10-01' then 1 else 0 end)  as Oktober
                                , (case when monitoring_month = '".$year."-11-01' then 1 else 0 end)  as November
                                , (case when monitoring_month = '".$year."-12-01' then 1 else 0 end)  as Desember
                                FROM
                                (
                                    SELECT id_detail_mitigation, target_month, monitoring_month, notes, risk_mitigation_detail
                                    FROM risk_mitigation_detail_monitorings JOIN risk_mitigation_details ON risk_mitigation_details.id = risk_mitigation_detail_monitorings.id_detail_mitigation
                                    WHERE LEFT(target_month, 4) LIKE '".$year."' OR LEFT(monitoring_month, 4) LIKE '".$year."'
                                    
                                ) _tb
                                GROUP BY id_detail_mitigation, monitoring_month;")->getResultArray();
    }

    
    
}
