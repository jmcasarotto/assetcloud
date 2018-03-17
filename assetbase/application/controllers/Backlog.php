<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backlog extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Backlogs');
	}

	public function index($permission)
	{
		$data['list'] = $this->Backlogs->backlog_List();
		$data['permission'] = $permission;
		$this->load->view('backlog/list', $data);
	}

	public function cargarback($permission){ 
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('backlog/view_',$data);
    }

	public function getequipo(){
		
		$equipo = $this->Backlogs->getequipo();
		//echo json_encode($Customers);

		if($equipo)
		{	
			$arre=array();
	        foreach ($equipo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function gettarea(){
	
		$tarea = $this->Backlogs->gettareas();
		
		if($tarea)
		{	
			$arre=array();
	        foreach ($tarea as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getcantidad(){
		
		$cantidad = $this->Backlogs->getcantidad($this->input->post());
		if($cantidad)
		{	
			$arre=array();
	        foreach ($cantidad as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	
  	public function guardar_backlog(){
		
		$parametros=$_POST['parametros'];
		$fe=$_POST['fecha'];
		$eq=$_POST['equipo'];
		$ta=$_POST['tarea'];
		$hs=$_POST['horas'];
		
		
		$uno=substr($fe, 0, 2); 
        $dos=substr($fe, 3, 2); 
        $tres=substr($fe, 6, 4); 
        $resul = ($tres."/".$dos."/".$uno); 
		$datos = array(
						'id_equipo'=>$eq,
						'tarea_descrip'=>$ta,
						
						'fecha'=>$resul,
						'horash' =>$hs,
						
						'estado'=>'C');
		$result = $this->Backlogs->insert_backlog($datos);
			
		print_r($result);
	}
		

	public function geteditar(){

		$id=$_GET['idpred'];
		$ide=$_GET['datos'];

		$result = $this->Backlogs->geteditar($id);
		if($result){	

			$arre['datos']=$result;
			$result2 = $this->Backlogs->traerequiposprev($ide,$id);
			if($result2){

				$arre['equipo']=$result2;
			}
			else 
				$arre['equipo']=0;
			
			echo json_encode($arre);

		}
		else echo "nada";
	}
	//Cambia de estado a "AN"
	public function baja_backlog(){
	
		$idpre=$_POST['gloid'];
		
		$datos = array('estado'=>"AN");

		//doy de baja
		$result = $this->Backlogs->update_back($datos, $idpre);
		print_r($result);
	
	}

	public function getbacklog(){

		$idb=$_POST['idB'];
		$ideq=$_POST['datos'];
		$datos=	$this->Backlogs->getbacklogs($idb,$ideq);

		if($datos){	
				$arre=array();
		        foreach ($datos as $row ) 
		        {   
		           $arre[]=$row;
		        }
				echo json_encode($arre);
			}
			else echo "nada";

	}

	public function backloginertot(){

		$eq=$_POST['equipo'];
		$tar=$_POST['tarea'];
		$fe=$_POST['fecha'];
		$idp=$_POST['idB'];
		$userdata = $this->session->userdata('user_data');
		$usrId = $userdata[0]['usrId'];

		$insert = array(
				   'nro' => $idp,
				   'fecha_inicio' => $fe,
				   'descripcion' => 'Backlog',			   
				   'estado' => 'C',
				   'id_usuario' => $usrId,
				   'id_usuario_a' => $usrId,
				   'id_sucursal' => 1,
				   'id_equipo' => $eq,
				   'id_tarea' => $tar,
				   'tipo'=> 4
				   );

		$result = $this->Backlogs->insert_backlogorden($insert);			
		print_r($result);

		
	}

	public function editar_backlog(){

		
		$fe=$_POST['fecha'];
		$eq=$_POST['equipo'];
		$ta=$_POST['tarea'];
		
		$id=$_POST['gloid'];
		
		$uno=substr($fe, 0, 2); 
        $dos=substr($fe, 3, 2); 
        $tres=substr($fe, 6, 4); 
        $resul = ($tres."/".$dos."/".$uno); 
		$datos = array(
						'id_equipo'=>$eq,
						'tarea_descrip'=>$ta,
						'fecha'=>$resul

				);

		$result1 = $this->Backlogs->update_back($datos,$id);			
		print_r($result1);

	}

	


}