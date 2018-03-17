<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('Depositos');
	}

	public function index($permission)
	{
		$data['list'] = $this->Depositos->deposito_List();
		$data['permission'] = $permission;
		$this->load->view('deposito/list', $data);
	}
	
	
	public function getpencil(){

		$id=$_GET['id_depo'];
		//print_r($id);
		$result = $this->Depositos->getpencil($id);
		print_r(json_encode($result));

	}

	public function edit_deposito(){

	    $datos=$_POST['parametros'];
	    $id=$_POST['ed'];
		

		$result = $this->Depositos->update_editar($datos,$id);
		return true;
  	}

  	public function agregar_deposito(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Depositos->agregar_depositos($datos);
	      	//print_r($this->db->insert_id());
	      	
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

  	public function baja_deposito(){
	
		$iddepo=$_POST['id_depo'];
		
		$result = $this->Depositos->eliminacion($iddepo);
		print_r($result);
	
	}

	
	
}
