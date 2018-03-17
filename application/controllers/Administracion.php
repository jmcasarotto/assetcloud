<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Administraciones');
	}

		public function index($permission)
	{		
		$data['list'] = $this->Administraciones->otrabajos_List();
		$data['permission'] = $permission;		
		$this->load->view('administracion/list', $data);
	}


	public function cargartarea($permission,$idglob){ 
		$data['list'] = $this->Administraciones->cargartareas($idglob);
		//var_dump($idglob);
		$data['id_orden'] = $idglob; 
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('administracion/pedido',$data); //equipo controlador 
    }
	


  	public function agregar_pedido()
	{

	    $num=$_POST['numero'];
	    $idop=$_POST['iort'];
	    $fecha = date("Y-m-d H:i:s");

	   //date('Y-m-d H:i:s')
	   
	   $arre=array();
	    $datos = array(
			       	 'fecha_entregada'=> $fecha, 
			       	 'estado'=>'E',
			         'numero_remito'=>$num

			        	 
		       		);
	    	
 //$idop, $num, $fecha
	    $result2 = $this->Administraciones->update_ordpedid($idop,  $datos);
	    
	   	return $result2; 		
	   
  	}
  	
  	
	

	
 
}