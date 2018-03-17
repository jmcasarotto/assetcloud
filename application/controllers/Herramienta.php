<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Herramienta extends CI_Controller {

	function __construct() 
        {
		parent::__construct();
		$this->load->model('Herramientas');
		
	}

	public function index($permission)
	{
		$data['list'] = $this->Herramientas->herramientas_List();
		$data['permission'] = $permission;
		$this->load->view('herramienta/list', $data);
	}
	


	
	public function getmodelo(){
		$this->load->model('Herramientas');
		$empresa = $this->Herramientas->getmodelos();
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

	
	public function getdeposito(){
		$this->load->model('Herramientas');
		$empresa = $this->Herramientas->getdepositos();
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

	public function agregar_herramienta(){

      if($_POST){
        $datos=$_POST['parametros'];

        $result = $this->Herramientas->agregar_herramientas($datos);
          //print_r($this->db->insert_id());
          
          if($result)
            echo $this->db->insert_id();
          else echo 0;
      }
    }


  public function getpencil(){

    $id=$_GET['idh'];
    //print_r($id);
    $result = $this->Herramientas->getpencil($id);
    print_r(json_encode($result));

  }

  public function baja_herramienta(){
  
    $idherr=$_POST['id_herr'];
    
    $result = $this->Herramientas->eliminacion($idherr);
    print_r($result);
  
  }

  public function edit_herramienta(){

    $datos=$_POST['parametros'];
    $id=$_POST['ed'];
    
    $result = $this->Herramientas->update_editar($datos,$id);
    return true;
    }
}