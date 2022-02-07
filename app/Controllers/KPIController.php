<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\KPIs;

class KPIController extends BaseController
{
    function __construct(){
		helper(['form', 'url']);
		$this->KPIModel = new KPIs();
    }

    public function index(){
		$data = [
            'title'=>'KPI',
            'content'=>'admin/pages/kpi/index'
        ];
        echo view('admin/template/template',$data);
    }
}
