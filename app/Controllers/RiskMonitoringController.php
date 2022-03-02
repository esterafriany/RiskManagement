<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;
use App\Models\RiskCauses;
use App\Models\RiskMitigations;
use App\Models\RiskMitigationDetails;
use App\Models\RiskMitigationDetailMonitorings;
use App\Models\RiskMitigationDetailOutputs;
use App\Models\RiskMitigationDetailEvidences;
use App\Models\KPIs;

class RiskMonitoringController extends BaseController
{
    function __construct(){
        helper(['form', 'url', 'filesystem']);
        $this->RiskEventModel = new RiskEvents();
        $this->RiskMitigationModel = new RiskMitigations();
        $this->RiskMitigationDetailModel = new RiskMitigationDetails();
        $this->RiskMitigationDetailMonitoringModel = new RiskMitigationDetailMonitorings();
        $this->RiskMitigationDetailOutputModel = new RiskMitigationDetailOutputs();
        $this->RiskMitigationDetailEvidenceModel = new RiskMitigationDetailEvidences();
        $this->RiskCauseModel = new RiskCauses();
        $this->KPIModel = new KPIs();
 
    }

    public function index(){
        $data = [
            'title'=>'Risk Monitoring',
            'content'=>'admin/pages/risk_monitoring/index',
            'kpi_list'=> $this->KPIModel->get_list_kpis()
        ];
        echo view('admin/template/template',$data);
    }

    public function getRiskMonitoring(){
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
        $totalRecords = $this->RiskMitigationModel->select('id')
                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
        ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
        ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
        ->select('risk_events.risk_event
            , risk_mitigations.risk_mitigation
            , risk_mitigation_details.id
            , risk_mitigation_details.risk_mitigation_detail')
                ->orLike('risk_mitigation', $searchValue)
                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
            ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
            ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
            ->select('risk_events.risk_event
                , risk_mitigations.risk_mitigation
                , risk_mitigation_details.id
                , risk_mitigation_details.risk_mitigation_detail')
                ->orLike('risk_event', $searchValue)
                ->orLike('risk_mitigation', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);
        
        $records = $this->RiskEventModel
                ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
                ->select('risk_events.risk_event
                    , risk_mitigations.risk_mitigation
                    , risk_mitigation_details.id
                    , risk_mitigation_details.risk_mitigation_detail')
                ->orLike('risk_events.risk_event', $searchValue)
                ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "risk_event"=>$record['risk_event'],
                "risk_mitigation"=>$record['risk_mitigation'],
                "risk_mitigation_detail"=>$record['risk_mitigation_detail']
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

    public function getDetailRiskMonitoring($id_detail_mitigation){
        $data = [
            'title'=>'Risk Monitoring Detail',
            'content'=>'admin/pages/risk_monitoring/detail_risk_monitoring',
            'id_detail_mitigation' => $id_detail_mitigation,
            'risk_mitigation_data'=> $this->RiskMitigationDetailModel->get_mitigation_with_detail($id_detail_mitigation),
            'state_message' => ''
        ];
        echo view('admin/template/template',$data);
    }

    public function getOutputList($id){
        $data = $this->RiskMitigationDetailOutputModel->get_list_output($id);
		
		echo json_encode($data);
    }

    public function getEvidenceList($id){
        $data = $this->RiskMitigationDetailEvidenceModel->get_list_evidence($id);
		
		echo json_encode($data);
    }

    public function onAddDetailMonitoring(){
        helper(['form', 'url', 'filesystem']);
        $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');
        
        try{
            //output
            $outputs = $this->request->getPost('output');
            //delete current output
            $this->RiskMitigationDetailOutputModel->delete_by_detail_mitigation_id($id_detail_mitigation);
            // re-add
            foreach ($outputs as $key => $value){
                $data_output = [
                    'id_detail_mitigation' => $id_detail_mitigation,
                    'output' => $outputs[$key],
                ];
                $this->RiskMitigationDetailOutputModel->insert($data_output);
            }

            //evidence
            //delete from fcpath folder
            $evidences = $this->RiskMitigationDetailEvidenceModel->get_list_evidence($id_detail_mitigation);
            
           
            if($this->request->getFileMultiple('evidence')){
                $i = 1;
                foreach($this->request->getFileMultiple('evidence') as $file){
                    //$fileName = "evidence_".$i.".".$file->getClientExtension();
                    $fileName = $file->getName();
                    
                    $file->move(FCPATH . 'uploads', $fileName);
                    
                    $data_evidence = [
                        'id_detail_mitigation' => $id_detail_mitigation,
                        'filename' => $fileName,
                        'pathname' => FCPATH . 'uploads' ,
                    ];
                    
                    $this->RiskMitigationDetailEvidenceModel->insert($data_evidence);
                    $i++;
                }
            }
                
            $data = [
                'title'=>'Risk Monitoring Detail',
                'content'=>'admin/pages/risk_monitoring/detail_risk_monitoring',
                'id_detail_mitigation' => $id_detail_mitigation,
                'risk_mitigation_data'=> $this->RiskMitigationDetailModel->get_mitigation_with_detail($id_detail_mitigation),
                'state_message' => 'success'
            ];
            echo view('admin/template/template',$data);
        }catch (\Exception $e) {
            $data = [
                'title'=>'Risk Monitoring Detail',
                'content'=>'admin/pages/risk_monitoring/detail_risk_monitoring',
                'id_detail_mitigation' => $id_detail_mitigation,
                'risk_mitigation_data'=> $this->RiskMitigationDetailModel->get_mitigation_with_detail($id_detail_mitigation),
                'state_message' => 'error'
            ];
            echo view('admin/template/template',$data);     
        }
        
    }

    public function onDeleteEvidence($id){
        $filename = $this->RiskMitigationDetailEvidenceModel->find($id);
        
        unlink (FCPATH . 'uploads\\'.$filename['filename']);
        $this->RiskMitigationDetailEvidenceModel->delete($id);

        echo json_encode(array("status" => TRUE));
    }

    public function getDetailMonitoringMonths($id){
        $data = $this->RiskMitigationDetailMonitoringModel->get_list_monitoring_by_id_detail_mitigation($id);
		
		echo json_encode($data);
    }
}
