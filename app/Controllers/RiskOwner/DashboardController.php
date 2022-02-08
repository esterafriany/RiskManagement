<?php

namespace App\Controllers\RiskOwner;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title'=>'title here',
            'content'=>'risk_owner/pages/dashboard/dashboard'
        ];
        echo view('risk_owner/template/dashboard_template',$data);
    }
}
