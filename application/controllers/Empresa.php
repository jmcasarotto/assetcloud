<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empresa extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Empresas');
	}

	public function index($permission)
	{
		$data['list'] = $this->Empresas->Empresas_List();
		$data['permission'] = $permission;
		$this->load->view('empresas/list', $data);
	}

	public function getEmpresa()
	{
		$data['data'] = $this->Empresas->getEmpresa($this->input->post());
		$response['html'] = $this->load->view('empresas/view_', $data, true);

		echo json_encode($response);
	}

	public function setEmpresa()
	{
		$data = $this->Empresas->setEmpresa($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);
		}
	}

	public function baja_cliente()
	{
	    $idcliente=$_POST['idcli'];

    	$result = $this->Empresas->eliminacion($idcliente);
    	print_r(true);
	}


}