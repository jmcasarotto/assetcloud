<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends CI_Model
{
 function __construct()
 {
  parent::__construct();
 }
 
 function sessionStart_($data = null){
  $result = array();
  if($data == null)
  {
   $result['usrId'] = -1;
   $result['valid'] = false;
  }
  else
  {
   $usr = $data['usr'];
   $pas = md5($data['pas']);

   $data = array(
     'usrNick' => $usr,
     'usrPassword' => $pas
    );

   $query= $this->db->get_where('sisusers',$data);
   if ($query->num_rows() != 0)
   {
    $u = $query->result_array();
    $result['usrId'] = $u[0]['usrId'];
    $result['valid'] = true;//$u[0];
   } else {
    $result['usrId'] = 0;
    $result['valid'] = false;
   }

  }

  return $result;
 }


 function getEquipos(){
  

  $this->db->select('id_equipo as id, descripcion as detalle');
  $this->db->where('estado != ', 'AN');
  $this->db->order_by('codigo', 'asc');
  $query= $this->db->get('equipos');
  $data = $query->result_array();
  return $data;
}

 function setOrder($data = null){
    $result = array();
    
    if($data == null){
       $result['result'] = false;
       $result['idOrder'] = 0;
    } 
    else {
      //var_dump($data);
       if($this->db->insert('solicitud_reparacion', $data) == false) {
        $result['result'] = false;
        $result['idOrder'] = 0;
       }else{
        $result['result'] = true;
        $result['id'] = $this->db->insert_id();
        //$result['id'] = 10;
       }
    }
    return $result;
    //return true;
 }
 function saveImage($data = null){
    if($data == null){
     return "False";
    }
    else{
     $id = $data['id'];
     $path = "assets/files/reclamos/".$id.".jpg"; 
     file_put_contents($path,base64_decode($data['image']));

     //actualizar path en base de datos
     $update = array(
       'foto' => $path
      );
      if($this->db->update('solicitud_reparacion', $update, array('id_solicitud'=>$id)) == false) {
       if($this->db->delete('solicitud_reparacion', array('id_solicitud'=>$id)) == false) {
         return "False";
        }
       return "False";
      }
     return "True";
    }
 }

}