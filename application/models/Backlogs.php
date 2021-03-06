<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Backlogs extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function backlog_List(){
		
		$sql="SELECT tbl_back.backId, tbl_back.id_equipo,tbl_back.tarea_descrip, tbl_back.fecha, tbl_back.estado,tbl_back.horash, equipos.descripcion AS des, equipos.marca, equipos.codigo, equipos.ubicacion, equipos.fecha_ingreso, tareas.id_tarea, tareas.descripcion as de1
	    	  FROM tbl_back
	    	  JOIN equipos ON equipos.id_equipo = tbl_back.id_equipo
	    	  JOIN tareas ON tareas.id_tarea = tbl_back.tarea_descrip

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

	function getcantidad($data = null){

		if($data == null)
		{
			return false;
		}
		else
		{
			
			$id_equipo = $data['id_equipo'];

			//Datos del usuario
			$query= $this->db->get_where('equipos',array('id_equipo'=>$id_equipo));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }
			
		}
	}

    //Insertar  predictivo
   	function insert_backlog($data){

        $query = $this->db->insert("tbl_back",$data);
        return $query;
    }  
  
    function geteditar($id){

	    $sql="SELECT *
	    	  FROM tbl_back
	    	  
	    	  WHERE backId=$id
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

		$sql="SELECT tbl_back.backId, tbl_back.id_equipo,tbl_back.tarea_descrip, tbl_back.fecha, tbl_back.estado,tbl_back.horash, equipos.descripcion AS des, equipos.marca, equipos.codigo, equipos.ubicacion, equipos.fecha_ingreso, tareas.id_tarea, tareas.descripcion as de1
		   	  FROM tbl_back
	    	  JOIN equipos ON equipos.id_equipo = tbl_back.id_equipo
	    	  JOIN tareas ON tareas.id_tarea = tbl_back.tarea_descrip

	    	  	WHERE tbl_back.backId=$id AND tbl_back.id_equipo=$ide
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

	function update_back($data,$id){
	    $this->db->where('backId', $id);
	    $query = $this->db->update("tbl_back",$data);
	    return $query;
	}

	function getbacklogs($idb,$ideq){

		$sql="SELECT *
	    	  FROM tbl_back	    	  
	    	  WHERE backId=$idb AND id_equipo=$ideq AND estado='C'
	    	  ";
	    
	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }	

	}

	function insert_backlogorden($data){

        $query = $this->db->insert("orden_trabajo",$data);
        return $query;
    }

    function gettareas(){

		$query= $this->db->get_where('tareas');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
			
	}


	




}	

?>