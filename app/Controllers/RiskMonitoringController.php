<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;
use App\Models\RiskCauses;
use App\Models\RiskMitigations;
use App\Models\RiskMitigationDetails;
use App\Models\RiskMitigationDetailOutputs;
use App\Models\KPIs;

class RiskMonitoringController extends BaseController
{
    function __construct(){
        helper(['form', 'url', 'filesystem']);
        $this->RiskEventModel = new RiskEvents();
        $this->RiskMitigationModel = new RiskMitigations();
        $this->RiskMitigationDetailModel = new RiskMitigationDetails();
        $this->RiskMitigationDetailOutputModel = new RiskMitigationDetailOutputs();
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
            'risk_mitigation_data'=> $this->RiskMitigationDetailModel->get_mitigation_with_detail($id_detail_mitigation)
        ];
        echo view('admin/template/template',$data);
    }

    public function getOutputList($id){
        $data = $this->RiskMitigationDetailOutputModel->get_list_output($id);
		
		echo json_encode($data);
    }

    public function onAddDetailMonitoring(){
        helper(['form', 'url', 'filesystem']);
        $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');
       
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
        if($this->request->getFileMultiple('evidence')){
            foreach($this->request->getFileMultiple('evidence') as $file){
        
                // $fileName = $file->getName();
                
                // $file->move(FCPATH . 'uploads', $fileName);
                
                // $data_dokumen = [
                // 	'id_surat_dokumen' => $id_surat,
                // 	'dokumen_name' => $fileName,
                // ];
                
                
                //insert tabel dokumen
                // $simpan = $model->upload_dokumen_surat_eksternal($data_dokumen);
            }
        }
            
        
        // $data = [
        //     'title'=>'Risk Monitoring Detail',
        //     'content'=>'admin/pages/risk_monitoring/test',
        //     'flashdata' => 'errodsfr'
        
        // ];
        // echo view('admin/template/template',$data);
    }
}
