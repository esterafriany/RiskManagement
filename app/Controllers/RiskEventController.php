<?php

namespace App\Controllers;
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
            'title'=>'Risk Events',
            'breadcrumb'=>'Home  <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Risk Register',
            'content'=>'admin/pages/risk_event/index',
            'kpi_list'=> $this->KPIModel->get_list_kpis()
        ];
        echo view('admin/template/template',$data);
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
                ->where('year' , $year)
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

        if (! $this->validate([
            'objective' => 'required',
            'id_kpi' => 'required',
            'risk_event' => 'required',
            'year' => 'required',
            'existing_control_1' => 'required',
            'existing_control_2' => 'required',
            'existing_control_3' => 'required', 
            'probability_level' => 'required', 
            'target_probability_level' => 'required', 
            'target_impact_level' => 'required', 
            
          ])) {
            throw new \Exception("Some message goes here");
          }else{
            //get inserted level
            $level_inserted = $this->request->getPost('probability_level') * $this->request->getPost('impact_level');
            $target_level_inserted = $this->request->getPost('target_probability_level') * $this->request->getPost('target_impact_level');
            
            //risk analysis
            if($level_inserted == 1 || $level_inserted == 2 || $level_inserted == 3 || $level_inserted == 4){
                $risk_analysis = "R";
            }else if($level_inserted == 5 || $level_inserted == 6 || $level_inserted == 8 || $level_inserted == 9){
                $risk_analysis = "M";
            }else if($level_inserted == 10 || $level_inserted == 12 || $level_inserted == 15 || $level_inserted == 16){
                $risk_analysis = "T";
            }else if($level_inserted == 20 || $level_inserted == 25){
                $risk_analysis = "E";
            }

            //risk analysis target
            if($target_level_inserted == 1 || $target_level_inserted == 2 || $target_level_inserted == 3 || $target_level_inserted == 4){
                $target_risk_analysis = "R";
            }else if($target_level_inserted == 5 || $target_level_inserted == 6 || $target_level_inserted == 8 || $target_level_inserted == 9){
                $target_risk_analysis = "M";
            }else if($target_level_inserted == 10 || $target_level_inserted == 12 || $target_level_inserted == 15 || $target_level_inserted == 16){
                $target_risk_analysis = "T";
            }else if($target_level_inserted == 20 || $target_level_inserted == 25){
                $target_risk_analysis = "E";
            }
            try {
                $data = [
                        'id_kpi' => $this->request->getPost('id_kpi'),
                        'risk_number' => '0',
                        'objective' => $this->request->getPost('objective'),
                        'risk_event' => $this->request->getPost('risk_event'),
                        'year' => $this->request->getPost('year'),
                        'existing_control_1' => $this->request->getPost('existing_control_1'),
                        'existing_control_2' => $this->request->getPost('existing_control_2'),
                        'existing_control_3' => $this->request->getPost('existing_control_3'),
                        'probability_level' => $this->request->getPost('probability_level'),
                        'impact_level' => $this->request->getPost('impact_level'),
                        'final_level' => $level_inserted,
                        'target_probability_level' => $this->request->getPost('target_probability_level'),
                        'target_impact_level' => $this->request->getPost('target_impact_level'),
                        'target_final_level' => $target_level_inserted,
                        'risk_analysis' => $risk_analysis,
                        'target_risk_analysis' => $target_risk_analysis,
                        ];

                $this->RiskEventModel->insert($data);
                
                ///update nomor risiko
                //get all risk event in selected year
                $data_risk_event = $this->RiskEventModel->get_list_risk_event($this->request->getPost('year'));

                $sort = array();
                foreach($data_risk_event as $k=>$v) {
                    $sort['final_level'][$k] = $v['final_level'];
                    $sort['level'][$k] = $v['level'];
                }
                array_multisort($sort['final_level'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
                //update risk number
                $risk_num = 1;
                for($k=0; $k<count($data_risk_event); $k++) {
                    $data_num['risk_number'] = $risk_num;
                    $this->RiskEventModel->update($data_risk_event[$k]['id'],$data_num);

                    $risk_num +=1;
                }

                /////////////////
                //update nomor risiko target
                //get all risk event in selected year
                $data_risk_event1 = $this->RiskEventModel->get_list_risk_event_target($this->request->getPost('year'));

                $sort1 = array();
                foreach($data_risk_event1 as $k=>$v) {
                    $sort1['target_final_level'][$k] = $v['target_final_level'];
                    $sort1['level'][$k] = $v['level'];
                }
                array_multisort($sort1['target_final_level'], SORT_DESC, $sort1['level'], SORT_DESC,$data_risk_event1);
                
                // //update risk number
                $risk_number = 1;
                for($l=0; $l<count($data_risk_event1); $l++) {
                
                    $data_number['risk_number_target'] = $risk_number;
                    $this->RiskEventModel->update($data_risk_event1[$l]['id'],$data_number);

                    $risk_number +=1;
                }
                /////////////////

                
                echo json_encode(array("status" => TRUE));
            }catch (\Exception $e) {
                
            }

          }

        
    }
    public function display_data(){
        /////////////////
        ///update nomor risiko target
        //get all risk event in selected year
        $data_risk_event = $this->RiskEventModel->get_list_risk_event_target('2022');

        $sort = array();
        foreach($data_risk_event as $k=>$v) {
            $sort['target_final_level'][$k] = $v['target_final_level'];
            $sort['level'][$k] = $v['level'];
        }
        array_multisort($sort['target_final_level'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
        
        //update risk number
        $risk_num = 1;
        for($k=0; $k<count($data_risk_event); $k++) {
            echo $risk_num."-".$data_risk_event[$k]['id'];
            echo '<br/>';
            $data_number['risk_number_target'] = $risk_num;
            $this->RiskEventModel->update($data_risk_event[$k]['id'],$data_number);

            $risk_num +=1;
        }
        /////////////////
    }

    public function onAddDetailRisk(){
        try {
            $risk_causes = json_decode($_POST['risk_cause']);
            $id_risk_event = json_decode($_POST['id_risk_event']);
            $division_assignment = json_decode($_POST['division_assignment']);
            $risk_categories = json_decode($_POST['risk_category']);
            $risk_event = json_decode($_POST['risk_event']);
            $year = json_decode($_POST['year']);

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
            $division_assignment_num = count($division_assignment);
            if($division_assignment_num > 0){
                $not_deleted_id_array=array();

                for($j = 0; $j < $division_assignment_num; $j++){
                    $arr = explode(".",$division_assignment[$j]);
                    
                    
                    //cek whether updated or inserted
                    if($arr[2]){
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
                            
                            $arr1 = explode(",",$arr[1]);
                            //get id mitigation division by updated id and id division
                            $arr_id_not_deleted_division = array();
                            

                            for($k = 0; $k < count($arr1); $k++){

                                $id_mitigation_division = $this->RiskMitigationDivisionModel
                                ->where('id_division',$arr1[$k])
                                ->where('id_risk_mitigation',$arr[2])
                                ->select('id')->first();
                                if($id_mitigation_division){
                                    array_push($arr_id_not_deleted_division, $arr1[$k]);
                                    $data2 = [
                                        'id_risk_mitigation' => $arr[2],
                                        'id_division' =>$arr1[$k],
                                        'is_active' => "1",
                                    ];
                                    $this->RiskMitigationDivisionModel->update($id_mitigation_division,$data2);
                                
                                }else{
                                    array_push($arr_id_not_deleted_division, $arr1[$k]);
                                    $data2 = [
                                        'id_risk_mitigation' => $arr[2],
                                        'id_division' =>$arr1[$k],
                                        'is_active' => "1",
                                    ];
                                    $this->RiskMitigationDivisionModel->insert($data2);
                                }
                            }

                            //delete
                            $not_deleted_id_division= implode(",",$arr_id_not_deleted_division);;
                            $this->RiskMitigationDivisionModel->delete_not_in_divison($not_deleted_id_division, $arr[2]);

                        }
                    }else{
                        //do insert
                        $risk_mitigation_name = $arr[0];
                    
                        //add risk mitigation tabel get inserted id
                        $data = [
                                'id_risk_event' => $id_risk_event,
                                'risk_mitigation' =>$risk_mitigation_name,
                                'is_active' => "1",
                        ];

                        $inserted_id = $this->RiskMitigationModel->insert($data);
                        array_push($not_deleted_id_array, $inserted_id);
                        $arr1 = explode(",",$arr[1]);

                        for($k = 0; $k < count($arr1); $k++){
                            //add risk assignment table using inserted id
                            $data2 = [
                                'id_risk_mitigation' => $inserted_id,
                                'id_division' =>$arr1[$k],
                                'is_active' => "1",
                            ];
                            $this->RiskMitigationDivisionModel->insert($data2);
                            
                        }
                    }
                }

                $not_deleted_id= implode(",",$not_deleted_id_array);;
                $this->RiskMitigationModel->delete_not_in($not_deleted_id, $id_risk_event);
                
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

            //update nomor resiko lagi
            //get all risk event in selected year
            $data_risk_event = $this->RiskEventModel->get_list_risk_event($year);

            $sort = array();
            foreach($data_risk_event as $k=>$v) {
                $sort['final_level'][$k] = $v['final_level'];
                $sort['level'][$k] = $v['level'];
            }
            array_multisort($sort['final_level'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
           
            //update risk number
            $risk_num = 1;
            for($k=0; $k<count($data_risk_event); $k++) {
                $data_num['risk_number'] = $risk_num;
                $this->RiskEventModel->update($data_risk_event[$k]['id'],$data_num);

                $risk_num += 1;
            }

            /////////////////
            ///update nomor risiko target
            //get all risk event in selected year
            $data_risk_event = $this->RiskEventModel->get_list_risk_event_target($this->request->getPost('year'));

            $sort = array();
            foreach($data_risk_event as $k=>$v) {
                $sort['target_final_level'][$k] = $v['target_final_level'];
                $sort['level'][$k] = $v['level'];
            }
            array_multisort($sort['target_final_level'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
            
            //update risk number
            $risk_num = 1;
            for($k=0; $k<count($data_risk_event); $k++) {
           
                $data_number['risk_number_target'] = $risk_num;
                $this->RiskEventModel->update($data_risk_event[$k]['id'],$data_number);

                $risk_num +=1;
            }
            ///////////////

            echo json_encode(array("status" => TRUE));
            //echo json_encode(array("status" => $not_deleted_id));
        }catch (\Exception $e) {
            
        }
    }

    public function onAddRiskResidual(){
        if (! $this->validate([
            'probability_level_residual' => 'required',
            'impact_level_residual' => 'required',
            'final_level_residual' => 'required',
        ])) {
            throw new \Exception("Some message goes here");
        }else{
            //get inserted level
            $residual_level_inserted = $this->request->getPost('probability_level_residual') * $this->request->getPost('impact_level_residual');
            $id_risk_event = $this->request->getPost('id_risk_event');
            try {
                $data = [
                        'probability_level_residual' => $this->request->getPost('probability_level_residual'),
                        'impact_level_residual' => $this->request->getPost('impact_level_residual'),
                        'final_level_residual' => $this->request->getPost('final_level_residual'),
                        'risk_analysis_residual' => $this->request->getPost('risk_analysis_residual'),
                        'risk_impact_quantitative' => $this->request->getPost('r'), //$this->request->getPost('risk_impact_quantitative'),
                        'description' => $this->request->getPost('description'),
                        ];

                $this->RiskEventModel->update($id_risk_event,$data);
            
                /////////////////
                ///update nomor risiko residual
                //get all risk event in selected year
                $data_risk_event = $this->RiskEventModel->get_list_risk_event_residual($this->request->getPost('year'));

                $sort = array();
                foreach($data_risk_event as $k=>$v) {
                    $sort['final_level_residual'][$k] = $v['final_level_residual'];
                    $sort['level'][$k] = $v['level'];
                }
                array_multisort($sort['final_level_residual'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
                
                //update risk number
                $risk_num = 1;
                for($k=0; $k<count($data_risk_event); $k++) {
                    
                    $data_number['risk_number_residual'] = $risk_num;
                    $this->RiskEventModel->update($data_risk_event[$k]['id'],$data_number);

                    $risk_num +=1;
                }
                ///////////////
                
                echo json_encode(array("status" => $data));
            }catch (\Exception $e) {
                
            }
        }
        
    }

    public function getDetailRiskEvent($id) {
		$data = [
            'title'=>'Risk Events',
            'breadcrumb'=>' Home  <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            Risk Register <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            Detail Risiko',
            'content'=>'admin/pages/risk_event/edit',
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'risk_category_list'=> $this->RiskCategoryModel->get_list_risk_category(),
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

    public function getDetailRiskResidual($id_risk_event){
        $data = [
            'title'=>'Risk Events',
            'breadcrumb'=>'Home  <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Risk Register
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Update Progress',
            'content'=>'admin/pages/risk_event/residual',
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'id_risk_event'=> $id_risk_event,
            'detail_risk_event' => $this->RiskEventModel->get_risk_event($id_risk_event)
        ];
        echo view('admin/template/template',$data);
    }

}
