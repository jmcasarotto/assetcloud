<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipos extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function equipos_List()
	{
	     $sql="SELECT  equipos.id_equipo,equipos.codigo, equipos.descripcion AS deeq, equipos.estado, unidad_industrial.id_unidad,unidad_industrial.descripcion AS deun, grupo.id_grupo, grupo.descripcion AS degr, area.id_area, area.descripcion AS dear, empresas.id_empresa,empresas.descripcion AS deem, sector.id_sector, sector.descripcion AS desec, criticidad.id_criti, criticidad.descripcion AS decri, proceso.id_proceso, proceso.descripcion AS depro
	    	  FROM equipos
               JOIN grupo ON grupo.id_grupo=equipos.id_grupo
               JOIN sector ON sector.id_sector=equipos.id_sector
	    	  JOIN empresas ON empresas.id_empresa=equipos.id_empresa
	    	  JOIN unidad_industrial ON unidad_industrial.id_unidad=equipos.id_unidad
	    	  JOIN criticidad ON criticidad.id_criti=equipos.id_criticidad
	    	  JOIN area ON area.id_area=equipos.id_area
            JOIN proceso ON proceso.id_proceso=equipos.id_proceso
            WHERE equipos.estado!='AN'

	    	  ORDER BY equipos.codigo ASC


	    	  ";


	    $query= $this->db->query($sql);
        if ($query->num_rows()!=0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
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
	function getareas(){

		$query= $this->db->get_where('area');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }

	}

    function gegrupos(){

        $query= $this->db->get_where('grupo');
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }

    }

	function getprocesos(){

         $query= $this->db->get_where('proceso');
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
	//etapa- sector
  	function getetapas(){

         $query= $this->db->get_where('sector');
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

	  function getmarcas(){

        $query= $this->db->get_where('marcasequipos');
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
            }

    }

	function getunidads(){

		 $query= $this->db->get_where('unidad_industrial');
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

    public function insert_equipinfo($data){

        $query = $this->db->insert("informacionequipo",$data);
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
	    $sql="SELECT equipos.id_equipo, equipos.descripcion, equipos.fecha_ingreso, equipos.fecha_garantia, equipos.marca, equipos.ubicacion, equipos.codigo, equipos.estado, equipos.fecha_ultimalectura, equipos.ultima_lectura, empresas.id_empresa,empresas.descripcion AS deemp, sector.id_sector, sector.descripcion AS desect,grupo.id_grupo, grupo.descripcion AS degrupo, criticidad.id_criti, criticidad.descripcion AS decriti, marcasequipos.marcaid, marcasequipos.marcadescrip
	    	  FROM equipos
	    	  JOIN empresas ON empresas.id_empresa=equipos.id_empresa
	    	  JOIN sector ON sector.id_sector=equipos.id_sector
	    	  JOIN criticidad ON criticidad.id_criti=equipos.id_criticidad
	    	  JOIN grupo ON grupo.id_grupo =equipos.id_grupo
	    	  JOIN marcasequipos ON marcasequipos.marcaid=equipos.marca


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
     * Devuleva la cantidad de equipos operativos.
     *
     * @return Void|Array     Cantidad de equipos operativos (estado activo o reparacion).
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
     * Historial de lecturas de los últimos 12 meses.
     * //Si un mes no tiene historial se agraga una lectura default.//
     * para cada mes, agrego una lectura con el dia 1 a las 00:00:00hs y otro el ultimo dia del mes a las 23:59:59hs
     *
     * @param   Array   $historial_lecturas     Historial de lecturas.
     *
     * @return  Array   Lecturas de los últimos 12 meses.
     */
    function historialLectures12Meses( $historial_lecturas ) {
        $mesActual      = date( 'Y-m', strtotime($historial_lecturas[1]["fecha"] ) ); // mes con formato "año-mes"
        $fecha2         = date_create($mesActual);
        $fecha2->modify('last day of this month');
        $mesActual2     = $fecha2->format('Y-m');
        $ultimoDiaMes2  = $fecha2->format('d');
        $punteroFecha   = $mesActual2."-".$ultimoDiaMes2." 23:59:59";
        //dump_exit( $fecha2 );

        $lecturasPorMes = array();
        $nroLecturas    = sizeof($historial_lecturas);
        $j = 0; // lecturas;
        $k = 0;
        $arrancaMesActual = true;
        $estadoInicial = $historial_lecturas[0]["estado"];
        //dump_exit( $estadoInicial );

        // recorro el historial de lecturas
        for($i=1; $i<$nroLecturas; $i++) {
            if( $mesActual2 == date( 'Y-m', strtotime($historial_lecturas[$i]["fecha"]) ) ) {
                //
                if ($arrancaMesActual == true) {
                    //agrego lectura con estado mes anterior
                    //$lecturasPorMes[$mesActual2][$j] = array(
                    $j=0;
                    $lecturasPorMes[$k][$j] = array(
                            'id_lectura' => "0",
                            'id_equipo'  => "0",
                            'lectura'    => "0",
                            'fecha'      => $mesActual2."-01 00:00:00",
                            'estado'     => $historial_lecturas[$i-1]["estado"]
                        );
                    $j++;
                    $arrancaMesActual = false;
                }
                // cargo el historial de lecturas
                //$lecturasPorMes[$mesActual2][$j] = $historial_lecturas[$i];
                $lecturasPorMes[$k][$j] = $historial_lecturas[$i];
                $j++;
            } else {
                $fecha2         = date_create($mesActual2);
                $fecha2->modify('last day of this month');
                $mesActual2     = $fecha2->format('Y-m');
                $ultimoDiaMes2  = $fecha2->format('d');
                //$lecturasPorMes[$mesActual2][$j] = array(
                $lecturasPorMes[$k][$j] = array(
                        'id_lectura' => "0",
                        'id_equipo'  => "0",
                        'lectura'    => "0",
                        'fecha'      => $mesActual2."-".$ultimoDiaMes2." 23:59:59",
                        'estado'     => $historial_lecturas[$i-1]["estado"]
                    );
                $mesActual2 = date( 'Y-m', strtotime($mesActual2." +1 month") );
                $j++; $k++;
                $i--; //para volver a la lectura
                $arrancaMesActual = true;
            }
            //FALTA VER EL ULTIMO MES. TENGO DESDE LA FEHCA ACTUAL
            //HAY QUE VER QUE PASA DESDE LA FECHA ACTUAL HASTA EL FINAL DE MES.
            //(PORQUE TOMO FECHA TOTAL DE MES.
            //CREO ESTO VA CDO CUENTO EL TIEMPO OPERATIVO)
        }

        //dump_exit($lecturasPorMes);
        return $lecturasPorMes;
    }

    /**
     * Saca diferencia entre dos fechas.
     *
     * @param   Datetime    $fecha_inicio   Fecha de inicio.
     * @param   Datetime    $fecha_fin      Fecha final de la comparacion.
     *
     * @return  Datetime    Diferencia de feachas.
     */
    function diferencia($fecha_inicio, $fecha_fin, $formato="s"){
        $datetime1 = new DateTime($fecha_inicio);
        $datetime2 = new DateTime($fecha_fin);
        $diferencia = $datetime1->diff($datetime2, false);
        switch( $formato ){
            case "y":
                $total = $diferencia->y + $diferencia->m / 12 + $diferencia->d / 365.25; break;
            case "m":
                $total= $diferencia->y * 12 + $diferencia->m + $diferencia->d/30 + $diferencia->h / 24;
                break;
            case "d":
                $total = $diferencia->y * 365.25 + $diferencia->m * 30 + $diferencia->d + $diferencia->h/24 + $diferencia->i / 60;
                break;
            case "h":
                $total = ($diferencia->y * 365.25 + $diferencia->m * 30 + $diferencia->d) * 24 + $diferencia->h + $diferencia->i/60;
                break;
            case "i":
                $total = (($diferencia->y * 365.25 + $diferencia->m * 30 + $diferencia->d) * 24 + $diferencia->h) * 60 + $diferencia->i + $diferencia->s/60;
                break;
            case "s":
                $total = ((($diferencia->y * 365.25 + $diferencia->m * 30 + $diferencia->d) * 24 + $diferencia->h) * 60 + $diferencia->i)*60 + $diferencia->s;
                break;
        }
        //dump_exit($total);
        return $total;
    }

    /**
     * Calcula la disponibilidad de los ultimos 12meses de los equipos.
     *
     * @param   Int     $idEquipo   id del equipo a evaluar | todos los equipos.
     *
     * @return  Array|Void  Disponibilidad de equipos x mes de los ultimos 12meses.
     */
    function kpiCalcularDisponibilidad($idEquipo, $fechaInicio=false, $fechaFin=false ) {
        $disponibilidad = array();
        // Si no hay una fecha específica saco los últimos 12 meses
        // (13 meses para saber el estado inicial de la primera lectura)
        if( $fechaInicio==false && $fechaFin==false) {
            $fechaInicio = strtotime($fechaFin.' -11 month');//12 o 13...no me queda claro (si es 12 para atras es 12. pero si pone cada mes en una cajita, serian 13)
            $fechaInicio = date('Y-m-d', $fechaInicio);
            $fechaFin    = date("Y-m-d");
            //dump_exit($fechaFin);
        }
        $fechaInicio = $fechaInicio." 00:00:00";
        $fechaFin    = $fechaFin." 23:59:59";

        //dump($idEquipo, "id equipo");
        //dump($fechaInicio, "fecha inicio");
        //dump($fechaFin, "fecha fin");

        //dump_exit($fechaInicio);
        //trae el historial de lecturas
        $this->db->select('id_lectura, id_equipo, lectura, fecha, estado');
        $this->db->from('historial_lecturas');
        if( $idEquipo != "all" ) // si idequipo = 'all' => traigo todos los datos
            $this->db->where('id_equipo', $idEquipo);
        $this->db->where('fecha >=', $fechaInicio);
        $this->db->where('fecha <=', $fechaFin);
        $this->db->order_by("fecha", "asc");
        $query = $this->db->get();
        $historial_lecturas = $query->result_array();

        /* Saco el historial de los 12 meses a mostrar. */
        /* para cada mes, agrego una lectura con el dia 1 a las 00:00:00hs y otro el ultimo dia del mes a las 23:59:59hs */
        /* el estado de esas lecturas se saca del elemento anterior y posterior */
        $historial_lecturas = $this->historialLectures12Meses($historial_lecturas);
        //dump($historial_lecturas);

        $nroMeses = sizeof($historial_lecturas); //12 meses
        $j = 0;
        //ordeno las lecturas x meses (los mas viejos primero)
        for($i=0; $i<$nroMeses; $i++){
            $lecturasMes[$j] = $historial_lecturas[$i];
            $j++;
        }
        $estado = $historial_lecturas[0][0]["estado"];
        $inicio = $historial_lecturas[0][0]["fecha"];

        // para cada mes
        for($i=0; $i<$nroMeses; $i++) {
            $horasOperativas = 0;
            $inicio = $lecturasMes[$i][0]["fecha"];
            $fin = false;

            $nroLecturasMes = sizeof($lecturasMes[$i]);

            // Para cada lectura
            for($j=0; $j<$nroLecturasMes; $j++) {
                if($lecturasMes[$i][$j]["estado"] == "AC") {
                    // (B)
                    if( $lecturasMes[$i][$j-1]["estado"] != "AC") {
                        $inicio = $lecturasMes[$i][$j]["fecha"];
                    }
                } else {
                    // (C)
                    if( $lecturasMes[$i][$j-1]["estado"] == "AC") {
                        $fin = $lecturasMes[$i][$j]["fecha"];
                        $horasOperativas = $horasOperativas + (int)$this->Equipos->diferencia($inicio, $fin);
                        //print_r($horasOperativas);
                    }
                }
            } //fin for lecturas
            if ( $fin == false ) {

                if( $lecturasMes[$i][$j-1]["estado"] != "AC") {
                    $fin = $lecturasMes[$i][0]["fecha"];
                } else {
                    $fin = $lecturasMes[$i][$j-1]["fecha"];
                }
            }
            $horasOperativas = $horasOperativas + (int)$this->Equipos->diferencia($inicio, $fin);
            //print_r($horasOperativas);
            //echo "<hr><br><br>";
            $totalHorasMes = $this->Equipos->diferencia($lecturasMes[$i][0]["fecha"], $lecturasMes[$i][$nroLecturasMes-1]["fecha"]);
            //$disponibilidadp[$i] = $horasOperativas * 100 / $totalHorasMes ;
            $disponibilidadp[$i] = number_format($horasOperativas * 100 / $totalHorasMes, 2, '.', '');
            $tiempo = date( 'Y-m', strtotime($lecturasMes[$i][$nroLecturasMes-1]["fecha"]) );
            $disponibilidadt[$i] = $tiempo;
            $inicio = $fin;
            //echo "<hr>";
        }//fin for meses

        $disponibilidad["porcentajeHorasOperativas"] = $disponibilidadp;
        $disponibilidad["tiempo"] = $disponibilidadt;
        //dump_exit($disponibilidad, "hsOperativas/tiempo");
        return $disponibilidad;
    }


}