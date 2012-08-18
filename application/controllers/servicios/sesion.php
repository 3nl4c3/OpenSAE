<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de sesiones, es una clase de servicios ya que
 * puede que sea compartido entre ambos tipos de capas.
 */
class Sesion extends CI_Controller {

	/**
	 * Metodo contructos.
	 * 
	 */
	public function __construct()
	{
	   parent::__construct();
	}

	/**
	 * 
	 */
	public function index()
	{
		//Página de formulario para iniciar sesión
		$this->load->view('servicios/sesion/login_form');
	}

	/**
	 * Metodo de para que el usuario pueda iniciar sesión
	 * 
	 */
	public function login()
	{
		
	}

	/**
	 * Metodo de para que el usuario pueda cerrar su sesión
	 * 
	 */
	public function logout()
	{

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */