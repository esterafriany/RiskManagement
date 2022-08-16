<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
            'breadcrumb' => '<a href='.base_url().'>Home</a>  
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Risk Monitoring',
            'content'=>'admin/pages/risk_monitoring/index',
            'kpi_list'=> $this->KPIModel->get_list_kpis()
        ];
        echo view('admin/template/template',$data);
    }

    public function excel($year){
        $data = [
            'title'=>'Risk Monitoring',
            'breadcrumb' => '<a href='.base_url().'>Home</a>  
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Risk Monitoring',
            'content'=>'admin/pages/risk_monitoring/index',
            'kpi_list'=> $this->RiskEventModel->get_data_report($year)
        ];
        echo view('admin/pages/index',$data);
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
        $totalRecords = $this->RiskEventModel
                                ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                                ->select('risk_events.risk_event
                                    , risk_events.id as id_risk_event
                                    , risk_mitigations.id as id_risk_mitigation
                                    , risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , divisions.name as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('divisions.name', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->where('risk_events.year' , $year)
                                //->groupBy('risk_mitigation_details.risk_mitigation_detail')
                                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
                                ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                                ->select('risk_events.risk_event
                                    , risk_events.id as id_risk_event
                                    , risk_mitigations.id as id_risk_mitigation
                                    , risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , divisions.name as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->orLike('divisions.name', $searchValue)
                                ->where('risk_events.year' , $year)
                                //->groupBy('risk_mitigation_details.risk_mitigation_detail')
                                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                    ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                    ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                    ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                    ->select('risk_events.risk_event
                        , risk_events.id as id_risk_event
                        , risk_mitigations.id as id_risk_mitigation
                        , risk_mitigation
                        , risk_mitigation_details.id
                        , risk_mitigation_details.risk_mitigation_detail
                        , divisions.name as division_name
                        , progress_percentage')
                    ->orLike('risk_events.risk_event', $searchValue)
                    ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                    ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                    ->orLike('divisions.name', $searchValue)
                    ->where('risk_events.year' , $year)
                    //->groupBy('risk_mitigation_details.risk_mitigation_detail, id_risk_mitigation')
                    ->orderBy($columnName,$columnSortOrder)
                    ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "risk_event"=>$record['risk_event'],
                "id_risk_event"=>$record['id_risk_event'],
                "id_risk_mitigation"=>$record['id_risk_mitigation'],
                "risk_mitigation"=>$record['risk_mitigation'],
                "risk_mitigation_detail"=>$record['risk_mitigation_detail'],
                "division_name"=>$record['division_name'],
                "progress_percentage"=>$record['progress_percentage'],
                
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

    public function getRiskMonitoringByRiskOwner($year){
        
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
                                ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                                ->select('risk_events.risk_event
                                    , risk_events.id as id_risk_event
                                    , risk_mitigations.id as id_risk_mitigation
                                    , risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , divisions.name as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->orLike('divisions.name', $searchValue)
                                ->where('risk_events.year' , $year)
                                //->groupBy('risk_mitigation_details.risk_mitigation_detail')
                                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
                                ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                                ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                                ->select('risk_events.risk_event
                                    , risk_events.id as id_risk_event
                                    , risk_mitigations.id as id_risk_mitigation
                                    , risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , divisions.name as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('divisions.name', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->where('risk_events.year' , $year)
                                //->groupBy('risk_mitigation_details.risk_mitigation_detail')
                                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                    ->join('risk_mitigations', 'risk_events.id = risk_mitigations.id_risk_event')
                    ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                    ->join('divisions', 'divisions.id = risk_mitigation_details.id_division')
                    ->select('risk_events.risk_event
                        , risk_events.id as id_risk_event
                        , risk_mitigations.id as id_risk_mitigation
                        , risk_mitigation
                        , risk_mitigation_details.id
                        , risk_mitigation_details.risk_mitigation_detail
                        , divisions.name as division_name
                        , progress_percentage')
                    ->orLike('risk_events.risk_event', $searchValue)
                    ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                    ->orLike('divisions.name', $searchValue)
                    ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                    ->where('risk_events.year' , $year)
                    //->groupBy('risk_mitigation_details.risk_mitigation_detail')
                    ->orderBy($columnName,$columnSortOrder)
                    ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "risk_event"=>$record['risk_event'],
                "id_risk_event"=>$record['id_risk_event'],
                "id_risk_mitigation"=>$record['id_risk_mitigation'],
                "risk_mitigation"=>$record['risk_mitigation'],
                "risk_mitigation_detail"=>$record['risk_mitigation_detail'],
                "division_name"=>$record['division_name'],
                "progress_percentage"=>$record['progress_percentage'],
                
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

    public function getDetailRiskMonitoring($id_detail_mitigation, $id_risk_mit, $id_risk_event){
        $data = [
            'title'=>'Risk Monitoring Detail',
            'breadcrumb' => 
            '<a href='.base_url().'>Home</a>  
                <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <a href='.base_url('admin/risk-mitigation').'>Risk Mitigation</a>
                <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <a href='.base_url('admin/detail-risk-mitigations').'/'.$id_detail_mitigation.'>Detail Risk Mitigation</a> 
                <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <a href='.base_url('admin/detail-risk-mitigation').'/'.$id_risk_mit.'/'.$id_risk_event.'>Detail Mitigation</a> 
                <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Monitoring Mitigasi Risiko',
            
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

    public function getEvidenceStatus($id_detail_mitigation){
        $data = [
            'evidence_status'=>$this->RiskMitigationDetailEvidenceModel->get_evidence_status($id_detail_mitigation),
            'monitoring_data'=> $this->RiskMitigationDetailEvidenceModel->get_data_monitoring($id_detail_mitigation)
        ];

		echo json_encode($data);
    }

    public function getEvidenceList($month,$id){
        $data = $this->RiskMitigationDetailEvidenceModel->get_list_evidence_by_month($month,$id);
		
		echo json_encode($data);
    }

    public function onAddDetailMonitoring(){
        helper(['form', 'url', 'filesystem']);
        $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');
        $arr_id_monitoring = array();

        if($this->request->getPost('btn-add-monitoring') == 'final_add'){
            try{
                //update progress_percentage
                $percentage['progress_percentage']=$this->request->getPost('progress_percentage');
                $this->RiskMitigationDetailModel->update($id_detail_mitigation, $percentage);

                //update output
                $outputs = $this->request->getPost('output');
                //delete current output
                $this->RiskMitigationDetailOutputModel->delete_by_detail_mitigation_id($id_detail_mitigation);
                
                // re-add
                foreach ($outputs as $key => $value){
                    $data_output = [
                        'id_detail_mitigation' => $id_detail_mitigation,
                        'output' => $outputs[$key],
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ];
                    $this->RiskMitigationDetailOutputModel->insert($data_output);
                }
            
                $target = $this->request->getPost('target[]');
                $notes = $this->request->getPost('notes[]');
                
                $arr_existing = array();
                $arr_checked = array();
                
                //existing target
                $get_existing_target = $this->RiskMitigationDetailMonitoringModel->get_list_monitoring_by_id_detail_mitigation($id_detail_mitigation);
                
                foreach($get_existing_target as $k=>$v) {
                    $tm = substr($v['target_month'], 5, -3);
                    array_push($arr_existing, $tm);
                }

                //update target month
                if($target){
                    for($i = 0; $i < count($target); $i++){
                        array_push($arr_checked,$target[$i]);  
                
                        $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
                        if($existing_data){
                            //update existing data
                            $data = [
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => date("Y")."-".$target[$i]."-01",
                                'notes' => $notes[$i+1],
                                'updated_at' => date('Y-m-d h:i:s'),    
                                
                            ];
                            $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
                        }else{
                            //check if new added or update based on monitoring
                            $monitoring_datas = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_monitoring($id_detail_mitigation, $target[$i]);

                            if($monitoring_datas){
                                //update data
                                $data=[
                                    'id_detail_mitigation' => $id_detail_mitigation,
                                    'target_month' => date("Y")."-".$target[$i]."-01",
                                    'updated_at' => date('Y-m-d h:i:s'),
                                    //'notes' => $notes[$i+1],
                                ];
                                $this->RiskMitigationDetailMonitoringModel->update($monitoring_datas->id,$data);
                            }else{
                                //insert new data
                                $data=[
                                    'id_detail_mitigation' => $id_detail_mitigation,
                                    'target_month' => date("Y")."-".$target[$i]."-01",
                                    'monitoring_month' => "0000-00-00",
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'updated_at' => date('Y-m-d h:i:s'),
                                    //'notes' => $notes[$i+1],
                                ];
                                
                                $inserted_id = $this->RiskMitigationDetailMonitoringModel->insert($data);
                                
                            }
                        }         
                    }
                }

                //delete not relevan target month
                //looping existing array  
                $arr_deleted = array();       
                for($i = 0 ; $i < count($arr_existing); $i++){
                    if (!in_array($arr_existing[$i], $arr_checked)){
                        array_push($arr_deleted,$arr_existing[$i]);
                    }
                }
                for($i = 0 ; $i < count($arr_deleted); $i++){
                    //update to 0000-00-00 where id_detail_mitigation and target_month
                    $a = $this->RiskMitigationDetailMonitoringModel->update_data_target_2($id_detail_mitigation, $arr_deleted[$i]);
                
                }

                $arr_checked_monitoring = array();
                //update monitoring month
                $monitoring = $this->request->getPost('monitoring[]');
                
                if($monitoring){

                    for($j = 0; $j < count($monitoring); $j++){
                        
                        array_push($arr_checked_monitoring,$monitoring[$j]);  
                        //get data with target month = monitoring month
                        $target_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_monitoring($id_detail_mitigation, $monitoring[$j]);
                        
                    //update
                        if($target_data){
                            
                            $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
                            array_push($arr_id_monitoring,$target_data->id);
                        }else{
                            $monitoring_data = $this->RiskMitigationDetailMonitoringModel
                            ->where('id_detail_mitigation', $id_detail_mitigation)
                            ->where('target_month', date("Y")."-".$monitoring[$j]."-01")->findAll();
                            
                            if($monitoring_data){
                                
                                //update
                                $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
                                
                            }else{
                                //add new row with target == null
                                $data=[
                                    'id_detail_mitigation' => $id_detail_mitigation,
                                    'target_month' => "0000-00-00",
                                    'monitoring_month' => date("Y")."-".$monitoring[$j]."-01",
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'updated_at' => date('Y-m-d h:i:s'),
                                ];
                                $inserted_id = $this->RiskMitigationDetailMonitoringModel->insert($data); 
                            
                            } 
                        }
                    }
                }

                $arr_existing_monitoring = array();
                foreach($get_existing_target as $k=>$v) {
                    $mm = substr($v['monitoring_month'], 5, -3);
                    if($mm != "00"){
                        array_push($arr_existing_monitoring, $mm);
                    }
                }

                //delete not relevan monitoring month
                //looping existing array  
                $arr_deleted_monitoring = array();       
                for($i = 0 ; $i < count($arr_existing_monitoring); $i++){
                    if (!in_array($arr_existing_monitoring[$i], $arr_checked_monitoring)){
                        array_push($arr_deleted_monitoring,$arr_existing_monitoring[$i]);
                    }
                }
                
                for($i = 0 ; $i < count($arr_deleted_monitoring); $i++){
                    //update to 0000-00-00 where id_detail_mitigation and target_month
                    $this->RiskMitigationDetailMonitoringModel->update_data_monitoring_2($id_detail_mitigation, $arr_deleted_monitoring[$i]);
                }

                //check mandatory evidence
                for($i = 0 ; $i < count($arr_id_monitoring); $i++){
                    $evidence_data = $this->RiskMitigationDetailEvidenceModel->select('*')
                                    ->where('id_detail_monitoring', $arr_id_monitoring[$i])->countAllResults();
                    if($evidence_data == 0){
                        return redirect()->back()->with('state_message', 'error');
                    }
                }
                if($target){
                    for($i = 0; $i < count($target); $i++){
                        $data=[
                            'id_detail_mitigation' => $id_detail_mitigation,
                            'target_month' => date("Y")."-".$target[$i]."-01",
                            'monitoring_month' => "0000-00-00",
                            'updated_at' => date('Y-m-d h:i:s'),
                            //'notes' => $notes[$i+1],
                        ];

                        $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
                        //dd($not_deleted->t_month == (int)$target[$i]);
                        
                        if(!empty($existing_data)){
                                $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
                        }else{
                            $this->RiskMitigationDetailMonitoringModel->insert($data);
                        }         
                    }
                }
                
                //update monitoring month
                $monitoring = $this->request->getPost('monitoring[]');
                if($monitoring){
                    for($j = 0; $j < count($monitoring); $j++){
                        $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);
                    }
                }

                //delete data with target and monitoring month 0000-00-00
                //$this->RiskMitigationDetailMonitoringModel->delete_null_target_monitoring();
                //delete data

                return redirect()->back()->with('state_message', 'success');
            }catch (\Exception $e) {
                return redirect()->back()->with('state_message', 'error');
            }
        }else{
            //update progress_percentage
            $percentage['progress_percentage'] = $this->request->getPost('progress_percentage');
            $percentage['updated_at'] = date('Y-m-d h:i:s');
            $this->RiskMitigationDetailModel->update($id_detail_mitigation, $percentage);

            //update output
            $outputs = $this->request->getPost('output');
            //delete current output
            $this->RiskMitigationDetailOutputModel->delete_by_detail_mitigation_id($id_detail_mitigation);

            // re-add
            foreach ($outputs as $key => $value){
                $data_output = [
                    'id_detail_mitigation' => $id_detail_mitigation,
                    'output' => $outputs[$key],
                    'updated_at' => date('Y-m-d h:i:s'),
                    'created_at' => date('Y-m-d h:i:s'),
                ];

                $this->RiskMitigationDetailOutputModel->insert($data_output);
            }
        
            $target = $this->request->getPost('target[]');
            $notes = $this->request->getPost('notes[]');
            
            $arr_existing = array();
            $arr_checked = array();
            
            //existing target
            $get_existing_target = $this->RiskMitigationDetailMonitoringModel->get_list_monitoring_by_id_detail_mitigation($id_detail_mitigation);
            
            foreach($get_existing_target as $k=>$v) {
                $tm = substr($v['target_month'], 5, -3);
                array_push($arr_existing, $tm);
            }

            //update target month
            if($target){
                for($i = 0; $i < count($target); $i++){
                    array_push($arr_checked,$target[$i]);  
            
                    $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
                    if($existing_data){
                        //update existing data
                        $data = [
                            'id_detail_mitigation' => $id_detail_mitigation,
                            'target_month' => date("Y")."-".$target[$i]."-01",
                            'updated_at' => date('Y-m-d h:i:s'),
                            //'notes' => $notes[$i],
                        ];
                        $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
                        

                    }else{
                        //check if new added or update based on monitoring
                        $monitoring_datas = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_monitoring($id_detail_mitigation, $target[$i]);

                        if($monitoring_datas){
                            //update data
                            $data=[
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => date("Y")."-".$target[$i]."-01",
                                'updated_at' => date('Y-m-d h:i:s'),
                                //'notes' => $notes[$i],
                            ];
                            $this->RiskMitigationDetailMonitoringModel->update($monitoring_datas->id,$data);
                        }else{
                            //insert new data
                            $data=[
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => date("Y")."-".$target[$i]."-01",
                                'monitoring_month' => "0000-00-00",
                                'updated_at' => date('Y-m-d h:i:s'),
                                'created_at' => date('Y-m-d h:i:s'),
                                //'notes' => $notes[$i],
                            ];
                            $inserted_id = $this->RiskMitigationDetailMonitoringModel->insert($data);
                        }
                    }         
                }
            }

            //delete not relevan target month
            //looping existing array  
            $arr_deleted = array();       
            for($i = 0 ; $i < count($arr_existing); $i++){
                if (!in_array($arr_existing[$i], $arr_checked)){
                    array_push($arr_deleted,$arr_existing[$i]);
                }
            }
            for($i = 0 ; $i < count($arr_deleted); $i++){
                //update to 0000-00-00 where id_detail_mitigation and target_month
                $a = $this->RiskMitigationDetailMonitoringModel->update_data_target_2($id_detail_mitigation, $arr_deleted[$i]);
               
            }

            $arr_checked_monitoring = array();
            //update monitoring month
            $monitoring = $this->request->getPost('monitoring[]');
            
            if($monitoring){
                for($j = 0; $j < count($monitoring); $j++){
                    array_push($arr_checked_monitoring,$monitoring[$j]);  
                    //get data with target month = monitoring month
                    $target_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_monitoring($id_detail_mitigation, $monitoring[$j]);
                    
                   //update
                    if($target_data){
                        $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
                        array_push($arr_id_monitoring,$target_data->id);
                    }else{
                        $monitoring_data = $this->RiskMitigationDetailMonitoringModel
                        ->where('id_detail_mitigation', $id_detail_mitigation)
                        ->where('target_month', date("Y")."-".$monitoring[$j]."-01")->findAll();
                        
                        if($monitoring_data){
                            
                            //update
                            $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
                             
                        }else{
                            //add new row with target == null
                            $data=[
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => "0000-00-00",
                                'monitoring_month' => date("Y")."-".$monitoring[$j]."-01",
                                'updated_at' => date('Y-m-d h:i:s'),
                                'created_at' => date('Y-m-d h:i:s'),
                                //'notes' => $notes[$j],
                            ];
                            $inserted_id = $this->RiskMitigationDetailMonitoringModel->insert($data); 
                           
                        } 
                    }
                }
            }

            $arr_existing_monitoring = array();
            foreach($get_existing_target as $k=>$v) {
                $mm = substr($v['monitoring_month'], 5, -3);
                if($mm != "00"){
                    array_push($arr_existing_monitoring, $mm);
                }
            }

            //delete not relevan monitoring month
            //looping existing array  
            $arr_deleted_monitoring = array();       
            for($i = 0 ; $i < count($arr_existing_monitoring); $i++){
                if (!in_array($arr_existing_monitoring[$i], $arr_checked_monitoring)){
                    array_push($arr_deleted_monitoring,$arr_existing_monitoring[$i]);
                }
            }
            
            for($i = 0 ; $i < count($arr_deleted_monitoring); $i++){
                //update to 0000-00-00 where id_detail_mitigation and target_month
                $this->RiskMitigationDetailMonitoringModel->update_data_monitoring_2($id_detail_mitigation, $arr_deleted_monitoring[$i]);
            }

            //delete data with target and monitoring month 0000-00-00
                $this->RiskMitigationDetailMonitoringModel->delete_null_target_monitoring();
            //delete data

            return redirect()->back()->with('state_message', 'success');
        }
    }

    // public function onAddDetailMonitoring(){
    //     helper(['form', 'url', 'filesystem']);
    //     $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');
        
    //     try{
    //         //update progress_percentage
    //         $percentage['progress_percentage']=$this->request->getPost('progress_percentage');
    //         $this->RiskMitigationDetailModel->update($id_detail_mitigation, $percentage);

    //         //output
    //         $outputs = $this->request->getPost('output');
    //         //delete current output
    //         $this->RiskMitigationDetailOutputModel->delete_by_detail_mitigation_id($id_detail_mitigation);
    //         // re-add
    //         foreach ($outputs as $key => $value){
    //             $data_output = [
    //                 'id_detail_mitigation' => $id_detail_mitigation,
    //                 'output' => $outputs[$key],
    //             ];
    //             $this->RiskMitigationDetailOutputModel->insert($data_output);
    //         }
            
    //         //target monitoring
    //         //$this->RiskMitigationDetailMonitoringModel->delete_by_detail_mitigation_id($id_detail_mitigation);
            
    //         $target = $this->request->getPost('target[]');
    //         $notes = $this->request->getPost('notes[]');

    //         for($i = 0; $i < count($target); $i++){
    //             $data=[
    //                 'id_detail_mitigation' => $id_detail_mitigation,
    //                 'target_month' => date("Y")."-".$target[$i]."-01",
    //                 'monitoring_month' => "0000-00-00",
    //                 'notes' => $notes[$i],
    //             ];

    //             $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
    //             //dd($not_deleted->t_month == (int)$target[$i]);
                
    //             if(!empty($existing_data)){
    //                  $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
    //             }else{
    //                 $this->RiskMitigationDetailMonitoringModel->insert($data);
    //             }         
    //         }

    //         if($this->request->getPost('monitoring[]')){
    //             $monitoring = $this->request->getPost('monitoring[]');
    //             //update monitoring month
    //             for($i = 0; $i < count($monitoring); $i++){
    //                 $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$i]);
    //             }
    //         }
            
    //         return redirect()->back()->with('state_message', 'success');

    //     }catch (\Exception $e) {
    //         return redirect()->back()->with('state_message', 'error');
    //     }
    // }

    // public function onUploadEvidence(){
    //     $id_detail_monitoring = $this->RiskMitigationDetailMonitoringModel->get_id_monitoring($this->request->getPost('month'),$this->request->getPost('id_detail_mitigation'));

    //     if($id_detail_monitoring){
    //         if($this->request->getFileMultiple('evidence')){
    //             $i = 1;
    //             foreach($this->request->getFileMultiple('evidence') as $file){
                    
    //                 $fileName = $file->getName();
                    
    //                 $file->move(FCPATH . 'uploads/'.$id_detail_monitoring->id.'/', $fileName);

    //                 $data_evidence = [
    //                     'id_detail_monitoring' => $id_detail_monitoring->id,
    //                     'filename' => $fileName,
    //                     'pathname' => FCPATH . "/uploads/".$id_detail_monitoring->id,
                        
    //                 ];
                    
    //                 $this->RiskMitigationDetailEvidenceModel->insert($data_evidence);
    //                 $i++;
    //             }
    //         }
    //     }
    //     return redirect()->back()->with('state_message', 'file');
    // }

    public function onUploadEvidence(){
        $id_detail_monitoring = $this->RiskMitigationDetailMonitoringModel->get_id_monitoring($this->request->getPost('month'),$this->request->getPost('id_detail_mitigation'));
       
        if($id_detail_monitoring){
            if($this->request->getFileMultiple('evidence')){
                $i = 1;
                foreach($this->request->getFileMultiple('evidence') as $file){
                    //$fileName = "evidence_".$i.".".$file->getClientExtension();
                    $fileName = $file->getName();
                    $file->move(FCPATH .DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$id_detail_monitoring->id.'/', $fileName);
                    $data_evidence = [
                        'id_detail_monitoring' => $id_detail_monitoring->id,
                        'filename' => $fileName,
                        'flags' => '1',
                        'pathname' => FCPATH . DIRECTORY_SEPARATOR."uploads". DIRECTORY_SEPARATOR.$id_detail_monitoring->id,
                        'created_at' => date("Y-md H:i:s")
                    ];
                    
                    $this->RiskMitigationDetailEvidenceModel->insert($data_evidence);
                    $i++;
                }
            }
        }
        return redirect()->back()->with('state_message', 'file');
    }

    public function download($id_detail_monitoring,$filename){
        return $this->response->download(FCPATH . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.$id_detail_monitoring.'/'.$filename, null);
    }

    public function onDeleteEvidence($id, $id_detail_monitoring){
        $data["flags"] = '0'; 
        $this->RiskMitigationDetailEvidenceModel->update($id, $data);

        // $filename = $this->RiskMitigationDetailEvidenceModel->find($id);
        
        // unlink (FCPATH .DIRECTORY_SEPARATOR. 'uploads'.DIRECTORY_SEPARATOR.$id_detail_monitoring.DIRECTORY_SEPARATOR.$filename['filename']);
        // $this->RiskMitigationDetailEvidenceModel->delete($id);

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

    public function onDownloadReportExcelBreakdown($year){
        $datas = $this->RiskEventModel->get_data_report($year);
        $data_target = $this->RiskEventModel->get_data_target($year);
        $data_monitoring = $this->RiskEventModel->get_data_monitoring($year);
        $data_risk_count = $this->RiskEventModel->get_risk_number_count($year);
        $data_risk_mitigation_count = $this->RiskEventModel->get_risk_mitigation_count($year);
        $spreadsheet = new Spreadsheet();

        //column header name
        $spreadsheet->setActiveSheetIndex(0)
        //set column tittle
        ->setCellValue('A4', 'NO')
        ->setCellValue('B4', 'RISK EVENT')
        ->setCellValue('C4', 'RENCANA MITIGASI')
        ->setCellValue('D4', 'DETAIL MITIGASI')
        ->setCellValue('E4', 'PIC')
        ->setCellValue('F4', 'OUTPUT')
        ->setCellValue('G4', 'WAKTU PELAKSANAAN  MITIGASI & REALISASI MITIGASI')
        ->setCellValue('G5', 'TRIWULAN I ')
        ->setCellValue('J5', 'TRIWULAN II')
        ->setCellValue('M5', 'TRIWULAN III')
        ->setCellValue('P5', 'TRIWULAN IV')
        ->setCellValue('G6', 'JAN')
        ->setCellValue('H6', 'FEB')
        ->setCellValue('I6', 'MAR')
        ->setCellValue('J6', 'APR')
        ->setCellValue('K6', 'MEI')
        ->setCellValue('L6', 'JUN')
        ->setCellValue('M6', 'JUL')
        ->setCellValue('N6', 'AGS')
        ->setCellValue('O6', 'SEP')
        ->setCellValue('P6', 'OKT')
        ->setCellValue('Q6', 'NOV')
        ->setCellValue('R6', 'DES')
        ->setCellValue('S4', 'CATATAN')
        ->setCellValue('D2', 'RISK MONITORING PERUM PPD '.$year)
        //set merge cells
        ->mergeCells('A4:A6')
        ->mergeCells('B4:B6')
        ->mergeCells('C4:C6')
        ->mergeCells('D4:D6')
        ->mergeCells('E4:E6')
        ->mergeCells('F4:F6')
        ->mergeCells('G5:I5')
        ->mergeCells('G4:R4')
        ->mergeCells('J5:L5')
        ->mergeCells('M5:O5')
        ->mergeCells('P5:R5')
        ->mergeCells('S4:S6');

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 11
                
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'argb' => '191970',
                ],
                'endColor' => [
                    'argb' => '191970',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ];

        $spreadsheet->getActiveSheet()->getStyle('A4:S6')->applyFromArray($styleArray); 
    
        //rows target and monitoring
        $column = 7; //target
        $column1 = 8; //monitoring
        // $column_risk_number = 0;
        
        foreach($datas as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['risk_number'])
                        ->setCellValue('B' . $column, $data['risk_event'])
                        ->setCellValue('C' . $column, $data['risk_mitigation'])
                        ->setCellValue('D' . $column, $data['risk_mitigation_detail'])
                        ->setCellValue('E' . $column, $data['name'])
                        ->setCellValue('F' . $column, $data['output'])
                        ->setCellValue('S' . $column, $data['notes']);
            $spreadsheet->getActiveSheet()->mergeCells('D' . $column. ':D'. $column + 1); 
            $spreadsheet->getActiveSheet()->mergeCells('E' . $column. ':E'. $column + 1); 
            $spreadsheet->getActiveSheet()->mergeCells('F' . $column. ':F'. $column + 1); 

            //target
            foreach($data_target as $data1) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'size'  => 10
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'BDD6EE',
                        ],
                        'endColor' => [
                            'argb' => 'BDD6EE',
                        ],
                    ],
                    'borders' => [
                        'allborders' => [
                            'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ]
                ];
                
                if($data['id_detail_mitigation'] == $data1['id_detail_mitigation']){
                    if($data1['Januari'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('G' . $column)->applyFromArray($styleArray);
                    }else if($data1['Februari'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('H' . $column)->applyFromArray($styleArray);
                    }else if($data1['Maret'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('I' . $column)->applyFromArray($styleArray);
                    }else if($data1['April'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('J' . $column)->applyFromArray($styleArray);
                    }else if($data1['Mei'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('K' . $column)->applyFromArray($styleArray);
                    }else if($data1['Juni'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('L' . $column)->applyFromArray($styleArray); 
                    }else if($data1['Juli'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('M' . $column)->applyFromArray($styleArray);
                    }else if($data1['Agustus'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('N' . $column)->applyFromArray($styleArray);
                    }else if($data1['September'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('O' . $column)->applyFromArray($styleArray);
                    }else if($data1['Oktober'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('P' . $column)->applyFromArray($styleArray);
                    }else if($data1['November'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('Q' . $column)->applyFromArray($styleArray);
                    }else if($data1['Desember'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('R' . $column)->applyFromArray($styleArray);  
                    }
                }
                $notes = "";
            }

            //monitoring
            foreach($data_monitoring as $data2) {
                $styleArray1 = [
                    'font' => [
                        'bold' => true,
                        'size'  => 10
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'C5E0B3',
                        ],
                        'endColor' => [
                            'argb' => 'C5E0B3',
                        ],
                    ],
                    'borders' => [
                        'allborders' => [
                            'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ]
                ];

                if($data['id_detail_mitigation'] == $data2['id_detail_mitigation']){
                    if($data2['Januari'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('G' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Februari'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('H' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Maret'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('I' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['April'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('J' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Mei'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('K' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Juni'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('L' . $column1)->applyFromArray($styleArray1); 
                    }else if($data2['Juli'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('M' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Agustus'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('N' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['September'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('O' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Oktober'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('P' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['November'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('Q' . $column1)->applyFromArray($styleArray1);
                    }else if($data2['Desember'] == '1'){
                        $spreadsheet->getActiveSheet()->getStyle('R' . $column1)->applyFromArray($styleArray1);  
                    }
                }
            }
            $column += 2;
            $column1 += 2;
        }

        //merge cell risk number and events
        $count = 7;
        $temp_count = 0;
        foreach($data_risk_count as $data) {
            $a = $temp_count + ($data['count']*2) + 6;
            // echo 'A'.$count.':A'. $a;
            // echo '<br/>';
            $spreadsheet->getActiveSheet()->mergeCells('A'.$count.':A'. $a); 
            $spreadsheet->getActiveSheet()->mergeCells('B'.$count.':B'. $a); 
            
            $count = $a+1;
            $temp_count = $a - 6;
        }

        foreach($data_risk_count as $data) {
            $a = $temp_count + ($data['count']*2) + 6;
            $spreadsheet->getActiveSheet()->mergeCells('C'.$count.':C'. $a); 
            
            $count = $a+1;
            $temp_count = $a - 6;
        }

        // merge cell risk mitigations
        $count = 7;
        $temp_count = 0;
        $a = 0;
        foreach($data_risk_mitigation_count as $data) {
            $a = $temp_count + ($data['count']*2) + 6;
            $spreadsheet->getActiveSheet()->mergeCells('C'.$count.':C'. $a); 
            
            $count = $a+1;
            $temp_count = $a - 6;
        }

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath('assets/images/logo_ppd.png'); /* put your path and image here */
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(90);
        $drawing->getShadow()->setVisible(true);
        $drawing->setHeight(30);
        $drawing->setWidth(30);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'size'  => 14 
            ] 
        ];
        $spreadsheet->getActiveSheet()->getStyle('D2')->applyFromArray($styleArray); 

        $writer = new Xls($spreadsheet);
        $fileName = 'Data_Report_Breakdown';

        // Redirect hasil generate xlsx ke web client
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename='.$fileName.'.xls');
        header('Cache-Control: max-age=0');

        // $writer = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel2010');  
        $writer->save('php://output');
    }

    public function onDownloadReportExcelGabungan($year){
        $data1 = $this->RiskEventModel->get_data_report_gabungan($year);
        $data2 = $this->RiskEventModel->get_data_report_gabungan_2($year);

        $spreadsheet = new Spreadsheet();
        //column header name
        $spreadsheet->setActiveSheetIndex(0)
        //set column tittle
        ->setCellValue('A4', 'NO')
        ->setCellValue('B4', 'RISK EVENT')
        ->setCellValue('C4', 'RENCANA MITIGASI')
        ->setCellValue('D4', 'DETAIL MITIGASI')
        ->setCellValue('E4', 'PIC')
        ->setCellValue('F4', 'OUTPUT')
        ->setCellValue('G4', 'WAKTU PELAKSANAAN  MITIGASI & REALISASI MITIGASI')
        ->setCellValue('G5', 'TRIWULAN I ')
        ->setCellValue('J5', 'TRIWULAN II')
        ->setCellValue('M5', 'TRIWULAN III')
        ->setCellValue('P5', 'TRIWULAN IV')
        ->setCellValue('G6', 'JAN')
        ->setCellValue('H6', 'FEB')
        ->setCellValue('I6', 'MAR')
        ->setCellValue('J6', 'APR')
        ->setCellValue('K6', 'MEI')
        ->setCellValue('L6', 'JUN')
        ->setCellValue('M6', 'JUL')
        ->setCellValue('N6', 'AGS')
        ->setCellValue('O6', 'SEP')
        ->setCellValue('P6', 'OKT')
        ->setCellValue('Q6', 'NOV')
        ->setCellValue('R6', 'DES')
        ->setCellValue('S4', 'CATATAN')
        ->setCellValue('D2', 'RISK MONITORING PERUM PPD '.$year)
        //set merge cells
        ->mergeCells('A4:A6')
        ->mergeCells('B4:B6')
        ->mergeCells('C4:C6')
        ->mergeCells('D4:D6')
        ->mergeCells('E4:E6')
        ->mergeCells('F4:F6')
        ->mergeCells('G5:I5')
        ->mergeCells('G4:R4')
        ->mergeCells('J5:L5')
        ->mergeCells('M5:O5')
        ->mergeCells('P5:R5')
        ->mergeCells('S4:S6');

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 11
                
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'argb' => '191970',
                ],
                'endColor' => [
                    'argb' => '191970',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ];

        $spreadsheet->getActiveSheet()->getStyle('A4:S6')->applyFromArray($styleArray); 

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath('assets/images/logo_ppd.png'); /* put your path and image here */
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(90);
        $drawing->getShadow()->setVisible(true);
        $drawing->setHeight(30);
        $drawing->setWidth(30);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        
        //define row start
        $column = 7; //target
        $column1 = 8; //monitoring

        $styleArray = [
            'font' => [
                'bold' => true,
                'size'  => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'BDD6EE',
                ],
                'endColor' => [
                    'argb' => 'BDD6EE',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ];

        $styleArray1 = [
            'font' => [
                'bold' => true,
                'size'  => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'C5E0B3',
                ],
                'endColor' => [
                    'argb' => 'C5E0B3',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ];

        foreach($data2 as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['risk_number'])
                        ->setCellValue('B' . $column, $data['risk_event'])
                        ->setCellValue('C' . $column, $data['risk_mitigation'])
                        ->setCellValue('D' . $column, $data['risk_mitigation_detail'])
                        ->setCellValue('E' . $column, $data['division'])
                        ->setCellValue('S' . $column, $data['notes']);
            $spreadsheet->getActiveSheet()->mergeCells('D' . $column. ':D'. $column + 1); 
            $spreadsheet->getActiveSheet()->mergeCells('E' . $column. ':E'. $column + 1); 
            $spreadsheet->getActiveSheet()->mergeCells('F' . $column. ':F'. $column + 1);
            
            foreach($data1 as $datas) {
                if($data['id_detail_mitigation'] == $datas['id_detail_mitigation']){

                    $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $column, $datas['output']);
                    //set target color
                    if(substr($datas['target_month'],5,2) == '01'){
                        $spreadsheet->getActiveSheet()->getStyle('G' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '01'){
                        $spreadsheet->getActiveSheet()->getStyle('H' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '02'){
                        $spreadsheet->getActiveSheet()->getStyle('I' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '03'){
                        $spreadsheet->getActiveSheet()->getStyle('J' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '04'){
                        $spreadsheet->getActiveSheet()->getStyle('K' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '05'){
                        $spreadsheet->getActiveSheet()->getStyle('L' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '06'){
                        $spreadsheet->getActiveSheet()->getStyle('M' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '07'){
                        $spreadsheet->getActiveSheet()->getStyle('N' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '08'){
                        $spreadsheet->getActiveSheet()->getStyle('O' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '09'){
                        $spreadsheet->getActiveSheet()->getStyle('P' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '10'){
                        $spreadsheet->getActiveSheet()->getStyle('Q' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '11'){
                        $spreadsheet->getActiveSheet()->getStyle('R' . $column)->applyFromArray($styleArray);
                    }else if(substr($datas['target_month'],5,2) == '12'){

                    }

                    //set monitoring color
                    if(substr($datas['monitoring_month'],5,2) == '01'){
                        $spreadsheet->getActiveSheet()->getStyle('G' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '01'){
                        $spreadsheet->getActiveSheet()->getStyle('H' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '02'){
                        $spreadsheet->getActiveSheet()->getStyle('I' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '03'){
                        $spreadsheet->getActiveSheet()->getStyle('J' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '04'){
                        $spreadsheet->getActiveSheet()->getStyle('K' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '05'){
                        $spreadsheet->getActiveSheet()->getStyle('L' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '06'){
                        $spreadsheet->getActiveSheet()->getStyle('M' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '07'){
                        $spreadsheet->getActiveSheet()->getStyle('N' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '08'){
                        $spreadsheet->getActiveSheet()->getStyle('O' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '09'){
                        $spreadsheet->getActiveSheet()->getStyle('P' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '10'){
                        $spreadsheet->getActiveSheet()->getStyle('Q' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '11'){
                        $spreadsheet->getActiveSheet()->getStyle('R' . $column1)->applyFromArray($styleArray1);
                    }else if(substr($datas['monitoring_month'],5,2) == '12'){

                    }
                }
            }

            $column += 2; //target
            $column1 += 2; //monitoring
        }

        $writer = new Xls($spreadsheet);
        $fileName = 'Data_Report_Gabungan';

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename='.$fileName.'.xls');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function getListRiskEvent($risk_detail, $id_risk_event){
        $data = $this->RiskMitigationDetailModel->get_list_risk_event_by_risk_detail($risk_detail, $id_risk_event);
		echo json_encode($data);

    }

    public function copyEvidence($risk_detail, $id_division, $month, $id_risk_event, $current_id_detail_monitoring){
        $data = $this->RiskMitigationDetailModel->copy_evidence($risk_detail, $id_division, $month, $id_risk_event, $current_id_detail_monitoring);
		
		echo json_encode($data);
    }

}
