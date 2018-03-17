<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Altparametros extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function param_List(){

		$query= $this->db->get('parametros');
		
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

		$query= $this->db->get_where('parametros',array('paramId'=>$id));
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}


  	function update_editar($data, $id){
  		
        $this->db->where('paramId', $id);
        $query = $this->db->update("parametros",$data);
        return $query;
    }	

    function agregar_parametros($data){
                   
        $query = $this->db->insert("parametros",$data);
    	return $query;
        
    }
    function eliminacion($data)
    {
       	$this->db->where('paramId', $data);
		$query =$this->db->delete('parametros');
        return $query;
    }


}	

?>