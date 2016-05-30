<?php
	class Detail extends CI_Controller{
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
		
		public function index($nim=""){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nim'] = $nim;
			$data['nama'] = $this->aktor->getNama();
			$data['row'] = $this->tabel->detailTA($nim);
			$data['linkKeluar'] = "Detail/logOut/";
			$this->load->view("detail_ta",$data);
		}
	}
?>