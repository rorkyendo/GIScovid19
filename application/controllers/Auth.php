<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
		*created by https://medandigitalinnovation.com
		*Estimate 2019
	 */
	public function __construct()
  {
			parent::__construct();
  }

	public function index()
	{
    $this->login();
	}

  public function login($param1='',$param2=''){
		if ($param1=='do_login') {
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password'));
			$auth = $this->AuthModel->getAccountLogin($username,$password);
			if ($auth) {
				foreach ($auth as $key) {
					$loginSession = array(
						'user_id' => $key->user_id,
						'username' => $key->username,
						'hak_akses' => $key->hak_akses,
						'alamat' => $key->alamat,
						'email' => $key->email,
						'no_telp' => $key->no_telp,
						'LoggedIN' => TRUE
					);
				}
				$this->session->set_userdata($loginSession);
				redirect('backend/dashboard');
			}else {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Username atau Password yang anda masukkan salah!</div>');
				redirect('auth');
			}
		}else {
			$this->load->view('frontend/login/index');
		}
  }

	public function logout()
	{
		$this->session->set_userdata('login', 0);
		$this->session->sess_destroy();
    	$this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url(),'refresh');
	}


}
