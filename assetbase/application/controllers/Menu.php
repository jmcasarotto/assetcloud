<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Menu Class
 * Clase para el manejo del menú del sistema,
 * que extiende de la clase MY_Controller.
 */
class Menu extends CI_Controller {

	/**
	 * Clase constructora
	 * Método constructor de la clase Menú.
	 *
	 * @return	void
	 */
	function __construct()
    {
		parent::__construct();
		$this->load->model('Menus');
	}

	// --------------------------------------------------------------------

	/**
     * Menu::index()
     *
     * Carga el meta description. Y carga las distintas partes del tempalte.
     * Tambien carga archivos css y js del menu, y los datos del menu.
     */
	public function index($permission)
	{
		//dump_exit($permission);
		$data['data']       = $this->Menus->getMenu();
		$data['permission'] = $permission;
		$this->load->view('menu/list', $data);
	}

	public function editMenu()
	{
		echo "hola editar menu";
	}

	public function deleteMenu()
	{
		echo "hola eliminar menu";
	}

}
