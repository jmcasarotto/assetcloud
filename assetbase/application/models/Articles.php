<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Articles extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function Articles_List(){

		$this->db->select('articles.*,conffamily.famName,tbl_unidadmedida.descripcion');
		$this->db->from('articles');
		$this->db->join('conffamily', 'articles.famId = conffamily.famId');
		$this->db->join('tbl_unidadmedida', 'tbl_unidadmedida.id_unidadmedida = articles.unidadmedida');

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
	
	
	function getArticle($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idArt = $data['id'];

			$data = array();

			//Datos del articulo
			//$query= $this->db->get_where('articles',array('artId'=>$idArt));
			$sql="SELECT *
	    	  FROM articles
	    	  JOIN tbl_unidadmedida ON tbl_unidadmedida.id_unidadmedida=articles.unidadmedida
	    	    	  

	    	  WHERE articles.artId=$idArt
	    	  ";
	    
	    $query= $this->db->query($sql);
	    
	 	if ($query->num_rows() != 0)
			{
				$c = $query->result_array();
				$data['article'] = $c[0];

			} else {
				$art = array();

				$art['artId'] = '';
				$art['artBarCode'] = '';
				$art['artDescription'] = '';
				$art['artCoste'] = '';
				$art['artMargin'] = '';
				$art['artMarginIsPorcent'] = '';
				$art['artIsByBox'] = '';
				$art['artCantBox'] = '';
				$art['artEstado'] = 'AC';
				$art['unidadmedida'] = '';
				$art['punto_pedido'] = '';

				$data['article'] = $art;
			}
			$data['article']['action'] = $action;

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;
			$data['action'] = $action;
			//familias
			$query= $this->db->get('conffamily');
			if ($query->num_rows() != 0)
			{
				$data['familia'] = $query->result_array();	
			}

			
			return $data;
		}
	}
	

	
	function getdatosarts(){

		$query= $this->db->get_where('tbl_unidadmedida');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }
				
	}
	
	function getdatosfams(){

		$query= $this->db->get_where('conffamily');
		if($query->num_rows()>0){
		    return $query->result();
		}
		else{
		    return false;
		    }
				
	}
	function setArticle($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$id 	= $data['id'];
            $act 	= $data['act'];
            $name 	= $data['name'];
            $status = $data['status'];
            $box 	= $data['box'];
            $boxCant = $data['boxCant'];
            $code 	= $data['code'];
            $famid 	= $data['fam'];   
            $unidmed= $data['unidmed'];   
            $puntped= $data['puntped'];     

			$data = array(
				   'artBarCode'						=> $code,
				   'artDescription' 				=> $name,
				   
				   'artEstado' 						=> $status,
				   'artIsByBox'			 			=> ($box === 'true'),
				   'artCantBox'						=> $boxCant,
				   'famId'						=> $famid,
				   'unidadmedida'               => $unidmed,
				   'punto_pedido'               => $puntped
				   
			);

			switch($act){
				case 'Add':
					//Agregar Artículo 
					if($this->db->insert('articles', $data) == false) {
						return false;
					} 
					break;
				
				 case 'Edit':
				 	//Actualizar Artículo
				 	if($this->db->update('articles', $data, array('artId'=>$id)) == false) {
				 		return false;
				 	}
				 	break;
					
				 case 'Del':
				 	//Eliminar Artículo
				 	if($this->db->delete('articles', array('artId'=>$id)) == false) {
				 		return false;
				 	}
				 	break;
				 	
			}
			return true;

		}
	}
	
	function searchByCode($data = null){
		$str = '';
		if($data != null){
			$str = $data['code'];
		}

		$articles = array();

		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where(array('artBarCode'=>$str, 'artEstado'=>'AC')); 
		$query = $this->db->get();
		if ($query->num_rows()!=0)
		{
			if($query->num_rows() > 1){
				//Multiples coincidencias
			} else {
				//Unica coincidencia
				$a = $query->result_array();
				$articles = $a[0];

				//Calcular precios 
				$pUnit = $articles['artCoste'];
				if($articles['artIsByBox'] == 1){
					$pUnit = $articles['artCoste'] / $articles['artCantBox'];
				}

				if($articles['artMarginIsPorcent'] == 1){
					$articles['pVenta'] = $pUnit + ($pUnit * ($articles['artMargin'] / 100));
				} else {
					$articles['pVenta'] = $pUnit + $articles['artMargin'];
				}

			}
			return $articles;
		}

		return $articles;
	}

	function searchByAll($data = null){
		$str = '';
		if($data != null){
			$str = $data['code'];
		}

		$art = array();

		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where('artEstado','AC');
		if($str != ''){
			$this->db->like('artBarCode',$str);
			$this->db->or_like('artDescription',$str);
		}
		$query = $this->db->get();
		if ($query->num_rows()!=0)
		{
			foreach($query->result_array() as $a){
				$articles = $a;

				//Calcular precios 
				$pUnit = $articles['artCoste'];
				if($articles['artIsByBox'] == 1){
					$pUnit = $articles['artCoste'] / $articles['artCantBox'];
				}

				if($articles['artMarginIsPorcent'] == 1){
					$articles['pVenta'] = $pUnit + ($pUnit * ($articles['artMargin'] / 100));
				} else {
					$articles['pVenta'] = $pUnit + $articles['artMargin'];
				}

				$art[] = $articles;
			}
		}

		return $art;
	}

	function update_articulo($data, $idarticulo){

        $this->db->where('artId', $idarticulo);
        $query = $this->db->update("articles",$data);
        
		return $query;
    }

    function getpencil($id){ 

	    $sql="SELECT *
	    	  FROM articles
	    	  JOIN tbl_unidadmedida ON tbl_unidadmedida.id_unidadmedida=articles.unidadmedida
	    	  JOIN conffamily ON conffamily.famId=articles.famId
	    	      	  

	    	  WHERE articles.artId=$id
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

	function update_editar($data, $id){
        $this->db->where('artId', $id);
        $query = $this->db->update("articles",$data);
        return $query;
    }

}
?>