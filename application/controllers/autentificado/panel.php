<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase model que ejecuta metodos para el manejo de sesiones y  autentificaciones.
 * @author      Saúl Espinosa <rinku@moobky.com>
 * @package     OpenSAE
 * @subpackage  dashboard
 * @license     http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version     1.0.0
 */
class Panel extends CI_Controller {

	/**
	 * metodo constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * metodo de la página principal del panel del dashboard, se muestran estadisticas y el menu a los diferentes enlances y/o modulos
	 * @return void 
	 */
	public function index()
	{
		$this->sesion_model->genera_permisos();
		echo 'Hola mundo </br>';
		echo anchor('servicios/sesion/logout', 'cerrar sesión');
	}
}