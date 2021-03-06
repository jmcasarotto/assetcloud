<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Componentes extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function componentes_List(){

	 $sql="SELECT equipos.id_equipo, equipos.codigo, equipos.descripcion, componentes.id_componente,  componentes.descripcion AS descomp, componenteequipo.estado
	    	FROM equipos
	    	JOIN componenteequipo ON componenteequipo.id_equipo=equipos.id_equipo
	    	JOIN componentes ON componentes.id_componente=componenteequipo.id_componente
	    	
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

	function traerequipo(){

		$sql="SELECT *
				FROM equipos 
				WHERE estado='AC'
		";

		$query= $this->db->query($sql);
        return $query->result();

	}
	
	function getequipo($id){

		$sql="SELECT equipos.descripcion 
	    	  FROM equipos
	    	 WHERE equipos.id_equipo=$id
	    	  ";
	    
	    $query= $this->db->query($sql);

	    foreach ($query->result_array() as $row)
						{		
							
						        $data['descripcion'] = $row['descripcion'];
						        
						       
						       return $data; 
						}
			

		//$query= $this->db->get_where('equipos');
		/*if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
			*/
	}

	function getrepartidor(){

		$query= $this->db->get_where('componentes');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	
	}

	
	function getcomponente(){

		$query= $this->db->get_where('componentes');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	
	}

	function getmarca(){

		$query= $this->db->get_where('marcasequipos');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	
	}

	public function agregar_componente($insert){

		/*$cons="INSERT INTO componentes(descripcion) VALUES ('$data')";
		$query= $this->db->query($cons);*/
                   
        $query = $this->db->insert("componentes",$insert);
    	return $query;    
    }

    function getcompo($id){
		
			$sql= "SELECT equipos.id_equipo, equipos.descripcion, componentes.descripcion AS dee11, componenteequipo.id_componente 
					FROM equipos
					JOIN componenteequipo ON componenteequipo.id_equipo= equipos.id_equipo
					JOIN componentes ON componentes.id_componente= componenteequipo.id_componente 
					WHERE componenteequipo.id_equipo=$id ";

			 $query= $this->db->query($sql);
	
			//$query= $this->db->get_where('equipos',array('id_equipo'=>$id);
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }
			
		
	}


	function getequip($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			
			$id = $data['idequipo'];

			$query= $this->db->get_where('equipos',array('id_equipo'=>$id));

			if($query->num_rows()>0){
	            return $query->result();
	        }
	        else{
	            return false;
	        }

    	}
	
	}

	function getInfoEquipos($id){
		echo "estoy en el modelo";
				

		/*$this->db->select('componentes.descripcion AS compo_desc
				');
		$this->db->from('componentes');
		
		$this->db->join('componenteequipo', 'componenteequipo.id_componente = componentes.id_componente');
		
		$this->db->having('componenteequipo.id_equipo', $id);
		$query = $this->db->get();*/	

		$sql="SELECT componentes.descripcion 
	    	  FROM componentes
	    	  JOIN componenteequipo ON componenteequipo.id_componente = componentes.id_componente
	    	  
	    	  
	    	  WHERE componenteequipo.id_equipo=$id
	    	  ";
	    
	    $query= $this->db->query($sql);
			

		 

		foreach ($query->result_array() as $row)
		{		
			
		        $data['descripcion'] = $row['descripcion'];
		       
		       //var_dump($data);
		       return $data; 
		}
		 
			
	}

	public function insert_componente($data2)
    {
        $query = $this->db->insert("componenteequipo",$data2);
        return $query;
    }

    

	public function updatecomp($ultimoId,$update)
    {
        $this->db->where('id_componente', $ultimoId);
        $query = $this->db->update("componentes",$update);
        return $query;
    }

    public function delete_asociacion($idequip,$idcomp)
    {
     //    $sql="DELETE FROM componenteequipo 
   		// 	WHERE id_equipo=$idequip AND id_componente=$idcomp ";
   		// $query= $this->db->query($sql);
   		// echo"$query";
        //return $query;
        $consulta= "UPDATE componenteequipo SET estado='AN'
          
					WHERE id_equipo=$idequip AND id_componente=$idcomp " ;

		$query= $this->db->query($consulta);
        
		return $query;
    }


	
}	

?>