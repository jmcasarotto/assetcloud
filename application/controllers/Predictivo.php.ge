<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predictivo extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Predictivos');
		$this->load->model('Otrabajos');
	}

	public function index($permission)
	{
		$data['list'] = $this->Predictivos->predictivo_List();
		$data['permission'] = $permission;
		$this->load->view('predictivo/list', $data);
	}

	public function cargarpredictivo($permission){ 
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('predictivo/view_',$data);
    }
    public function volver($permission){ 
    	$data['list'] = $this->Otrabajos->otrabajos_List();
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('otrabajos/list',$data);
    }


	public function getequipo(){
		
		$equipo = $this->Predictivos->getequipo();
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
	
	public function getpredictivo(){

		$idpe=$_POST['idp'];
		$ideq=$_POST['datos'];
		$datos=	$this->Predictivos->getpredictivos($idpe,$ideq);

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

	
  	public function guardar_predictivo(){
		
		$parametros=$_POST['parametros'];
		$fe=$_POST['fecha'];
		$eq=$_POST['equipo'];
		$can=$_POST['cantidad'];
		$ta=$_POST['tarea'];
		$per=$_POST['periodo'];
		$hs=$_POST['horas'];
		
		$uno=substr($fe, 0, 2); 
        $dos=substr($fe, 3, 2); 
        $tres=substr($fe, 6, 4); 
        $resul = ($tres."/".$dos."/".$uno); 
		$datos = array(
						'id_equipo'=>$eq,
						'tarea_descrip'=>$ta,
						'periodo'=>$per,
						'fecha'=>$resul,
						'cantidad'=>$can,
						'horash'=>$hs,
						'estado'=>'C');

		$result = $this->Predictivos->insert_predictivo($datos);			
		print_r($result);
		
	}
		

	public function geteditar(){

		$id=$_GET['idpred'];
		$ide=$_GET['datos'];

		$result = $this->Predictivos->geteditar($id);
		if($result){	

			$arre['datos']=$result;
			$result2 = $this->Predictivos->traerequiposprev($ide,$id);
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
	public function baja_predictivo(){
	
		$idpre=$_POST['gloid'];
		
		$datos = array('estado'=>"AN");

		//doy de baja
		$result = $this->Predictivos->update_predictivo($datos, $idpre);
		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function predictivoinertot(){

		$eq=$_POST['equipo'];
		$tar=$_POST['tarea'];
		$fe=$_POST['fecha'];
		$idp=$_POST['idp'];
		$userdata = $this->session->userdata('user_data');
		$usrId = $userdata[0]['usrId'];

		$insert = array(
				   'nro' => $idp,
				   'fecha_inicio' => $fe,
				   'descripcion' => 'Predictivo',			   
				   'estado' => 'C',
				   'id_usuario' => $usrId,
				   'id_usuario_a' => $usrId,
				   'id_sucursal' => 1,
				   'id_equipo' => $eq,
				   'id_tarea' => $tar,
				   'tipo'=> 5
				   );

		$result = $this->Predictivos->insert_predictivoorden($insert);			
		print_r($result);

		
	}

	public function editar_predictivo(){

		
		$fe=$_POST['fecha'];
		$eq=$_POST['equipo'];
		$can=$_POST['cantidad'];
		$ta=$_POST['tarea'];
		$per=$_POST['periodo'];
		$id=$_POST['globi'];
		
		$uno=substr($fe, 0, 2); 
        $dos=substr($fe, 3, 2); 
        $tres=substr($fe, 6, 4); 
        $resul = ($tres."/".$dos."/".$uno); 
		$datos = array(
						'id_equipo'=>$eq,
						'tarea_descrip'=>$ta,
						'fecha'=>$resul,
						'periodo'=>$per,
						'cantidad'=>$can
						

				);

		$result1 = $this->Predictivos->update_predictivo($datos,$id);			
		print_r($result1);

	}
	


}