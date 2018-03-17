<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sector extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('sectores');
	}

	public function index($permission)
	{
		$data['list'] = $this->sectores->grupo_List();
		$data['permission'] = $permission;
		$this->load->view('sectores/list', $data);
	}
	
	public function getsector(){
		$data['data'] = $this->sectores->getsectores($this->input->post());
		$response['html'] = $this->load->view('sectores/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setsector(){
		$data = $this->sectores->setsectores($this->input->post());
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
