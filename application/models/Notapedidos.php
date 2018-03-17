<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notapedidos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
    function notaPedidos_List(){
    
      $this->db->select('tbl_notapedido.id_notaPedido,
                          tbl_notapedido.fecha,
                          tbl_notapedido.id_ordTrabajo,
                          orden_trabajo.descripcion');     
      $this->db->from('tbl_notapedido');
      $this->db->join('orden_trabajo','tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');  
      
      $query= $this->db->get();
    
      if ($query->num_rows()!=0)
      {
       return $query->result_array();          
      }
      else
      { 
        return array();
      }
    }       

      // Trae lista de articulos por id de nota de pedido 
    function getNotaPedidoIds($data){
      
      $id = $data['id'];
      
      $this->db->select('tbl_notapedido.id_notaPedido,
                          tbl_notapedido.fecha,
                          tbl_notapedido.id_ordTrabajo,
                          orden_trabajo.descripcion,
                          tbl_detanotapedido.cantidad,
                          tbl_detanotapedido.provid,
                          tbl_detanotapedido.fechaEntrega,
                          tbl_detanotapedido.fechaEntregado,
                          tbl_detanotapedido.remito,
                          tbl_detanotapedido.estado,
                          abmproveedores.provnombre,
                          articles.artDescription'
                        );
      $this->db->from('tbl_notapedido');
      $this->db->join('orden_trabajo', 'tbl_notapedido.id_ordTrabajo = orden_trabajo.id_orden');
      $this->db->join('tbl_detanotapedido', 'tbl_detanotapedido.id_notaPedido = tbl_notapedido.id_notaPedido');
      $this->db->join('abmproveedores', 'abmproveedores.provid = tbl_detanotapedido.provid');
      $this->db->join('articles', 'tbl_detanotapedido.artId = articles.artId');
      $this->db->where('tbl_notapedido.id_notaPedido', $id);
      $query = $this->db->get();
      
      if ($query->num_rows()!=0){      
        return $query->result_array();       
      }
      else{ 
        return array();
      }
    }	

    function getOrdenesCursos(){
        
        $this->db->select('orden_trabajo.id_orden,orden_trabajo.descripcion');
        $this->db->from('orden_trabajo');
        $this->db->where('orden_trabajo.estado', 'C');
        $query = $this->db->get();
        if ($query->num_rows() != 0){
            
            return $query->result_array();             
        }        
    }

    function getDetalles($id_orden){
        
        $id = $id_orden['id_orden'];
        $this->db->select('orden_trabajo.descripcion');
        $this->db->from('orden_trabajo');
        $this->db->where('orden_trabajo.id_orden', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0){
            
            return $query->result_array();             
        }   
    }     
            
    function getArticulos(){
        $query = $this->db->query("SELECT articles.artId, articles.artBarCode,articles.artDescription FROM articles");
        $i=0;
        foreach ($query->result() as $row){

            $insumos[$i]['value'] = $row->artId;
            $insumos[$i]['label'] = $row->artBarCode;
            $insumos[$i]['descripcion'] = $row->artDescription;
            $i++;
        }
        return $insumos;
    }  

    function getProveedores(){
        
        $this->db->select('abmproveedores.provid, abmproveedores.provnombre');
        $this->db->from('abmproveedores');        
        $query = $this->db->get();
        if ($query->num_rows() != 0){
            
            return $query->result_array();             
        }   
    }  

    function setNotaPedidos($data){
      
      $this->db->trans_start();    
        $orden = $data['orden_Id'][0]; 
        $notaP = array(
                'fecha' => date('Y-m-d H:i:s'),
                'id_ordTrabajo' => $orden
                );
        $this->db->insert('tbl_notapedido', $notaP);
        $idNota = $this->db->insert_id();
       
        for($i=0; $i<count($data['insum_Id']); $i++){

            $insumo = $data['insum_Id'][$i];
            $cant = $data['cant_insumos'][$i];
            $proveed = $data['proveedid'][$i];
            $date = $data['fechaentrega'][$i]; 
            $newDate = date("Y-m-d", strtotime($date));

            $nota = array(
                    'id_notaPedido' => $idNota,
                    'artId' => $insumo,
                    'cantidad' => $cant,
                    'provid' => $proveed,
                    'fechaEntrega' => $newDate,
                    'fechaEntregado' => $newDate,
                    'remito' => 1,
                    'estado' => 'P' // Estado Pedido
                    );
            $this->db->insert('tbl_detanotapedido', $nota);
        }
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
           return false;  
      }
      else{
           return true;
      }    

    } // fin setNotaPedidos   
    
	
}	

