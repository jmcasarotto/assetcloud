<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipos extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function equipos_List()
	{
	    $sql="SELECT  *,empresas.descripcion AS de11,sector.descripcion AS de13, criticidad.descripcion AS de14, grupo.descripcion AS de12
	    	  FROM equipos
	    	  JOIN empresas ON empresas.id_empresa=equipos.id_empresa
	    	  JOIN sector ON sector.id_sector=equipos.id_sector
	    	  JOIN criticidad ON criticidad.id_criti=equipos.id_criticidad
	    	  JOIN grupo ON grupo.id_grupo=equipos.id_grupo
	    	  ORDER BY equipos.codigo ASC


	    	  ";

	    $query= $this->db->query($sql);

	    if( $query->num_rows() > 0)
	    {
	      $data['openBox'] = 1;
	      $data['data'] = $query->result_array();
	      return  $data;
	    }
	    else { $data['openBox'] = 1;
	      return $data;
	    }
	}

	function getequipofichas($id){


		$sql="SELECT  ficha_equipo.id_equipo, ficha_equipo.marca, ficha_equipo.modelo, ficha_equipo.numero_motor, ficha_equipo.numero_serie, ficha_equipo.fecha_ingreso, ficha_equipo.dominio, ficha_equipo.fabricacion, ficha_equipo.peso, ficha_equipo.bateria, ficha_equipo.hora_lectura

	    	  FROM ficha_equipo
	    	  JOIN equipos ON equipos.id_equipo=ficha_equipo.id_equipo
	    	  WHERE equipos.id_equipo=$id


	    	  ";

	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}


	function getempresa(){

		$query= $this->db->get_where('empresas');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }


	}

	function getasegurados(){

		$query= $this->db->get_where('seguro');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }


	}
	function getsector(){

		$query= $this->db->get_where('sector');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}

	function getcriti(){

		$query= $this->db->get_where('criticidad');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}

	function getgrupo(){

		$query= $this->db->get_where('grupo');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}

	function getcontra(){

		$query= $this->db->get_where('contratistas');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}

	public function agregar_empresa($data){

        $query = $this->db->insert("empresas",$data);
    	return $query;
    }

    public function agregar_sector($data){

        $query = $this->db->insert("sector",$data);
    	return $query;
   	}

   	public function agregar_criti($data){

        $query = $this->db->insert("criticidad",$data);
    	return $query;

    }

    public function agregar_grupo($data){

        $query = $this->db->insert("grupo",$data);
    	return $query;

    }
    public function agregar_componente($data){

        $query = $this->db->insert("componentes",$data);
    	return $query;

    }

    public function agregar_seguros($data){

        $query = $this->db->insert("seguro",$data);
    	return $query;

    }
    public function insert_equipo($data)
    {
        $query = $this->db->insert("equipos",$data);
        return $query;
    }

    public function update_equipo($data, $idequipo)
    {
        $this->db->where('id_equipo', $idequipo);
        $query = $this->db->update("equipos",$data);
        return $query;
    }
    public function update_equipo2($estado, $idequi)
    {
       $this->db->where('id_equipo', $idequi);
        $query = $this->db->update("equipos",$estado);
        return $query;

        /*$consulta= "UPDATE equipos SET estado=$estado,

							   WHERE id_equipo=$idequi" ;

		$query= $this->db->query($consulta);*/
    }

    public function update_cambio($data, $idequipo)
    {
        $this->db->where('id_equipo', $idequipo);
        $query = $this->db->update("equipos",$data);
        return $query;
    }

     public function update_estado($data, $idequipo)
    {
        $this->db->where('id_equipo', $idequipo);
        $query = $this->db->update("equipos",$data);
        return $query;
    }

    public function update_e($estado, $idequi)
    {
        $this->db->where('id_equipo', $idequi);
        $query = $this->db->update("equipos",$estado);
        return $query;
    }

    function getpencil($id)
	{ //JOIN grupo ON grupo.id_grupo=equipos.id_grupo
	    $sql="SELECT equipos.id_equipo, equipos.descripcion, equipos.fecha_ingreso, equipos.fecha_garantia, equipos.marca, equipos.ubicacion, equipos.codigo, equipos.estado, equipos.fecha_ultimalectura, equipos.ultima_lectura, empresas.id_empresa,empresas.descripcion AS deemp, sector.id_sector, sector.descripcion AS desect,grupo.id_grupo, grupo.descripcion AS degrupo, criticidad.id_criti, criticidad.descripcion AS decriti
	    	  FROM equipos
	    	  JOIN empresas ON empresas.id_empresa=equipos.id_empresa
	    	  JOIN sector ON sector.id_sector=equipos.id_sector
	    	  JOIN criticidad ON criticidad.id_criti=equipos.id_criticidad
	    	  JOIN grupo ON grupo.id_grupo =equipos.id_grupo


	    	  WHERE equipos.id_equipo=$id
	    	  ";

	    $query= $this->db->query($sql);

	    if( $query->num_rows() > 0)
	    {
	      return $query->result_array();
	    }
	    else {
	      return 0;
	    }
	}

	function getdatosfichas($id){
	// ficha_equipo.id_lectura, historial_lectura.lectura JOIN historial_lectura ON historial_lectura.id_equipo=equipos.id_equipo
	    $sql="SELECT equipos.id_equipo, equipos.descripcion, equipos.fecha_ingreso, equipos.fecha_garantia, equipos.marca, equipos.ubicacion, equipos.codigo, equipos.estado, equipos.fecha_ultimalectura, equipos.ultima_lectura, sector.id_sector, sector.descripcion AS desect
	    	  FROM equipos
	    	  JOIN sector ON sector.id_sector=equipos.id_sector

	    	  WHERE equipos.id_equipo=$id
	    	  ";

	    $query= $this->db->query($sql);

	    if( $query->num_rows() > 0)
	    {
	      return $query->result_array();
	    }
	    else {
	      return 0;
	    }
	}

	function contratista($id)
	{
	    $sql="SELECT *
	    	  FROM equipos

	    	  WHERE id_equipo=$id
	    	  ";

	    $query= $this->db->query($sql);

	    if( $query->num_rows() > 0)
	    {
	      return $query->result_array();
	    }
	    else {
	      return 0;
	    }
	}

	function getcodigo($data = null){

		$query= $this->db->get_where('equipos');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }
	}

	function Buscar($a){

		$sql="SELECT id_equipo
	    	  FROM equipos
	    	 WHERE codigo=$a
	    	  ";

	    $query= $this->db->query($sql);

	    foreach ($query->result_array() as $row)
						{

						        $data = $row['id_equipo'];


						       return $data;
						}
	}


	public function update_editar($data, $id)
    {
        $this->db->where('id_equipo', $id);
        $query = $this->db->update("equipos",$data);
        return $query;
    }

    function getco($data = null){

		if($data == null)
		{
			return false;
		}
		else
		{

			$ide = $data['id_equipo'];

			$query= $this->db->get_where('equipos',array('id_equipo'=>$ide));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}
	}

	function getinfo($data = null){

		if($data == null)
		{
			return false;
		}
		else
		{

			$ide1 = $data['idequipo'];

			$query= $this->db->get_where('equipos',array('id_equipo'=>$ide1));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}
	}

	public function insert_contratista($data)
    {
        $query = $this->db->insert("contratistaquipo",$data);
        return 1;
    }

    public function insert_componentes($data)
    {
        $query = $this->db->insert("componentes",$data);
        //$query= $this->db->query($sql);
         return 1;

    }


	public function insert_componenteequip($data)
    {
        $query = $this->db->insert("componenteequipo",$data);
        //$query= $this->db->query($sql);
         return 1;

    }

	public function agregar_ficha($data)
    {
        $query = $this->db->insert("ficha_equipo",$data);
        //$query= $this->db->query($sql);
         return 1;

    }

    public function update_ficha($data, $id)
    {
        $this->db->where('id_equipo', $id);
        $query = $this->db->update("ficha_equipo",$data);
        return $query;
    }

    function getsolImps($id){

     	$sql="SELECT equipos.ubicacion, equipos.marca, equipos.codigo, equipos.estado, equipos.id_sector, ficha_equipo.marca AS marcaeq, ficha_equipo.modelo, ficha_equipo.numero_motor, ficha_equipo.numero_serie, ficha_equipo.fecha_ingreso as fechain, ficha_equipo.dominio, ficha_equipo.fabricacion, ficha_equipo.peso, ficha_equipo.bateria, ficha_equipo.hora_lectura, sector.descripcion AS sector
     		FROM equipos
     		JOIN ficha_equipo ON ficha_equipo.id_equipo=equipos.id_equipo
     		JOIN sector ON  sector.id_sector=equipos.id_sector



                  WHERE equipos.id_equipo=$id
              ";

        $query= $this->db->query($sql);
        foreach ($query->result_array() as $row){

            $data['codigo'] = $row['codigo'];
            $data['estado'] = $row['estado'];
            $data['ubicacion'] = $row['ubicacion'];
            $data['marca'] = $row['marca'];
            $data['marcaeq'] = $row['marcaeq'];
            $data['modelo'] = $row['modelo'];
            $data['numero_motor'] = $row['numero_motor'];
            $data['numero_serie'] = $row['numero_serie'];
            $data['fechain'] = $row['fechain'];
            $data['dominio'] = $row['dominio'];
            $data['fabricacion'] = $row['fabricacion'];
            $data['peso'] = $row['peso'];
          	$data['bateria'] = $row['bateria'];
          	$data['hora_lectura'] = $row['hora_lectura'];
          	$data['sector'] = $row['sector'];

           return $data;
        }

    }


    function getequiposseguro($id){

     	$sql="SELECT *
     		FROM seguro
     		JOIN equipos ON equipos.id_equipo=seguro.id_equipo



                  WHERE equipos.id_equipo=$id
              ";

        $query= $this->db->query($sql);
        foreach ($query->result_array() as $row){

            $data['asegurado'] = $row['asegurado'];
            $data['ref'] = $row['ref'];
            $data['numero_pliza'] = $row['numero_pliza'];
            $data['fecha_inicio'] = $row['fecha_inicio'];
            $data['fecha_vigencia'] = $row['fecha_vigencia'];
            $data['cobertura'] = $row['cobertura'];


           return $data;
        }

    }


    function getequiposorden($id){

     	$sql="SELECT orden_servicio.fecha, orden_servicio.id_contratista, orden_servicio.id_equipo, orden_servicio.id_solicitudreparacion, orden_servicio.estado, solicitud_reparacion.causa, contratistas.nombre
     		FROM orden_servicio
     		JOIN solicitud_reparacion ON solicitud_reparacion.id_solicitud=orden_servicio.id_solicitudreparacion
     		JOIN equipos ON equipos.id_equipo= orden_servicio.id_equipo
     		JOIN contratistas ON contratistas.id_contratista= orden_servicio.id_contratista
     		WHERE orden_servicio.id_equipo=$id
              ";

        /*$query= $this->db->query($sql);
        foreach ($query->result_array() as $row){

            $data['fecha'] = $row['fecha'];
            $data['causa'] = $row['causa'];
            $data['nombre'] = $row['nombre'];
            $data['estado'] = $row['estado'];



        }

        return $data; */

        $query= $this->db->query($sql);

        if( $query->num_rows() > 0)
        {
          return $query->result_array();
        }
        else {
          return 0;
        }

    }


    /// Guarda lectura Hugo
    function setLecturas($data){

    	 $this->db->trans_start();
	     	$id_equipo = $data["id_equipo"];
	     	$lectura = $data["lectura"];
	     	$observacion = $data["observacion"];
	     	$operario = $data['operario'];
	     	$turno = $data['turno'];
	     	$estado = $data['estado'];
	     	$userdata = $this->session->userdata('user_data');
	     	$usrId = $userdata[0]['usrId'];

	     	$datos = array(
				     	'id_equipo' => $id_equipo,
				         'lectura' =>  $lectura,
				         'fecha' => date('Y-m-d H:i:s'),
				         'usrId' => $usrId,
				         'observacion' => $observacion,
				         'operario_nom' => $operario,
				         'turno' => $turno,
				         'estado' => $estado
	                    );
	     		//guarda la lectura
	     	$this->db->where('id_equipo', $id_equipo);
	     	$this->db->insert('historial_lecturas', $datos);

	     		// actualiza el estado en equipos (R reparacion y O a AC)
	     	if ($estado == "R") {
	     		$estado_eq = array('estado'=>"R");;
	     	}
	     	if ($estado == "O") {
	     		$estado_eq = array('estado'=>"AC");;
	     	}
	     	$this->db->where('equipos.id_equipo',$id_equipo);
	     	$this->db->update('equipos',$estado_eq);

    	 $this->db->trans_complete();

    	 if ($this->db->trans_status() === FALSE)
    	 {
    	     return false;
    	 }
    	 else{
    	     return true;
    	 }
    }
    /// Trae lecturas de equipo por id de equipo
    function getHistoriaLecturas($data){
    	$id = $data['idequipo'];
    	$this->db->select('historial_lecturas.id_equipo,
				    	historial_lecturas.lectura,
				    	historial_lecturas.fecha,
				    	historial_lecturas.usrId,
				    	historial_lecturas.observacion,
				    	historial_lecturas.operario_nom AS operario,
				    	historial_lecturas.turno,
				    	equipos.codigo');
    	$this->db->from('historial_lecturas');
    	$this->db->join('equipos', 'equipos.id_equipo = historial_lecturas.id_equipo');
    	$this->db->where('historial_lecturas.id_equipo', $id);
    	$query= $this->db->get();

		if ($query->num_rows()!=0)
		{
			return $query->result_array();
		}
		else
		{
			return [];
		}
    }

    function getEqPorIds($data){

    	$id = $data['idequipo'];

		$this->db->select('equipos.id_equipo,
							equipos.codigo,
							historial_lecturas.lectura,
							historial_lecturas.fecha,
							historial_lecturas.estado');
		$this->db->from('historial_lecturas');
		$this->db->join('equipos', 'equipos.id_equipo = historial_lecturas.id_equipo');
		$this->db->where('historial_lecturas.id_equipo',$id);
		$this->db->order_by('id_lectura','DESC');
		$this->db->limit(1);

		$query= $this->db->get();

        if ($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }



    /**
     *
     *
     */
    function kpiSacarEquiposOperativos()
    {
        $this->db->select('count(equipos.estado) as cantEstadoActivo');
        $this->db->from('equipos');
        $this->db->where('equipos.estado', 'AC');
        $this->db->or_where('equipos.estado', 'RE');
        $this->db->group_by('equipos.estado');
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();
        }
    }

    /**
     * saca diferencia entre fechas
     *
     */
    function diferencia($fecha_inicio, $fecha_fin){
        $datetimei = new DateTime($fecha_inicio);
        $datetimef = new DateTime($fecha_fin);
        return $datetimef->diff($datetimei);
    }

    /**
     *
     */
    function kpiCalcularDisponibilidad($idEquipo = 1) {
        $disponibilidad = array();

        $this->db->select("*");
        $this->db->from("historial_lecturas");
        $this->db->where('id_equipo', $idEquipo);
        $query = $this->db->get();

        if ($query->num_rows() != 0)
        {
            $historial_lecturas = $query->result_array();

            $estado = $historial_lecturas[0]["estado"];
            $fecha_inicio = $historial_lecturas[0]["fecha"];
            $j = 0;

            for($i=0; $i<sizeof($historial_lecturas); $i++) {
                //echo $i; echo "-";
                //echo $j; echo "<br>";
                if($historial_lecturas[$i]["estado"] == $estado) {
                }
                else
                {
                    $fecha_fin = $historial_lecturas[$i]["fecha"];

                    $datetimei = new DateTime($fecha_inicio);
                    $datetimef = new DateTime($fecha_fin);
                    $disp = $datetimef->diff($datetimei);
                    $disponibilidad[$j]["diferencia"] = $disp->format("%Y-%m-%d %H:%I:%S");
                    $disponibilidad[$j]["estado"] = $estado;
                    //$disponibilidad = diferencia($fecha_inicio, $fecha_fin);
                    //disponibilidad es un arreglo bidimencional [cantidad de hs, estado]
                    $fecha_inicio = $fecha_fin;
                    $estado = $historial_lecturas[$i]["estado"];
                    $j++;
                }
            }

            $i--;
            if($historial_lecturas[$i]["estado"] == $historial_lecturas[$i-1]["estado"]) {
                /*dump($historial_lecturas[$i]["fecha"]);
                dump($fecha_fin);
                dump($i);*/
                $fecha_fin = $historial_lecturas[$i]["fecha"];
                $datetimei = new DateTime($fecha_inicio);
                $datetimef = new DateTime($fecha_fin);
                $disp = $datetimef->diff($datetimei);
                $disponibilidad[$j]["diferencia"] = $disp->format("%Y-%m-%d %H:%I:%S");
                $disponibilidad[$j]["estado"] = $historial_lecturas[$i]["estado"];
            }
            else
            {
                $fecha_fin = $historial_lecturas[$i-1]["fecha"];
                $datetimei = new DateTime($fecha_inicio);
                $datetimef = new DateTime($fecha_fin);
                $disp = $datetimef->diff($datetimei);
                $disponibilidad[$j]["diferencia"] = $disp->format("%Y-%m-%d %H:%I:%S");
                $disponibilidad[$j]["estado"] = $historial_lecturas[$i]["estado"];
            }

            dump($disponibilidad);
            return $disponibilidad;

        } else {
            return false;
        }

    }


}