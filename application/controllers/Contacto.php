<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller
{
	public function __construct()
  {
        parent::__construct();
        $this->load->model('CategoriaModel');
        $this->load->model('ServicioModel');
        // carga los datos
		    $this->load->model('DatosModel');
        //$this->session->mensaje_email ='';
				date_default_timezone_set('America/Santiago');
	}

	public function index()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('contacto/contacto');
		$this->load->view('/template/footer');
	}

	public function enviar_correo()
	{
		if ( function_exists( 'date_default_timezone_set' ) )
			date_default_timezone_set('America/Santiago');
		//Cargamos la librería email
    $this->load->library('email');


		$nombre = $this->input->post('name');
		$apellido = $this->input->post('apellido');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');

		//Indicamos el protocolo a utilizar
      $config['protocol'] = 'smtp';

     //El servidor de correo que utilizaremos
      $config["smtp_host"] = 'ssl://mail.redelect.cl';

     //Nuestro usuario
      $config["smtp_user"] = 'notificador@redelect.cl';

     //Nuestra contraseña
      $config["smtp_pass"] = 'notificador';

     //El puerto que utilizará el servidor smtp
      $config["smtp_port"] = '465';

			$config["mailtype"] = 'html';

     //El juego de caracteres a utilizar
      $config['charset'] = 'utf-8';

     //Permitimos que se puedan cortar palabras
      $config['wordwrap'] = TRUE;

     //El email debe ser valido
     $config['validate'] = true;


    //Establecemos esta configuración
      $this->email->initialize($config);

    //Ponemos la dirección de correo que enviará el email y un nombre
      $this->email->from('notificador@redelect.cl', 'Notificador Redelect');

    /*
     * Ponemos el o los destinatarios para los que va el email
     * en este caso al ser un formulario de contacto te lo enviarás a ti
     * mismo
     */
      $this->email->to('whernandez@redelect.cl', 'Walter Hernandez');

    //Definimos el asunto del mensaje
      $this->email->subject('Consulta');

    //Definimos el mensaje a enviar
      $this->email->message(
        'Nombre: ' . $nombre . ' ' . $apellido. '<br>'.
        'Email: ' . $email . '<br>'.
        'Mensaje: ' . $message
      );

      //Enviamos el email y si se produce bien o mal que avise con una flasdata
      if($this->email->send()){
          $this->session->mensaje_email = '<font color="green">Mensaje enviado</font>';
      }else{
          $this->session->mensaje_email = '<font color="red">Ocurrio un error. Intentelo denuevo</font>';
      }

      redirect(base_url("index.php/Contacto"));
	}
}
