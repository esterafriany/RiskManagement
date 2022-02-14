<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;
use App\Models\RiskCauses;
use App\Models\RiskMitigations;
use App\Models\KPIs;

class RiskEventController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
        $this->RiskMitigationModel = new RiskMitigations();
        $this->RiskCauseModel = new RiskCauses();
        $this->KPIModel = new KPIs();
    }
    
    public function index(){
        $data = [
            'title'=>'Risk Events',
            'content'=>'admin/pages/risk_event/index',
            'kpi_list'=> $this->KPIModel->get_list_kpis()
        ];
        echo view('admin/template/template',$data);
    }

    public function getRiskEvent(){
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
                ->select('*')
                ->orLike('risk_event', $searchValue)
                ->orLike('is_active', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);

        $records = $this->RiskEventModel
                ->join('kpis', 'kpis.id = risk_events.id_kpi')
                ->select('risk_events.id as id, kpis.name as kpi_name, risk_number, risk_event, risk_events.is_active, risk_events.year')
                ->orLike('risk_events.risk_event', $searchValue)
                //->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);
                
        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
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

                $this->RiskEventModel->insert($data);
                    
                echo json_encode(array("status" => TRUE));
            }catch (\Exception $e) {
                
            }
        }
    }

    public function onAddDetailRisk(){
        try {
           
            $risk_causes = json_decode($_POST['risk_cause']);
            $id_risk_event = json_decode($_POST['id_risk_event']);
            $risk_mitigations = json_decode($_POST['risk_mitigation']);

            
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
            
            $risk_mitigation_num = count($risk_mitigations);
            if($risk_mitigation_num > 0){
                //delete risk mit
                //$this->RiskMitigationModel->delete_by_id_risk($id_risk_event);
                //re-add risk mit
                for($j = 0; $j < $risk_mitigation_num; $j++){
                    $data = [
                        'id_risk_event' => $id_risk_event,
                        'risk_mitigation' =>$risk_mitigations[$j],
                        'is_active' => "1",
                    ];
                    $this->RiskMitigationModel->insert($data);
                }
            }
           
            echo json_encode(array("status" => TRUE));
            //echo json_encode(array("status" => $risk_cause_num));
        }catch (\Exception $e) {
            
        }
    }

    public function getDetailRiskEvent($id) {
		$data = [
            'title'=>'Risk Events',
            'content'=>'admin/pages/risk_event/edit',
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'detail_risk_event' => $this->RiskEventModel->get_risk_event($id)
        ];
        echo view('admin/template/template',$data);
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
