<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;

class DashboardController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
    }

    public function index()
    {
        $data = [
            'title'=>'title here',
            'content'=>'admin/pages/dashboard/dashboard'
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
