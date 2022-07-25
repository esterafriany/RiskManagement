<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskMitigationProgressRiskOwners extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_mitigation_progress_risk_owners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_risk_event',
        'id_division',
        'probability_level_residual',
        'impact_level_residual',
        'final_level_residual',
        'risk_analysis_residual',
        'risk_impact_quantitative',
        'description',
        'created_at',
        'updated_at'
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

    public function get_risk_progress_by_id_division($id_risk_event,$id_division){
        return $this->db->query("SELECT * FROM risk_mitigation_progress_risk_owners 
        WHERE id_risk_event ='".$id_risk_event."' AND id_division= '".$id_division."'")->getRow();
    }
}
