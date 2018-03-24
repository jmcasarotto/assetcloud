<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Clientes extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function addCliente($datos)
    {

        $this->db->insert('clientes',$datos);
        $lastid = $this->db->insert_id();

        return $lastid;
    }
}

?>