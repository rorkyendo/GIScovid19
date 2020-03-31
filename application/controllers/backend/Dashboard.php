<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
		*created by https://medandigitalinnovation.com
		*Estimate 2019
	 */

	public function __construct(){
		parent::__construct();
        if($this->session->userdata('LoggedIN') == FALSE )
        {
            redirect('Auth/logout');
        }
	}

	private $title = 'Dashboard';

	public function index()
	{
		$data['title'] = $this->title;
		$data['subtitle'] = 'PantauCorona V1';
		$data['sembuh'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Sembuh');
		$data['pdp'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','PDP');
		$data['positif'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Positif');
		$data['meninggal'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Meninggal');
		$data['content'] = 'backend/dashboard/index';
		$this->load->view('backend/content',$data);
	}

}
