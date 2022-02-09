<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;

class RiskEventController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
    }
    
    public function index()
    {
        $data = [
            'title'=>'Risk Events',
            'content'=>'admin/pages/risk_event/index'
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
        $totalRecords = $this->RiskCategoriesModel->select('id')
                ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->RiskEventModel->select('id')
                ->orLike('name', $searchValue)
                ->countAllResults();

        ## Fetch records
        $records = $this->RiskEventModel
                ->select('*')
                ->orLike('name', $searchValue)
                ->orLike('is_active', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);

        $records = $this->RiskEventModel
                ->join('kpis', 'kpis.id = risk_events.id_kpi')
                ->select('risk_events.id as id, kpis.name as kpi_name, risk_number, risk_event, risk_events.is_active, year')
                ->orLike('risk_events.risk_event', $searchValue)
                ->orLike('risk_events.is_active', $searchValue)
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
}
