<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
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
            'breadcrumb'=>'
            <a href='.base_url().'>Home</a>
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                             Dashboard',
            'content'=>'admin/pages/dashboard/dashboard',
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
            $percent = $temp_realisasi->realisasi /$temp_target->target * 100;
            
            $array[$i] = array($list_division[$i]['name'],$percent);
        }

        $data['percentage'] = $array;
      

        echo view('admin/template/dashboard_template',$data);
    }

    public function onGetDataMatrix($year) {
		$data = $this->RiskEventModel->get_data_matrix($year);
		
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
            'breadcrumb' => '
            <a href='.base_url().'>Home</a>
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Kamus Data<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Kriteria Kemungkinan',
            'content'=>'admin/pages/risk_terms/probability_criteria',
        ];

        echo view('admin/template/template',$data);
    }

    public function view_impact_criteria()
    {
        $data = [
            'title'=>'Kriteria Dampak',
            'breadcrumb' => '
            <a href='.base_url().'>Home</a>
            <svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Kamus Data<svg width="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>Kriteria Dampak',
            'content'=>'admin/pages/risk_terms/impact_criteria',
        ];

        echo view('admin/template/template',$data);
    }
}
