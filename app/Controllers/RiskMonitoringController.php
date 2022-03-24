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
        helper(['form', 'url', 'filesystem','download']);
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

    public function getRiskMonitoring($year){
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
            ->where('risk_events.year' , $year)
                ->orLike('risk_mitigation', $searchValue)
                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
                ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id', 'left')
                ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                ->select('risk_events.risk_event
                    , risk_mitigations.risk_mitigation
                    , risk_mitigation_details.id
                    , risk_mitigation_details.risk_mitigation_detail
                    , GROUP_CONCAT(divisions.name) as id_div
                    ')

                ->orLike('risk_events.risk_event', $searchValue)
                ->where('risk_events.year' , $year)
                ->groupBy('risk_mitigation_details.id')
                ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "risk_event"=>$record['risk_event'],
                "risk_mitigation"=>$record['risk_mitigation'],
                "risk_mitigation_detail"=>$record['risk_mitigation_detail'],
                "id_division"=>$record['id_div']
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

    public function getEvidenceList($month,$id){
        $data = $this->RiskMitigationDetailEvidenceModel->get_list_evidence_by_month($month,$id);
		
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
            
            //target monitoring
            $this->RiskMitigationDetailMonitoringModel->delete_by_detail_mitigation_id($id_detail_mitigation);
            
            $target = $this->request->getPost('target[]');
            $notes = $this->request->getPost('notes[]');
            $monitoring = $this->request->getPost('monitoring[]');

            for($i = 0; $i < count($target); $i++){
                
                $data=[
                    'id_detail_mitigation' => $id_detail_mitigation,
                    'target_month' => date("Y")."-".$target[$i]."-01",
                    'monitoring_month' => "0000-00-00",
                    'notes' => $notes[$i],
                ];

                $num_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
                if(!$num_data){
                    $this->RiskMitigationDetailMonitoringModel->insert($data);
                }               
            }

            //update monitoring month
            for($i = 0; $i < count($monitoring); $i++){
                $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$i]);
            }
            
            return redirect()->back()->with('state_message', 'success');

        }catch (\Exception $e) {
            return redirect()->back()->with('state_message', 'error');
        }
    }

    public function onUploadEvidence(){
        $id_detail_monitoring = $this->RiskMitigationDetailMonitoringModel->get_id_monitoring($this->request->getPost('month'),$this->request->getPost('id_detail_mitigation'));

        if($id_detail_monitoring){
            if($this->request->getFileMultiple('evidence')){
                $i = 1;
                foreach($this->request->getFileMultiple('evidence') as $file){
                    //$fileName = "evidence_".$i.".".$file->getClientExtension();
                    $fileName = $file->getName();
                    
                    $file->move(FCPATH . 'uploads', $fileName);
                    
                    $data_evidence = [
                        'id_detail_monitoring' => $id_detail_monitoring->id,
                        'filename' => $fileName,
                        'pathname' => FCPATH . 'uploads' ,
                    ];
                    
                    $this->RiskMitigationDetailEvidenceModel->insert($data_evidence);
                    $i++;
                }
            }
        }

        return redirect()->back()->with('state_message', 'file');

    }

    public function download($filename){
        return $this->response->download(FCPATH.'/uploads/'.$filename, null);
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

    public function onShowNotes($id, $month) {
		$data = $this->RiskMitigationDetailMonitoringModel->get_notes($id, $month);
		
		echo json_encode($data);
	}
}
