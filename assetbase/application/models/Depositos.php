<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Depositos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function deposito_List(){

		$query= $this->db->get('abmdeposito');
		
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

		$query= $this->db->get_where('abmdeposito',array('depositoId'=>$id));
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}


  	function update_editar($data, $id){
  		
        $this->db->where('depositoId', $id);
        $query = $this->db->update("abmdeposito",$data);
        return $query;
    }	

    function agregar_depositos($data){
                   
        $query = $this->db->insert("abmdeposito",$data);
    	return $query;
        
    }
    function eliminacion($data)
    {
       	$this->db->where('depositoId', $data);
		$query =$this->db->delete('abmdeposito');
        return $query;
    }


}	

?>