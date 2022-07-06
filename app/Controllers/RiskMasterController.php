<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskCategories;

class RiskMasterController extends BaseController
{
  function __construct(){
    helper(['form', 'url']);
    $this->RiskCategoriesModel = new RiskCategories();
  }

  public function index(){
    $data = [
      'title'=>'Risk Category',
      'breadcrumb' => '
      <a href='.base_url().'>Home</a>
      <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      Master Data<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      Risk Category',
      'content'=>'admin/pages/risk_category/index'
    ];
    echo view('admin/template/template',$data);
  }

  public function getRiskCategory()
  {
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
    $totalRecords = $this->RiskCategoriesModel->select('id')
            ->countAllResults();

    ## Total number of records with filtering
    $totalRecordwithFilter = $this->RiskCategoriesModel->select('id')
            ->orLike('name', $searchValue)
            ->countAllResults();

    ## Fetch records
    $records = $this->RiskCategoriesModel
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

  public function onAddRiskCategory(){
		if (! $this->validate([
			'name' => 'required',
			'description' => 'required',
			'is_active' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'description' => $this->request->getPost('description'),
						'is_active' => $this->request->getPost('is_active'),
						];

				$this->RiskCategoriesModel->insert($data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}
  }

  public function onDetailRiskCategory($id) {
		$data = $this->RiskCategoriesModel->get_risk_category($id);
		
		echo json_encode($data);
	}

  public function onEditRiskCategory($id){
		if (! $this->validate([
			'name' => 'required',
			'description' => 'required',
			'is_active' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'name' => $this->request->getPost('name'),
						'description' => $this->request->getPost('description'),
						'is_active' => $this->request->getPost('is_active'),
						];
				$this->RiskCategoriesModel->update($id, $data);
					
				echo json_encode(array("status" => TRUE));
			}catch (\Exception $e) {
				
			}
		}
  }

  public function onDeleteRiskCategory($id){
      try {
        $this->RiskCategoriesModel->delete($id);
        echo json_encode(array("status" => TRUE));
      }catch (\Exception $e) {
        
      }
  }
}
