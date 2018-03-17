<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Graficas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getEquipo()
    {
        $this->db->select('id_equipo, codigo, descripcion');
        $this->db->from('equipos');
        $this->db->where('equipos.estado', 'AC');
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

    function getParametroEquipos($data)
    {
        $id_equipo = $data["equipo"];

        $this->db->select('parametros.paramId, parametros.paramdescrip');
        $this->db->from('setupparam');
        $this->db->join('parametros', 'setupparam.id_parametro = parametros.paramId', 'inner');
        $this->db->where('setupparam.id_equipo', $id_equipo);
        $this->db->group_by('parametros.paramId');

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

    function getValorParametros($data)
    {
        $id_parametro = $data["parametro"];
        $id_equipo    = $data["equipo"];

        /*$this->db->select('parametroequipo.valor, parametroequipo.fechahora, parametros.paramdescrip, setupparam.maximo, setupparam.minimo');
        $this->db->from('parametroequipo');
        $this->db->join('setupparam', 'parametroequipo.paramId = setupparam.id_parametro', 'inner');
        $this->db->join('setupparam', 'parametroequipo.id_equipo = setupparam.id_equipo', 'inner');
        $this->db->join('parametros', 'setupparam.id_parametro = parametros.paramId', 'inner');
        $this->db->where('parametroequipo.id_equipo', $id_parametro);
        $this->db->where('parametroequipo.id_equipo', $id_equipo);
        $this->db->order_by('parametroequipo.fechahora');
        $query= $this->db->get();*/
        $sql= "SELECT
            parametroequipo.valor,
            parametroequipo.fechahora,
            setupparam.maximo,
            setupparam.minimo,
            parametros.paramdescrip,
            parametroequipo.paramId,
            parametroequipo.id_equipo
            FROM
            parametroequipo
            INNER JOIN setupparam ON setupparam.id_parametro = parametroequipo.paramId AND parametroequipo.id_equipo = setupparam.id_equipo
            INNER JOIN parametros ON parametros.paramId = setupparam.id_parametro
            WHERE
            parametroequipo.id_equipo = '".$id_equipo."' AND
            parametroequipo.paramId = '".$id_parametro."'
            ORDER BY
            parametroequipo.fechahora ASC";
        $query= $this->db->query($sql);

        if ($query->num_rows()!=0)
        {
            //print_r( $query->result_array() );
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }

}