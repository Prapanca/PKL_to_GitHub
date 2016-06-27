<?php
	class TA_Controllers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model('ta_models');
			$this->load->helper(array('form', 'url'));
			$this->load->helper('url');
			$this->load->library('session');	
		}
		
		public function logOut(){
			$data = array('id_admin'=>1, 'aksi'=>'Keluar dari Sistem Penyimpanan Laporann PKL dan Makalah TA', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function tabel_ta(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['row'] = $this->ta_models->getTabelTA();
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$this->load->view('tabel_ta', $data);
		}
		
		function form_ta(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$this->load->view('form_ta', array('error' => ' ','nama'=> $this->aktor->getNama(), 'linkKeluar'=> 'logOut', 'dosen'=> $this->ta_models->dosen()));
		}
		
		function submitTA(){
			/*	Upload Foto */
			$config							= array();
			$config['upload_path']          = './Uploads/'.$this->session->userdata('nim').'/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			
			mkdir($config['upload_path'], 0777);
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['foto']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['foto']['name']= $files['foto']['name'][$i];
				$_FILES['foto']['type']= $files['foto']['type'][$i];
				$_FILES['foto']['tmp_name']= $files['foto']['tmp_name'][$i];
				$_FILES['foto']['error']= $files['foto']['error'][$i];
				$_FILES['foto']['size']= $files['foto']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('foto');
			}
			/*	./Upload Foto */
			
			/*	Upload File */
			$data							= array();
			$data['upload_path']          = './uploads/';
			$data['allowed_types']        = 'pdf|ppt|pptx|doc|docx|rar|zip|txt';
			$data['max_size']             = 0;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file']['name']= $files['file']['name'][$i];
				$_FILES['file']['type']= $files['file']['type'][$i];
				$_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
				$_FILES['file']['error']= $files['file']['error'][$i];
				$_FILES['file']['size']= $files['file']['size'][$i];    

				$this->upload->initialize($data);
				$this->upload->do_upload('file');
			}
			/*	./Upload File */
			
			$this->ta_models->submitTA();
			redirect ('TA_Controllers/tabel_ta');
			
		}
		
		function detailTA($nim){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->ta_models->detailTA($nim);
			$this->load->view('detail_ta', $data);
		}
		
		function editTA($nim){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->ta_models->editTA($nim);
			$this->load->view('form_ta_edit', $data);
		}
		
		function deleteTA($nim){
			$data = array('id_admin'=>1, 'aksi'=>'Menghapus Data Makalah TA', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->ta_models->deleteTA($nim);
			redirect ('TA_Controllers/tabel_ta');
		}
		
		function update(){
			$this->ta_models->update();
			redirect ('TA_Controllers/tabel_ta');
		}
		
		function form_ta_edit(){
			$data ['dosen'] = $this->ta_models->dosen();
			$this->load->view('form_ta_edit', $data);
		}
		
	}
?>