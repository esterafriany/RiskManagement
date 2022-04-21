<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\Users;

class AuthenticationController extends BaseController
{
    private $session;

	public function __construct()
    {
        $this->UsersModel = new Users();
        session()->start();
    }

    public function index()
    {
        $this->session = \Config\Services::session();
        $this->session->set('key','12345');
        
		helper(['form']);
        if (empty(session()->get('email'))) {
			echo view('admin/template/login_header');
			echo view('admin/pages/authentication/login');
			echo view('admin/template/login_footer');
        } else {
            return redirect('get-dashboards');
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
				'division_name'       => $data['division_name'],
				'id_division'       => $data['id_division'],
				'isLoggedIn'      => TRUE
			];
			$session->set($ses_data);
            
			
            if(session()->get('id_group') == "1"){
                return redirect('get-dashboards');
            }else{
                return redirect('get-dashboard');
            }
            
			
        }else{
            $session->setFlashdata('msg', 'User tidak ditemukan. Periksa kembali email dan password Anda.');
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
