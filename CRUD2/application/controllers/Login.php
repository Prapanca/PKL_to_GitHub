<?php
	class Login extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->helper('url');
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
				$data = array('id_admin'=>$this->aktor->getNama(), 'aksi'=>'Masuk dari Sistem Penyimpanan Laporann PKL dan Makalah TA', 'tujuan'=>0);
				$this->db->insert('aktifitas',$data);
				redirect("/Aktifitas");
			}
			else{
				redirect("/Login");
			}

		}
		
		public function index(){
			$this->load->view("login");
		}
	}
?>