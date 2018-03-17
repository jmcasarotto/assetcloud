<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporteordenes extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	// function getRepOrdServicio($data){

	// 	if ($data['desde'] || $data['hasta'] !== "") {
			
	// 		$datDesde = $data['desde'];
	//         $datDesde = explode('-', $datDesde);
	//         $desde = $datDesde[2].'-'.$datDesde[1].'-'.$datDesde[0];

	//         $datHasta = $data['hasta'];
	//         $datHasta = explode('-', $datHasta);
	//         $hasta = $datHasta[2].'-'.$datHasta[1].'-'.$datHasta[0];
	// 	}        

 //        $id_equipo = $data['id_equipo'];
 //        $id_sector = $data['id_sector'];
        
 //        $this->db->select(
 //                    'orden_servicio.id_orden, 
 //                    orden_servicio.estado,                   
 //                    orden_servicio.comprobante,
 //                    orden_servicio.fecha, 
 //                    equipos.id_equipo,
 //                    equipos.codigo,
 //                    equipos.ubicacion,
 //                    solicitud_reparacion.id_solicitud,
 //                    solicitud_reparacion.solicitante, 
 //                    solicitud_reparacion.f_solicitado,                     
 //                    solicitud_reparacion.causa');
 //        $this->db->from('orden_servicio');
 //        $this->db->join('solicitud_reparacion', 'orden_servicio.id_solicitudreparacion = solicitud_reparacion.id_solicitud');
 //        $this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');  
        
 //        if ($id_sector !== "") {
 //        	$this->db->join('sector', 'equipos.id_sector = sector.id_sector');
 //        	$this->db->where('sector.id_sector', $id_sector);
 //        }
 //        if ($id_equipo !== "") {
 //        	$this->db->where('equipos.id_equipo', $id_equipo);
 //        }
 //        if ($data['desde'] || $data['hasta'] !== "") {
 //        	$this->db->where('orden_servicio.fecha >=',$desde);
 //        	$this->db->where('orden_servicio.fecha <=',$hasta);
 //        }       
 //        $query = $this->db->get();

 //        if ($query->num_rows()!=0)
 //        {
 //            return $query->result_array();  
 //        }
 //        else
 //        {   
 //            return array();
 //        }  

 //    }

    function getequipos($ideq){

        $this->db->select('equipos.id_equipo, equipos.codigo, equipos.estado AS estadoeq, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio,orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, orden_trabajo.fecha_entregada, orden_trabajo.descripcion as desot, orden_trabajo.estado, orden_trabajo.id_solicitud, orden_trabajo.tipo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_notapedido.id_ordTrabajo, tbl_tipoordentrabajo.id, tbl_tipoordentrabajo.tipo_orden, tbl_tipoordentrabajo.descripcion AS destipo, tareas.id_tarea, tareas.descripcion AS det, COUNT(id_notaPedido) AS nota');
        $this->db->from('orden_trabajo');
        $this->db->join('equipos', 'equipos.id_equipo = orden_trabajo.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden'); 
        $this->db->join('tbl_tipoordentrabajo', 'tbl_tipoordentrabajo.tipo_orden = orden_trabajo.tipo');
     
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_equipo', $ideq);
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }


    }

    function traerorden($idot){


        $this->db->select('equipos.id_equipo, equipos.codigo, equipos.estado AS estadoeq, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio,orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, orden_trabajo.fecha_entregada, orden_trabajo.descripcion as desot, orden_trabajo.estado, orden_trabajo.id_solicitud, orden_trabajo.tipo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_notapedido.id_ordTrabajo, tbl_tipoordentrabajo.id, tbl_tipoordentrabajo.tipo_orden, tbl_tipoordentrabajo.descripcion AS destipo, tareas.id_tarea, tareas.descripcion AS det, COUNT(id_notaPedido) AS nota');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden'); 
        $this->db->join('tbl_tipoordentrabajo', 'tbl_tipoordentrabajo.tipo_orden = orden_trabajo.tipo');
     
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_orden', $idot);
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }

    }

     function calestados($est){


        $this->db->select('equipos.id_equipo, equipos.codigo, equipos.estado AS estadoeq, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio,orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, orden_trabajo.fecha_entregada, orden_trabajo.descripcion as desot, orden_trabajo.estado, orden_trabajo.id_solicitud, orden_trabajo.tipo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_notapedido.id_ordTrabajo, tbl_tipoordentrabajo.id, tbl_tipoordentrabajo.tipo_orden, tbl_tipoordentrabajo.descripcion AS destipo, tareas.id_tarea, tareas.descripcion AS det, COUNT(id_notaPedido) AS nota');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden'); 
        $this->db->join('tbl_tipoordentrabajo', 'tbl_tipoordentrabajo.tipo_orden = orden_trabajo.tipo');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.estado',  $est);
        
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }

 //    function getfechas($resul, $resul1){

 //        $this->db->select('*');
 //        $this->db->from('equipos');
 //        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
 //        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
 //        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
 //        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
 //        $this->db->where('tbl_notapedido.fecha >=',  $resul);
 //        $this->db->where('tbl_notapedido.fecha <=', $resul1);
 //        $query= $this->db->get();


    
 //        if($query->num_rows()>0){
 //            return $query->result();
 //        }
 //        else{
 //            return false;
 //            }


 //    }

 //    function getarticulos(){

	// 	$this->db->select('*');
 //        $this->db->from('articles');
 //        $query= $this->db->get();

	// 	if ($query->num_rows()!=0){

	// 		$i=0;
	// 		foreach ($query->result() as $row){
	// 		   $data[$i]["artBarCode"] = $row->artBarCode;
	// 		   $data[$i]["artDescription"] = $row->artDescription;
	// 		   $data[$i]["artId"] = $row->artId;
	// 		   $i++;
	// 		}		
	//         return $data;
	//     }
	// }

	// function traerArticulos($idart){


 //        $this->db->select('*');
 //        $this->db->from('equipos');
 //        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
 //        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
 //        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
 //        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
 //        $this->db->where('articles.artId',  $idart);
        
 //        $query= $this->db->get();


    
 //        if($query->num_rows()>0){
 //            return $query->result();
 //        }
 //        else{
 //            return false;
 //        }

	// }

}