<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('Marcas');
	}

	public function index($permission)
	{
		$data['list'] = $this->Marcas->marca_List();
		$data['permission'] = $permission;
		$this->load->view('marca/list', $data);
	}
	
	
	public function getpencil(){

		$id=$_GET['id_mar'];
		//print_r($id);
		$result = $this->Marcas->getpencil($id);
		print_r(json_encode($result));

	}

	public function edit_marca(){

	    $datos=$_POST['parametros'];
	    $id=$_POST['ed'];
		

		$result = $this->Marcas->update_editar($datos,$id);
		return true;
  	}

  	public function agregar_marca(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Marcas->agregar_marcas($datos);
	      	//print_r($this->db->insert_id());
	      	
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

	//Cambia de estado a "AN"
	public function baja_marca(){
	
		$idpre=$_POST['gloid'];
		
		$datos = array('estado'=>"AN");

		//doy de baja
		$result = $this->Marcas->update_marca($datos, $idpre);
		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}

	
	
}
