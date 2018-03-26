<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cuenta extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCuentas()
    {

        $this->db->select('cuenta.*,tipocuenta.*');
        $this->db->from('cuenta');
        $this->db->join('tipocuenta','cuenta.id=tipocuenta.tipocuentaid','inner');

        $query=$this->db->get();

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