<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Administraciones extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function otrabajos_List(){

		$this->db->select('orden_trabajo.id_orden, orden_trabajo.nro,orden_trabajo.fecha_inicio, orden_trabajo.fecha_entrega, orden_trabajo.fecha_terminada, orden_trabajo.fecha_aviso, orden_trabajo.fecha_entregada, orden_trabajo.descripcion, orden_trabajo.cliId, orden_trabajo.estado, orden_trabajo. id_usuario, orden_trabajo.id_usuario_a, user1.usrName AS nombre, orden_trabajo.id_usuario_e, orden_trabajo.id_sucursal, admcustomers.cliLastName,admcustomers.cliName, sisusers.usrName,sucursal.descripc');
		$this->db->from('orden_trabajo');
		$this->db->join('admcustomers', 'admcustomers.cliId = orden_trabajo.cliId');
		$this->db->join('sisusers', 'sisusers.usrId = orden_trabajo.id_usuario');
		$this->db->join('sisusers AS user1', 'user1.usrId = orden_trabajo.id_usuario_a');
		$this->db->join('sucursal', 'sucursal.id_sucursal = orden_trabajo.id_sucursal');
		//$this->db->join('orden_pedido', 'orden_pedido.id_trabajo = orden_trabajo.id_orden');
		//$this->db->join('tbl_notapedido', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
		$this->db->group_by('orden_trabajo.id_orden');
		//$this->db->order_by('orden_trabajo.id_orden', 'asc');


			
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

	function cargartareas($idglob){
		//var_dump($idglob);
		
		/*$sql="SELECT *  FROM tbl_listarea  FULL OUTER JOIN sisusers ON tbl_listarea.id_usuario= sisusers.usrId WHERE tbl_listarea.id_orden=$idglob";
		$query= $this->db->query($sql); $this->db->select('tbl_listarea.*, sisusers.usrName');*/

		$this->db->select('orden_pedido.*, abmproveedores.provnombre');
		$this->db->from('orden_pedido');
		$this->db->join('abmproveedores', 'abmproveedores.provid = orden_pedido.id_proveedor');
		$this->db->where('orden_pedido.id_trabajo',$idglob);
					$this->db->group_by('orden_pedido.id_orden');
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
        
    function update_ordpedid($id, $datos){

    	/*$sql="UPDATE orden_pedido
				SET fecha_entregada = $fecha,
				estado = 'E',
				numero_remito=$datos
				WHERE id_trabajo= $id
				";
		$query= $this->db->query($sql);
		if( $query->num_rows() > 0){

					  return $query->result_array();	
		} 
		else {
		 return 0;
		}*/

       


        $this->db->where('id_orden', $id);
        $query = $this->db->update("orden_pedido",$datos);
        return $query;
    }
}	

?>