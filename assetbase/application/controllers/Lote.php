<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lote extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Lotes');
	}

	public function index($permission)
	{
		$data['list'] = $this->Lotes->Lotes_List();
		$data['permission'] = $permission;
		$this->load->view('lotes/list', $data);
	}
	
	public function puntoPedList(){
		$data['list'] = $this->Lotes->puntoPedListado();
		$data['permission'] = $permission;
		$this->load->view('lotes/list_punto_ped', $data);
	}

	public function getMotion(){
		$data['data'] = $this->Stocks->getMotion($this->input->post());
		$response['html'] = $this->load->view('stock/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setMotion(){
		$data = $this->Stocks->setMotion($this->input->post());
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