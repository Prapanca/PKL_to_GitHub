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
			$data = array('id_admin' => $data['status'], 'aksi'=>'Keluar dari Sistem Penyimpanan Laporann PKL dan Makalah TA', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		public function profil(){
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
			$data['row'] = $this->aktor->getAdmin($this->session->userdata('id'))->row_array();
			$this->load->view('profil_admin', $data);
		}
		
		public function simpan_profil(){
			$id = $this->session->userdata('id');
			$name = $this->input->post('name');
			$nip = $this->input->post('nip');
			$username = $this->input->post('username');
			
			$data = array(
				'name'=>$name,
				'nip'=>$nip,
				'username'=>$username
			);
			$update = $this->aktor->update($id, $data);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
?>