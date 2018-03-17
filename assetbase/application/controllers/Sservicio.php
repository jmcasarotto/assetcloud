<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sservicio extends CI_Controller {
	
	function __construct(){

		parent::__construct();
		$this->load->model('Sservicios');
	}

	public function index($permission){
		
		$data['list'] = $this->Sservicios->servicios_List();
		$data['permission'] = $permission;
		$this->load->view('Sservicios/list', $data);
	}

	// public function indexSolicitante($permission){
		
	// 	//echo "est en el controller";
	// 	$data['list'] = $this->Sservicios->servicios_List();
	// 	$data['permission'] = $permission;
	// 	$this->load->view('Sservicios/list_solicitante', $data);
	// }

	function elimSolicitud(){
		$id = $this->input->post('id_solic');
		$response = $this->Sservicios->elimSolicitudes($id);
		echo json_encode($response);
	}

	
	
	public function activSolicitud(){
		$data = $this->input->post();
		$response = $this->Sservicios->activSolicitudes($data);
		echo json_encode($response);
	}

	public function getservicios(){

		$data['data'] = $this->Sservicios->getservicios($this->input->post());
		echo json_encode($response);
	}
	
	public function setservicios(){

		$data = $this->Sservicios->setservicios($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);	
		}
	}

	public function get_SolicTerminada(){

		$data['list'] = $this->Sservicios->get_SolicTerminadas();
		$data['permission'] = $permission;
		$this->load->view('Sservicios/list_term', $data);
	}

	public function getInfoEquipo(){

		$data = $this->Sservicios->getInfoEquipos($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);	
		}
	}
	
	public function getSector(){	
		
		$response = $this->Sservicios->getSectores($this->input->post());
      	echo json_encode($response);		
	}
	
	public function getEquipSector(){
		$response = $this->Sservicios->getEquipSectores($this->input->post());
      	echo json_encode($response);
	}

	public function getEquipo(){
		$response = $this->Sservicios->getEquipos($this->input->post());
      	echo json_encode($response);
	}
	
	public function getsolImp()
	{  
		$id=$_POST['idservicio'];

		$result = $this->Sservicios->getsolImps($id);		
		
		if($result)
		{	
			
			$arre['datos']=$result;
			print_r(json_encode($arre));
			
		}
		else echo "nada";
		//return json_encode($arre);
	}

	public function confSolicitud(){

		$data = $this->Sservicios->confSolicitudes($this->input->post());
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
