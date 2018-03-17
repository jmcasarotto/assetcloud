<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Marcas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function marca_List(){

		$query= $this->db->get('marcasequipos');
		
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

		$query= $this->db->get_where('marcasequipos',array('marcaid'=>$id));
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}


  	function update_editar($data, $id){
  		
        $this->db->where('marcaid', $id);
        $query = $this->db->update("marcasequipos",$data);
        return $query;
    }	

    function agregar_marcas($data){
                   
        $query = $this->db->insert("marcasequipos",$data);
    	return $query;
        
    }
   
    function update_marca($data, $id){
	    $this->db->where('marcaid', $id);
	    $query = $this->db->update("marcasequipos",$data);
	    return $query;
	}
	

}	

?>