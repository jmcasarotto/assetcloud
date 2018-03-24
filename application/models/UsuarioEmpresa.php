<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class UsuarioEmpresa extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function addUsuarioEmpresa($userId, $empresaId)
    {
        $datos = array(
            'empresaid' => $empresaId,
            'usrId' => $userId,
        );
        $this->db->insert('usuarioasempresa',$datos);
    }
}

?>