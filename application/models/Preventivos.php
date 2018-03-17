<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Preventivos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function preventivos_List(){

			/*$this->db->select('preventivo.*, equipos.descripcion AS des,tareas.descripcion AS descrip, componentes.descripcion, periodo.descripcion AS desc');
			$this->db->from('preventivo');
			$this->db->join('equipos', 'equipos.id_equipo = preventivo.id_equipo');
			$this->db->join('tareas', 'tareas.id_tarea = preventivo.id_tarea');
			$this->db->join('componentes', 'componentes.id_componente = preventivo.id_componente');
			$this->db->join('periodo', 'periodo.id_periodo = preventivo.perido');
			$this->db->group_by('preventivo.prevId');


			$query= $this->db->get();

		if ($query->num_rows()!=0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}*/

		$sql="SELECT preventivo.prevId, preventivo.id_equipo,preventivo.id_tarea, preventivo.id_componente, preventivo.perido, preventivo.cantidad, preventivo.ultimo,preventivo.critico1, preventivo.estadoprev, equipos.descripcion AS des, equipos.marca, equipos.codigo, equipos.ubicacion, equipos.fecha_ingreso, tareas.descripcion AS deta, componentes.descripcion, grupo.descripcion AS des1
	    	  FROM preventivo
	    	  JOIN equipos ON equipos.id_equipo = preventivo.id_equipo
	    	  JOIN grupo ON equipos.id_grupo=grupo.id_grupo
	    	  JOIN tareas ON tareas.id_tarea = preventivo.id_tarea
	    	  JOIN componentes ON componentes.id_componente = preventivo.id_componente

	    	  ";

	    $query= $this->db->query($sql);

	    if( $query->num_rows() > 0)
	    {

	      $data['data'] = $query->result_array();
	      return  $data;
	    }


	}


	function getequipo(){

				/*$query= $this->db->get_where('equipos');
				if($query->num_rows()>0){
	                return $query->result();
	            }
	            else{
	                return false;
	            }*/


	            $sql="SELECT *
	    	  FROM equipos
	    	  WHERE equipos.estado='AC'


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

	function getcantidad($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{

			$id_equipo = $data['id_equipo'];

			//Datos del usuario
			$query= $this->db->get_where('equipos',array('id_equipo'=>$id_equipo));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}
	}

	function gettarea(){

				$query= $this->db->get_where('tareas');
				if($query->num_rows()>0){
	                return $query->result();
	            }
	            else{
	                return false;
	            }


	}

	function getcomponente($id){

		$sql="SELECT componentes.id_componente, componentes.descripcion
		  FROM componentes
		  JOIN componenteequipo ON componenteequipo.id_componente = componentes.id_componente

		  WHERE componenteequipo.id_equipo=$id
		  ";

	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }


	}

	function getperiodo(){

		$query= $this->db->get_where('periodo');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }


	}

	function getherramienta(){

		$query= $this->db->get_where('herramientas');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

	}

	function getinsumo(){

		$query= $this->db->get_where('articles');
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }

	}

	function getProductos (){
  	 	$query = $this->db->query("SELECT `herrId`,`herrcodigo`, `herrmarca`, `equip_est` FROM `herramientas`");
     	$i=0;
	    foreach ($query->result() as $row)
	    {
	        $productos[$i]['label'] = $row->herrcodigo;
	        $productos[$i]['value'] = $row->herrmarca;
	        $productos[$i]['id_herr'] = $row->herrId;
	        $i = $i++;
	    }
	    return $productos;
    }

    function getdatos($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{

			$idh = $data['id_herramienta'];

			//Datos del usuario
			$query= $this->db->get_where('herramientas',array('herrId'=>$idh));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}
	}

	function insumo($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{

			$id_insumo = $data['artId'];

			//Datos del usuario
			$query= $this->db->get_where('herramientas',array('artId'=>$id_insumo));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}
	}

	function traerinsumo($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{

			$id = $data['id_insumo'];

			//Datos del usuario
			$query= $this->db->get_where('articles',array('artId'=>$id));



			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }

		}

	}



	public function agregar_componente($data){

        $query = $this->db->insert("componentes",$data);
    	return $query;

    }

    public function insert_preventivo($data)
    {
        $query = $this->db->insert("preventivo",$data);
        return $query;
    }

	public function insert_preventivoherramientas($data2)
    {
        $query = $this->db->insert("tbl_preventivoherramientas",$data2);
        return $query;
    }

    public function insert_preventivoinsumos($data3)
    {
        $query = $this->db->insert("tbl_preventivoinsumos",$data3);
        return $query;
    }

    public function agregar_insumo($data){

        $query = $this->db->insert("articles",$data);
    	return $query;
    }

    public function insert_herramienta($data){
        $query = $this->db->insert("herramientas",$data);
        return $query;
    }

    function get_pedido($id){

		$query= "SELECT *
				 FROM herramientas
				 WHERE id_herramienta=$id";

        $result = $this->db->query($query);
		if($result->num_rows()>0){
            return $result->result_array();
        }
        else{
            return false;
        }

	}

    function geteditar($id){
	    $sql="SELECT preventivo.prevId, preventivo.perido, preventivo.cantidad, preventivo.ultimo, preventivo.critico1, preventivo.estadoprev, preventivo.horash, equipos.id_equipo, equipos.codigo, equipos.marca, equipos.fecha_ingreso, equipos.descripcion, equipos.ubicacion, componentes.id_componente, componentes.descripcion AS comp, tareas.id_tarea, tareas.descripcion AS descripta
	    	  FROM preventivo
	    	  JOIN equipos ON equipos.id_equipo=preventivo.id_equipo
	    	  JOIN tareas ON tareas.id_tarea=preventivo.id_tarea
	    	  JOIN componentes ON componentes.id_componente=preventivo.id_componente
	    	  WHERE prevId=$id
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

	function getpreventivoherramientas($id){
	    $sql= "SELECT *
	    		FROM tbl_preventivoherramientas
    			JOIN herramientas ON herramientas.herrId = tbl_preventivoherramientas.herrId
				WHERE tbl_preventivoherramientas.prevId=$id
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

	function getpreventivoinsumos($id){

	    $sql= "SELECT *
	    		from tbl_preventivoinsumos
    			JOIN articles ON articles.artId = tbl_preventivoinsumos.artId
				WHERE tbl_preventivoinsumos.prevId=$id
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

	public function update_preventivo($data, $idprev){
        $this->db->where('prevId', $idprev);
        $query = $this->db->update("preventivo",$data);
        return $query;
    }

	public function update_editar($data, $idp){
	    $this->db->where('prevId', $idp);
	    $query = $this->db->update("preventivo",$data);
	    return $query;
	}

	public function editar_preventivoherramientas($data, $data4){
	    $this->db->where('herrId', $data4);
	    $query = $this->db->update("tbl_preventivoherramientas",$data);
	    return $query;
	}

	public function editar_preventivoinsumos($data, $data5){
	    $this->db->where('artId', $data5);
	    $query = $this->db->update("tbl_preventivoinsumos",$data);
	    return $query;
	}


    /**
     * Trae listado de equipos que tengan mantenimiento preventivo por horas
     *
     * @return  Array   Vuleca la variable o no devuelve nada
     */
    function getPreventivosPorHora()
    {
        $this->db->select('equipos.codigo, equipos.descripcion, equipos.id_equipo, equipos.ultima_lectura, sector.descripcion as descripSector, preventivo.estadoprev, preventivo.prevId, preventivo.cantidad, preventivo.critico1');
        $this->db->from('preventivo');
        $this->db->join('equipos', 'equipos.id_equipo = preventivo.id_equipo', 'inner');
        $this->db->join('sector', 'sector.id_sector = equipos.id_sector', 'inner');
        $this->db->where('preventivo.perido', 'Horas');
        $this->db->where('equipos.estado', 'AC');

        $query= $this->db->get();

        if ($query->num_rows() > 0)
        {
            $preventivos  = $query->result_array();
            $data['data'] = $this->revisaEstadoPreventivosPorHoras( $preventivos );
            //$data['data'] = $query->result_array();

            return  $data;
        }
        else
        {
            return false;
        }
    }

    // bucle que recorra preventivos
    //      con id_equipo traigo historial_lecturas ->ultima lectura
    //      hago cuenta
    //      si es necesario llamo funcion que cambia estado de preventivo
    //      cambio $preventivos[estadoprev]
    // cierro bucle
    // devuelvo $preventivos
    function revisaEstadoPreventivosPorHoras( $preventivos )
    {
        $cantPreventivos = sizeof( $preventivos );
        for ($i=0; $i<$cantPreventivos; $i++)
        {
            $lecturaActual = $this->getLecturaActual( $preventivos[$i]['id_equipo'] );
            //dump( $lecturaActual, 'Lectura Actual' );
            //dump( $preventivos[$i]['ultima_lectura'], 'Ultima lectura' );
            //dump( $preventivos[$i]['cantidad'], 'cantidad' );
            //dump( $preventivos[$i]['critico1'], 'critico' );


            //1er caso: lecturaactual - ultimalectura >= cantidad  => estado vencido
            if (($lecturaActual - $preventivos[$i]['ultima_lectura']) >= $preventivos[$i]['cantidad'])
            {
                if ($preventivos[$i]['estadoprev'] != 'VE')
                {
                    $this->cambiaEstadoPreventivo( $preventivos[$i]['prevId'], 'VE' );
                    $preventivos[$i]['estadoprev'] = 'VE';
                }
            }

            //2do caso: lecturaactual - ultimalectura < cantidad  => estado en curso
            if (($lecturaActual - $preventivos[$i]['ultima_lectura']) < $preventivos[$i]['cantidad'])
            {
                //3er caso: > cantidad => estado critico
                if (($lecturaActual - $preventivos[$i]['ultima_lectura']) > $preventivos[$i]['cantidad'])
                {
                    if ($preventivos[$i]['estadoprev'] != 'CR')
                    {
                        $this->cambiaEstadoPreventivo( $preventivos[$i]['prevId'], 'CR' );
                        $preventivos[$i]['estadoprev'] = 'CR';
                    }
                }
                else // si no es critico => esta en curso
                {
                    if ($preventivos[$i]['estadoprev'] != 'C')
                    {
                        $this->cambiaEstadoPreventivo( $preventivos[$i]['prevId'], 'C' );
                        $preventivos[$i]['estadoprev'] = 'C';
                    }
                }
            }
        }
        return $preventivos;
    }

    /**
     * Devuelve la ultima lectura de un equipo determinado
     *
     * @param   String  $id_equipo  Equipo que se quiere saber la ultima lectura
     * @return  Int     Última lectura
     */
    function getLecturaActual( $id_equipo )
    {
        $this->db->select('lectura');
        $this->db->from('historial_lecturas');
        $this->db->where('id_equipo', $id_equipo);
        $this->db->order_by('id_lectura', 'desc');
        $this->db->limit(1);

        $query= $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data  = $query->result_array();
            return  (int)$data[0]['lectura'];
        }
        else
        {
            return false;
        }
    }

    /**
     * Cambia el campo Estado de la tabla preventivo
     *
     * @param   String  $idPreventivo   Id del preventivo a modificar
     * @param   String  $estado         Valor del nuevo estado
     * @return  bool                    Cambio correcto o incorrecto
     */
    function cambiaEstadoPreventivo( $idPreventivo, $estado )
    {
        $this->db->trans_start();   // inicio transaccion

            $data = array(
                   'estadoprev' => $estado
                );
            $this->db->where('prevId', $idPreventivo);
            $this->db->update('preventivo', $data);

        $this->db->trans_complete(); //fin transaccion

        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function getpreventivos($idpe,$ideq){

		$sql="SELECT *
	    	  FROM preventivo
	    	  
	    	  WHERE prevId=$idpe AND id_equipo=$ideq AND estadoprev='C'
	    	  ";
	    
	    $query= $this->db->query($sql);

		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }	

	}
	  	function insert_preventivoorden($data)
    {
        $query = $this->db->insert("orden_trabajo",$data);
        return $query;
    }

}
