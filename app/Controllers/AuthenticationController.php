<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\Users;

class AuthenticationController extends BaseController
{
	public function __construct()
    {
        $this->UsersModel = new Users();
    }

    public function index()
    {
		helper(['form']);
        if (empty(session()->get('email'))) {
			echo view('admin/template/login_header');
			echo view('admin/pages/authentication/login');
			echo view('admin/template/login_footer');
        } else {
            return redirect()->to(base_url('/'));
        }
    }
	
	public function login()
    {
		$session = session();
		
		$email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passdecryt = md5($password);
		
		$data = $this->UsersModel->login($email, $passdecryt);
	
		if($data){
			$ses_data = [
				'id'   => $data['id'],
				'name'      => $data['name'],
				'email'       => $data['email'],
				'id_group'       => $data['id_group'],
				'isLoggedIn'      => TRUE
			];
			$session->set($ses_data);
			
			return redirect('get-dashboards');
			
        }else{
            $session->setFlashdata('msg', 'User not Found');
            return redirect()->to(base_url('/'));
        }
    }
	
	function logout()
    {
        $session = session();
        session()->destroy();
		
        return redirect()->to(base_url('/'));
    }
	
}
