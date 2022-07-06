<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\KPIs;

class KPIController extends BaseController
{
    function __construct(){
      helper(['form', 'url']);
      $this->KPIModel = new KPIs();
    }

    public function index(){
		  $data = [
        'title'=>'KPI',
        'breadcrumb' => '<a href='.base_url().'>Home</a>
        <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        
        Master Data<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>KPI',
        'content'=>'admin/pages/kpi/index'
      ];
      echo view('admin/template/template',$data);
    }

    public function getKPI(){
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
        $totalRecords = $this->KPIModel->select('id')
                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->KPIModel->select('id')
                ->orLike('name', $searchValue)
                ->countAllResults();

        ## Fetch records
        $records = $this->KPIModel
                ->select('*')
                ->orLike('name', $searchValue)
                ->orLike('description', $searchValue)
                ->orLike('level', $searchValue)
                ->orderBy('level')
                ->findAll($rowperpage, $start);
                 
        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "name"=>$record['name'],
                "level"=>$record['level'],
                "description"=>$record['description'],
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

    public function onAddKPI(){
      if (! $this->validate([
        'name' => 'required',
        'description' => 'required',
        'level' => 'required',
        'year' => 'required',
        'is_active' => 'required',
      ])) {
        throw new \Exception("Some message goes here");
      }else{
        try {
          $data = [
              'name' => $this->request->getPost('name'),
              'description' => $this->request->getPost('description'),
              'level' => $this->request->getPost('level'),
              'year' => $this->request->getPost('year'),
              'is_active' => $this->request->getPost('is_active'),
              ];

          $this->KPIModel->insert($data);
            
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
      }
    }

  public function onDetailKPI($id) {
		$data = $this->KPIModel->get_kpi($id);
		
		echo json_encode($data);
	}

    public function onEditKpi($id){
      if (! $this->validate([
        'name' => 'required',
        'description' => 'required',
        'is_active' => 'required',
        'level' => 'required',
        'year' => 'required',
      ])) {
        throw new \Exception("Some message goes here");
      }else{
        try {
          $data = [
              'name' => $this->request->getPost('name'),
              'description' => $this->request->getPost('description'),
              'is_active' => $this->request->getPost('is_active'),
              'level' => $this->request->getPost('level'),
              'year' => $this->request->getPost('year'),
              ];
          $this->KPIModel->update($id, $data);
            
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
      }
    }

    public function onDeleteKPI($id){
		try {
			$this->KPIModel->delete($id);
			echo json_encode(array("status" => TRUE));
		}catch (\Exception $e) {
			
		}
    }
}
