<?php defined('BASEPATH') OR exit('No direct script access allowed');

class  Ficha extends CI_Controller {

    public function __construct(){
        parent::__construct();
       $this->load->model('Fichas');
    }

    public function index($permission){    
    	
		$data['list'] = $this->Fichas->equipos_List();
		$data['permission'] = $permission;
		
		$this->load->view('ficha/list', $data);
		     
    }
    
    public function cargarequipo($permission,$idglob){ 
    	//$data['list'] = $this->Fichas->equipos($idglob);
        $data['permission'] = $permission;    // envia permisos  
        $data['id_equipo'] = $idglob;      
        $this->load->view('ficha/view_',$data);
    }

    public function cargarequipoDos($permission,$idglob){ 
    	$data['list'] = $this->Fichas->equipos($idglob);
        $data['permission'] = $permission;    // envia permisos  
        $data['id_equipo'] = $idglob;     

        $this->load->view('ficha/editar',$data);
    }
    //   public function cargarficha($permission,$idglob){ 
    //     // $data['list'] = $this->Fichas->equipos();
    //     $data['permission'] = $permission;    // envia permisos 
    //     $data['id_equipo'] = $idglob;      
    //     $this->load->view('ficha/view_',$data);
    // }

    public function getcodigo(){
		$this->load->model('Fichas');
		$empresa = $this->Fichas->getcodigos();
		//echo json_encode($Customers);

		if($empresa)
		{	
			$arre=array();
	        foreach ($empresa as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}



}
 


