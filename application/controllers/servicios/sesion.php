<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de sesiones, es una clase de servicios ya que
 * puede que sea compartido entre ambos tipos de capas.
 */
class Sesion extends CI_Controller {

	/**
	 * Metodo constructor.
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sesion_model');
	}

	/**
	 * 
	 */
	public function index()
	{
		if ($this->session->userdata('easo_logged_IN'))
		{
			exit();
		}
		//Página de formulario para iniciar sesión
		$this->load->view('servicios/sesion/login_form');
	}

	/**
	 * Metodo de para que el usuario pueda iniciar sesión
	 * 
	 */
	public function login()
	{
		if ($this->session->userdata('easo_logged_IN'))
		{
			exit();
		}
		$this->load->library('form_validation');
		$this->load->helper('text');

		$this->form_validation->set_rules('usuario', 'correo electrónico', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('contrasenia', 'contraseña', 'trim|required|min_length[6]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('servicios/sesion/login_form');
		}
		else
		{
			$sesion = array(
				'usuario' => convert_accented_characters($this->input->post('usuario')),
				'password' => md5($this->input->post('contrasenia'))
			);
			$id_usuario = $this->sesion_model->comprueba_login($sesion);
			if ($id_usuario != FALSE) 
			{
				$datos_sesion = array(
                   'easo_ID_user'  => $id_usuario,
                   'easo_logged_IN' => TRUE
               );

				$this->session->set_userdata($datos_sesion);
			}
			else
			{
				redirect('servicios/sesion/login');
			}
		}
	}

	/**
	 * Metodo de para que el usuario pueda cerrar su sesión
	 * 
	 */
	public function logout()
	{
		$datos_sesion = array(
			'easo_ID_user'  => '',
			'easo_logged_IN' => FALSE
		);

		$this->session->unset_userdata($datos_sesion);
		$this->session->sess_destroy();
		redirect('index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */