<?php
	class Aktifitas extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model("aktifitas_models");
			$this->load->helper("url");
			$this->load->library("session");
		}
		public function logOut(){
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Keluar dari Sistem Penyimpanan Laporann PKL dan Makalah TA', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function index(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['row'] = $this->aktifitas_models->getAktifitas();
			$data['linkKeluar'] = "Aktifitas/logOut/";
			$this->load->view("aktifitas",$data);
		}
	}
?>