<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parametros extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*function parametros_List($id){

		$sql= "SELECT *
			FROM setupparam 
			JOIN parametros ON parametros.paramId=setupparam.id_parametro
			JOIN equipos ON equipos.id_equipo=setupparam.id_equipo
			WHERE setupparam.id_equipo=$id";

			//$this->db->get_where('parametroequipo',array('id'=>$id));
			
			$query= $this->db->query($sql);
			
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

	 /*$sql="SELECT setupparam.id_parametro,setupparam.maximo, setupparam.minimo, setupparam.id_equipo, parametros.paramdescrip,  equipos.codigo 
	    	FROM setupparam
	    	JOIN equipos ON equipos.id_equipo=setupparam.id_equipo
	    	JOIN parametros ON parametros.paramId=setupparam.id_parametro
	    	
	    	  ";
	    
	 $query= $this->db->query($sql);
		
		if ($query->num_rows()!=0)
		{
			$data['data'] = $query->result_array();	
	      return  $data;	
		}
		else
		{	
			return false;
		}*/
//	}

	function getequipo(){

		$sql= "SELECT *
			FROM equipos 
			
			WHERE equipos.estado='AC'  ";
		//$query= $this->db->get_where('equipos');
		$query= $this->db->query($sql);

		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
			
	}
//AND equipos.estado='AC'
	 function getparametros($id){
			
			$sql= "SELECT *
			FROM setupparam 
			JOIN parametros ON parametros.paramId=setupparam.id_parametro
			JOIN equipos ON equipos.id_equipo=setupparam.id_equipo 
			WHERE equipos.id_equipo=$id AND equipos.estado='AC'  ";

			//$this->db->get_where('parametroequipo',array('id'=>$id));
			
			$query= $this->db->query($sql);
			
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }
			
	
		
	}


	function traerparametro(){

				$query= $this->db->get_where('parametros');
				if($query->num_rows()>0){
	                return $query->result();
	            }
	            else{
	                return false;
	            }
			
	}

	public function guardar($data){
                   
        $query = $this->db->insert("parametros",$data);
    	return $query;    
    }


	

	public function guardar_todo($data){
                   
        $query = $this->db->insert("setupparam",$data);
    	return $query;    
    }

    public function delete_parametro($eq,$dato2){
    	
    	$sql="DELETE FROM setupparam WHERE id_equipo=$eq AND id_parametro=$dato2";
    	$query= $this->db->query($sql);
	    	   
	    return $query;
	  
       /* $this->db->where('id_equipo', $idq);
        $query = $this->db->delete("setupparam");
        return $query;*/
    }
     public function delete_p($idq,$idp){
    	
    	$sql="DELETE FROM setupparam WHERE id_equipo=$idq AND id_parametro=$idp";
    	$query= $this->db->query($sql);
	    	   
	    return $query;
	  
       /* $this->db->where('id_equipo', $idq);
        $query = $this->db->delete("setupparam");
        return $query;*/
    }

    function geteditar($id, $idp){
	    $sql="SELECT setupparam.id_equipo, setupparam.id_parametro, setupparam.maximo, setupparam.minimo, equipos.codigo, parametros.paramdescrip
	    	  FROM setupparam
	    	  JOIN equipos ON equipos.id_equipo=setupparam.id_equipo
	    	  JOIN parametros ON parametros.paramId= setupparam.id_parametro
	    	 
	    	  WHERE setupparam.id_equipo=$id and setupparam.id_parametro= $idp
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

	function editar($id, $idp2){
	    $sql="SELECT setupparam.id_equipo, setupparam.id_parametro, setupparam.maximo, setupparam.minimo, equipos.codigo, parametros.paramdescrip
	    	  FROM setupparam
	    	  JOIN equipos ON equipos.id_equipo=setupparam.id_equipo
	    	  JOIN parametros ON parametros.paramId= setupparam.id_parametro
	    	 
	    	  WHERE setupparam.id_equipo=$id and setupparam.id_parametro= $idp2
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


    public function update_editar($m,$n ,$pa, $equ){

    	$sql=" UPDATE setupparam SET
    						    maximo=$m,
    						    minimo=$n
    		WHERE id_equipo = $equ AND id_parametro=$pa";

        $query= $this->db->query($sql);
        return $query;
	    

       /* id_equipo=$ide,
    		id_parametro=$pa, 
       $this->db->where('id_equipo' AND 'id_parametro', $ide, $pa);
        $query = $this->db->update("setupparam",$data);
        return $query;*/
	   /* if( $query->num_rows() > 0)
	    {
	      return $query->result_array();	
	    } 
	    else {
	      return 0;
	    }*/
    }

}	

?>