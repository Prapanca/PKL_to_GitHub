<?php
	class Form extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function dosen(){
			$query = $this->db->query('SELECT * FROM dosen');
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function submit(){
			$form = array(
				'nim' => $this->input->post('nim'),
				'nip' => $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
			);
			$this->db->insert('makalah_ta',$form);
			
			$form2 = array(
				'nim' => $this->input->post('nim'),
				'name' => $this->input->post('name'),
				'angkatan' => $this->input->post('angkatan'),
			);
			$this->db->insert('mahasiswa',$form2);
			redirect("/Tabel_TA");
		}
		
	}
?>