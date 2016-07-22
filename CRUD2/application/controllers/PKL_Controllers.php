<?php
	class PKL_Controllers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model('PKL_models');
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
		
		public function tabel_pkl(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['row'] = $this->pkl_models->getTabelPKL();
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$this->load->view('tabel_pkl', $data);
		}
		
		function form_pkl(){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$this->load->view('form_pkl', array('error' => ' ','nama'=> $this->aktor->getNama(), 'linkKeluar'=> 'logOut', 'dosen'=> $this->pkl_models->dosen()));
		}
		
		function submitPKL(){
			if(!is_dir(''.$this->input->post('nim'))){
				$config['upload_path']      = './Uploads/'.$this->input->post('nim');
				mkdir($config['upload_path'], 0777);
			}
			
			/*	Upload Foto */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			
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
			
			/*	Upload File .DOC */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'doc|docx';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['doc']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['doc']['name']= $files['doc']['name'][$i];
				$_FILES['doc']['type']= $files['doc']['type'][$i];
				$_FILES['doc']['tmp_name']= $files['doc']['tmp_name'][$i];
				$_FILES['doc']['error']= $files['doc']['error'][$i];
				$_FILES['doc']['size']= $files['doc']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('doc');
			}
			/*	./Upload File .DOC*/
			
			/*	/Upload File .PDF*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['pdf']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['pdf']['name']= $files['pdf']['name'][$i];
				$_FILES['pdf']['type']= $files['pdf']['type'][$i];
				$_FILES['pdf']['tmp_name']= $files['pdf']['tmp_name'][$i];
				$_FILES['pdf']['error']= $files['pdf']['error'][$i];
				$_FILES['pdf']['size']= $files['pdf']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('pdf');
			}
			/*	./Upload File .PDF*/
			
			/*	/Upload File .ppt / .pptx*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'ppt|pptx';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['ppt']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['ppt']['name']= $files['ppt']['name'][$i];
				$_FILES['ppt']['type']= $files['ppt']['type'][$i];
				$_FILES['ppt']['tmp_name']= $files['ppt']['tmp_name'][$i];
				$_FILES['ppt']['error']= $files['ppt']['error'][$i];
				$_FILES['ppt']['size']= $files['ppt']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('ppt');
			}
			/*	./Upload File .ppt / .pptx*/
			
			/*	/Upload File SorceCode .zip/.rar */
			/*	./Upload File SorceCode .zip/.rar*/
			
			/*	/Upload File Artikel Ilmiah .zip/.rar */
			/*	./Upload File Artikel Ilmiah .zip/.rar*/
			
			/*	/Upload File Lampiran .zip/.rar*/
			/*	./Upload File Lampiran .zip/.rar*/
			
			function TampilPdf(){
				$this->load->library('pdf');
				$this->pdf->Tampil();
			}
			
			$this->pkl_models->submitPKL();
			redirect ('PKL_Controllers/tabel_pkl');
			
		}
		
		function detailPKL($nim){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->pkl_models->detailPKL($nim);
			$this->load->view('detail_pkl', $data);
		}
		
		function editPKL($nim){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->pkl_models->editPKL($nim);
			$this->load->view('form_pkl_edit', $data);
		}
		
		function deletePKL($nim){
			$data = array('id_admin'=>1, 'aksi'=>'Menghapus Data Makalah PKL', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->pkl_models->deletePKL($nim);
			redirect ('PKL_Controllers/tabel_pkl');
		}
		
		function update(){
			$this->pkl_models->update();
			redirect ('PKL_Controllers/tabel_pkl');
		}
		
		function form_pkl_edit(){
			$data ['dosen'] = $this->pkl_models->dosen();
			$this->load->view('form_pkl_edit', $data);
		}
		
	}
?>