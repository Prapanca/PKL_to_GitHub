<?php
	class Admin extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->helper(array('form', 'url'));
			$this->load->helper('url');
			$this->load->library('session');
			
		}
		
		public function logOut(){
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Keluar dari Sistem Pengelolaan Skripsi', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function profil($idUser=''){
			$idUser= intval($idUser);
			if($idUser < 1 || $idUser > 2){
				$idUser=$this->aktor->getStatus();
			}

			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['linkKeluar'] = base_url()."index.php/Admin/logOut";
			$data['status'] = $idUser.'';
			$data['nama'] = $this->aktor->getNama();
			if($idUser==''){
				$data['row'] = $this->aktor->getAdmin($this->session->userdata('id'))->row_array();
			}else{
				$data['row'] = $this->aktor->getAdmin($idUser)->row_array();
			}
			$this->load->view('profil_admin_detail', $data);
		}
		
		public function profil_admin(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['linkKeluar'] = "logOut";
			$data['status'] = $this->aktor->getStatus();
			$data['nama'] = $this->aktor->getNama();
			$data['data'] = $this->aktor->dataAdmin();
			$this->load->view('profil_admin', $data);
		}
		
		function edit_profil(){
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
			$data['dosen'] = $this->ta_models->dosen();
			$this->load->view('profil', $data);
		}
		
		function update(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			/* Cek File Admin */
			$this->load->database();
			$id_admin = $this->input->post('id_admin');
			$this->db->where('id_admin', $id_admin);
			$admin = $this->db->get('admin')->result_array()[0];
			/* #/Cek File Admin */
			
			/*	Upload Foto */
			if($_FILES['foto']['name']!=null){
				$config							= array();
				$config['upload_path']			= './Uploads/'.$this->input->post('id_admin').'/';
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
							$path= str_ireplace('\application','',APPPATH).'uploads\\'.$id_admin.'\\'.$admin['foto'];
							unlink($path);
						}
					}
					$data['foto'] = $uploadFile;
				}
			}else{
				$data['foto'] = null;
			}
			/*	./Upload Foto */
			
			$this->aktor->update($data);
			//$this->session->set_flashdata('status', 'Sukses');
			//redirect ('TA_Controllers/detailTA/'.$nim.'');
		}
		
		public function simpan_profil(){
			$id = $this->input->post('id_admin');
			$id= intval($id);
			if($id < 1 || $id > 2){
				$id=$this->aktor->getStatus();
			}
			$id.='';
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$name = $this->input->post('name');
			$nip = $this->input->post('nip');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$foto = $this->input->post('foto');
			
			$data = array(
				'name'=>$name,
				'nip'=>$nip,
				'username'=>$username,
				'password'=> md5($password),
				'foto'=>$foto
			);
			$update = $this->aktor->update($id, $data);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
?>