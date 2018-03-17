<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unloads extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getValeDescarga(){        

        $this->db->select('tbl_valedesacarga.valedfecha,
                            tbl_valedesacarga.respons,
                            tbl_valedesacarga.dest,
                            herramientas.herrcodigo, 
                            herramientas.herrmarca, 
                            herramientas.herrdescrip');

        $this->db->from('tbl_valedesacarga');
        $this->db->join('tbl_detavaledescarga', 'tbl_detavaledescarga.valedid = tbl_valedesacarga.valedid');
        $this->db->join('herramientas', 'tbl_detavaledescarga.herrId = herramientas.herrId');
       
        $query = $this->db->get();
        return $query->result_array();
    }



    function getHerramientas(){
        
        $this->db->select('herrdescrip, herrmarca, herrcodigo, herrId');
        $this->db->from('herramientas');
        $this->db->where('equip_estad', 'TR');
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
                            'valedfecha' => $date[2].'-'.$date[1].'-'.$date[0],
                            'usrId' => $usrId,
                            'respons' => $resp,
                            'dest' => $dest
                        );
        $this->db->insert('tbl_valedesacarga', $valeSalHerram);
        $idInsertVale = $this->db->insert_id();

                // detalle herramientas
        for ($i=0; $i < count($data['herrid']) ; $i++) { 
            
            $detavalHerram["valedid"] = $idInsertVale;
            $detavalHerram["herrId"] = $data["herrid"][$i];
            
            $this->db->insert('tbl_detavaledescarga', $detavalHerram);

                // actualiza estado de herramienta por id
            $estado['equip_estad'] = 'AC';
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
