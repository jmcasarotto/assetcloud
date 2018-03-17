<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('Users');
	}

	public function index($permission)
	{
		$data['list'] = $this->Users->User_List();
		$data['permission'] = $permission;
		$this->load->view('users/list', $data);
	}

	public function getUser()
	{
		$data['data'] = $this->Users->getUser($this->input->post());
		$response['html'] = $this->load->view('users/view_', $data, true);

		echo json_encode($response);
	}

	public function setUser()
	{
		$data = $this->Users->setUser($this->input->post());

		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);
		}
	}


	public function test()
	{
		//Creamos las variables necesarias
		$dataForm['id'] = $_POST['id'];
		$dataForm['act'] = $_POST['act'];
		$dataForm['usrNick'] = $_POST['usrNick'];
		$dataForm['usrName'] = $_POST['usrName'];
		$dataForm['usrLastName'] = $_POST['usrLastName'];
		$dataForm['usrComision'] = $_POST['usrComision'];
		$dataForm['usrPassword'] = $_POST['usrPassword'];
		$dataForm['grpId'] = $_POST['grpId'];

		//Convertimos la información de la imagen en binario para insertarla en la BBDD
		if( $_FILES['imagen']['size'] != 0 ) {
			$imagenBinaria = file_get_contents($_FILES['imagen']['tmp_name']);
			$dataForm['usrimag'] = $imagenBinaria;
		} else {
			$dataForm['usrimag'] = '';
		}


		$data = $this->Users->setUser( $dataForm );

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
