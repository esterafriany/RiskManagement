<?php

namespace App\Models;

use CodeIgniter\Model;

class Groups extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'groups';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
		"name",
		"is_root",
		"is_need_credential",
		"can_approval_job",
		"is_active",
        "created_at",
        "updated_at"
	];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
	
	public function users()
    {
        return $this->hasMany('users', 'App\Models\Users');
    }
	
	public function get_list_groups()
    {
        return $this->db->query("SELECT * FROM groups")->getResultArray();
    }
	
	public function get_group($id)
    {	
		return $this->db->query("SELECT * FROM groups WHERE id ='".$id."'")->getRow();
    }
	
}
