<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tareas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function tarea_List(){

		$query= $this->db->get('tareas');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getpencil($id){

		$query= $this->db->get_where('tareas',array('id_tarea'=>$id));
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}


  	function update_editar($data, $id){
  		
        $this->db->where('id_tarea', $id);
        $query = $this->db->update("tareas",$data);
        return $query;
    }	

    function agregar_tareas($data){
                   
        $query = $this->db->insert("tareas",$data);
    	return $query;
        
    }
    function eliminacion($data)
    {
       	$this->db->where('id_tarea', $data);
		$query =$this->db->delete('tareas');
        return $query;
    }


}	

?>