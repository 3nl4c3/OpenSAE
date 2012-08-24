<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase model que ejecuta metodos para el manejo de sesiones y  autentificaciones.
 * @author      Saúl Espinosa <rinku@moobky.com>
 * @package     OpenSAE
 * @subpackage  autentificación
 * @license     http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version     1.0.1
 */
class Sesion_Model extends CI_Model {

	private $tb_usuarios = 'osae_usuarios';
	private $tb_error_login = 'osae_error_login';
    private $en_sesion = FALSE;

    /**
     * metodo constructor, otra de sus funciones es inicializar la variable de en_sesion
     * para verificar si el usuario esta en sesion (true) o no (false).
     */
    public function __construct()
    {
       parent::__construct();
       $this->en_sesion = $this->session->userdata('easo_logged_IN');
    }

    /**
     * metodo que comprueba si el usuario y su password coninciden con los que
     * proporciono anteriormente y ya se encuentran en la tabla de usuarios. Si el usuario
     * o contraseña no son correctos se hace un error de login.
     * @param 	array 	$datos	los datos de login proporcionados, usuarios y password
     * @return 	boole	Si el usuario existe y su contraseña es correcta TRUE, si no, FALSE
     * @since   1.0.0
     */
    function comprueba_login($datos)
    {
    	$this->db->where($datos);
    	$query = $this->db->get($this->tb_usuarios);
    	if ($query->num_rows() == 1)
    	{
    		return $query->row('id_usuario');
    	}
    	else
    	{
    		//$this->_error_login($datos['usuario']); no se usa por el momento.
    		return FALSE;
    	}
    }

    /**
     * metodo privado que proporciona la opciones de guardar en la tabla correspondiente los intentos
     * de un usuario por iniciar sesión.
     * @param   int  $id_usuario id del usuario.
     * @return  void
     * @since   1.0.0
     */
    private function _error_login($usuario = 0)
    {
    	$this->db->insert($this->tb_error_login, array(
    		'usuario_tipeado' => $usuario
    	));
    }

    /**
     * metodo con el cual se general los permisos extraidos de la base de datos, primero se comprueba que el usuario este en sesión para despues
     * generar sus permisos y verificar que tenga acceso a siertos modulos o acciones dentro del sistema.
     * @param  string   $sin_permiso_redirect   uri de la pagina a la que se quiere redirigir si no se tiene permisos.
     * @param  string   $sin_permiso_mensaje    mensaje que aparece cuando no se tiene permisos.
     * @return void
     * @since  1.0.0
     */
    public function genera_permisos($sin_permiso_redirect = 'iniciar-sesion', $sin_permiso_mensaje = 'Es necesario que inicie sesión para entrar a esta área')
    {
    	if ($this->en_sesion == TRUE)
    	{
    		return TRUE;
    	}
    	else
        {
            $this->session->set_flashdata('mensaje_temporal', $sin_permiso_mensaje);
            redirect($sin_permiso_redirect);
            exit($sin_permiso_mensaje);
        }
    }

    /**
     * comprueba que el usuario efectivamente no esta en sesión, principalmente funciona para
     * no ver el login cuando ya ha ingresdo al sistema.
     * @param   string   $esta_logueado_redirect     uri de donde se desea redirigir al usuario si está logueado.
     * @return  void
     */
    public function no_esta_logueado($esta_logueado_redirect = 'index')
    {
    	if ($this->en_sesion == TRUE)
        {
            redirect($esta_logueado_redirect);
        }
    }

}

/* End of file sesion_model.php */
/* Location: ./application/model/sesion_model.php */