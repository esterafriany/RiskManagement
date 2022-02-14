<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskMitigations;


class RiskMitigationController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskMitigationModel = new RiskMitigations();
    }

    public function getRiskMitigationList()
    {
        $data = $this->RiskMitigationModel->get_list_risk_mitigation();
		
		echo json_encode($data);
    }
}
