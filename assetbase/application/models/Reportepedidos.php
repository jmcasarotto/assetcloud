<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportepedidos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    function getequipos($ideq){

        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('equipos.id_equipo', $ideq);
        $query= $this->db->get();
    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }


    }

    function getfechas($resul, $resul1){

        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('tbl_notapedido.fecha >=',  $resul);
        $this->db->where('tbl_notapedido.fecha <=', $resul1);
        $query= $this->db->get();
    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }


    }

    function getarticulos(){

		$this->db->select('*');
        $this->db->from('articles');
        $query= $this->db->get();

		if ($query->num_rows()!=0){

			$i=0;
			foreach ($query->result() as $row){
			   $data[$i]["artBarCode"] = $row->artBarCode;
			   $data[$i]["artDescription"] = $row->artDescription;
			   $data[$i]["artId"] = $row->artId;
			   $i++;
			}		
	        return $data;
	    }
	}

    function getordenes(){

        $this->db->select('*');
        $this->db->from('orden_trabajo');
        $query= $this->db->get();

        if ($query->num_rows()!=0){

            $i=0;
            foreach ($query->result() as $row){
              

               $data[$i]["descripcion"] = $row->descripcion;
               $data[$i]["id_orden"] = $row->id_orden;
               $i++;
            }       
            return $data;
        }
    }
    
    function getnotas(){

        $this->db->select('*');
        $this->db->from('tbl_notapedido');
        $query= $this->db->get();

        if ($query->num_rows()!=0){

            $i=0;
            foreach ($query->result() as $row){
              
                $data[$i]['id_ordTrabajo'] = $row->id_ordTrabajo;
               $data[$i]['fecha'] = $row->fecha;
               $data[$i]['id_notaPedido'] = $row->id_notaPedido;
               $i++;
            }       
            return $data;
        }
    }

	function traerArticulos($idart){


        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('articles.artId',  $idart);
        
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

	}

    function calestados($est){


         $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('tbl_detanotapedido.estado',  $est);
        
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }
    function calnotas($idnot){


        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('tbl_notapedido.id_notaPedido',  $idnot);
        
        $query= $this->db->get();


    
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }


    }
    
    function traerorden($idot){


         $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_orden',  $idot);
        
        $query= $this->db->get();


        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }

    
    function guardaroteq($idot,$ideq){

        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_orden',  $idot);
        $this->db->where('orden_trabajo.id_equipo',  $ideq);
        $query= $this->db->get();


        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }

    

    function guardarestaeq($estad,$ideq){

        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_notapedido.id_ordTrabajo, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_equipo',  $ideq);
        $this->db->where('tbl_detanotapedido.estado',  $estad);
        $query= $this->db->get();


        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }

    function guardareqfechas($resul,$resul1,$ideq){

        $this->db->select('equipos.id_equipo, equipos.descripcion AS deseq, equipos.fecha_ingreso, equipos.codigo, tbl_notapedido.id_notaPedido, tbl_notapedido.fecha, tbl_notapedido.id_ordTrabajo, tbl_detanotapedido.id_detaNota, tbl_detanotapedido.artId, tbl_detanotapedido.cantidad, tbl_detanotapedido.provid, tbl_detanotapedido.fechaEntrega, tbl_detanotapedido.fechaEntregado, tbl_detanotapedido.estado AS estdet, abmproveedores.provid, abmproveedores.provnombre, articles.artBarCode, articles.artDescription, orden_trabajo.id_orden, orden_trabajo.id_tarea, orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, fecha_entregada, orden_trabajo.descripcion AS desot, orden_trabajo.id_solicitud, orden_trabajo.tipo, tareas.id_tarea, tareas.descripcion AS deta');
        $this->db->from('equipos');
        $this->db->join('orden_trabajo', 'orden_trabajo.id_equipo = equipos.id_equipo');
        $this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
        $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
        $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
        $this->db->join('articles', 'articles.artId = tbl_detanotapedido.artId');
        $this->db->join('tareas', 'tareas.id_tarea = orden_trabajo.id_tarea');
        $this->db->where('orden_trabajo.id_equipo',  '$ideq');
        $this->db->where('tbl_notapedido.fecha >=',  '$resul');
        $this->db->where('tbl_notapedido.fecha <=', '$resul1');
        $query= $this->db->get();


        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

    }

}

