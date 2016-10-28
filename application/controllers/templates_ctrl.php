<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Templates_ctrl extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}

		public function view($view){
			$this->load->view('templates/pages/'.$view);
		}
	}
?>