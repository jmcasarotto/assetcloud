<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grupo extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('Grupos');
	}

	public function index($permission)
	{
		$data['list'] = $this->Grupos->grupo_List();
		$data['permission'] = $permission;
		$this->load->view('grupos/list', $data);
	}
	
	public function getgrupos(){
		$data['data'] = $this->Grupos->getgrupo($this->input->post());
		$response['html'] = $this->load->view('grupos/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setgrupos(){
		$data = $this->Grupos->setgrupo($this->input->post());
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
