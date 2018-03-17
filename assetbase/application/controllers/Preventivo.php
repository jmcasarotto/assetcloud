<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preventivo extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Preventivos');
	}

	public function index($permission)
	{
		$data['list2'] = $this->Preventivos->getPreventivosPorHora();
		//$data['permission'] = $permission;
		//$this->load->view('calendar/calendar', $data);
		$data['list'] = $this->Preventivos->preventivos_List();
		$data['permission'] = $permission;
		$this->load->view('preventivo/list', $data);

	}

	public function cargarpreventivo($permission){ 
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('preventivo/view_',$data);
    }

     public function volver($permission){ 
    	$data['list'] = $this->Otrabajos->otrabajos_List();
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('otrabajos/list',$data);
    }

	public function getequipo(){
		$this->load->model('Preventivos');
		$equipo = $this->Preventivos->getequipo();
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

	
	public function getcantidad(){
		$this->load->model('Preventivos');
		$cantidad = $this->Preventivos->getcantidad($this->input->post());
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
	
	public function gettarea(){
		$this->load->model('Preventivos');
		$tarea = $this->Preventivos->gettarea();
		//echo json_encode($Customers);

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

	public function getcomponente(){
		$this->load->model('Preventivos');
		$id=$_POST['id_equipo']; 
		$componente = $this->Preventivos->getcomponente($id);
		//echo json_encode($Customers);

		if($componente)
		{	
			$arre=array();
	        foreach ($componente as $row ) 
	        {   
	           $arre[]=$row;
	        }
	        //return $arre;
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getProducto (){
    	$response = $this->Preventivos->getProductos($this->input->post());
    	echo json_encode($response);
    }

	public function agregar_componente()
	{

	    if($_POST)
	    {
	    	$datos=$_POST['datos'];

	     	$result = $this->Preventivos->agregar_componente($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

  	public function agregar_insumo()
	{

	    if($_POST)
	    {
	    	$datos=$_POST['datos'];

	     	$result = $this->Equipos->agregar_insumo($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}


  	public function guardar_preventivo(){

		//$datos=$_POST['data'];
		$eq=$_POST['equipo'];
		$ta=$_POST['tarea'];
		$pe=$_POST['periodo'];
		$can=$_POST['cantidad'];
		$ultm=$_POST['ultimo'];
		$com=$_POST['componente'];
		$canhm=$_POST['cantidadhm'];
		$herramienta=$_POST['idsherramienta'];
		$insumo=$_POST['idsinsumo'];
		$co=$_POST['comp'];
		$co2=$_POST['comp2'];

		$uno=substr($ultm, 0, 2); 
        $dos=substr($ultm, 3, 2); 
        $tres=substr($ultm, 6, 4); 
        $resul = ($tres."/".$dos."/".$uno); 
		$datos = array(
						'id_equipo'=>$eq,
						'id_tarea'=>$ta,
						'perido'=>$pe,
						'cantidad'=>$can,
						'ultimo'=>$ultm,
						'id_componente'=>$com,
						'horash'=>$canhm,
						'estadoprev'=>'C'
						);

		
		$result = $this->Preventivos->insert_preventivo($datos);
		//print_r($result);
		//$i=1;
		//$j=1;
		if($result)
		{
			$ultimoId=$this->db->insert_id(); 
			
			$arre=array();

		    if(count($herramienta) > 0 )
		        foreach ($herramienta as $row ) 
		        {   
		        	if($co[$row] )
		        	{
		        		$datos2 = array(
			        	 'prevId'=>$ultimoId, 
			        	 'herrId'=>$row,
			        	 'cantidad'=>$co[$row]

		        	);
		        	/*$datos3 = array(
		        	 'prevId'=>$ultimoId, 
		        	 'artId'=>$row
		        	);	*/
		        	print_r($datos2);

		          	$this->Preventivos->insert_preventivoherramientas($datos2);
		          	//$this->Preventivos->insert_preventivoinsumos($datos3);
		          }
		          $i++;
		        }

	       echo 1;
	        $arre2=array();
	        	if(count($insumo) > 0 )
	        	
	        		foreach ($insumo as $row ) 
		        	{   
		        		if($co2[$row] )
		        		{
				        	$datos3 = array(
				        	 'prevId'=>$ultimoId, 
				        	 'artId'=>$row,
				        	 'cantidad'=>$co2[$row]
		        		);
		        	
		        	//print_r($datos3);

		          	$this->Preventivos->insert_preventivoinsumos($datos3);
		          	//$this->Preventivos->insert_preventivoinsumos($datos3);
		          		}
		          		$j++;
		      		}
		      

	        echo 2;

			
		}
		else echo "error al insertar";

		print_r($result);
	}
		


	
	public function guardar_agregar(){
			
			$datos=$_POST['data'];
			
			$result = $this->Preventivos->insert_herramienta($datos);
				
		}
	public function getperiodo(){
		$this->load->model('Preventivos');
		$periodo = $this->Preventivos->getperiodo();
		//echo json_encode($Customers);

		if($periodo)
		{	
			$arre=array();
	        foreach ($periodo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getherramienta(){
		$this->load->model('Preventivos');
		$herramienta = $this->Preventivos->getherramienta();
		//echo json_encode($Customers);

		if($herramienta)
		{	
			$arre=array();
	        foreach ($herramienta as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getdatos(){
		$this->load->model('Preventivos');
		$datos = $this->Preventivos->getdatos($this->input->post());
		if($datos)
		{	
			$arre=array();
	        foreach ($datos as $row ) 
	        {   
	           $arre[]=$row;
	        }
			//echo
			print_r(json_encode($arre));
		}
		else echo "nada";
	}

	public function getinsumo(){
		$this->load->model('Preventivos');
		$insumo = $this->Preventivos->getinsumo();
		//echo json_encode($Customers);

		if($insumo)
		{	
			$arre=array();
	        foreach ($insumo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	//GUARDAR PEDIDO
	public function guardarorden()
	{
		
		$datos=$_POST['datos'];

		$result = $this->Otrabajos->insert_herramienta($datos);
		
		$id=$this->db->insert_id();
		
		$result2 = $this->Otrabajos->get_pedido($id);

		echo json_encode($result2);

	}

	public function traerinsumo(){
		$this->load->model('Preventivos');
		$ins = $this->Preventivos->traerinsumo($this->input->post());
		if($ins)
		{	
			$arre=array();
	        foreach ($ins as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}


	public function geteditar(){

		$id=$_GET['idprev'];

		$result = $this->Preventivos->geteditar($id);
		if($result)
		{	
			$arre['datos']=$result;

			$herramientas = $this->Preventivos->getpreventivoherramientas($id);
			if($herramientas)
			{
				$arre['herramientas']=$herramientas;

			}
			else $arre['herramientas']=0;
			
			if($result)
			{
				$arre['datos']=$result;
				$insumos = $this->Preventivos->getpreventivoinsumos($id);
				if($insumos)
				{
					$arre['insumos']=$insumos;
				}
				else $arre['insumos']=0;
				
			}
			
			echo json_encode($arre);

		}
		else echo "nada";
	}

	public function baja_preventivo(){
	
		$idprev=$_POST['idprev'];
		
		$datos = array('estadoprev'=>"AN");

		//doy de baja
		$result = $this->Preventivos->update_preventivo($datos, $idprev);
		print_r($result);
	
	}

	public function getpreventivo(){

		$idpe=$_POST['idp'];
		$ideq=$_POST['datos'];
		$datos=	$this->Preventivos->getpreventivos($idpe,$ideq);

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

	public function editar_preventivo(){
			
		$datos=$_POST['data'];
		//$idi=$_POST['idsinsumo'];
		//$idh=$_POST['idsherramienta']; 
        $idp=$_POST['preglob'];
        //$co=$_POST['comp'];
		//$co2=$_POST['comp2'];


		$result = $this->Preventivos->update_editar($datos,$idp);
		print_r($result);
		
		/*$i=1;
		$j=1;
		if($result)
		{
			$ultimoId=$this->db->insert_id(); 
			
			$arre=array();
		    if(count($idh) > 0 )
		        foreach ($idh as $row ) 
		        {   

		        	if($co[$i] )
		        	{
			        	$datos2 = array(
			        	 'prevId'=>$ultimoId, 
			        	 'herrId'=>$row,
			        	 'cntidad' =>$co2
			        	);
		        	$datos4 = array('herrId' => $row);

		          	$this->Preventivos->editar_preventivoherramientas($datos2,$datos4);

		         	}
		         	$i++;
		        }

	       	echo 1;
        	$arre2=array();
        	if(count($idi) > 0 )
        		foreach ($idi as $row ) 
	        {   
	        	if($co2[$j] )
		       {
	        	$datos3 = array(
	        	 'prevId'=>$ultimoId, 
	        	 'artId'=>$row,
	        	 'cantidad' =>$co2
	        	);
	        	$datos5 = array('artId' => $row);

	          	$this->Preventivos->editar_preventivoinsumos($datos3, $datos5);
	          }
	          $j++;
	          
	       }

	        echo 2;

			
		}
		else echo "error al insertar";
		print_r($result);*/
	}

	public function preventivoinertot(){

		$eq=$_POST['equipo'];
		$tar=$_POST['tarea'];
		$fe=$_POST['fecha'];
		$idp=$_POST['idp'];
		$userdata = $this->session->userdata('user_data');
		$usrId = $userdata[0]['usrId'];

		$insert = array(
					'id_tarea' => $tar,
				   'nro' => $idp,
				   'fecha_inicio' => $fe,
				   'descripcion' => 'Preventivo',			   
				   'estado' => 'C',
				   'id_usuario' => $usrId,
				   'id_usuario_a' => $usrId,
				   'id_sucursal' => 1,
				   'id_equipo' => $eq,
				   'tipo'=> 5
				   );

		$result = $this->Preventivos->insert_preventivoorden($insert);			
		print_r($result);

		
	}


}