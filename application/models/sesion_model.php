<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion_Model extends CI_Model {

	private $tabla_usuarios = 'osae_usuarios';
	private $error_login = 'osae_error_login';

    public function __construct()
    {
       parent::__construct();
    }

    /**
     * Metodo que comprueba si el usuario y su password coninciden con los que
     * proporciono anteriormente y ya se encuentran en la tabla de usuarios. Si el usuario
     * o contraseña no son correctos se hace un error de login.
     * @param 	array 	$datos	los datos de login proporcionados, usuarios y password
     * @return 	boole	Si el usuario existe y su contraseña es correcta TRUE, si no, FALSE
     */
    function comprueba_login($datos)
    {
    	$this->db->where($datos);
    	$query = $this->db->get($this->tabla_usuarios);
    	if ($query->num_rows() == 1)
    	{
    		return $query->row('id_usuario');
    	}
    	else
    	{
    		$this->_error_login($datos['usuario']);
    		return FALSE;
    	}
    }

    private function _error_login($usuario)
    {
    	$this->db->insert($this->error_login, array(
    		'usuario_tipeado' => $usuario
    	));
    }

}

/* End of file sesion_model.php */
/* Location: ./application/controllers/sesion_model.php */