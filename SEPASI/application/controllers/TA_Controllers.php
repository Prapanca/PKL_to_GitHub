<?php
	class TA_Controllers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model('TA_Models');
			$this->ta_models = new TA_Models();
			$this->load->helper(array('form', 'url'));
			$this->load->helper('url');
			$this->load->library('session');
		}
		
		public function logOut(){
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Keluar dari Sistem Pengeloalaan Skripsi', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function tabel_ta($tahun = null){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if($tahun == null){
				$data['row'] = $this->ta_models->getTabelTA();
			}
			else{
				$data['row'] = $this->ta_models->getTabelTA($tahun);
			}
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$this->load->view('tabel_ta', $data);
		}
		
		public function get_all_nim(){
			$query = $this->ta_models->read(null);
			$i=0;
			foreach($query->result() as $result){
				$data[$i] = $result->nim;
				$i++;
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
		
		public function get_mahasiswa_ta($nim = null){
			$query = $this->ta_models->read(array('nim'=>$nim));
			if($query->num_rows() > 0){
				foreach($query->result() as $result){
					$data['name'] = $result->name;
					$data['angkatan'] = $result->angkatan;
				}
			}else{
				$data = null;
			}
			
			header('Content-Type: application/json');
			echo json_encode($data);
		}
		
		function form_ta(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			//$data[;
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$this->load->view('form_ta',
									array('error' => ' ',
										'nama'=> $this->aktor->getNama(),
										'linkKeluar'=> 'logOut',
										'dosen'=> $this->ta_models->dosen(),
										'status_smt' => $query_semester['status_smt'],
										'thn_ajaran' => $query_semester['thn_ajaran'],
										)
							);
		}
		
		function semester(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$query = $this->db->query("SELECT * FROM semester");
			$query = $query->row_array();
			$data['id'] = $query['id'];
			$data['semester'] = $query['status_smt'];
			$data['thn_ajaran'] = $query['thn_ajaran'];
			
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$this->load->view('semester', $data);
		}
		
		function semester_edit($id){
			$semester = $this->input->post('semester');
			$thn_ajaran = $this->input->post('tahun');
			
			$data = array('semester'=>$semester, 'thn_ajaran'=>$thn_ajaran);
			$update = $this->db->query("UPDATE semester SET status_smt='".$semester."', thn_ajaran='".$thn_ajaran."' WHERE id='".$id."'");
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		function submitTA(){
			if(!is_null($this->ta_models->detailTA($this->input->post('nim')))){
				$query_semester = $this->db->query("SELECT * FROM semester");
				$query_semester = $query_semester->row_array();
				if(!$this->session->has_userdata('login'))
					redirect('/Login');
				//echo "Hello";
					$this->load->view('form_ta',
									array('error2' => ' nim '.$this->input->post('nim').' terdaftar, silahkan edit <a href="'.base_url()."index.php/TA_Controllers/detailTA/".$this->input->post('nim').'">disini</a>',
										'nama'=> $this->aktor->getNama(),
										'linkKeluar'=> 'logOut',
										'dosen'=> $this->ta_models->dosen(),
										'status_smt' => $query_semester['status_smt'],
										'thn_ajaran' => $query_semester['thn_ajaran'],
										)
							);
			return;
			}
			if(!is_dir(''.$this->input->post('nim'))){
				$config['upload_path']      = './Uploads/'.$this->input->post('nim');
				mkdir($config['upload_path'], 0777);
			}
			
			/*	Upload Foto */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 1000;
			
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
			$config['max_size']             = 40000;
			
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
			$config['max_size']             = 40000;
			
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
			
			/*	/Upload File Dokumen per_bab .zip/.rar*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'zip|rar';
			$config['max_size']             = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file4']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file4']['name']= $files['file4']['name'][$i];
				$_FILES['file4']['type']= $files['file4']['type'][$i];
				$_FILES['file4']['tmp_name']= $files['file4']['tmp_name'][$i];
				$_FILES['file4']['error']= $files['file4']['error'][$i];
				$_FILES['file4']['size']= $files['file4']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('file4');
				$uploadFile = $this->upload->data()['file_name'];
				$data['dokumen_per_bab'] = $uploadFile;
			}
			/*	./Upload File Dokumen per_bab .zip/.rar*/
			
			/*	/Upload File .ppt / .pptx*/
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'ppt|pptx';
			$config['max_size']             = 5050;
			
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
			
			/*	/Upload File Artikel Ilmiah .doc */
			$config							= array();
			$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
			$config['allowed_types']        = 'doc|docx';
			$config['max_size']             = 40000;
			
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
			/*	./Upload File Artikel Ilmiah .doc*/
			
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
			
			$this->ta_models->submitTA($data);
			redirect ('TA_Controllers/detailTA/'.$this->input->post('nim'));
		}
		
		function TampilPdf($nim){
			$this->load->library('pdf');
			$data = $this->ta_models->detailTA($nim);
			$array = array(
				'nama'	=> $data[0]->name,
				'nim'	=> $data[0]->nim,
				'judul' => $data[0]->judul,
			);
			$this->pdf->Tampil($array);
		}
		
		function detailTA($nim){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				{redirect('/Login');}
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->ta_models->detailTA($nim);
			$data['nimPDF'] = $nim;			
			$this->load->view('detail_ta', $data);
		}
		
		function editTA($nim){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "../logOut";
			$data['row'] = $this->ta_models->editTA($nim);
			$data['dosen'] = $this->ta_models->dosen();
			$this->load->view('form_ta_edit', $data);
		}
		
		function deleteTA($nim){
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Menghapus Data Dokumen Skripsi', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->ta_models->deleteTA($nim);
			redirect ('TA_Controllers/tabel_ta');
		}
		
		function update(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			/* Cek File Mahasiswa */
			$this->load->database();
			$nim = $this->input->post('nim');
			$this->db->where('nim', $nim);
			$mahasiswa = $this->db->get('mahasiswa')->result_array()[0];
			$makalah_ta = $this->db->get('makalah_ta')->result_array()[0];
			/* #/Cek File Mahasiswa */
			
			/*	Upload Foto */
			if($_FILES['foto']['name']!=null){
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
			}else{
				$data['foto'] = null;
			}
			/*	./Upload Foto */
			
			/*	Upload File .DOC */
			if($_FILES['doc']['name']!=null){
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
						if (!empty($makalah_ta['doc'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['doc'];
							unlink($path);
						}
					}
					$data['doc'] = $uploadFile;
				}
			}else{
				$data['doc'] = null;
			}
			/*	./Upload File .DOC*/
			
			/*	/Upload File .PDF*/
			if($_FILES['pdf']['name']!=null){
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
						if (!empty($makalah_ta['pdf'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['pdf'];
							unlink($path);
						}
					}
					$data['pdf'] = $uploadFile;
				}
			}else{
				$data['pdf'] = null;
			}
			/*	./Upload File .PDF*/
			
			/*	/Upload File Dokumen per_bab .zip/.rar*/
			if($_FILES['file4']['name']!=null){
				$config							= array();
				$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
				$config['allowed_types']        = 'zip|rar';
				$config['max_size']             = 100000;
				
				$this->load->library('upload');

				$files = $_FILES;
				$cpt = count($_FILES['file4']['name']);
				for($i=0; $i<$cpt; $i++)
				{
					$_FILES['file4']['name']= $files['file4']['name'][$i];
					$_FILES['file4']['type']= $files['file4']['type'][$i];
					$_FILES['file4']['tmp_name']= $files['file4']['tmp_name'][$i];
					$_FILES['file4']['error']= $files['file4']['error'][$i];
					$_FILES['file4']['size']= $files['file4']['size'][$i];    

					$this->upload->initialize($config);
					$this->upload->do_upload('file4');
					$uploadFile = $this->upload->data()['file_name'];
					if (!empty($uploadFile)){
						if (!empty($makalah_ta['dokumen_per_bab'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['dokumen_per_bab'];
							unlink($path);
						}
					}
					$data['dokumen_per_bab'] = $uploadFile;
				}
			}else{
				$data['file4'] = null;
			}
			/*	./Upload File Dokumen per_bab .zip/.rar*/
			
			/*	/Upload File .ppt / .pptx*/
			if($_FILES['ppt']['name']!=null){
				$config							= array();
				$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
				$config['allowed_types']        = 'ppt|pptx';
				$config['max_size']             = 5050;
				
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
						if (!empty($makalah_ta['ppt'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['ppt'];
							unlink($path);
						}
					}
					$data['ppt'] = $uploadFile;
				}
			}else{
				$data['ppt'] = null;
			}

			/*	./Upload File .ppt / .pptx*/
			
			/*	/Upload File SorceCode .zip/.rar */
			if($_FILES['file1']['name']!=null){
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
						if (!empty($makalah_ta['source_code'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['source_code'];
							unlink($path);
						}
					}
					$data['source_code'] = $uploadFile;
				}
			}else{
				$data['file1'] = null;
			}
			/*	./Upload File SorceCode .zip/.rar*/
			
			/*	/Upload File Artikel Ilmiah .doc */
			if($_FILES['file2']['name']!=null){
				$config							= array();
				$config['upload_path']			= './Uploads/'.$this->input->post('nim').'/';
				$config['allowed_types']        = 'doc|docx';
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
						if (!empty($makalah_ta['artikel_ilmiah'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['artikel_ilmiah'];
							unlink($path);
						}
					}
					$data['artikel_ilmiah'] = $uploadFile;
				}
			}else{
				$data['file2'] = null;
			}
			/*	./Upload File Artikel Ilmiah .doc */
			
			/*	/Upload File Lampiran .zip/.rar*/
			if($_FILES['file3']['name']!=null){
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
						if (!empty($makalah_ta['lampiran'])){
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim.'\\'.$makalah_ta['lampiran'];
							unlink($path);
						}
					}
					$data['lampiran'] = $uploadFile;
				}
			}else{
				$data['file3'] = null;
			}
			/*	./Upload File Lampiran .zip/.rar*/
			
			$this->ta_models->update($data);
			$this->session->set_flashdata('status', 'Sukses');
			redirect ('TA_Controllers/detailTA/'.$nim.'');
		}
		
	}
?>