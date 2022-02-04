<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
		echo view('admin/template/header');
		echo view('admin/template/sidebar');
        echo view('admin/pages/dashboard/index');
    }
}
