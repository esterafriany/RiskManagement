<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskCauses;

class RiskCauseController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskCauseModel = new RiskCauses();
    }

    public function index()
    {
        //
    }

    public function getRiskCauseList($id_risk_event){
        $data = $this->RiskCauseModel->get_list_risk_cause($id_risk_event);
		
		echo json_encode($data);
    }

    public function onDeleteRiskCause($id){
        try {
          $this->RiskCauseModel->delete($id);
          echo json_encode(array("status" => TRUE));
        }catch (\Exception $e) {
          
        }
    }

}
