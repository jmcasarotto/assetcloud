<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pedidos extends CI_Model
{
	function __construct(){

		parent::__construct();
	}	
	
	 ////////////  ADMINISTRACION DE PEDIDOS  ////////////////    

    function otrabajos_List(){    	

		$this->db->select('orden_trabajo.id_orden, orden_trabajo.nro,orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, orden_trabajo.fecha_aviso, orden_trabajo.fecha_entregada, orden_trabajo.descripcion, orden_trabajo.cliId, orden_trabajo.estado, orden_trabajo. id_usuario, orden_trabajo.id_usuario_a, user1.usrName AS nombre, orden_trabajo.id_usuario_e, orden_trabajo.id_sucursal, admcustomers.cliLastName,admcustomers.cliName, sisusers.usrName,sucursal.descripc');
		$this->db->from('orden_trabajo');
		$this->db->join('admcustomers', 'admcustomers.cliId = orden_trabajo.cliId');
		$this->db->join('sisusers', 'sisusers.usrId = orden_trabajo.id_usuario');
		$this->db->join('sisusers AS user1', 'user1.usrId = orden_trabajo.id_usuario_a');
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

    function getNotaPedidoIds($id){
        //echo("en cintroldor");
  		//dump_exit($id);
      $this->db->select('orden_trabajo.nro,
      					tbl_detanotapedido.id_detaNota,
						tbl_detanotapedido.id_notaPedido,
						tbl_detanotapedido.artId,
						tbl_detanotapedido.cantidad,
						tbl_detanotapedido.provid,
						tbl_detanotapedido.fechaEntrega,
						tbl_detanotapedido.fechaEntregado,
						tbl_detanotapedido.remito,
						tbl_detanotapedido.estado,
						tbl_notapedido.id_ordTrabajo,
						tbl_notapedido.fecha,
						articles.artDescription,
						abmproveedores.provnombre'
                        );
      $this->db->from('tbl_notapedido');
      $this->db->join('orden_trabajo', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
      $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
      $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
      $this->db->join('articles', 'tbl_detanotapedido.artId = articles.artId');
      $this->db->where('tbl_notapedido.id_ordTrabajo', $id);
      $query = $this->db->get();
      
      if ($query->num_rows()!=0){      
        return $query->result_array();
      }
      else{ 
        return array();
      }
    }

    function setArtNotPedidos($data){
   	
	   	$this->db->trans_start();

	   	for ($i=0; $i < count($data['arrayId']); $i++) { 
	   	
		   	$id_deta = $data['arrayId'][$i];
		   	$datos['remito'] = $data['num_remito'];
			$datos['estado'] = 'E';
	       	$this->db->where('id_detaNota', $id_deta);
	       	$this->db->update('tbl_detanotapedido', $datos);
	   	}

	   	$this->db->trans_complete();

	   if ($this->db->trans_status() === FALSE)
	   {
	       return false;  
	   }
	   else{
	       return true;
	   }
   	}

   	function getProveedores(){
        
        $this->db->select('abmproveedores.provid, abmproveedores.provnombre');
        $this->db->from('abmproveedores');        
        $query = $this->db->get();
        if ($query->num_rows() != 0){
            
            return $query->result_array();             
        }   
    } 

    	// Cambia los proveedores en el id nota de pedido
    function setNuevosProveedores($data){

    	$id_articulo = $data['id_articulo'];
    	$id_detanota = $data['id_detanota'];
    	$id_proveedor['provid'] = $data['id_proveedor'];

    	$this->db->trans_start();
	    	$this->db->where('artId', $id_articulo);
	    	$this->db->where('id_detaNota', $id_detanota);
	        $this->db->update('tbl_detanotapedido', $id_proveedor);
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