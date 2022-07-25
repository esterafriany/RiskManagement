<?php

namespace App\Models;

use CodeIgniter\Model;

class RiskEventCategories extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'risk_event_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_risk_category",
        "id_risk_event",
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

    public function get_list_risk_event_categories()
    {	
		  return $this->db->query("SELECT * FROM risk_event_categories")->getResultArray();
    }

    public function delete_by_id_risk($id_risk_event)
    {	
      $sql = "DELETE FROM risk_event_categories WHERE id_risk_event='".$id_risk_event."'";
      $result = $this->db->query($sql);
    }
    
}
