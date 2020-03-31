<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

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
		$data['content'] = 'frontend/info/index';
		$data['sembuh'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Sembuh');
		$data['pdp'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','PDP');
		$data['positif'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Positif');
		$data['meninggal'] = $this->GeneralModel->count_by_id_general('peta_wilayah','kp_name','Meninggal');
		$this->load->view('frontend/content',$data);
	}

	public function clusterMap(){
		$kategori = $this->GeneralModel->get_general('kategori_peta');
		foreach ($kategori as $key) {
			$data = $this->GeneralModel->get_by_id_general('peta_wilayah','kp_name',$key->kp_name);
			foreach ($data as $row) {
				$cluster[$key->kp_name][] = array(
						'lokasi' => $row->lokasi,
						'lat' => $row->lat,
						'lng' => $row->lon
				);
			}
		}
		echo json_encode($cluster);
	}

}
