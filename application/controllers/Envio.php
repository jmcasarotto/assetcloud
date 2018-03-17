<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Envio extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Envios');
	}

	public function index($permission)
	{
		$data['list'] = $this->Envios->envios_List();
		$data['permission'] = $permission;
		$this->load->view('envio/list', $data);
	}
	
	public function entrega()
	{
	
		$idequipo=$_POST['id_orden'];
		$fecha = date("Y-m-d");
		//$datos = array('estado'=>'E');

		//doy de baja
		$result = $this->Envios->entregas($idequipo, $fecha);
		print_r($result);
	
	}

	public function ModificarFecha(){
	
		$ido=$_POST['ido'];
		$fe=$_POST['fe'];
		
		$uno=substr($fe, 0, 2); 
        $dos=substr($fe, 3, 2); 
        $tres=substr($fe, 6, 4); 
        $resulfe = ($tres."/".$dos."/".$uno); 
		$datos = array('fecha_entrega'=>$resul,
						'estado' =>'As');

	
		$result = $this->Envios->ModificarFechas($ido, $datos);
		print_r($result);
	
	}

	

}