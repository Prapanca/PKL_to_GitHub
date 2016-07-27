<?php
	class PKL_Controllers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model('pkl_models');
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
		
		public function tabel_pkl($nim = NULL){
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['row'] = $this->pkl_models->getTabelPKL();
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$data['nimPDF'] = $nim;
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
				$uploadFile = $this->upload->data()['file_name'];
				$data['foto'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				$data['doc'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				$data['pdf'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				$data['ppt'] = $uploadFile;
			}
			/*	./Upload File .ppt / .pptx*/
			
			/*	/Upload File SorceCode .zip/.rar */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file1']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file1']['name']= $files['file1']['name'][$i];
				$_FILES['file1']['type']= $files['file1']['type'][$i];
				$_FILES['file1']['tmp_name']= $files['file1']['tmp_name'][$i];
				$_FILES['file1']['error']= $files['file1']['error'][$i];
				$_FILES['file1']['size']= $files['file1']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file1');
				$uploadFile = $this->upload->data()['file_name'];
				$data['source_code'] = $uploadFile;
			}
			/*	./Upload File SorceCode .zip/.rar*/
			
			/*	/Upload File Artikel Ilmiah .zip/.rar */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file2']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file2']['name']= $files['file2']['name'][$i];
				$_FILES['file2']['type']= $files['file2']['type'][$i];
				$_FILES['file2']['tmp_name']= $files['file2']['tmp_name'][$i];
				$_FILES['file2']['error']= $files['file2']['error'][$i];
				$_FILES['file2']['size']= $files['file2']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file2');
				$uploadFile = $this->upload->data()['file_name'];
				$data['artikel_ilmiah'] = $uploadFile;
			}
			/*	./Upload File Artikel Ilmiah .zip/.rar*/
			
			/*	/Upload File Lampiran .zip/.rar*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file3']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file3']['name']= $files['file3']['name'][$i];
				$_FILES['file3']['type']= $files['file3']['type'][$i];
				$_FILES['file3']['tmp_name']= $files['file3']['tmp_name'][$i];
				$_FILES['file3']['error']= $files['file3']['error'][$i];
				$_FILES['file3']['size']= $files['file3']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file3');
				$uploadFile = $this->upload->data()['file_name'];
				$data['lampiran'] = $uploadFile;
			}
			/*	./Upload File Lampiran .zip/.rar*/
			
			$this->pkl_models->submitPKL($data);
			redirect ('PKL_Controllers/tabel_pkl/'.$this->input->post('nim'));
		}
		
		function TampilPdf($nim){
			$this->load->library('pdf');
			$data = $this->pkl_models->detailPKL($nim);
			$array = array(
				'nama'	=> $data[0]->name,
				'nim'	=> $data[0]->nim,
				'judul' => $data[0]->judul
			);
			$this->pdf->Tampil($array);
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
			$data['dosen'] = $this->pkl_models->dosen();
			$this->load->view('form_pkl_edit', $data);
		}
		
		function deletePKL($nim){
			$data = array('id_admin'=>1, 'aksi'=>'Menghapus Data Laporan Praktik Kerja Lapangan', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->pkl_models->deletePKL($nim);
			redirect ('PKL_Controllers/tabel_pkl');
		}
		
		function update(){
			/* Cek File Mahasiswa */
			$this->load->database();
			$nim = $this->input->post('nim');
			$this->db->where('nim', $nim);
			$mahasiswa = $this->db->get('mahasiswa')->result_array()[0];
			$makalah_pkl = $this->db->get('makalah_pkl')->result_array()[0];
			/* #/Cek File Mahasiswa */
			
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
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($mahasiswa['foto'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$mahasiswa['foto'];
						unlink($path);
					}
				}
				$data['foto'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['doc'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['doc'];
						unlink($path);
					}
				}
				$data['doc'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['pdf'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['pdf'];
						unlink($path);
					}
				}
				$data['pdf'] = $uploadFile;
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
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['ppt'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['ppt'];
						unlink($path);
					}
				}
				$data['ppt'] = $uploadFile;
			}
			/*	./Upload File .ppt / .pptx*/
			
			/*	/Upload File SorceCode .zip/.rar */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file1']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file1']['name']= $files['file1']['name'][$i];
				$_FILES['file1']['type']= $files['file1']['type'][$i];
				$_FILES['file1']['tmp_name']= $files['file1']['tmp_name'][$i];
				$_FILES['file1']['error']= $files['file1']['error'][$i];
				$_FILES['file1']['size']= $files['file1']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file1');
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['source_code'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['source_code'];
						unlink($path);
					}
				}
				$data['source_code'] = $uploadFile;
			}
			/*	./Upload File SorceCode .zip/.rar*/
			
			/*	/Upload File Artikel Ilmiah .zip/.rar */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file2']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file2']['name']= $files['file2']['name'][$i];
				$_FILES['file2']['type']= $files['file2']['type'][$i];
				$_FILES['file2']['tmp_name']= $files['file2']['tmp_name'][$i];
				$_FILES['file2']['error']= $files['file2']['error'][$i];
				$_FILES['file2']['size']= $files['file2']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file2');
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['artikel_ilmiah'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['artikel_ilmiah'];
						unlink($path);
					}
				}
				$data['artikel_ilmiah'] = $uploadFile;
			}
			/*	./Upload File Artikel Ilmiah .zip/.rar*/
			
			/*	/Upload File Lampiran .zip/.rar*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file3']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file3']['name']= $files['file3']['name'][$i];
				$_FILES['file3']['type']= $files['file3']['type'][$i];
				$_FILES['file3']['tmp_name']= $files['file3']['tmp_name'][$i];
				$_FILES['file3']['error']= $files['file3']['error'][$i];
				$_FILES['file3']['size']= $files['file3']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file3');
				$uploadFile = $this->upload->data()['file_name'];
				if (!empty($uploadFile)){
					if (!empty($makalah_pkl['lampiran'])){
						$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_pkl['lampiran'];
						unlink($path);
					}
				}
				$data['lampiran'] = $uploadFile;
			}
			/*	./Upload File Lampiran .zip/.rar*/
			
			$this->pkl_models->update($data);
			redirect ('PKL_Controllers/tabel_pkl');
		}
		
	}
?>