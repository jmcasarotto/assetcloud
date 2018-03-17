<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashs extends CI_Model
{

	function getcobrador($data = null)
	{

        $data = array();

        $this->db->select('Count(solicitud_reparacion.id_solicitud) as cant');
        $this->db->from('solicitud_reparacion');
        $this->db->group_by('solicitud_reparacion.estado');
        $this->db->having('solicitud_reparacion.estado  ','C');
        $query = $this->db->get();

        if ($query->num_rows() != 0)
        {
            $f = $query->result_array();
            $data = $f[0];
        }

        return $data;
    }
}

