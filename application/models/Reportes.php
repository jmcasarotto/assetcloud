<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getRepOrdServicio($data){

		if ($data['desde'] || $data['hasta'] !== "") {
			
			$datDesde = $data['desde'];
	        $datDesde = explode('-', $datDesde);
	        $desde = $datDesde[2].'-'.$datDesde[1].'-'.$datDesde[0];

	        $datHasta = $data['hasta'];
	        $datHasta = explode('-', $datHasta);
	        $hasta = $datHasta[2].'-'.$datHasta[1].'-'.$datHasta[0];
		}        

        $id_equipo = $data['id_equipo'];
        $id_sector = $data['id_sector'];
        
        $this->db->select(
                    'orden_servicio.id_orden, 
                    orden_servicio.estado,                   
                    orden_servicio.comprobante,
                    orden_servicio.fecha, 
                    equipos.id_equipo,
                    equipos.codigo,
                    equipos.ubicacion,
                    solicitud_reparacion.id_solicitud,
                    solicitud_reparacion.solicitante, 
                    solicitud_reparacion.f_solicitado,                     
                    solicitud_reparacion.causa');
        $this->db->from('orden_servicio');
        $this->db->join('solicitud_reparacion', 'orden_servicio.id_solicitudreparacion = solicitud_reparacion.id_solicitud');
        $this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');  
        
        if ($id_sector !== "") {
        	$this->db->join('sector', 'equipos.id_sector = sector.id_sector');
        	$this->db->where('sector.id_sector', $id_sector);
        }
        if ($id_equipo !== "") {
        	$this->db->where('equipos.id_equipo', $id_equipo);
        }
        if ($data['desde'] || $data['hasta'] !== "") {
        	$this->db->where('orden_servicio.fecha >=',$desde);
        	$this->db->where('orden_servicio.fecha <=',$hasta);
        }       
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }  

    }

}