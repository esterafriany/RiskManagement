<?php

namespace App\Controllers\RiskOwner;
use App\Controllers\BaseController;
use Illuminate\Http\Request;

//Model
use App\Models\RiskEvents;

class RiskEventController extends BaseController
{
    function __construct(){
        helper(['form', 'url']);
        $this->RiskEventModel = new RiskEvents();
    }
    
    public function index(){
        $data = [
            'title'=>'Risiko Utama',
            'content'=>'risk_owner/pages/risk_event/index'
          ];
          echo view('risk_owner/template/template',$data);
    }
}
