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
            'title'=>'title here',
            'content'=>'admin/pages/dashboard/dashboard',
            'total_risk_category'=> $this->RiskCategoryModel->select('*')->countAllResults(),
            'total_division'=> $this->DivisionModel->select('*')->countAllResults(),
            'total_kpi'=> $this->KPIModel->select('*')->countAllResults(),
            'progress_percentage'=> $this->RiskMitigationModel->get_progress_percentage_per_risk_owner('2022'),
            'progress_percentage_corporate'=> $this->RiskMitigationModel->get_progress_percentage_per_corporate('2022')
        ];

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
}
