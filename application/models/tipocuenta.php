<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tipocuenta extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getTipoCuentas()
    {
        $query = $this->db->get('tipocuenta');
        if ($query->num_rows()!=0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
}

?>