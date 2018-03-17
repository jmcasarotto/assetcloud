<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lectura extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Lecturas');
	}

	public function index($permission)
	{
		$data['list'] = $this->Lecturas->lectura_List();
		$data['permission'] = $permission;
		$this->load->view('lectura/lect', $data);
	}

	public function getequipo(){
		$this->load->model('Lecturas');
		$equipo = $this->Lecturas->getequipo();
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

	public function getcriticidad(){
		$this->load->model('LecturaS');
		$criticidad = $this->Lecturas->getcriticidad();
		//echo json_encode($Customers);

		if($criticidad)
		{	
			$arre=array();
	        foreach ($criticidad as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	
	public function guardar_lectura()
	{
		
		$datos=$_POST['data'];
		

		$result = $this->Lecturas->insert_lectura($datos);
		
		if($result)
		{
			$ultimoId=$this->db->insert_id(); 
			
			$arre=array();
		    
	        echo 1;
			
		}
		else echo "error al insertar";
	}

	public function getparametros(){
		//$this->load->model('Lecturas');
		$id = $datos=$_POST['id_equipo'];
		$parametros = $this->Lecturas->getparametros($id);
		if($parametros)
		{	
			$arre=array();
	        foreach ($parametros as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	/*public function guardar_lectura()
	{
		$datos=$_POST['data'];
		//$parametros=$_POST['idsparametro'];

		$result = $this->Lecturas->insert_lectura($datos);
		
		
	}*/

	public function guardar_parametro()
	{
		
		$id_equipo=$_POST['id_equipo'];
		$id_parametro=$_POST['id_parametro'];
		$valor=$_POST['valor'];

			$insert = array(
				   
				   'paramId' => $id_parametro,
				   'id_equipo' =>$id_equipo ,
				   'valor' => $valor,
				   'fechahora'=> date("Y-m-d H:i:s")
				   
			);
			$result = $this->Lecturas->insert_parametro($insert);
			print_r($result);

			// $datos2=array();
   //          //$cont= count($datos);
   //          $i=1;
	  //   	if(count($datos) > 0 )
	  //       	foreach ($datos as $row ) 
	  //       	{   
	  //       		while ($compo[$i]>0)
	        		 	 
	  //       		{
	        		
			//         	$datos2 = array(
			//         	 'id_equipo'=>$datos['id_equipo'], 
			//         	 'fechahora' =>date("Y-m-d H:i:s"), 
			//         	 'paramId'=>$row,
			//         	 'valor' =>$compo[$i]
			//         	);	


	  //         	$this->Lecturas->insert_parametro($datos2);
	  //         	$i++;
	  //         	print_r($datos2);
	  //         }
	         
	  //       }	        
	}

	public function bajaparametro(){
	
		$ide=$_POST['gloequip'];
		$idp=$_POST['gloparam']; 
		$va=$_POST['glovalor'];

		$result = $this->Lecturas->delete_p($ide,$idp,$va);
		print_r($result);
		
	}

	
	
	

}