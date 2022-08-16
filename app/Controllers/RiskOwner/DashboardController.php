<?php

namespace App\Controllers\RiskOwner;
use App\Controllers\BaseController;

use App\Models\RiskEvents;
use App\Models\RiskCategories;
use App\Models\RiskMitigations;
use App\Models\Divisions;
use App\Models\KPIs;

class DashboardController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
        $this->RiskCategoryModel = new RiskCategories();
        $this->DivisionModel = new Divisions();
        $this->KPIModel = new KPIs();
        $this->RiskMitigationModel = new RiskMitigations();
    }

    public function index()
    {
        $data = [
            'title'=>'Risk Register Apps',
            'content'=>'risk_owner/pages/dashboard/dashboard',
            'breadcrumb'=>
            '<a href='.base_url('risk_owner/dashboards').'>Home</a>  
                <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Dashboard',
            'total_risk_category'=> $this->RiskCategoryModel->select('*')->countAllResults(),
            'total_division'=> $this->DivisionModel->select('*')->countAllResults(),
            'total_kpi'=> $this->KPIModel->select('*')->countAllResults(),
            
        ];

        //get listDivisionId
        $list_division = $this->DivisionModel->get_list_divisions();
        
        if(date('d') >= '1' && date('d') <='15'){
            $month = date('m', strtotime('-2 month'));
            
        }else if(date('d') >= '16' && date('d') <= date('t')){
            $month = date('m', strtotime('-1 month'));
            

        }
        $year = '2022';

        $array = array();
        for($i=0; $i<count($list_division); $i++){
            $temp_target = $this->RiskMitigationModel->get_count_target($list_division[$i]['id'], $year, $month);
            $temp_realisasi = $this->RiskMitigationModel->get_count_monitoring($list_division[$i]['id'], $year, $month);
            
            if($temp_target->target != '0'){
                $percent = $temp_realisasi->realisasi /$temp_target->target * 100;
            }else{
                $percent = 0;
            }
            
            $array[$i] = array($list_division[$i]['name'],$percent);
        }

        $data['percentage'] = $array;

        if($month == '01'){
            $month_name = 'Januari';
        }else if($month == '02'){
            $month_name = 'Februari';
        }else if($month == '03'){
            $month_name = 'Maret';
        }else if($month == '04'){
            $month_name = 'April';
        }else if($month == '05'){
            $month_name = 'Mei';
        }else if($month == '06'){
            $month_name = 'Juni';
        }else if($month == '07'){
            $month_name = 'Juli';
        }else if($month == '08'){
            $month_name = 'Agustus';
        }else if($month == '09'){
            $month_name = 'September';
        }else if($month == '10'){
            $month_name = 'Oktober';
        }else if($month == '11'){
            $month_name = 'November';
        }else if($month == '12'){
            $month_name = 'Desember';
        }

        $data['month_name'] = $month_name;

        echo view('risk_owner/template/dashboard_template',$data);
    }

    public function onGetDataMatrix($year) {
		$data = $this->RiskEventModel->get_data_matrix($year);
		
		echo json_encode($data);
	}

    public function onGetDataMatrixRiskOwner($year, $id_division) {		
        $data = [
            'all_data_matrix' => $this->RiskEventModel->get_data_matrix($year),
            'data_matrix_risk_owner'=> $this->RiskEventModel->get_data_matrix_risk_owner($year, $id_division),
        ];
		
		echo json_encode($data);
	}

    public function onGetDataMatrixProgress($year) {
		$data = $this->RiskEventModel->get_data_progress_matrix($year);
		
		echo json_encode($data);
	}

    public function view_probability_criteria()
    {
        $data = [
            'title'=>'Kriteria Kemungkinan',
            'breadcrumb'=>
                '<a href='.base_url('risk_owner/dashboards').'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                                  <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Kriteria Kemungkinan',
            'content'=>'risk_owner/pages/risk_terms/probability_criteria',
        ];

        echo view('risk_owner/template/template',$data);
    }

    public function view_impact_criteria()
    {
        $data = [
            'title'=>'Kriteria Impact',
            'breadcrumb'=>
                '<a href='.base_url('risk_owner/dashboards').'>Home</a>  
                    <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                                  <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                Kriteria Kemungkinan',
            'content'=>'risk_owner/pages/risk_terms/impact_criteria',
        ];

        echo view('risk_owner/template/template',$data);
    }
}
