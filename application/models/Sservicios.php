<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sservicios extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function servicios_List(){	// trae solicitudes en estado Solicitado o en Curso			

		$userdata = $this->session->userdata('user_data');
        $usrId = $userdata[0]['usrId'];   
        $grupoId = $userdata[0]["grpId"];
		
		$this->db->select('solicitud_reparacion.*,
			equipos.codigo as equipo, 
			sector.descripcion as sector, 
			grupo.descripcion as grupo, 
			equipos.ubicacion');
		$this->db->from('solicitud_reparacion');
		$this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');
		$this->db->join('sector', 'equipos.id_sector = sector.id_sector');
		$this->db->join('grupo', 'equipos.id_grupo = grupo.id_grupo');
		//$this->db->where('solicitud_reparacion.estado', 'C');
		//$this->db->or_where('solicitud_reparacion.estado', 'S');
		$this->db->order_by('solicitud_reparacion.id_solicitud','DESC');
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
	
	function get_SolicTerminadas(){	// trae solicitudes en estado Terminado	
		
		$this->db->select('solicitud_reparacion.*,
			equipos.descripcion as equipo, 
			sector.descripcion as sector, 
			grupo.descripcion as grupo, 
			equipos.ubicacion');
		$this->db->from('solicitud_reparacion');
		$this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');
		$this->db->join('sector', 'equipos.id_sector = sector.id_sector');
		$this->db->join('grupo', 'equipos.id_grupo = grupo.id_grupo');				
		$this->db->where('solicitud_reparacion.estado', 'T');
		$this->db->order_by('solicitud_reparacion.id_solicitud','DESC');
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

	function elimSolicitudes($id){
		$estado = array(
		        'estado' => 'AN'		        
				);

		$this->db->where('id_solicitud', $id);
		$this->db->update('solicitud_reparacion', $estado);
	}

	function activSolicitudes($data){ // activa solicitudes terminadas.

		$this->db->trans_start();   

			$id_solicitud = $data['id_solicitud']; 	

	        $estado['estado'] = 'S';
	        $this->db->where('id_solicitud', $id_solicitud);
	        $this->db->update('solicitud_reparacion', $estado);

        $this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		 return false;  
		} else{
		 return true;
		}  
	}

	function getservicios($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$id_solicitud = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('solicitud_reparacion',array('id_solicitud'=>$id_solicitud));
			
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['servicio'] = $f[0];
			} else {
				$servicio = array();
				$servicio['causa'] = '';
				$servicio['fsolicitado'] = '';
				$servicio['f_sugerido'] = '';
				$servicio['hora_sug'] = '';
				$servicio['causa'] = '';
				$data['servicio'] = $servicio;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			

			//Zonas
			$query= $this->db->get('equipos');
			if ($query->num_rows() != 0)
			{
				$data['equipos'] = $query->result_array();	
			}
			return $data;

		}
	}	
	
	function getEquipSectores($data = null){

		$id = $data["id_sector"];

		 $this->db->select('equipos.id_equipo,
							equipos.codigo,
							');
        $this->db->from('equipos');
        $this->db->where('equipos.estado', 'AC');
        $this->db->where('equipos.id_sector', $id);
        $query= $this->db->get();

		if ($query->num_rows()!=0){

			$i=0;
			foreach ($query->result() as $row){
			   
			   $data[$i]["descripcion"] = $row->codigo;
			   $data[$i]["id_equipo"] = $row->id_equipo;
			   $i++;
			}		
	        return $data;
	    }	    
	}

	function getEquipos(){
		$this->db->select('equipos.id_equipo,
							equipos.codigo,
							');
        $this->db->from('equipos');
        $query= $this->db->get();

		if ($query->num_rows()!=0){

			$i=0;
			foreach ($query->result() as $row){
			   
			   $data[$i]["descripcion"] = $row->codigo;
			   $data[$i]["id_equipo"] = $row->id_equipo;
			   $i++;
			}		
	        return $data;
	    }
	}
	
	function getSectores(){

        $query = $this->db->query("SELECT `id_Sector`, `descripcion` FROM `sector`");
        $i=0;
        foreach ($query->result() as $row){

        	$sectores[$i]['label'] = $row->descripcion;
            $sectores[$i]['value'] = $row->id_Sector;
            $i++;
        }

        return $sectores;
    }

    function getsolImps($id){
		//echo"ESTOY EN EL MODELO";
		

			$sql="SELECT solicitud_reparacion.solicitante, solicitud_reparacion.f_solicitado, solicitud_reparacion.f_sugerido, solicitud_reparacion.hora_sug, solicitud_reparacion.causa, equipos.codigo, equipos.ubicacion, equipos.id_sector, equipos.id_grupo, grupo.descripcion AS degr, sector.descripcion AS sec
		    	  FROM solicitud_reparacion
		    	  JOIN equipos ON equipos.id_equipo=solicitud_reparacion.id_equipo
		    	  JOIN grupo ON grupo.id_grupo=equipos.id_grupo
		    	  JOIN sector ON sector.id_sector=equipos.id_sector

		    	  WHERE solicitud_reparacion.id_solicitud=$id
	    	  ";
	    
	    	$query= $this->db->query($sql);

	   	
				foreach ($query->result_array() as $row)
						{		
							
						        $data['f_solicitado'] = $row['f_solicitado'];
						        $data['solicitante'] = $row['solicitante'];
						        $data['causa'] = $row['causa'];
						        $data['hora_sug'] = $row['hora_sug'];
						        $data['codigo'] = $row['codigo'];
						        $data['ubicacion'] = $row['ubicacion'];
						        $data['degr'] = $row['degr'];
						        $data['sec'] = $row['sec'];
						       
						       return $data; 
						}
	}
	// Guarda solicitud de Servicio
	function setservicios($data = null){ 
		
		if($data == null)
		{
			return false;
		}
		else
		{			
			$equipId = $data['equip'];
			$solicita = $data['solici'];
			$dia = $data['fecha'];
			$dia = explode('-', $dia);
			$hora = $data['hora'];
			$min = $data['min'];
			$falla = $data['falla'];
			$idPreventivo = $data['id_prev'];				
			
			$this->db->trans_start();

				if ($idPreventivo !== "") { //actualiza fecha preventivo (fecha sistema)

					$fechUltimo['ultimo'] = date('Y-m-d H:i:s');
			        $this->db->where('prevId', $idPreventivo);
			        $this->db->update('preventivo', $fechUltimo);		        
				}

				$userdata = $this->session->userdata('user_data');
                $usrId = $userdata[0]['usrId'];     // guarda usuario logueado
                
				$insert = array(
						'f_solicitado' => date('Y-m-d H:i:s'), 
					   'f_sugerido' => $dia[2].'-'.$dia[1].'-'.$dia[0],
					   'hora_sug' => $hora.':'.$min,
					   'id_equipo' => $equipId,
					   'estado' => 'S',	// graba estado Solicitado, cambia a 'C' en Orden Servicio
					   'usrId' => $usrId,
					   'solicitante' => $solicita,
					   'causa' => $falla
					);
				$this->db->insert('solicitud_reparacion', $insert);

			$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                 return false;  
             }
             else{
                 return true;
             } 

				// if($this->db->insert('solicitud_reparacion', $insert) == false) {
				// 	return false;
				// }else{
				// 	return "Se programo la Solicitud de Servicio para el día <br>".$data['fecha']." a las ".$data['hora'].":".$data['min'];
				// }	


		}	
	}
	// Guarda confirmacion de Solicitud de Servicio, por usr que la hizo
	function confSolicitudes($data){
		
		// falta cambiar el estado de la solicitud en tabla


		$id = $data['id_sol'];
		$fecha = $data['fecha_conformidad'];
		$obs = $data['observ_conformidad'];		
		
		$datos = array(
		        'fecha_conformidad' => $fecha,
		        'observ_conformidad' => $obs,
		        'estado' => 'T'		        
				);
		
		$this->db->trans_start();
			$this->db->where('id_solicitud', $id);
			$this->db->update('solicitud_reparacion', $datos);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			return false;  
		}
		else{
		    
			return true;
		}
	}

}	

?>