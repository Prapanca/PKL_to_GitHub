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
		
		public function simpan_profil(){
			$id = $this->input->post('id_admin');
			$id= intval($id);
			if($id < 1 || $id > 2){
				$id=$this->aktor->getStatus();
			}
			$id.='';
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$name 		= $this->input->post('name');
			$nip		= $this->input->post('nip');
			$email		= $this->input->post('email');
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');

			if(!is_dir('aktor/'.($id == 1 ? 'admin' : 'kajur').'/'))
				{
					mkdir('aktor/'.($id = 1 ? 'admin' : 'kajur'));
				}

			$conPic['upload_path'] = 'aktor/'.($id = 1 ? 'admin' : 'kajur');
			$conPic['allowed_types'] = 'png|jpg';
			$conPic['overwrite'] = true;
			$conPic['remove_spaces'] = true;
			$conPic['max_size'] = 2048;
			$conPic['max_width'] = 1400;
			$conPic['max_height'] = 1800;

			$data = array(
				'name'=>$name,
				'nip'=>$nip,
				'email'=>$email,
				'username'=>$username,
				'password'=> md5($password)
			);
			$this->load->library('upload',$conPic);
			$this->upload->initialize($conPic);
			if(!$this->upload->do_upload('foto')){
				//exit($this->upload->display_errors());	
			}
			else{

				$dataS = $this->upload->data();

				$data['foto'] = $dataS['file_name'];
			}

			
			$update = $this->aktor->update(($id == 'admin' ? 2 : 1), $data);
			//exit(var_dump($id));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
?>