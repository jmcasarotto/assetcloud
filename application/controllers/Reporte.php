<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('Reportes');
	}

	public function index($permission){

		$data['permission'] = $permission;
		$this->load->view('reportes/view_', $data);
	}
	
	public function getReporte (){

		$data['ordenes'] = $this->Reportes->getRepOrdServicio($this->input->post());
      	$response['html'] = $this->load->view('reportes/orden_view_', $data, true);     
      	echo json_encode($response);		
	}
}