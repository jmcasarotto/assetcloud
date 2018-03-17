<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Calendarios');
	}

	public function index($permission)
	{

		$data['list'] = $this->Calendarios->getPreventivosPorHora();
		$data['permission'] = $permission;
		$this->load->view('calendar/calendar', $data);
	}

	public function indexpred($permission)
	{

		$this->load->view('calendar/calendar2');
	}

	public function indexot($permission)
	{
		$data['list'] = $this->Calendarios->getPreventivosPorHora();

		$data['list1'] = $this->Calendarios->getpredlist();

		$data['list2'] = $this->Calendarios->getbacklog();
		$data['list3'] = $this->Calendarios->getPreventivos();
		$data['list4'] = $this->Calendarios->getsservicio();
		$data['permission'] = $permission;

		$this->load->view('calendar/calendar1', $data);
	}


	public function setot(){
		$dato = $this->input->post();

		$data = $this->Calendarios->setVisit($this->input->post());

		 if($data  == false)
		 {
			echo json_encode(false);

		 }
		 else
		 {
		 	echo json_encode($data);
		 }
	}


	public function getPreventivo(){
		$data = $this->Calendarios->getPreventivos($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);
		}
	}


	public function getcalendarot(){
		$data = $this->Calendarios->getot($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);
		}
	}

	public function getbacklog(){
		$data = $this->Calendarios->getbacklog($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);
		}
	}

	public function getcalendarpred(){
		$data = $this->Calendarios->getpred($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);
		}
	}


	///////////// Hugo
	public function guardar_agregar(){


	 	$data = $this->input->post();
	 	//dump_exit($data);

		$userdata = $this->session->userdata('user_data');
        $usrId= $userdata[0]['usrId'];

	    if($_POST) {

	    	$id_tarea = $_POST['id_tarea'];
	    	$id_pred = $_POST['id_pred'];	// id predic - correct
	    	$equipo = $_POST['ide'];
	    	$tipo = $_POST['tipo'];	// numero de tipo segun tbl_ordentrabajo
	    	$fecha_progr_pred = $_POST['fecha_progr_pred'];
	    	$fecha_progr_pred = explode('-', $fecha_progr_pred);
			$prog_pred = $fecha_progr_pred[2].'-'.$fecha_progr_pred[1].'-'.$fecha_progr_pred[0];
	    	$fecha_inicio = $_POST['fecha_inicio'];
	    	$descripcion = $_POST['descripcion'];	// descripcion del predictivo

	    	$datos2 = array(
	    				'id_tarea'=> $id_tarea,
			    		'nro'=> 1,	//por defecto( no se usa)
			    		'fecha'=> date('Y-m-d'),
			    		'fecha_program'=>  $prog_pred,
			    		'fecha_inicio'=> $fecha_inicio,
			    		'descripcion'=> $descripcion,
			    		'cliId'=> 1,	//por defecto( no se usa)
			    		'estado' =>'C',
			    		'id_usuario' => $usrId,
			    		'id_usuario_a' => 1,
			    		'id_usuario_e' => 1,
			    		'id_sucursal' => 1,
			    		'id_solicitud' =>  $id_pred,
			    		'tipo' => $tipo,	// tipo 5 es predictivo en tbl_tipoordentrabajo
			    		'id_equipo' => $equipo
		        		);

	     	$result = $this->Calendarios->guardar_agregar($datos2);
	      	//print_r($this->db->insert_id());
	      	/*if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;*/
	      	return true;
	    }
  	}

}