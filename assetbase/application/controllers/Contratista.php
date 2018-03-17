<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratista extends CI_Controller {
	function __construct()
        {
		parent::__construct();
		$this->load->model('Contratistas');
	}

	public function index($permission)
	{
		$data['list'] = $this->Contratistas->contratistas_List();
		$data['permission'] = $permission;
		$this->load->view('contratistas/list', $data);
	}
	
	public function getcontratista(){
		$data['data'] = $this->Contratistas->getcontratistas($this->input->post());
		$response['html'] = $this->load->view('contratistas/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setcontratista(){
		$data = $this->Contratistas->setcontratistas($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);	
		}
	}
	
	public function baja_contratista(){
  
    $idpa=$_POST['idpa'];
    
    $result = $this->Contratistas->eliminacion($idpa);
    print_r($result);
  
  }

  public function getpencil(){

    $id=$_GET['id_pa'];
    //print_r($id);
    $result = $this->Contratistas->getpencil($id);
    print_r(json_encode($result));

  }

  public function edit_contratista(){

    $datos=$_POST['parametros'];
    $id=$_POST['ed'];
    
    $result = $this->Contratistas->update_editar($datos,$id);
    return true;
    }


	

	
	
}
