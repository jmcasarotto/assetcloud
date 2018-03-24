<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ciudades extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getCiudades($codigo)
    {
        $query= $this->db->get_where('ciudades',array('Paises_Codigo' => $codigo));
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