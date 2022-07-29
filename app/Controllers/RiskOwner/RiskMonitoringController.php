<?php

namespace App\Controllers\RiskOwner;
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
            'breadcrumb'=>
                '<a href='.base_url('risk_owner/dashboards').'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Risk Monitoring',
            'content'=>'risk_owner/pages/risk_monitoring/index',
            'kpi_list'=> $this->KPIModel->get_list_kpis()
        ];
        echo view('risk_owner/template/template',$data);
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
                                    , GROUP_CONCAT(divisions.name) as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->where('risk_events.year' , $year)
                                ->groupBy('risk_mitigation_details.risk_mitigation_detail')
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
                                    , GROUP_CONCAT(divisions.name) as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->where('risk_events.year' , $year)
                                ->groupBy('risk_mitigation_details.risk_mitigation_detail')
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
                        , GROUP_CONCAT(divisions.name) as division_name
                        , progress_percentage')
                    ->orLike('risk_events.risk_event', $searchValue)
                    ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                    ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                    ->where('risk_events.year' , $year)
                    ->groupBy('risk_mitigation_details.risk_mitigation_detail')
                    ->orderBy($columnName,$columnSortOrder)
                    ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){
            $data[] = array( 
                "id"=>$record['id'],
                "risk_event"=>$record['risk_event'],
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

    public function getDetailRiskMonitoring($id_detail_mitigation,$id_risk_mitigation, $id_risk_event){
        $data = [
            'title'=>'Risk Monitoring Detail',
            'breadcrumb'=>
                '<a href='.base_url().'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <a href='.base_url('risk_owner/get-risk-mitigations').'>Risk Mitigations</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <a href='.base_url('risk_owner/get-detail-risk-mitigation').'/'.$id_risk_event.'>Detail Risk Mitigations</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <a href='.base_url('risk_owner/detail-mitigation-risk').'/'.$id_risk_mitigation.'/'.$id_risk_event.'>Detail Mitigation</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Monitoring Mitigasi Risiko',
            'content'=>'risk_owner/pages/risk_monitoring/detail_risk_monitoring',
            'id_detail_mitigation' => $id_detail_mitigation,
            'risk_mitigation_data'=> $this->RiskMitigationDetailModel->get_mitigation_with_detail($id_detail_mitigation),
            'state_message' => ''
        ];
        echo view('risk_owner/template/template',$data);
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
                                        'updated_at' => date('Y-m-d h:i:s'),
                                        'created_at' => date('Y-m-d h:i:s'),
                                        //'notes' => $notes[$j+1],
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
            $percentage['updated_at'] = date('Y-m-d H:i:s');
            $this->RiskMitigationDetailModel->update($id_detail_mitigation, $percentage);

            //update output
            $outputs = $this->request->getPost('output');
            //delete current output
            $this->RiskMitigationDetailOutputModel->delete_by_detail_mitigation_id($id_detail_mitigation);
            
            if($outputs){

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
                            'updated_at' => date("Y-m-d h:i:s"),
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
                                'updated_at' => date("Y-m-d h:i:s"),
                                //'notes' => $notes[$i],
                            ];
                            $this->RiskMitigationDetailMonitoringModel->update($monitoring_datas->id,$data);
                        }else{
                            //insert new data
                            $data=[
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => date("Y")."-".$target[$i]."-01",
                                'monitoring_month' => "0000-00-00",
                                'updated_at' => date("Y-m-d h:i:s"),
                                'created_at' => date("Y-m-d h:i:s"),

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

    // public function onSubmitDetailMonitoring(){
    //     helper(['form', 'url', 'filesystem']);
    //     $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');

    //     //check mandatory evidence based on realisasi month
    //     //get list monitoring month
    //     $monitoring_data = $this->RiskMitigationDetailMonitoringModel->select('*')
    //                             ->where('id_detail_mitigation', $id_detail_mitigation)
    //                             ->where('monitoring_month <>', '0000-00-00')
    //                             ->findAll();
        
    //     for($i = 0 ; $i < count($monitoring_data); $i++){
    //         $evidence_data = $this->RiskMitigationDetailEvidenceModel->select('*')
    //                             ->where('id_detail_monitoring', $monitoring_data[$i]['id'])->countAllResults();
    //         if($evidence_data == 0){
    //             return redirect()->back()->with('state_message', 'error');
    //         }
    //     }
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
                    ];
                    
                    $this->RiskMitigationDetailEvidenceModel->insert($data_evidence);
                    $i++;
                }
            }
        }
        return redirect()->back()->with('state_message', 'file');
    }

    public function onAddNotes(){
        $id_detail_monitoring = $this->RiskMitigationDetailMonitoringModel->get_id_monitoring($this->request->getPost('month'),$this->request->getPost('id_detail_mitigation'));
       
        if($id_detail_monitoring){
            $this->RiskMitigationDetailMonitoringModel->update_notes($id_detail_monitoring->id, $this->request->getPost('notes'));
        }

        return redirect()->back()->with('state_message', 'success');
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

   
}
