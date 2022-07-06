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
            'progress_percentage'=> $this->RiskMitigationModel->get_progress_percentage_per_risk_owner('2022'),
            'progress_percentage_corporate'=> $this->RiskMitigationModel->get_progress_percentage_per_corporate('2022')
        ];

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
