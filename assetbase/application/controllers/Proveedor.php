<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class proveedor extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('proveedores');
	}

	public function index($permission)
	{
		$data['list'] = $this->proveedores->proveedores_List();
		$data['permission'] = $permission;
		$this->load->view('proveedores/list', $data);
	}
	
	public function getproveedor(){
		$data['data'] = $this->proveedores->getproveedores($this->input->post());
		$response['html'] = $this->load->view('proveedores/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setproveedor(){
		$data = $this->proveedores->setproveedores($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);	
		}
	}
	
	

	
	
}
