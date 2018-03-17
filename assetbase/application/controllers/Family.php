<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class family extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('Familys');
	}

	public function index($permission)
	{
		$data['list'] = $this->Familys->Family_List();
		$data['permission'] = $permission;
		$this->load->view('familys/list', $data);
	}
	
	public function getFamily(){
		$data['data'] = $this->Familys->getFamily($this->input->post());
		$response['html'] = $this->load->view('familys/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setFamily(){
		$data = $this->Familys->setFamily($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);	
		}
	}
	
	public function indexSF($permission)
	{
		$data['list'] = $this->Familys->FamilySF_List();
		$data['permission'] = $permission;
		$this->load->view('familys/listSF', $data);
	}

	public function getSFFamily(){
		$data['data'] = $this->Familys->getSFFamily($this->input->post());
		$response['html'] = $this->load->view('familys/viewSF_', $data, true);

		echo json_encode($response);
	}

	public function setSFFamily(){
		$data = $this->Familys->setSFFamily($this->input->post());
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
