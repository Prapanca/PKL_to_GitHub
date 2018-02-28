<?php
	class Login extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->helper('url');
			$this->load->database();
		}
		
		function authentication(){
			if($this->input->post('username') === null){
				redirect("/Login");
				return;
			}
			if($this->input->post('password') === null){
				redirect("/Login");
				return;
			}
			if($this->aktor->setAktor($this->input->post('username'),$this->input->post('password')))
			{
				$data['status'] = $this->aktor->getStatus();
				$data = array('id_admin' => $data['status'], 'aksi'=>'Masuk dari Sistem Pengelolaan Skripsi', 'tujuan'=>0);	
				redirect('/TA_Controllers/tabel_ta');
			}
			else{
				redirect("/Login");
			}

		}
		
		public function index(){
			$status = $this->aktor->getStatus();
			if(!is_bool($status)){
				if(intval($status) == 1)
					redirect('/Aktifitas');
				else
					redirect('/TA_Controllers/tabel_ta');
				return;
			}
			$this->load->view("login");
		}
	}
?>