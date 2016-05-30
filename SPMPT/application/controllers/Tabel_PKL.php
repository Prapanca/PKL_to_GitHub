<?php
	class Tabel_PKL extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model("tabel");
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
			$data['row'] = $this->tabel->getTabel_PKL();
			$data['linkKeluar'] = "Home/logOut/";
			$this->load->view("tabel_pkl",$data);
		}
	}
?>