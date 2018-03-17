<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Envios extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function envios_List(){

			$this->db->select('orden_trabajo.*, sisusers.usrName,sucursal.descripc');
			$this->db->from('orden_trabajo');
			$this->db->join('sisusers', 'sisusers.usrId = orden_trabajo.id_usuario');
			$this->db->join('sucursal', 'sucursal.id_sucursal = orden_trabajo.id_sucursal');
			$this->db->group_by('orden_trabajo.id_orden');

			
			$query= $this->db->get();
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{	
			return false;
		}
	}


	function entregas($id,$datos)
	{
	   
        //$query = $this->db->update("orden_trabajo",$datos);
        //return $query;

         $sql="UPDATE orden_trabajo SET estado= 'E',
         								fecha_entregada='$datos'

	    	  WHERE id_orden=$id
	    	  ";
	    
	    $query= $this->db->query($sql);
        
		return $query;
	}

		function ModificarFechas($ido,$resultfe){
    	
        $consulta= "UPDATE orden_trabajo SET estado='As',
    										fecha_entrega='$resultfe'
                               
				WHERE id_orden=$ido" ;

		$query= $this->db->query($consulta);
        
		return $query;

    }
	
 	

}	

?>