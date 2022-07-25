<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskCategories extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      "name",
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

    public function get_risk_category($id)
    {	
		  return $this->db->query("SELECT * FROM risk_categories WHERE id ='".$id."'")->getRow();
    }

    public function get_list_risk_category()
    {	
		  return $this->db->query("SELECT * FROM risk_categories WHERE is_active='1'")->getResultArray();
    }

    public function get_list_risk_category_by_risk_id($risk_id)
    {	
		  return $this->db->query("
            SELECT risk_categories.id as id_category, risk_event_categories.id as id_risk_category, risk_categories.name
            FROM risk_categories JOIN risk_event_categories
            ON risk_categories.id = risk_event_categories.id_risk_category
            WHERE risk_event_categories.id_risk_event = '".$risk_id."'")->getResultArray();
    }


    

    
}
