<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskCategories;

class RiskCategoryController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskCategoryModel = new RiskCategories();
    }

    public function getRiskCategoryList(){
        $data = $this->RiskCategoryModel->get_list_risk_category();
		
		echo json_encode($data);
    }

    public function getRiskCategoryByRiskEvent($id_risk){
        $data = $this->RiskCategoryModel->get_list_risk_category_by_risk_id($id_risk);

        $data = [
            'risk_event_category_list'=> $this->RiskCategoryModel->get_list_risk_category_by_risk_id($id_risk),
            'risk_category_list'=> $this->RiskCategoryModel->get_list_risk_category()
        ];
		
		echo json_encode($data);
    }
}
