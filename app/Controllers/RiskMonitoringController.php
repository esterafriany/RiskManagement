<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            'breadcrumb' => 'Home<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Risk Monitoring',
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
        $totalRecords = $this->RiskEventModel
                        ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
                        ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
                        ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id', 'left')
                        ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                        ->select('risk_events.risk_event
                            , risk_mitigations.risk_mitigation
                            , risk_mitigation_details.id
                            , risk_mitigation_details.risk_mitigation_detail
                            , GROUP_CONCAT(divisions.name) as division_name
                            , progress_percentage')
                        ->orLike('risk_events.risk_event', $searchValue)
                        ->where('risk_events.year' , $year)
                        ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
                        ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
                                ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
                                ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id', 'left')
                                ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                                ->select('risk_events.risk_event
                                    , risk_mitigations.risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , GROUP_CONCAT(divisions.name) as division_name
                                    , progress_percentage')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->where('risk_events.year' , $year)
                                ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
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
                        , GROUP_CONCAT(divisions.name) as division_name
                        , progress_percentage')
                    ->orLike('risk_events.risk_event', $searchValue)
                    ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                    ->where('risk_events.year' , $year)
                    ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
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
                                ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id', 'left')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id', 'left')
                                ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id', 'left')
                                ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                                ->select('risk_events.risk_event
                                    , risk_mitigations.risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , GROUP_CONCAT(divisions.name) as division_name
                                    , progress_percentage')
                                ->where('risk_events.year' , $year)
                                ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
                                ->orLike('risk_events.risk_event', $searchValue)
                                ->orLike('risk_mitigations.risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_details.risk_mitigation_detail', $searchValue)
                                ->orLike('progress_percentage', $searchValue)
                                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel
                                ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id')
                                ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id')
                                ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                                ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                                ->select('risk_events.risk_event
                                    , risk_mitigations.risk_mitigation
                                    , risk_mitigation_details.id
                                    , risk_mitigation_details.risk_mitigation_detail
                                    , GROUP_CONCAT(divisions.name) as division_name
                                    , progress_percentage')
                                ->where('risk_events.year' , $year)
                                ->orLike('risk_event', $searchValue)
                                ->orLike('risk_mitigation', $searchValue)
                                ->orLike('risk_mitigation_detail', $searchValue)
                                ->orLike('progress_percentage', $searchValue)
                                ->orLike('divisions.name', $searchValue)
                                ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
                                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                    ->join('risk_mitigations', 'risk_mitigations.id_risk_event = risk_events.id')
                    ->join('risk_mitigation_divisions', 'risk_mitigation_divisions.id_risk_mitigation = risk_mitigations.id')
                    ->join('risk_mitigation_details', 'risk_mitigation_details.id_risk_mitigation = risk_mitigations.id')
                    ->join('divisions', 'divisions.id = risk_mitigation_divisions.id_division')
                    ->select('risk_events.risk_event
                        , risk_mitigations.risk_mitigation
                        , risk_mitigation_details.id
                        , risk_mitigation_details.risk_mitigation_detail
                        , GROUP_CONCAT(divisions.name) as division_name
                        , progress_percentage')
                    ->where('risk_events.year' , $year)
                    ->orLike('risk_event', $searchValue)
                    ->orLike('risk_mitigation', $searchValue)
                    ->orLike('risk_mitigation_detail', $searchValue)
                    ->orLike('progress_percentage', $searchValue)
                    ->orLike('divisions.name', $searchValue)
                    ->groupBy('risk_mitigation_details.id, risk_mitigations.id')
                    //->orderBy($columnName,$columnSortOrder)
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

    public function getDetailRiskMonitoring($id_detail_mitigation){
        $data = [
            'title'=>'Risk Monitoring Detail',
            'breadcrumb' => 'Home<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
             Risk Mitigation&nbsp;<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
             Detail Risiko&nbsp;<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
             Detail Mitigasi Risiko&nbsp;<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
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

    public function getEvidenceList($month,$id){
        $data = $this->RiskMitigationDetailEvidenceModel->get_list_evidence_by_month($month,$id);
		
		echo json_encode($data);
    }

    public function onAddDetailMonitoring(){
        helper(['form', 'url', 'filesystem']);
        $id_detail_mitigation =  $this->request->getPost('id_detail_mitigation');
        $arr_id_monitoring = array();
        
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
                            'notes' => $notes[$i],
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
                                'notes' => $notes[$i],
                            ];
                            $this->RiskMitigationDetailMonitoringModel->update($monitoring_datas->id,$data);
                            
                        }else{
                            //insert new data
                            $data=[
                                'id_detail_mitigation' => $id_detail_mitigation,
                                'target_month' => date("Y")."-".$target[$i]."-01",
                                'monitoring_month' => "0000-00-00",
                                'notes' => $notes[$i],
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
                                'notes' => $notes[$i],
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
            // if($target){
            //     for($i = 0; $i < count($target); $i++){
            //         $data=[
            //             'id_detail_mitigation' => $id_detail_mitigation,
            //             'target_month' => date("Y")."-".$target[$i]."-01",
            //             'monitoring_month' => "0000-00-00",
            //             'notes' => $notes[$i],
            //         ];
    
            //         $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
            //         //dd($not_deleted->t_month == (int)$target[$i]);
                    
            //         if(!empty($existing_data)){
            //              $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
            //         }else{
            //             $this->RiskMitigationDetailMonitoringModel->insert($data);
            //         }         
            //     }
            // }
            
            // //update monitoring month
            // $monitoring = $this->request->getPost('monitoring[]');
            // if($monitoring){
            //     for($j = 0; $j < count($monitoring); $j++){
            //         $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);
            //     }
            // }
            return redirect()->back()->with('state_message', 'success');

        }catch (\Exception $e) {
            return redirect()->back()->with('state_message', 'error');
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
            
    //         $target = $this->request->getPost('target[]');
    //         $notes = $this->request->getPost('notes[]');
    //         $arr_existing = array();
    //         $arr_checked = array();
            
    //         //existing target
    //         $get_existing_target = $this->RiskMitigationDetailMonitoringModel->get_list_monitoring_by_id_detail_mitigation($id_detail_mitigation);
        
    //         foreach($get_existing_target as $k=>$v) {
    //             $tm = substr($v['target_month'], 5, -3);
    //             array_push($arr_existing, $tm);
    //         }

    //         //update target month
    //         if($target){
    //             for($i = 0; $i < count($target); $i++){
    //                 array_push($arr_checked,$target[$i]);  
            
    //                 $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
    //                 if($existing_data){
    //                     //update existing data
    //                     $data = [
    //                         'id_detail_mitigation' => $id_detail_mitigation,
    //                         'target_month' => date("Y")."-".$target[$i]."-01",
    //                         'notes' => $notes[$i],
    //                     ];
    //                     $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
    //                 }else{
    //                     //check if new added or update based on monitoring
    //                     $monitoring_datas = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_monitoring($id_detail_mitigation, $target[$i]);

    //                     if($monitoring_datas){
    //                         //update data
    //                         $data=[
    //                             'id_detail_mitigation' => $id_detail_mitigation,
    //                             'target_month' => date("Y")."-".$target[$i]."-01",
    //                             'notes' => $notes[$i],
    //                         ];
    //                         $this->RiskMitigationDetailMonitoringModel->update($monitoring_datas->id,$data);

    //                     }else{
    //                         //insert new data
    //                         $data=[
    //                             'id_detail_mitigation' => $id_detail_mitigation,
    //                             'target_month' => date("Y")."-".$target[$i]."-01",
    //                             'monitoring_month' => "0000-00-00",
    //                             'notes' => $notes[$i],
    //                         ];
    //                         $this->RiskMitigationDetailMonitoringModel->insert($data);
    //                     }
    //                 }         
    //             }
    //         }

    //         //delete not relevan target month
    //         //looping existing array  
    //         $arr_deleted = array();       
    //         for($i = 0 ; $i < count($arr_existing); $i++){
    //             if (!in_array($arr_existing[$i], $arr_checked)){
    //                 array_push($arr_deleted,$arr_existing[$i]);
    //             }
    //         }
    //         for($i = 0 ; $i < count($arr_deleted); $i++){
    //             //update to 0000-00-00 where id_detail_mitigation and target_month
    //             $a = $this->RiskMitigationDetailMonitoringModel->update_data_target_2($id_detail_mitigation, $arr_deleted[$i]);
               
    //         }

    //         //update monitoring month
    //         $arr_checked_monitoring = array();
    //         $monitoring = $this->request->getPost('monitoring[]');
                   
    //         if($monitoring){
    //             for($j = 0; $j < count($monitoring); $j++){
    //                 array_push($arr_checked_monitoring,$monitoring[$j]);  
    //                 //get data with target month = monitoring month
    //                 $target_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $monitoring[$j]);
                    
    //                 //update
    //                 if($target_data){
    //                     $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
    //                 }else{
    //                     $monitoring_data = $this->RiskMitigationDetailMonitoringModel
    //                     ->where('id_detail_mitigation', $id_detail_mitigation)
    //                     ->where('monitoring_month', date("Y")."-".$monitoring[$j]."-01")->findAll();
                        
    //                     if($monitoring_data){
    //                         //update
    //                         $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);  
    //                     }else{
    //                         //if exist target then update
                            

    //                         //if not exist target insert new data
    //                         //add new row with target == null
    //                         $data=[
    //                             'id_detail_mitigation' => $id_detail_mitigation,
    //                             'target_month' => "0000-00-00",
    //                             'monitoring_month' => date("Y")."-".$monitoring[$j]."-01",
    //                             'notes' => $notes[$i],
    //                         ];
                           
    //                         $this->RiskMitigationDetailMonitoringModel->insert($data); 
    //                     } 
    //                 }
    //             }
    //         }

    //         $arr_existing_monitoring = array();

    //         foreach($get_existing_target as $k=>$v) {
    //             $mm = substr($v['monitoring_month'], 5, -3);
    //             if($mm != "00"){
    //                 array_push($arr_existing_monitoring, $mm);
    //             }
                
    //         }

    //         //delete not relevan monitoring month
    //         //looping existing array  
    //         $arr_deleted_monitoring = array();       
    //         for($i = 0 ; $i < count($arr_existing_monitoring); $i++){
    //             if (!in_array($arr_existing_monitoring[$i], $arr_checked_monitoring)){
    //                 array_push($arr_deleted_monitoring,$arr_existing_monitoring[$i]);
    //             }
    //         }
            
    //         for($i = 0 ; $i < count($arr_deleted_monitoring); $i++){
    //             //update to 0000-00-00 where id_detail_mitigation and target_month
    //             $a=$this->RiskMitigationDetailMonitoringModel->update_data_monitoring_2($id_detail_mitigation, $arr_deleted_monitoring[$i]);
    //         }

    //         // if($target){
    //         //     for($i = 0; $i < count($target); $i++){
    //         //         $data=[
    //         //             'id_detail_mitigation' => $id_detail_mitigation,
    //         //             'target_month' => date("Y")."-".$target[$i]."-01",
    //         //             'monitoring_month' => "0000-00-00",
    //         //             'notes' => $notes[$i],
    //         //         ];
    
    //         //         $existing_data = $this->RiskMitigationDetailMonitoringModel->get_data_by_month_target($id_detail_mitigation, $target[$i]);
    //         //         //dd($not_deleted->t_month == (int)$target[$i]);
                    
    //         //         if(!empty($existing_data)){
    //         //              $this->RiskMitigationDetailMonitoringModel->update($existing_data->id,$data);
    //         //         }else{
    //         //             $this->RiskMitigationDetailMonitoringModel->insert($data);
    //         //         }         
    //         //     }
    //         // }
            
    //         // //update monitoring month
    //         // $monitoring = $this->request->getPost('monitoring[]');
    //         // if($monitoring){
    //         //     for($j = 0; $j < count($monitoring); $j++){
    //         //         $this->RiskMitigationDetailMonitoringModel->update_data_monitoring($id_detail_mitigation, $monitoring[$j]);
    //         //     }
    //         // }
    //         return redirect()->back()->with('state_message', 'success');

    //     }catch (\Exception $e) {
    //         return redirect()->back()->with('state_message', 'error');
    //     }
    // }

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
                        'pathname' => FCPATH . DIRECTORY_SEPARATOR."uploads". DIRECTORY_SEPARATOR.$id_detail_monitoring->id,
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
        $filename = $this->RiskMitigationDetailEvidenceModel->find($id);
        
        unlink (FCPATH .DIRECTORY_SEPARATOR. 'uploads'.DIRECTORY_SEPARATOR.$id_detail_monitoring.DIRECTORY_SEPARATOR.$filename['filename']);
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

    public function onDownloadReportExcelBreakdown(){
        // echo view('admin/pages/risk_monitoring/download_report');

        $datas = $this->RiskEventModel->get_data_report();
        $data_target = $this->RiskEventModel->get_data_target();
        $data_monitoring = $this->RiskEventModel->get_data_monitoring();

        $spreadsheet = new Spreadsheet();

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No')
        ->setCellValue('B1', 'Risk Event')
        ->setCellValue('C1', 'Rencana Mitigasi')
        ->setCellValue('d1', 'Detail Mitigasi')
        ->setCellValue('E1', 'PIC')
        ->setCellValue('F1', 'Output');

        $column = 2;
        $column1 = 3;
        
        foreach($datas as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['risk_number'])
                        ->setCellValue('B' . $column, $data['risk_event'])
                        ->setCellValue('C' . $column, $data['risk_mitigation'])
                        ->setCellValue('D' . $column, $data['risk_mitigation_detail'])
                        ->setCellValue('E' . $column, $data['name'])
                        ->setCellValue('F' . $column, $data['output']);

            //target
            foreach($data_target as $data1) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'BDD6EE',
                        ],
                        'endColor' => [
                            'argb' => 'BDD6EE',
                        ],
                    ],
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
            }

            //monitoring
            foreach($data_monitoring as $data2) {
                $styleArray1 = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'C5E0B3',
                        ],
                        'endColor' => [
                            'argb' => 'C5E0B3',
                        ],
                    ],
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



        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_Report_Breakdown';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
