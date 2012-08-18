<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de usuarios, para cuando no han iniciado sesión.
 * 
 */
class Usuario extends CI_Controller {

	/**
	 * Metodo contructo que carga la instacia de los permisos.
	 * 
	 */
	public function __construct()
	{
	   parent::__construct();
	}

	/**
	 * Metodo principal que muestra el login de usuario.
	 * 
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */