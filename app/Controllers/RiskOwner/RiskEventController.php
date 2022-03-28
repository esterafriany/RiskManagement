<?php

namespace App\Controllers\RiskOwner;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;
use App\Models\RiskCauses;
use App\Models\RiskCategories;
use App\Models\RiskMitigations;
use App\Models\RiskEventCategories;
use App\Models\RiskMitigationDivisions;
use App\Models\KPIs;

class RiskEventController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
        $this->RiskMitigationModel = new RiskMitigations();
        $this->RiskCauseModel = new RiskCauses();
        $this->KPIModel = new KPIs();
        $this->RiskCategoryModel = new RiskCategories();
        $this->RiskEventCategoryModel = new RiskEventCategories();
        $this->RiskMitigationDivisionModel = new RiskMitigationDivisions();
 
    }
    
    public function index(){
        $data = [
            'title'=>'Risiko Utama',
            'content'=>'risk_owner/pages/risk_event/index'
          ];
          echo view('risk_owner/template/template',$data);
    }

    public function getRiskEvent($year){
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
        $totalRecords = $this->RiskEventModel->select('id')
                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel->select('id')
                ->orLike('risk_event', $searchValue)
                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                ->where('year' , $year)
                ->select('*')
                ->orLike('risk_event', $searchValue)
                ->orLike('is_active', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);

        $records = $this->RiskEventModel
                ->join('kpis', 'kpis.id = risk_events.id_kpi')
                ->select('risk_events.id as id, risk_events.objective, kpis.name as kpi_name, risk_number, risk_event, risk_events.is_active, risk_events.year')
                ->orLike('risk_events.risk_event', $searchValue)
                ->where('risk_events.year' , $year)
                ->findAll($rowperpage, $start);
                
        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "objective"=>$record['objective'],
                "kpi_name"=>$record['kpi_name'],
                "risk_number"=>$record['risk_number'],
                "risk_event"=>$record['risk_event'],
                "year"=>$record['year'],
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

    public function onAddRiskEvent(){
        try {
            $data = [
                    'id_kpi' => $this->request->getPost('id_kpi'),
                    'risk_number' => $this->request->getPost('risk_number'),
                    'objective' => $this->request->getPost('objective'),
                    'risk_event' => $this->request->getPost('risk_event'),
                    'year' => $this->request->getPost('year'),
                    'existing_control_1' => $this->request->getPost('existing_control_1'),
                    'existing_control_2' => $this->request->getPost('existing_control_2'),
                    'existing_control_3' => $this->request->getPost('existing_control_3'),
                    'probability_level' => $this->request->getPost('probability_level'),
                    'impact_level' => $this->request->getPost('impact_level'),
                    'final_level' => $this->request->getPost('final_level'),
                    ];

            $this->RiskEventModel->insert($data);
                
            echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
            
        }
    }

    public function onAddDetailRisk(){
        try {
           
            $risk_causes = json_decode($_POST['risk_cause']);
            $risk_event = json_decode($_POST['risk_event']);
            $id_risk_event = json_decode($_POST['id_risk_event']);
            $id_risk_owner = json_decode($_POST['risk_owner_id']);
            $risk_categories = json_decode($_POST['risk_category']);
            $risk_mitigation = json_decode($_POST['risk_mitigation']);
            
            

            //update risk event
            $this->RiskEventModel->update($id_risk_event,$risk_event);

            //risk cause
            $risk_cause_num = count($risk_causes);
            if($risk_cause_num > 0){
                //delete risk cause
                $this->RiskCauseModel->delete_by_id_risk($id_risk_event);
                 //re-add risk cause
                for($i = 0; $i < $risk_cause_num; $i++){
                    $data = [
                        'id_risk_event' => $id_risk_event,
                        'risk_cause' =>$risk_causes[$i],
                        'is_active' => "1",
                    ];
                    $this->RiskCauseModel->insert($data);
                }
            }
            
            //risk assignment
            $deleted_id_risk_mitigation = $this->RiskMitigationModel->get_deleted_risk_mitigation($id_risk_event);
  
            for($num = 0; $num < count($deleted_id_risk_mitigation); $num++){
                //delete risk mit division
                $this->RiskMitigationDivisionModel->delete_by_id_risk_mitigation($deleted_id_risk_mitigation[$num]['id']); 
            }
            //delete risk mit
            $this->RiskMitigationModel->delete_by_id_risk($id_risk_event);

            //re-add risk mit
            for($j = 0; $j < count($risk_mitigation); $j++){
             
                //add risk mitigation tabel get inserted id
                $data = [
                        'id_risk_event' => $id_risk_event,
                        'risk_mitigation' =>$risk_mitigation[$j],
                        'is_active' => "1",
                ];

                $inserted_id = $this->RiskMitigationModel->insert($data);
            
                //add risk assignment table using inserted id
                $data2 = [
                    'id_risk_mitigation' => $inserted_id,
                    'id_division' =>$id_risk_owner,
                    'is_active' => "1",
                ];
                $this->RiskMitigationDivisionModel->insert($data2);
                
            }
            

            //risk category
            $risk_category_num = count($risk_categories);
            if($risk_category_num > 0){
                //delete risk cause
                $this->RiskEventCategoryModel->delete_by_id_risk($id_risk_event);
                 //re-add risk cause
                for($k = 0; $k < $risk_category_num; $k++){
                    $data = [
                        'id_risk_event' => $id_risk_event,
                        'id_risk_category' =>$risk_categories[$k],
                        'is_active' => "1",
                    ];
                    $this->RiskEventCategoryModel->insert($data);
                }
            }

            
           
            echo json_encode(array("status" => TRUE));
            //echo json_encode(array("status" => $risk_event));
        }catch (\Exception $e) {
            
        }
    }

    public function getDetailRiskEvent($id) {
		$data = [
            'title'=>'Risk Events',
            'content'=>'risk_owner/pages/risk_event/edit',
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'risk_category_list'=> $this->RiskCategoryModel->get_list_risk_category(),
            'detail_risk_event' => $this->RiskEventModel->get_risk_event($id)
        ];
        echo view('risk_owner/template/template',$data);
	}
    
    public function onEditRiskEvent($id){
        if (! $this->validate([
            'id_kpi' => 'required',
                'risk_number' => 'required',
                'risk_event' => 'required',
                'year' => 'required',
                'is_active' => 'required',
        ])) {
            throw new \Exception("Some message goes here");
        }else{
            try {
                $data = [
                    'id_kpi' => $this->request->getPost('id_kpi'),
                    'risk_number' => $this->request->getPost('risk_number'),
                    'risk_event' => $this->request->getPost('risk_event'),
                    'year' => $this->request->getPost('year'),
                    'is_active' => $this->request->getPost('is_active'),
                    ];
                $this->RiskEventModel->update($id, $data);
                    
                echo json_encode(array("status" => TRUE));
            }catch (\Exception $e) {
                
            }
        }
    }

    public function onDeleteRiskEvent($id){
        try {
          $this->RiskEventModel->delete($id);
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
    }
}
