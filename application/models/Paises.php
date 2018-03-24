<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Paises extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getPaises()
    {
        $query= $this->db->get('paises');

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