<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskMitigations;
use App\Models\Divisions;
use App\Models\RiskMitigationDivisions;


class RiskMitigationController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskMitigationModel = new RiskMitigations();
        $this->DivisionModel = new Divisions();
        $this->RiskMitigationDivisionModel = new RiskMitigationDivisions();
    }

    public function getRiskMitigationList($id_risk)
    {
        $data = [
            'risk_mitigation_list'=> $this->RiskMitigationModel->get_list_risk_mitigation($id_risk),
            'risk_division_list'=> $this->DivisionModel->get_list_divisions()
        ];
		
		echo json_encode($data);
    }

    public function getRiskMitigationDivision($id_risk_mitigation){
        
        $data = $this->RiskMitigationDivisionModel->get_risk_division_by_risk_mitigation_id($id_risk_mitigation);

        echo json_encode($data);
    }
    
}
