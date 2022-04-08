<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\Users;
use App\Models\Groups;
use App\Models\Divisions;

class UserController extends BaseController
{
	function __construct(){
		helper(['form', 'url']);
		$this->GroupModel = new Groups();
		$this->UserModel = new Users();
		$this->DivisionModel = new Divisions();
	}
	
	public function index(){
		echo view('admin/template/template');
	}
	
	public function group_list(){
		$data = [
            'title'=>'title here',
            'content'=>'admin/pages/group/index'
        ];
        echo view('admin/template/template',$data);
	}
	
	public function getGroup(){

        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();
 
        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value
 
        ## Total number of records without filtering
		
        $totalRecords = $this->GroupModel->select('id')
                 ->countAllResults();
 
        ## Total number of records with filtering
        $totalRecordwithFilter = $this->GroupModel->select('id')
                 ->orLike('name', $searchValue)
                 ->countAllResults();
  
        ## Fetch records
        $records = $this->GroupModel
				 ->select('*')
                 ->orLike('name', $searchValue)
                 ->orLike('is_active', $searchValue)
                 ->orderBy($columnName,$columnSortOrder)
                 ->findAll($rowperpage, $start);
				 
		
					 
		$data = array();
 
        foreach($records as $record ){
 
           $data[] = array( 
              "id"=>$record['id'],
              "name"=>$record['name'],
              "is_active"=>$record['is_active']
           ); 
        }
        
        ## Response
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordwithFilter,
           "aaData" => $data,
           "token" => csrf_hash() // New token hash
        );
		return $this->response->setJSON($response);
	}
	
	public function onDetailGroup($id) {
		$data = $this->GroupModel->get_group($id);
		
		echo json_encode($data);
	}
	
	public function onAddGroup(){
		if (! $this->validate([
			'name' => 'required',
			'is_active' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'is_root' => $this->request->getPost('is_root'),
						'is_active' => $this->request->getPost('is_active'),
						];
				$this->GroupModel->insert($data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}
  }
	
	public function onEditGroup($id){
		if (! $this->validate([
			'name' => 'required',
			'is_active' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'is_root' => $this->request->getPost('is_root'),
						'is_active' => $this->request->getPost('is_active'),
						];
				$this->GroupModel->update($id, $data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}

  }
	
	public function onDeleteGroup($id){
		try {
			$this->GroupModel->delete($id);
				
			echo json_encode(array("status" => TRUE));
		}catch (\Exception $e) {
			
		}
  }
	
	public function user_list() {

		$data = [
            'title'=>'title here',
            'content'=>'admin/pages/user/index',
            'group_list'=> $this->GroupModel->get_list_groups(),
            'division_list'=> $this->DivisionModel->get_list_divisions()
        ];
        echo view('admin/template/template',$data);
    }
	
	public function getUsers(){

        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();
 
        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value
 
        ## Total number of records without filtering
		
        $totalRecords = $this->UserModel->select('id')
                 ->countAllResults();
 
        ## Total number of records with filtering
        $totalRecordwithFilter = $this->UserModel->select('id')
                 ->orLike('name', $searchValue)
                 ->orLike('email', $searchValue)
                 ->orLike('password', $searchValue)
                 ->orLike('is_active', $searchValue)
                 ->countAllResults();
  
        ## Fetch records
        $records = $this->UserModel
				->join('groups', 'groups.id = users.id_group')
				->join('divisions', 'divisions.id = users.id_division')
				->select('users.id as id, users.name as user_name, groups.name as group_name, users.is_active, email')
                 ->orLike('users.name', $searchValue)
				 ->orLike('email', $searchValue)
                 ->orLike('users.is_active', $searchValue)
                 //->orderBy($columnName,$columnSortOrder)
                 ->findAll($rowperpage, $start);
	 
		$data = array();
 
        foreach($records as $record ){
 
           $data[] = array( 
              "id"=>$record['id'],
              "user_name"=>$record['user_name'],
              "group_name"=>$record['group_name'],
              "email"=>$record['email'],
              "is_active"=>$record['is_active']
           ); 
        }
        
        ## Response
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordwithFilter,
           "aaData" => $data,
           "token" => csrf_hash() // New token hash
        );
       return $this->response->setJSON($response);
    }

    public function onAddUser(){
		if (! $this->validate([
			'name' => 'required',
			'is_active' => 'required',
			'email' => 'required',
			'password' => 'required',
			'id_group' => 'required',
		])) {
			throw new \Exception("Error lohh ini :(");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'email' => $this->request->getPost('email'),
						'password' => md5($this->request->getPost('password')),
						'id_group' => $this->request->getPost('id_group'),
						'is_active' => $this->request->getPost('is_active'),
						];
				$this->UserModel->insert($data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}
    }

  public function onDetailUser($id) {
		$data = $this->UserModel->get_user($id);
		
		echo json_encode($data);
	}

    public function onEditUser($id){
		if (! $this->validate([
			'name' => 'required',
			'is_active' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'email' => $this->request->getPost('email'),
						'password' => md5($this->request->getPost('password')),
						'id_group' => $this->request->getPost('id_group'),
						'is_active' => $this->request->getPost('is_active'),
						];
				$this->UserModel->update($id, $data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}

    }

    public function onDeleteUser($id){
      try {
        $this->UserModel->delete($id);
          
        echo json_encode(array("status" => TRUE));
      }catch (\Exception $e) {
        
      }
    }
	
    public function division_list(){
      $data = [
              'title'=>'title here',
              'content'=>'admin/pages/division/index'
          ];
          echo view('admin/template/template',$data);
    }

    public function getDivision(){
      $request = service('request');
      $postData = $request->getPost();
      $dtpostData = $postData['data'];
      $response = array();
 
      ## Read value
      $draw = $dtpostData['draw'];
      $start = $dtpostData['start'];
      $rowperpage = $dtpostData['length']; // Rows display per page
      $columnIndex = $dtpostData['order'][0]['column']; // Column index
      $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
      $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
      $searchValue = $dtpostData['search']['value']; // Search value
 
      ## Total number of records without filtering
      $totalRecords = $this->DivisionModel->select('id')->countAllResults();
 
      ## Total number of records with filtering
      $totalRecordwithFilter = $this->DivisionModel->select('id')
                ->orLike('name', $searchValue)
                ->orLike('is_active', $searchValue)
                ->countAllResults();
  
      ## Fetch records
      $records = $this->DivisionModel
              ->select('*')
              ->orLike('name', $searchValue)
              ->orLike('is_active', $searchValue)
              ->orderBy($columnName,$columnSortOrder)
              ->findAll($rowperpage, $start);

		$data = array();
 
    foreach($records as $record ){
        $data[] = array( 
          "id"=>$record['id'],
          "name"=>$record['name'],
          "division_code"=>$record['division_code'],
          "is_active"=>$record['is_active']
        ); 
    }
        
    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data,
        "token" => csrf_hash() // New token hash
    );
    
    return $this->response->setJSON($response);

  }
    
    public function onAddDivision(){
      if (! $this->validate([
        'name' => 'required',
        'division_code' => 'required',
        'is_active' => 'required',
      ])) {
        throw new \Exception("Some message goes here");
      }else{
        try {
          $data = [
              'name' => $this->request->getPost('name'),
              'division_code' => $this->request->getPost('division_code'),
              'is_active' => $this->request->getPost('is_active'),
              ];
          $this->DivisionModel->insert($data);
            
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
      }
    }

    public function onDetailDivision($id) {
      $data = $this->DivisionModel->get_division($id);
      
      echo json_encode($data);
    }

    public function onDeleteDivision($id){
      try {
        $this->DivisionModel->delete($id);
          
        echo json_encode(array("status" => TRUE));
      }catch (\Exception $e) {
        
      }
    }

    public function onEditDivision($id){
      if (! $this->validate([
        'name' => 'required',
        'division_code' => 'required',
        'is_active' => 'required',
      ])) {
        throw new \Exception("Some message goes here");
      }else{
        try {
          $data = [
              'name' => $this->request->getPost('name'),
              'division_code' => $this->request->getPost('is_root'),
              'is_active' => $this->request->getPost('is_active'),
              ];
          $this->DivisionModel->update($id, $data);
            
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
      }
  
    }

    public function getListDivision(){
        
      $data = $this->DivisionModel->get_list_division();

      echo json_encode($data);
  }
    
	
}
