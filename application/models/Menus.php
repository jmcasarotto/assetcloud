<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * menuModel Class
 * Clase para el manejo del menú del sistema,
 * que extiende de la clase MY_Model.
 */
class Menus extends CI_Model {

	/**
	 * __construct()
	 * Método constructor de la clase menuModel.
	 *
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * Database Loader
	 *
	 * @param	array	$data	Whether to enable Query Builder
	 *
	 * @return	array
	 */
	function getMenu($data = null)
	{
		$query= $this->db->get('sismenu');

		if ($query->num_rows()!=0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
		/*$data = array();
		$i = 0;

		$query= $this->db->get('sismenu');

		foreach ($query->result() as $row)
		{
			$menu = array();

		    $menu['id']     = $row->id;
		    $menu['parent'] = $row->parent;
		    $menu['name']   = $row->name;
		    $menu['icon']   = $row->icon;
		    $menu['slug']   = $row->slug;
		    $menu['number'] = $row->number;

		    $data[$i] = $menu;
		    $i++;
		}

		return $data;/**/
	}

}
