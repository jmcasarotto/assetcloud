<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getValeSalidaHerr(){        

        $this->db->select('tbl_valesalida.fecha, 
                            herramientas.herrcodigo, 
                            herramientas.herrmarca, 
                            herramientas.herrdescrip,
                            tbl_valesalida.respons ,
                            tbl_valesalida.dest');

        $this->db->from('tbl_valesalida');
        $this->db->join('tbl_detavalesalida', 'tbl_detavalesalida.valesid = tbl_valesalida.valesid');
        $this->db->join('herramientas', 'tbl_detavalesalida.herrId = herramientas.herrId');
       
        $query = $this->db->get();
        return $query->result_array();
    }


    function getHerramientas(){
        
        $this->db->select('herrdescrip, herrmarca, herrcodigo, herrId');
        $this->db->from('herramientas');
        $this->db->where('equip_estad', 'AC');
        $query = $this->db->get();
        $i=0;
        foreach ($query->result() as $row){

            $herramientas[$i]['label'] = $row->herrdescrip;
            $herramientas[$i]['value'] = $row->herrmarca;
            $herramientas[$i]['codherram'] = $row->herrcodigo;
            $herramientas[$i]['herrId'] = $row->herrId;

            $i++;
        }
        return $herramientas;
    }

    function setHerramientas($data){
      
      $this->db->trans_start();   // inicio transaccion

        $date = $data['fecha'];
        $date = explode('/', $date);                    
        
        $userdata = $this->session->userdata('user_data');
        $usrId = $userdata[0]['usrId'];     // guarda usuario logueado
        $resp = $data['respons'];
        $dest = $data['dest'];
        $valeSalHerram = array(
                            'fecha' => $date[2].'-'.$date[1].'-'.$date[0],
                            'usrid' => $usrId,
                            'respons' => $resp,
                            'dest' => $dest
                        );
        $this->db->insert('tbl_valesalida', $valeSalHerram);
        $idInsertVale = $this->db->insert_id();

                // detalle herramientas
        for ($i=0; $i < count($data['herrid']) ; $i++) { 
            
            $detavalHerram["valesid"] = $idInsertVale;
            $detavalHerram["herrId"] = $data["herrid"][$i];
            
            $this->db->insert('tbl_detavalesalida', $detavalHerram);

            ////// actualiza estado de herramienta por id
            $estado['equip_estad'] = 'TR';
            $this->db->where('herrId', $detavalHerram["herrId"]);
            $this->db->update('herramientas', $estado);  
        }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
        {
            return false;  // Si funciona mal return false
        }
      else{
            return true;
        }
      
    }
    
}
