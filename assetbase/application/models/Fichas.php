<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fichas extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function equipos_List()
	{
	    $sql="SELECT  *
	    	  FROM ficha_equipo
	    	
	    	  ORDER BY ficha_equipo.numero ASC
	    	  

	    	  ";
	    
	    $query= $this->db->query($sql);
	    
	    if( $query->num_rows() > 0)
	    {
	      $data['openBox'] = 1;
	      $data['data'] = $query->result_array();	
	      return  $data;
	    } 
	    else { $data['openBox'] = 1;
	      return $data;
	    }
	}

		function equipos($id){


		$sql="SELECT  ficha_equipo.id_fichaequip, ficha_equipo.marca, ficha_equipo.modelo, ficha_equipo.modelo, ficha_equipo.numero_motor, ficha_equipo.numero_serie, ficha_equipo.fecha_ingreso, ficha_equipo.dominio, ficha_equipo.fabricacion, ficha_equipo.peso, ficha_equipo.bateria, ficha_equipo.hora_lectura, equipos.id_equipo, equipos.descripcion, equipos.fecha_ingreso, equipos.fecha_baja, equipos.fecha_garantia, equipos.marca, equipos.codigo, equipos.ubicacion, equipos. ubicacion, equipos.id_empresa, equipos.id_sector, equipos.id_hubicacion, equipos.id_grupo, equipos.id_criticidad, equipos.estado, equipos.fecha_ultimalectura, equipos.ultima_lectura
	    	  FROM ficha_equipo
	    	  JOIN equipos ON equipos.id_equipo=ficha_equipo.id_equipo
	    	  WHERE equipos.id_equipo=$id
	    	

	    	  ";
	    
	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
		    return $query->result_array();
		}
		else{
		    return false;
		    }
	}

	function getcodigos(){

		$query= $this->db->get_where('equipos');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }
				

	}

	
	

}
