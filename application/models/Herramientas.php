<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Herramientas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function herramientas_List(){
		
			$this->db->select('herramientas.*,abmdeposito.depositodescrip, abmdeposito.depositoId,marcasequipos.marcadescrip');			
			$this->db->from('herramientas');
			$this->db->join('abmdeposito','abmdeposito.depositoId = herramientas.depositoId');	
			$this->db->join('marcasequipos','marcasequipos.marcaid = herramientas.modid');
			$query= $this->db->get();
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{	
			return array();
		}
	}
	

	/*function getDepositos(){

        $query = $this->db->query("SELECT `depositoId`, `depositodescrip` FROM `abmdeposito`");
        $depositos = $query->result_array();

        return $depositos;
    }*/
    
	

	function getmodelos(){

		$sql="SELECT * FROM marcasequipos";
		//$this->db->get_where('marcasequipos');

		$query= $this->db->query($sql);
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }
	}
	

	function getdepositos(){

		$sql="SELECT * FROM abmdeposito";
		//$this->db->get_where('marcasequipos');

		$query= $this->db->query($sql);
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

		/*$query= $this->db->get_where('abmdeposito');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }*/
	}

	function agregar_herramientas($data){
                   
        $query = $this->db->insert("herramientas",$data);
    	return $query;
        
    }

    function getpencil($id){

		$sql= "SELECT herramientas.*,abmdeposito.depositodescrip, abmdeposito.depositoId,marcasequipos.marcaid, marcasequipos.marcadescrip			
			from herramientas
			JOIN abmdeposito ON abmdeposito.depositoId = herramientas.depositoId	
			JOIN marcasequipos ON marcasequipos.marcaid = herramientas.modid

			WHERE herramientas.herrId=$id";
			$query= $this->db->query($sql);

		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}

	 function eliminacion($data)
    {
       	$this->db->where('herrId', $data);
		$query =$this->db->delete('herramientas');
        return $query;
    }

    	function update_editar($data, $id){
  		
        $this->db->where('herrId', $id);
        $query = $this->db->update("herramientas",$data);
        return $query;
    }	


}
?>