<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title'=>'title here',
            'content'=>'admin/pages/dashboard/dashboard'
        ];
        echo view('admin/template/dashboard_template',$data);
    }
}
