<?php
	class Home extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->helper("url");
			$this->load->library("session");
		}
		public function logOut(){
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function index(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "Home/logOut/";
			$this->load->view("home",$data);
		}
	}
?>