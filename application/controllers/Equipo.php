<?php defined('BASEPATH') OR exit('No direct script access allowed');

class  Equipo extends CI_Controller {

    public function __construct(){
        parent::__construct();
       $this->load->model('Equipos');
    }

    public function index($permission){    
    	
		$data['list'] = $this->Equipos->equipos_List();
		$data['permission'] = $permission;
		
		$this->load->view('equipo/list', $data);
		     
    }
    
    public function cargarequipo($permission){ 
        $data['permission'] = $permission;    // envia permisos 
        //$data['id_equipo'] = $idglob;      
        $this->load->view('equipo/view_',$data); //equipo controlador 
    }

    public function getequipoficha(){
		$id=$_POST['idglob'];
		$equipo = $this->Equipos->getequipofichas($id);
		//echo json_encode($Customers);

		if($equipo!=false)
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

    public function getempresa(){
		
		$empresa = $this->Equipos->getempresa();
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
	public function getmarca(){
		
		$marca = $this->Equipos->getmarcas();
		//echo json_encode($Customers);

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
	public function getgrupo(){
		
		$grupo = $this->Equipos->gegrupos();
		//echo json_encode($Customers);

		if($grupo)
		{	
			$arre=array();
	        foreach ($grupo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getcontra(){

		
		$empresa = $this->Equipos->getcontra();
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
 	
 	public function getarea(){
	
		$area = $this->Equipos->getareas();
		//echo json_encode($Customers);

		if($area)
		{	
			$arre=array();
	        foreach ($area as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getcriti(){
		$this->load->model('Equipos');
		$criti = $this->Equipos->getcriti();
		//echo json_encode($Customers);

		if($criti)
		{	
			$arre=array();
	        foreach ($criti as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getunidad(){
		
		$unidad = $this->Equipos->getunidads();
		//echo json_encode($Customers);

		if($unidad)
		{	
			$arre=array();
	        foreach ($unidad as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	public function getproceso(){
		
		$proceso = $this->Equipos->getprocesos();
		//echo json_encode($Customers);

		if($proceso)
		{	
			$arre=array();
	        foreach ($proceso as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	public function getetapa(){
		
		$etapa = $this->Equipos->getetapas();
		//echo json_encode($Customers);

		if($etapa)
		{	
			$arre=array();
	        foreach ($etapa as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	public function getcodigo(){
		$this->load->model('Equipos');
		$codigo = $this->Equipos->getcodigo();
		//echo json_encode($Customers);

		if($codigo)
		{	
			$arre=array();
	        foreach ($codigo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getasegurado(){
		$this->load->model('Equipos');
		$codigo = $this->Equipos->getasegurados();
		//echo json_encode($Customers);

		if($codigo)
		{	
			$arre=array();
	        foreach ($codigo as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}
	public function agregar_empresa(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_empresa($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_seguro(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_seguros($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_unidad(){

	    if($_POST)
	    {
	    	$datos=$_POST['datos'];

	     	$result = $this->Equipos->agregar_unidad($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_criti(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_criti($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_area(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_area($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_proceso(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_proceso($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_etapa(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_etapa($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
  	public function agregar_grupo(){

	    if($_POST)
	    {
	    	$datos=$_POST['parametros'];

	     	$result = $this->Equipos->agregar_grupos($datos);
	      	//print_r($this->db->insert_id());
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}
 //  	public function guardar_equipo(){
		
	// 	$datos=$_POST['data'];
	// 	$mar=$_POST['marca'];
	// 	$cod=$_POST['codigo'];
	// 	$com=$_POST['comp'];
	// 	$can=$_POST['j'];
	// 	//var_dump($com);
	// 	// $c= $can / 2;
	// 	// $i=1;
	// 	// $j=2;
		

	// 	$result = $this->Equipos->insert_equipo($datos);
	// 	if($result!=0){

	// 		$ultimoId=$this->db->insert_id();
	// 		$arre=array();
	// 		//if($i<$c){
	// 			//if ($com[$i]<$can ) 
	// 			foreach ($com as $row) 
	// 	        {   
	// 	        	//if ($com[$j]<$can )
	// 	        	foreach ($com as $row2) 
	// 	        	 { 
	// 	           		$datos2 = array(
							
	// 			        	'titulo'=>$row, 
	// 			        	'descripcion'=>$row2,
	// 			        	'id_equipo'=>$ultimoId
				        

	// 		    			);
	// 	           		 $result2 = $this->Equipos->insert_equipinfo($datos2);

	// 	           	}
	// 	           	$i++;
	// 	           	$j++;
		        

	// 	        }
	          
       


	// 	}
		
	// 	print_r(json_encode($result));
		
		
	// }

	public function guardar_equipo(){
		
		$datos=$_POST['data'];
		$mar=$_POST['marca'];
		$cod=$_POST['codigo'];
		$com=$_POST['comp'];
		$can=$_POST['j'];
		
	
		//$i=0;
		//$j=1;
		$result = $this->Equipos->insert_equipo($datos);
		// if($result!=0){
		// 	$ultimoId=$this->db->insert_id();
		// 	$arre=array();
		// 	$can=count($com);
		// 	//var_dump($can);
			
		// 	if ($i<($can-1)){ 
		  
		//         if ($j<$can ){
				
		//            		$datos2 = array(
		// 		        	'titulo'=>$com[$i], 
		// 		        	'descripcion'=>$com[$j],
		// 		        	'id_equipo'=>$ultimoId
		// 	    			);
		//            		$result2 = $this->Equipos->insert_equipinfo($datos2);
		//         }
		//         $j++2;    
		//     }
		//     $i+2;
		// }

		print_r(json_encode($result));
	}

	public function mostrar_ventana()
	{
		  
	
		 echo $this->load->view('equipo/ventana','' , true);
	
		
	
	}
	public function mostrar_asignar()
	{
		$data['permission'] = $permission;    // envia permisos       
        $this->load->view('equipo/asigna',$data);
	
		// echo $this->load->view('equipo/asigna','' , true);
	
		
	
	}

	public function baja_equipo()
	{
	
		$idequipo=$_POST['idequipo'];
		
		$datos = array('estado'=>"AN");
		 //$this->load->model('modalbaja');

		//doy de baja
		$result = $this->Equipos->update_equipo($datos, $idequipo);
		print_r($result);
	
	}
	public function cambio_equipo()
	{
	
		$idequipo=$_POST['idequipo'];
		
		$datos = array('estado'=>"IN");

		//doy de baja
		$result = $this->Equipos->update_cambio($datos, $idequipo);
		print_r($result);
	
	}

	public function cambio_estado(){
	
		$idequipo=$_POST['idequipo'];
		
		$datos = array('estado'=>"AC");

		//doy de baja
		$result = $this->Equipos->update_estado($datos, $idequipo);
		print_r($result);
	
	}

	public function getpencil(){

		$id=$_GET['id_equipo'];
		//print_r($id);
		$result = $this->Equipos->getpencil($id);
		print_r(json_encode($result));

	}
	
	public function getdatosficha(){

		$id=$_POST['cod'];
		//print_r($id);
		$result = $this->Equipos->getdatosfichas($id);
		print_r(json_encode($result));

	}

	public function contratista(){

		$ide=$_GET['id_equipo'];
		//print_r($id);
		$result = $this->Equipos->contratista($ide);
		
	}

	public function autocompleteempresa(){
	 
	 if (isset($_GET['term'])){
	  $q = strtolower($_GET['term']);
	  $valores = $this->autocomplete->getAutocompleteempresa($q);
	  echo json_encode($valores);
	 } 
	}

	public function editar_equipo(){
		
		$datos=$_POST['data'];
		$id=$_POST['comglob'];

		$result = $this->Equipos->update_editar($datos,$id);
		print_r(json_encode($result));
		
	}
	
	public function getco(){
		
		$this->load->model('Equipos');
		$codi = $this->Equipos->getco($this->input->post());
		if($codi){	
			$arre=array();
        	foreach ($codi as $row ){   
           		$arre[]=$row;
        	}
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function getinfo(){
		
		$this->load->model('Equipos');
		$info = $this->Equipos->getco($this->input->post());
		if($info)
		{	
			$arre=array();
	        foreach ($info as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}


	public function guardarcontra()
	{
		
		$datos=$_POST['idscontra'];//contratista
		
		$contra=$_POST['idglob'];


		$arre=array();
		// foreach ($datos as $row ) 
		//         {  $a=$row; 
		        	 
		        	
		//     $result=$this->Equipos->buscar($contra);
		// }

	    if(count($datos) > 0 )
	    {
	    	
	    	
		        foreach ($datos as $row ) 
		        {   
		        	$datos2 = array(
		        	 'id_equipo'=>$contra, 
		        	 'id_contratista'=>$row
		        	);	

		        	//print_r($datos2);

		          	$r1=$this->Equipos->insert_contratista($datos2);
		        }
	    	
		}

		echo json_encode($r1);

	}

	public function agregar_componente()
	{

	    if($_POST)
	    {
	    	$datos=$_POST['datos'];

	     	$result = $this->Equipos->agregar_componente($datos);
	      	//print_r($this->db->insert_id());
	      	
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

  	public function guardar_ficha(){

	    if($_POST)
	    {
	    	$datos=$_POST['data'];

	     	$result = $this->Equipos->agregar_ficha($datos);
	      	//print_r($this->db->insert_id());
	      	
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

  	public function editar_ficha(){

	    if($_POST)
	    {
	    	$datos=$_POST['data'];
	    	$id=$_POST['idglob'];

	     	$result = $this->Equipos->update_ficha($datos, $id);
	      	//print_r($this->db->insert_id());
	      	
	      	if($result)
	      		echo $this->db->insert_id();
	      	else echo 0;
	    }
  	}

  	public function getsolImp(){  

      $id=$_POST['idequip'];
      $result = $this->Equipos->getsolImps($id);

      if($result){ 
        
        $arre['datos']=$result;
       $equipos = $this->Equipos->getequiposseguro($id);
        
        if($equipos)
        {
          $arre['equipos']=$equipos;
        }
        else $arre['equipos']=0;

        $orden = $this->Equipos->getequiposorden($id);
        
        if($orden)
        {
          $arre['orden']=$orden;
        }
        else $arre['orden']=0;


        echo json_encode($arre);
      }
      else echo "nada";


  	}

  	/// Guarda lectura Hugo
  	public function setLectura(){
  		$result = $this->Equipos->setLecturas($this->input->post());
  		echo json_encode($result);
  	}

  	public function getHistoriaLect(){
  		$result = $this->Equipos->getHistoriaLecturas($this->input->post());
  	  	echo json_encode($result);	
  	}

  	public function getEqPorId(){
  		$result = $this->Equipos->getEqPorIds($this->input->post());
  	  	echo json_encode($result);
  	}
}
 


