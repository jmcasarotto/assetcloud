<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportepedido extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('Reportepedidos');
	}

	public function index($permission){

		$data['permission'] = $permission;
		$this->load->view('reportepedido/view_', $data);
	}
	
	// public function getReporte (){

	// 	$data['ordenes'] = $this->Reportes->getRepOrdServicio($this->input->post());
 //      	$response['html'] = $this->load->view('reportes/orden_view_', $data, true);     
 //      	echo json_encode($response);		
	// }

	public function getequipo(){
		
		$ideq=$_POST['id_eq'];

		$equipo = $this->Reportepedidos->getequipos($ideq);
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
		else 
			echo json_encode(0);
	}
	
	public function getfecha(){
		
		$de=$_POST['de'];
		$hs=$_POST['a'];

		$uno=substr($de, 0, 2); //d
	  	$dos=substr($de, 3, 2); //m
	  	$tres=substr($de, 6, 4); //a
	  	$resul = ($tres."-".$dos."-".$uno); 

	  	$uno1=substr($hs, 0, 2); 
	   	$dos1=substr($hs, 3, 2); 
	   	$tres1=substr($hs, 6, 4); 
	   	$resul1 = ($tres1."-".$dos1."-".$uno1);
    
		$fecha = $this->Reportepedidos->getfechas($resul,$resul1);
		//echo json_encode($Customers);

		if($fecha)
		{	
			$arre=array();
	        foreach ($fecha as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}
	
	public function getarticulo(){
		$response = $this->Reportepedidos->getarticulos();
      	echo json_encode($response);
	}

	public function getorden(){
		$response = $this->Reportepedidos->getordenes();
      	echo json_encode($response);
	}
	
	public function getnota(){
		$response = $this->Reportepedidos->getnotas();
      	echo json_encode($response);
	}
	
	public function traerArticulo(){
		
		$idart=$_POST['id_art'];
		
    
		$articulo = $this->Reportepedidos->traerArticulos($idart);
		//echo json_encode($Customers);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}

	public function calestado(){
		
		$est=$_POST['avestado'];
		
		$articulo = $this->Reportepedidos->calestados($est);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else 
		echo json_encode(0);
	}

	
	public function calnota(){
		
		$idnot=$_POST['id_not'];
		
		$articulo = $this->Reportepedidos->calnotas($idnot);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else 
		echo json_encode(0);
	}
	public function guardaroteq(){
		
		$idot=$_POST['id_ot'];
		$ideq=$_POST['id_eq'];

		$articulo = $this->Reportepedidos->guardaroteq($idot,$ideq);
		//echo json_encode($Customers);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}

	
	public function guardarestaeq(){
		
		$estad=$_POST['vares'];
		$ideq=$_POST['id_eq'];

		$articulo = $this->Reportepedidos->guardarestaeq($estad,$ideq);
		//echo json_encode($Customers);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}

	
	public function guardareqfecha(){
		
		$ifh=$_POST['fhasta'];
		$idfd=$_POST['fdesde'];
		$ideq=$_POST['id_eq'];

		$uno=substr($ifh, 0, 2); //d
	  	$dos=substr($ifh, 3, 2); //m
	  	$tres=substr($ifh, 6, 4); //a
	  	$resul = ($tres."-".$dos."-".$uno); 


	  	$uno1=substr($idfd, 0, 2); 
	   	$dos1=substr($idfd, 3, 2); 
	   	$tres1=substr($idfd, 6, 4); 
	   	$resul1 = ($tres1."-".$dos1."-".$uno1);

		$articulo = $this->Reportepedidos->guardareqfechas($resul,$resul1,$ideq);
		//echo json_encode($Customers);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}

	
	public function traerot(){
		
		$idot=$_POST['id_ot'];
		
    
		$articulo = $this->Reportepedidos->traerorden($idot);
		//echo json_encode($Customers);

		if($articulo)
		{	
			$arre=array();
	        foreach ($articulo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo json_encode(0);
	}

}





// }