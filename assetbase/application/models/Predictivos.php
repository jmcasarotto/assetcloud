<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Predictivos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function predictivo_List(){

		
		$sql="SELECT predictivo.predId, predictivo.id_equipo,predictivo.tarea_descrip, predictivo.fecha,  predictivo.periodo,  predictivo.cantidad,predictivo.estado, predictivo.horash, equipos.descripcion AS des, equipos.marca, equipos.codigo, equipos.ubicacion, equipos.fecha_ingreso, tareas.descripcion as de1
	    	  FROM predictivo
	    	  JOIN equipos ON equipos.id_equipo = predictivo.id_equipo
	    	  JOIN tareas ON tareas.id_tarea = predictivo.tarea_descrip

	    	  ";
	    
	    $query= $this->db->query($sql);
	    
	    if( $query->num_rows() > 0)
	    {
	      
	      $data['data'] = $query->result_array();	
	      return  $data;
	    } 
	    else 
	    	$data['data'] = 0;
	      return  $data;
 
	}

	
	function getequipo(){
			

	    $sql="SELECT * 
	    	  FROM equipos
	    	  WHERE equipos.estado='AC'
	    	  

	    	  ";
	    
	    $query= $this->db->query($sql);
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{	
			return false;
		}		

	}

	function getpredictivos($idpe,$ideq){

		$sql="SELECT *
	    	  FROM predictivo
	    	  
	    	  WHERE predId=$idpe AND id_equipo=$ideq AND estado='C'
	    	  ";
	    
	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }	

	}

    //Insertar  predictivo
   	function insert_predictivo($data)
    {
        $query = $this->db->insert("predictivo",$data);
        return $query;
    }
    
   	function insert_predictivoorden($data)
    {
        $query = $this->db->insert("orden_trabajo",$data);
        return $query;
    }
     
    function geteditar($id){

	    $sql="SELECT *
	    	  FROM predictivo
	    	  
	    	  WHERE predId=$id
	    	  ";
	    
	    $query= $this->db->query($sql);
	    
	    if( $query->num_rows() > 0)
	    {
	      return $query->result_array();	
	    } 
	    else {
	      return 0;
	    }
	}

	function traerequiposprev($ide,$id){

		 $sql="SELECT predictivo.id_equipo, predictivo.predId, predictivo.tarea_descrip, predictivo.fecha, predictivo.estado as es, predictivo.cantidad, predictivo.periodo, equipos.codigo, equipos.ubicacion, equipos.marca, equipos.fecha_ingreso, equipos.descripcion   
		   	 	FROM predictivo
	    	  	JOIN equipos ON equipos.id_equipo=predictivo.id_equipo

	    	  	WHERE predictivo.predId=$id AND predictivo.id_equipo=$ide
	    	  ";
	    
	    $query= $this->db->query($sql);
	    
	    if( $query->num_rows() > 0)
	    {
	      return $query->result_array();	
	    } 
	    else {
	      return 0;
	    }

	}


	function update_editar($data, $idp){
	    $this->db->where('prevId', $idp);
	    $query = $this->db->update("preventivo",$data);
	    return $query;
	}

	
	function update_predictivo($data, $id){
	    $this->db->where('predId', $id);
	    $query = $this->db->update("predictivo",$data);
	    return $query;
	}
	




}	

?>