<?php

namespace App\Controllers\RiskOwner;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskMitigations;
use App\Models\RiskMitigationDetails;
use App\Models\RiskEvents;
use App\Models\Divisions;
use App\Models\RiskMitigationDivisions;
use App\Models\RiskMitigationDetailMonitorings;
use App\Models\RiskMitigationDetailOutputs;

use App\Models\RiskCauses;
use App\Models\KPIs;


class RiskMitigationController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskMitigationModel = new RiskMitigations();
        $this->RiskMitigationDetailModel = new RiskMitigationDetails();
        $this->DivisionModel = new Divisions();
        $this->RiskMitigationDivisionModel = new RiskMitigationDivisions();
        $this->RiskEventModel = new RiskEvents();
        $this->RiskCauseModel = new RiskCauses();
        $this->KPIModel = new KPIs();
        $this->RiskMitigationDetailMonitoring = new RiskMitigationDetailMonitorings();
        $this->RiskMitigationDetailOutput = new RiskMitigationDetailOutputs();
        
    }

    public function index()
    {
        $data = [
            'title'=>'Risk Mitigations',
            'breadcrumb'=>
                '<a href='.base_url().'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Risk Mitigations',
            'content'=>'risk_owner/pages/risk_mitigation/index'
        ];
        echo view('risk_owner/template/template',$data);
    }

    public function getRiskMitigationList($id_risk)
    {
        $data = [
            'risk_mitigation_list'=> $this->RiskMitigationModel->get_list_risk_mitigation($id_risk),
            'risk_division_list'=> $this->DivisionModel->get_list_divisions()
        ];
		
		echo json_encode($data);
    }

    public function getRiskMitigationListRiskOwner($id_risk, $id_risk_owner)
    {
        $data = [
            'risk_mitigation_list'=> $this->RiskMitigationModel->get_list_risk_mitigation_by_risk_owner($id_risk, $id_risk_owner),
            'risk_division_list'=> $this->DivisionModel->get_list_divisions()
        ];
		
		echo json_encode($data);
    }

    public function getRiskMitigationDivision($id_risk_mitigation){
        
        $data = $this->RiskMitigationDivisionModel->get_risk_division_by_risk_mitigation_id($id_risk_mitigation);

        echo json_encode($data);
    }

    public function getRiskMitigation($year){
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
        $totalRecords = $this->RiskEventModel
                        ->join('kpis', 'kpis.id = risk_events.id_kpi')
                        ->where('risk_events.year' , $year)
                        ->select('risk_events.id as id, kpis.name as kpi_name, risk_number, risk_event, risk_events.is_active')
                        ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
                        ->join('kpis', 'kpis.id = risk_events.id_kpi')
                        ->where('risk_events.year' , $year)
                        ->select('risk_events.id as id, kpis.name as kpi_name, risk_number, risk_event, risk_events.is_active')
                        ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                ->join('kpis', 'kpis.id = risk_events.id_kpi')
                ->where('risk_events.year' , $year)
                ->select('risk_events.id as id, kpis.name as kpi_name, risk_number, risk_number_residual, risk_event, risk_events.is_active')
                ->orderBy('risk_events.risk_number_manual')
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);
                
        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "kpi_name"=>$record['kpi_name'],
                "risk_number"=>$record['risk_number'],
                "risk_number_residual"=>$record['risk_number_residual'],
                "risk_event"=>$record['risk_event'],
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

    public function getDetailRiskMitigations($id) {
		$data = [
            'title'=>'Detail Risk Mitigation',
            'breadcrumb'=>
                '<a href='.base_url().'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <a href='.base_url('risk_owner/get-risk-mitigations').'>Risk Mitigations</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Detail Risk Mitigations',
            'content'=>'risk_owner/pages/risk_mitigation/edit',
            'detail_risk_event'=> $this->RiskEventModel->get_risk_event($id),
            'risk_cause'=> $this->RiskCauseModel->get_list_risk_cause($id),
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'risk_mitigation' => $this->RiskMitigationModel->get_list_risk_mitigation($id)
        ];
        echo view('risk_owner/template/template',$data);
	}

    public function getDetailRiskMitigation($id) {
		$data = [
            'title'=>'Detail Mitigation',
            'breadcrumb'=>
                '<a href='.base_url().'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <a href='.base_url('risk_owner/get-risk-mitigations').'>Risk Mitigations</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Detail Risk Mitigations',
            'content'=>'risk_owner/pages/risk_mitigation/detail_risk_mitigation',
            'risk_mitigation' => $this->RiskMitigationModel->get_risk_mitigation($id),
            'id_risk_mitigation' => $id, 
        ];
        echo view('risk_owner/template/template',$data);
	}
    
    public function onDetailMitigation($id) {
		$data = $this->RiskMitigationDetailModel->get_detail_mitigation($id);
		
		echo json_encode($data);
	}

    public function getDetailMitigation($id_risk_mitigation){
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
        $totalRecords = $this->RiskMitigationDetailModel
        ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
        ->select('risk_mitigation_details.id, id_risk_mitigation, risk_mitigation_detail, id_division, divisions.name, division_code, risk_mitigation_details.is_active')
        ->orLike('risk_mitigation_detail', $searchValue)
        ->orderBy($columnName,$columnSortOrder)
        ->where('id_risk_mitigation' , $id_risk_mitigation)
                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskMitigationDetailModel
                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                ->select('risk_mitigation_details.id, id_risk_mitigation, risk_mitigation_detail, id_division, divisions.name, division_code, risk_mitigation_details.is_active')
                ->orLike('risk_mitigation_detail', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->where('id_risk_mitigation' , $id_risk_mitigation)
                ->countAllResults();

        ## Fetch records
        $records = $this->RiskMitigationDetailModel
                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                ->select('risk_mitigation_details.id, id_risk_mitigation, risk_mitigation_detail, id_division, divisions.name, division_code, risk_mitigation_details.is_active')
                ->orLike('divisions.name', $searchValue)
                ->orderBy('risk_mitigation_details.id', 'asc')
                ->orderBy($columnName,$columnSortOrder)
                ->where('id_risk_mitigation' , $id_risk_mitigation)
                ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "name"=>$record['name'],
                "id_division"=>$record['id_division'],
                "risk_mitigation_detail"=>$record['risk_mitigation_detail'],
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

    public function onAddDetailRisk(){
        try {
            $risk_causes = json_decode($_POST['risk_cause']);
            $id_risk_event = json_decode($_POST['id_risk_event']);
            $risk_mitigation = json_decode($_POST['risk_mitigation']);
            $risk_event = json_decode($_POST['risk_event']);
            $id_division = json_decode($_POST['id_division']);

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
            
            //risk mitigation
            $not_deleted_id_array = array();
            for($j = 0; $j < count($risk_mitigation); $j++){
                $arr = explode("#",$risk_mitigation[$j]);
                    
                if($arr[1]){
                    array_push($not_deleted_id_array,$arr[2]);  
                
                    $id = $this->RiskMitigationModel->where('id' , $arr[2])->select('*')->first();
                    if(count($id) !=0){
                        //do update
                        $risk_mitigation_name = $arr[0];
                        $data = [
                            'id_risk_event' => $id_risk_event,
                            'risk_mitigation' =>$risk_mitigation_name,
                            'is_active' => "1",
                        ];
                        $this->RiskMitigationModel->update($arr[2],$data);
                    }
                }else{
                    //do insert
                    $risk_mitigation_name = $arr[0];
                    $data = [
                        'id_risk_event' => $id_risk_event,
                        'risk_mitigation' =>$risk_mitigation_name,
                        'is_active' => "1",
                    ];
                    $inserted_id = $this->RiskMitigationModel->insert($data);
                    array_push($not_deleted_id_array, $inserted_id);

                    //insert to mitigation division
                    $data2 = [
                        'id_risk_mitigation' => $inserted_id,
                        'id_division' => $id_division,
                        'is_active' => "1",
                    ];
                    $this->RiskMitigationDivisionModel->insert($data2);
                }
            }

            //delete not in
            $not_deleted_id= implode(",",$not_deleted_id_array);;
            $this->RiskMitigationModel->delete_not_in($not_deleted_id, $id_risk_event);
            
            echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
            
        }
    }

    public function onAddDetailMitigation(){
		if (! $this->validate([
			'risk_mitigation_detail' => 'required',
			'id_risk_mitigation' => 'required',
		])) {
			throw new \Exception("Some message goes here");
		}else{
			try {
				$data = [
						'risk_mitigation_detail' => $this->request->getPost('risk_mitigation_detail'),
						'id_division' => session()->get('id_division'),
						'id_risk_mitigation' => $this->request->getPost('id_risk_mitigation'),
				];
                

				$this->RiskMitigationDetailModel->insert($data);
					
				echo json_encode(array("status" => session()->get('id_division')));
			}catch (\Exception $e) {
				
			}
		}
    }

    public function onEditDetailMitigation($id){
       
        try {
            $data = [
                'risk_mitigation_detail' => $this->request->getPost('risk_mitigation_detail'),
                'id_division' => session()->get('id_division'),
                ];
            $this->RiskMitigationDetailModel->update($id, $data);
              
            echo json_encode(array("status" => TRUE));
          }catch (\Exception $e) {
            
          }
    }

    public function onDeleteDetailMitigation($id){
        try {
            // monitoring. outputs delete
            $this->RiskMitigationDetailMonitoring->delete_evidence_by_id_monitoring($id);
            $this->RiskMitigationDetailMonitoring->delete_by_detail_mitigation_id($id);
            $this->RiskMitigationDetailOutput->delete_by_detail_mitigation_id($id);
            $this->RiskMitigationDetailModel->delete($id);

            echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
    }
}
