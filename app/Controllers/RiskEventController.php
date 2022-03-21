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
        //get inserted level
        $level_inserted = $this->request->getPost('probability_level') * $this->request->getPost('impact_level');

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

            echo json_encode(array("status" => $data_risk_event));
        }catch (\Exception $e) {
            
        }
    }

    public function change(){
        //get all risk event in selected year
        $data_risk_event = $this->RiskEventModel->get_list_risk_event('2022');

      

        $sort = array();
        foreach($data_risk_event as $k=>$v) {
            $sort['final_level'][$k] = $v['final_level'];
            $sort['level'][$k] = $v['level'];
        }

        array_multisort($sort['final_level'], SORT_DESC, $sort['level'], SORT_DESC,$data_risk_event);
        dd($data_risk_event);
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
                $deleted_id_risk_mitigation = $this->RiskMitigationModel->get_deleted_risk_mitigation($id_risk_event);
                $valuee = count($deleted_id_risk_mitigation);
                for($num = 0; $num < count($deleted_id_risk_mitigation); $num++){
                    //delete risk mit division
                    $this->RiskMitigationDivisionModel->delete_by_id_risk_mitigation($deleted_id_risk_mitigation[$num]['id']); 
                }
                //delete risk mit
                $this->RiskMitigationModel->delete_by_id_risk($id_risk_event);

                //re-add risk mit
                for($j = 0; $j < $division_assignment_num; $j++){
                    $arr = explode(".",$division_assignment[$j]);
                    $risk_mitigation_name = $arr[0];
                    
                    //add risk mitigation tabel get inserted id
                    $data = [
                            'id_risk_event' => $id_risk_event,
                            'risk_mitigation' =>$risk_mitigation_name,
                            'is_active' => "1",
                    ];

                    $inserted_id = $this->RiskMitigationModel->insert($data);
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

                $risk_num +=1;
            }

            // echo json_encode(array("status" => TRUE));
            echo json_encode(array("status" => $year));
        }catch (\Exception $e) {
            
        }
    }

    public function getDetailRiskEvent($id) {
		$data = [
            'title'=>'Risk Events',
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
            'content'=>'admin/pages/risk_event/residual',
            'kpi_list'=> $this->KPIModel->get_list_kpis(),
            'detail_risk_event' => $this->RiskEventModel->get_risk_event($id_risk_event)
        ];
        echo view('admin/template/template',$data);
    }

}
