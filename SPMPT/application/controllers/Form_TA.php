<?php
	class Form_TA extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model("form");
			$this->load->model("tabel");
			$this->load->helper("url");
			$this->load->library("session");
			
		}
		public function logOut(){
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		function formTA(){
			$form = array(
				'nim' => $this->input->post('nim'),
				'nip' => $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
			);
			$this->form->savedata('makalah_ta',$form);
			
			$form2 = array(
				'nim' => $this->input->post('nim'),
				'name' => $this->input->post('name'),
				'angkatan' => $this->input->post('angkatan'),
			);
			$this->form->savedata('mahasiswa',$form2);
			redirect("/Tabel_TA");
		}
		
		public function index($nim=""){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['dosen'] = $this->form->getNama();
			$data['tahun'] = $this->form->getTahun();
			if ($nim == "")
				$data['row'] = NULL ;
			else 
				$data['row'] = $this->tabel->detailTA($nim);
			
			$data['linkKeluar'] = "Home/logOut/";
			$this->load->view("forms_ta",$data);
		}
	}
?>