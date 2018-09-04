<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institucion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ServicioModel');
		// carga los datos
		$this->load->model('DatosModel');

		date_default_timezone_set('America/Santiago');
	}

	public function index()
	{
		//$data['categorias'] = $this->CategoriaModel->obtenerCategorias();

		$this->load->view('/template/head');
		$this->load->view('Institucion/index');
		$this->load->view('/template/footer');
	}

	public function consultaInstitucion()
	{
		if ( function_exists( 'date_default_timezone_set' ) )
		{
			date_default_timezone_set('America/Santiago');
		}

		$config['upload_path'] = '././assets/archivos';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc';
		$config['max_size'] = 2000;
		$config['max_width'] = 5418;
		$config['max_height'] = 3048;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('archivo'))
		{
			
			//$error = array('error' => $this->upload->display_errors());
			//$this->session->mensaje_email = '<font color="red">Ocurrio un error. Intentelo denuevo</font>';
			$this->session->mensaje_email = $this->upload->display_errors();
			redirect(base_url("index.php/Institucion"));
		} else {
			$data = array('upload_data' => $this->upload->data());
			$file_name = $this->upload->data('file_name');
			//$base = 'localhost/redelect/';
			$base = 'https://www.redelect.cl/';

			//Cargamos la librería email
			$this->load->library('email');

			$institucion = $this->input->post('institucion');
			$nombre = $this->input->post('nombre');
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');
			$mensaje = $this->input->post('mensaje');

			//Indicamos el protocolo a utilizar
			$config['protocol'] = 'smtp';

			//El servidor de correo que utilizaremos
			$config["smtp_host"] = 'ssl://mail.redelect.cl';

			//Nuestro usuario
			$config["smtp_user"] = 'notificador2@redelect.cl';

			//Nuestra contraseña
			$config["smtp_pass"] = 'NotRed*2020';

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

			
			$this->email->to('whernandez@redelect.cl', 'Walter Hernandez');
			//$this->email->to('luimatam@developersur.cl', 'Walter Hernandez');

			//Definimos el asunto del mensaje
			$this->email->subject('Consulta web');

			//Definimos el mensaje a enviar
			$this->email->message(
				'Institución: ' . $institucion . '<br>'.
				'Nombre contacto: ' . $nombre . '<br>'.
				'Telefono: ' . $telefono. '<br>' .
				'Email: '. $email. '<br>'.
				'Mensaje: '. $mensaje
			);

			//adjuntamos archivo
			$this->email->attach($base.'assets/archivos/'.$file_name);

			//Enviamos el email y si se produce bien o mal que avise con una flasdata
			if($this->email->send()){
				$this->session->mensaje_email = '<font color="green">Mensaje enviado</font>';
			}else{
				$this->session->mensaje_email = $this->email->print_debugger();
				//$this->session->mensaje_email = '<font color="red">Ocurrio un error. Intentelo denuevo</font>';
			}

			redirect(base_url("index.php/Institucion"));

		}
	}
}
