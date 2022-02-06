<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'users';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
		"id_group",
		"email",
		"password",
		"username",
		"name",
		"gender",
		"no_telp",
		"alamat",
		"is_active"
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
	
	public function groups()
    {
        return $this->belongsToMany('groups', 'App\Models\Groups');
    }
	
	public function login($email,$password)
    {
        $result = $this->db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' AND is_active = '1'");
        $count =  count($result->getResultArray());
		
        if ($count > 0) {
            return $result->getRowArray();
        }
    }
	
	public function get_list_user()
    {
		
        return $this->db->query("SELECT users.id as id_user
								, groups.id as id_group
								, users.name as user_name
								, groups.name as group_name
								, email
								, password
								, username
								, gender
								, no_telp
								, alamat
								, users.is_active
								FROM users JOIN groups on users.id_group = groups.id")->getResultArray();
    }
    
    public function get_user($id)
    {	
		return $this->db->query("SELECT * FROM users WHERE id ='".$id."'")->getRow();
    }
}
