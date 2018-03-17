<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Componente extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Componentes');
	}

	public function index($permission)
	{
		$data['list'] = $this->Componentes->componentes_List();
		$data['permission'] = $permission;
		$this->load->view('componente/list', $data);
	}
	 public function cargarcomp($permission){ 
        $data['permission'] = $permission;    // envia permisos       
        $this->load->view('componente/view_',$data);
    }


	public function getequipo(){
		
		$id=$_POST['idequipo'];
		$equipo = $this->Componentes->getequipo($id);
		

		if($equipo)
		{	
			$arre=array();
	        foreach ($equipo as $row ) 
	        {   
	           $arre['datos']=$row;
	        }
			
			
			print_r(json_encode($arre)) ;
			//return $arre;
		}
		else echo "nada";
	}
	
		public function traerequipo(){
		$this->load->model('Componentes');
		
		$equipo = $this->Componentes->traerequipo();
		

		if($equipo)
		{	
			$arre=array();
	        foreach ($equipo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
			//var_dump($arre);
			//return $arre;
		}
		else echo "nada";
	}


	public function getcomponente(){
		$this->load->model('Componentes');
		$compo = $this->Componentes->getcomponente();
		

		if($compo)
		{	
			$arre=array();
	        foreach ($compo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	
	public function getmarca(){
		$this->load->model('Componentes');
		$marca = $this->Componentes->getmarca();
		

		if($marca)
		{	
			$arre=array();
	        foreach ($marca as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function agregar_componente()
	{	$this->load->model('Componentes');

		$datos=$_POST['parametros'];
			//print_r($datos);
        if ($datos >0) {
        	$equipId = $datos['id_equipo'];
        	$descripcion = $datos['descripcion'];
        	$informacion = $datos['informacion'];
			$marca =$datos['marcaid'];
			$pdf = $datos['pdf'];
			$fechahora = date("Y-m-d H:i:s");
			/*$sDirGuardar = $_SERVER["DOCUMENT_ROOT"]."/logtrack/assets/filesequipos".$pdf; 

			move_uploaded_file($pdf, $sDirGuardar);*/
 

			$insert = array(
				   'id_equipo' =>$equipId ,
				   'descripcion' => $descripcion,
				   'informacion' => $informacion,
				   'fechahora' => $fechahora,
				   'marcaid' => $marca
				);

		
	     	$result = $this->Componentes->agregar_componente($insert);
	     	print_r(json_encode($result));
	      	
	      		if ($result){
	      			$ultimoId=$this->db->insert_id(); 
	      			//print_r($ultimoId);
				    $path = "assets/filesequipos/".$ultimoId.".pdf"; 
				    file_put_contents($path,base64_decode($pdf));

				     //actualizar path en base de datos
				     $update = array(
				       'pdf' => $path
				      );
					 $comp= $this->Componentes->updatecomp($ultimoId,$update);
					//print_r($comp);
					return $comp;
	      		}
	      	//print_r(json_encode(true));

	      	}
  
  	}

  	public function getcompo(){
		$this->load->model('Componentes');

		$id=$_POST['idequipo']; 
		$compo = $this->Componentes->getcompo($id);
		if($compo!=0)
		{	
			$arre=array();
	        foreach ($compo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		//else echo "No hay componentes regristrados para ese equipo";
		/*{
			$equipo = $this->Componentes->getequipo($id);
			$arre=array();
	        foreach ($equipo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}*/ //asi siempre trae algo 

			

		return $compo;
	}

	 	public function getequip(){
		$this->load->model('Componentes');
		$equip = $this->Componentes->getequip($this->input->post());
		if($equip!= 0)
		{	
			$arre=array();
	        foreach ($compo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";

		return $compo;
	}

	public function getInfoEquipo(){
		echo "estoy en el controlador";
		$id=$_POST['idequip'];
		print_r($id);

		$result = $this->Componentes->getInfoEquipos($id);
		


		/*if($data  == false)
		{
			return false;
			//echo json_encode(false);
		}
		else
		{
			return $data;
			//echo json_encode($data);	
		}*/
				//return $result;
		if($result!=0)
		{	
			
			$arre['datos']=$result;
			
			//return $arre;

			/*$equipos = $this->Sservicios->getequiposBycomodato($id);
			if($equipos)
			{
				$arre['equipos']=$equipos;
			}
			else $arre['equipos']=0;*/
			var_dump($arre);
			return $arre;

			//return json_encode($arre);
		}
		else echo "nada";

	}
	
	
	public function guardar_componente()
	{
		
		$datos=$_POST['data'];
		$compo=$_POST['comp'];
		$ba=$_POST['x'];
		$ede=$_POST['ge'];

		//$result = $this->Comodatos->insert_comodato($datos);
		
		//$arre=array();
		$j=1;
		//$z=0;

	   // if(count($compo) > 0 )
	    	//if ($z<$ba) {
	    for ($i=0; $i < $ba ; $i++) { 
	 	     if($compo[$j]){
	         
	     
	        	$datos2 = array(
	        	 'id_equipo'=>$ede, 
	        	 'id_componente'=>$compo[$j],
	        	 'estado'=> 'AC'
	        	 
	        	);	

	        	print_r($datos2);

	        $res=$this->Componentes->insert_componente($datos2);
	          
	          	//$z++;
	        }
	        $j++;
	    }
		    
		return $res;    
	}

	public function baja_comp(){    
	
		$idequip=$_POST['idequipo'];
		$idcomp=$_POST['datos'];
		
	
		//doy de bajadelete_asociacion
		$result = $this->Componentes->delete_asociacion($idequip, $idcomp);

		print_r($result);
	
	}


		    

	
}